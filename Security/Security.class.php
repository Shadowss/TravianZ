<?php
// Security.class.php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009-2012 Kai Ratzeburg                                |
// +----------------------------------------------------------------------+
// | Licensed under the Apache License, Version 2.0 (the "License");      |
// | you may not use this file except in compliance with the License.     |
// | You may obtain a copy of the License at                              |
// | http://www.apache.org/licenses/LICENSE-2.0                           |
// | Unless required by applicable law or agreed to in writing, software  |
// | distributed under the License is distributed on an "AS IS" BASIS,    |
// | WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or      |

// | implied. See the License for the specific language governing         |
// | permissions and limitations under the License.                       |
// +----------------------------------------------------------------------+
// | Author: Kai Ratzeburg <ice-x@live.de>                                |
// +----------------------------------------------------------------------+

// Source Code Highlight 
/* Security Fix; Only dev
if(isset($_GET['show_source']))
{
    highlight_file(__FILE__);
    exit;
}
*/

/**
 * Provides static functions to help protect against cross site scripting
 * attacks and helps clean up the php environment upon initializing.
 *
 * Based upon Security library by http://kohanaphp.com/
 *
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
define('PCRE_UNICODE_PROPERTIES', (bool) preg_match('/^\pL$/u', '?'));

class Security
{
    // Instance of the security class.
    protected static $instance;
    protected $magic_quotes_gpc = FALSE;
    
    /**
     * Gets the instance of the Security class.
     *
     * @return object Instance of Security
     */
    public static function instance()
    {
        if(self::$instance === NULL)
        {
            //return new Security;
        }
        
        //return self::$instance;
    }
    
    
    /**
     * Constructor. Sanitizes global data GET, POST and COOKIE data.
     * Also makes sure those pesty magic quotes and register globals
     * don't bother us. This is protected because it really only needs
     * to be run once.
     *
     * @return void
     */
    protected function __construct()
    {
        if(self::$instance === NULL)
        {
            // Check for magic quotes
            if(get_magic_quotes_runtime())
            {
                // Dear lord!! This is bad and deprected. Sort it out ;)
                set_magic_quotes_runtime(0);
            }
            
            if(get_magic_quotes_gpc())
            {
                // This is also bad and deprected. See http://php.net/magic_quotes for more information.
                $this->magic_quotes_gpc = TRUE;
            }
            
            // Check for register globals and prevent security issues from arising.
            if(ini_get('register_globals'))
            {
                if(isset($_REQUEST['GLOBALS']))
                {
                    // No no no.. just kill the script here and now
                    exit('Illegal attack on global variable.');
                }
                
                // Get rid of REQUEST
                $_REQUEST = array();
                
                // The following globals are standard and shouldn't really be removed
                $preserve = array('GLOBALS', '_REQUEST', '_GET', '_POST', '_FILES', '_COOKIE', '_SERVER', '_ENV', '_SESSION');
                
                // Same effect as disabling register_globals
                foreach($GLOBALS as $key => $value)
                {
                    if( ! in_array($key, $preserve))
                    {
                        global $$key;
                        $$key = NULL;
                        
                        unset($GLOBALS[$key], $$key);
                    }
                }
            }
            
            // Sanitize global data
            
            if(is_array($_POST))
            {
                foreach($_POST as $key => $value)
                {
                    $_POST[$this->clean_input_keys($key)] = $this->clean_input_data($value);
                }
            }
            else
            {
                $_POST = array();
            }
            
            if(is_array($_GET))
            {
                foreach($_GET as $key => $value)
                {
                    $_GET[$this->clean_input_keys($key)] = $this->clean_input_data($value);
                }
            }
            else
            {
                $_GET = array();
            }
            
            if(is_array($_COOKIE))
            {
                foreach($_COOKIE as $key => $value)
                {
                    $_COOKIE[$this->clean_input_keys($key)] = $this->clean_input_data($value);
                }
            }
            else
            {
                $_COOKIE = array();
            }
            
            // Just make REQUEST a merge of POST and GET. Who really wants cookies in it anyway?
            $_REQUEST = array_merge($_GET, $_POST);

            
            self::$instance = $this;
        }
    }
    
    /**
     * Cross site filtering (XSS). Recursive.
     *
     * @param  string Data to be cleaned
     * @return mixed
     */
    public function xss_clean($data)
    {
        // If its empty there is no point cleaning it :\
        if(empty($data))
            return $data;
            
        // Recursive loop for arrays
        if(is_array($data))
        {
            foreach($data as $key => $value)
            {
                $data[$key] = $this->xss_clean($data);
            }
            
            return $data;
        }
        
        // Fix &entity\n;
        $data = str_replace(array('&','<','>'), array('&','<','>'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do
        {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);
        
        return $data;
    }
    
    /**
     * Enforces W3C specifications to prevent malicious exploitation.
     *
     * @param  string Key to clean
     * @return string
     */
    protected function clean_input_keys($data)
    {
        $chars = PCRE_UNICODE_PROPERTIES ? '\pL' : 'a-zA-Z';
        
        if ( ! preg_match('#^[' . $chars . '0-9:_.-]++$#uD', $data))
        {
            exit('Illegal key characters in global data');
        }
        
        return $data;
    }
    
    /**
     * Escapes data.
     *
     * @param  mixed Data to clean
     * @return mixed
     */
    protected function clean_input_data($data)
    {
        if(is_array($data))
        {
            $new_array = array();
            foreach($data as $key => $value)
            {
                $new_array[$this->clean_input_keys($key)] = $this->clean_input_data($value);
            }
            
            return $new_array;
        }
        
        if($this->magic_quotes_gpc === TRUE)
        {
            // Get rid of those pesky magic quotes!
            $data = stripslashes($data);
        }
        
        $data = $this->xss_clean($data);
        
        return $data;
    }
}
?>