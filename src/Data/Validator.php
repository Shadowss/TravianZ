<?php
namespace TravianZ\Data;

/**
 * Validate arrays of inputs, through well defined rules
 *
 * @author iopietro
 */
class Validator
{
    /**
     * @var string The custom string to ad to the parameter keys
     */
    const CUSTOM_ERROR_STRING = 'Error';

    /**
     * @var array The invaldiation reasoms
     */
    const INVALID_INPUT_REASONS = [ 
        'unrecognizedInput' => 'Unrecognized input.',
        'isRequired' => 'Empty %s.',
        'maxLength' => '%s is too long.',
        'minLength' => '%s is too short.',
        'isInt' => 'Invalid %s, it\'s not an integer number.',
        'isFloat' => 'Invalid %s, it\'s not a float number.',
        'isEmailValid' => 'Invalid email.',
        'isPasswordStrong' => 'The password is too weak.',
        'isUsernameValid' => 'Invalid username characters.  ',
        'minValue' => '%s is too small.',
        'maxValue' => '%s is too big.'
    ];

    /**
     * @var string The char which delimits each rule
     */
    const RULE_DELIMITER_CHAR = '|';

    /**
     * @var string The cahr which separate the value for each rule
     */
    const RULE_VALUE_SEPARATOR_CHAR = '=';

    /**
     * Validate an array of inputs
     *
     * @param array $inputs
     *            The inputs that need to be validated
     * @param array $rules
     *            The array which defines the validation rules
     * @return array Returns the invalid inputs with the invalid reasons, empty if they're all valid
     */
    public function validateInputs(array $inputs, array $rules): array
    {
        //Initialization
        $invalidInputs = [];

        foreach ($rules as $parameter => $rule) {
            //Check if the parameter has been passed
            if (!isset($inputs[$parameter]) || $inputs[$parameter] == '') {
                // Check if the parameter is required, if not and it's empty, skip it
                if (strpos($rule, 'isRequired') !== false) {
                    $inputs[$parameter] = '';
                } else {
                    continue;
                }
            }

            //Check if all rules are valids
            $ruleSet = explode(self::RULE_DELIMITER_CHAR, $rule);
            foreach ($ruleSet as $rule) {
                //If a single rule is invalid, break
                $reason = $this->getInputValidation($inputs[$parameter], $rule);
                if (!empty($reason)) {
                    $invalidInputs[$parameter.'Error'] = sprintf($reason, $parameter);
                    break;
                }
            } 
        }
        
        return $invalidInputs;
    }

    /**
     * Check if a single input is valid or not
     * 
     * @param string|array $input
     * @param array $rule
     * @return array Returns an empty array if it's valid, an array with the invalid reason
     */
    private function getInputValidation($input, string $rule) 
    {
        //Initializations
        $ruleArray[0] = $rule;
        $ruleArray[1] = '';
        $reason = '';

        //Separate the rule from its value
        if (strpos($rule, self::RULE_VALUE_SEPARATOR_CHAR) !== false) {
            $ruleArray = explode(self::RULE_VALUE_SEPARATOR_CHAR, $rule);
        }
        
        $isValid = $this->isInputValid($input, $ruleArray[0], $ruleArray[1]);

        //If it's invalid, get the invalid reason
        if (!$isValid) {
            if (isset(self::INVALID_INPUT_REASONS[$ruleArray[0]])) {
                $reason = self::INVALID_INPUT_REASONS[$ruleArray[0]];
            } else {
                $reason = self::INVALID_INPUT_REASONS['unrecognizedInput'];
            }

            return $reason;
        }
        
        return '';
    }

    /**
     * Check if the input is valid or not
     * 
     * @param string|array $input The user's input
     * @param string $rule The rule to check
     * @param string $value [Optional] The rule value
     * @return boolean Returns true if the input is valid, false otherwise
     */
    private function isInputValid($input, string $rule, string $value = '')
    {
        switch ($rule) {
            case 'isRequired':
                return is_array($input) ? !empty($input) : $input != '';
            case 'maxLength':
                return strlen($input) <= $value;
            case 'minLength':
                return strlen($input) >= $value;
            case 'isInt':
                return is_numeric($input) && intval($input) == $input;
            case 'isFloat':
                return is_numeric($input) && floatval($input) == $input;
            case 'isUsernameValid':
                return $this->isUsernameValid($input);
            case 'isEmailValid':
                return $this->isEmailValid($input);
            case 'isPasswordStrong':
                return $this->isPasswordStrong($input);
            case 'maxValue':
                return $input <= $value;
            case 'minValue':
                return $input >= $value; 
            default: //Every other unrecognized rules
                return false;
        }
    }

    /**
     * Check if the passed string is a valid username
     *
     * @param string $username
     * @return bool
     */
    public function isUsernameValid(string $username): bool
    {
        return !preg_match("/\\s/", $username);
    }

    /**
     * Check if the passed string is a valid email
     *
     * @param string $email
     * @return bool
     */
    public function isEmailValid(string $email): bool
    {
        return preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $email);
    }
    
    /**
     * Check if the passed string is a strong enough password
     *
     * @param string $password
     * @return bool
     */
    public function isPasswordStrong(string $password): bool
    {
        return preg_match('/^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z])/', $password);
    }
}
