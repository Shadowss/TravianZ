<?php
namespace TravianZ\Models;

use TravianZ\Mvc\Model;
use TravianZ\Data\Validator;
use TravianZ\Database\Database;
use TravianZ\Exceptions\InvalidParametersException;
use TravianZ\Entity\User;
use TravianZ\Enums\UserEnums;
use TravianZ\Account\Session;
use TravianZ\Account\ISessionBase;
use TravianZ\Utils\Generator;
use TravianZ\Utils\Mailer;
use TravianZ\Entity\Village;
use TravianZ\Entity\Villages;
use TravianZ\Entity\Message;

class AccountModel extends Model
{
    const LOGIN_INPUT_RULES = [
        'Username' => 'isRequired|minLength=3|maxLength=30',
        'Password' => 'isRequired|minLength=6|maxLength=100'
    ];

    const REGISTER_INPUT_RULES = [
        'Username' => 'isRequired|minLength=3|maxLength=30|isUsernameValid',
        'Email' => 'isRequired|minLength=3|maxLength=30|isEmailValid',
        'Password' => 'isRequired|minLength=6|maxLength=100|isPasswordStrong',
        'Ref' => 'isInt|minValue=6',
        'Tribe' => 'isRequired|isInt|minValue=1|maxValue=3',
        'Sector' => 'isRequired|isInt|minValue=0|maxValue=4',
        'Rules' => 'isRequired',
    ];
    
    const ACTIVATE_USER_INPUT_RULES = [
        'code' => 'isRequired|minLength=10|maxLength=10',
    ];
    
    const DELETE_ACTIVATION_INPUT_RULES = [
        'del' => 'isRequired|minLength=3|maxLength=30',
        'Password' => 'isRequired|minLength=6|maxLength=100'
    ];
    
    const GENERATE_NEW_PASSWORD_INPUT_RULES = [
        'Email' => 'isRequired|minLength=3|maxLength=30|isEmailValid',
    ];
    
    const SET_NEW_PASSWORD_INPUT_RULES = [
        'id' => 'isRequired|isInt|minValue=1',
        'code' => 'isRequired|minLength=10|maxLength=10',
    ];
    

    /**
     * @var int
     */
    private $time;

    /**
     * @var ISessionBase
     */
    private $session;
    
    public function __construct(){
        parent::__construct();
        $this->validator = new Validator();

        // Create the Session
        $this->session = new Session(Database::getInstance());
        
        // Set the object creation time
        $this->time = time();
    }

    /**
     * Default activate method, called when there are no action
     *
     * @param array $parameters
     * @return array
     */
    public function defaultActivate(array $parameters): array
    {
        $sessionInformations = $this->session->getInformations();
        
        // Check if there's an username
        if (isset($parameters['GET']['del'])) {
            $sessionInformations['del'] = $parameters['GET']['del'];
        } elseif(isset($parameters['GET']['code'])) {
            $sessionInformations['code'] = $parameters['GET']['code'];
        } elseif(isset($parameters['GET']['activate'])) {
            $sessionInformations['activate'] = $parameters['GET']['activate'];
        } elseif(isset($parameters['GET']['activated'])) {
            $sessionInformations['activated'] = $parameters['GET']['activated'];
        }

        return $sessionInformations;
    }
    
    /**
     * Default registration method, called when there are no action
     * 
     * @param array $parameters
     * @return array
     */
    public function defaultAnmelden(array $parameters): array
    {
        $sessionInformations = $this->session->getInformations();

        if (isset($parameters['GET']['Ref'])) {
            $sessionInformations['Ref'] = $parameters['GET']['Ref'];
        }

        return $sessionInformations;
    }
    
    /**
     * Default login method, called when there are no action
     *
     * @param array $parameters
     * @return array
     */
    public function defaultLogin(array $parameters): array
    {
        if (isset($parameters['GET']['deleteCookies'])) {
            // Delete all cookies
            $this->session->deleteCookies();
        }
        
        return $this->session->getInformations();
    }
    
    /**
     * Default logout method, called when there are no action
     *
     * @return array
     */
    public function defaultLogout(): array
    {
        // Log Out the user
        $this->session->logOut();        

        return $this->session->getInformations();
    }
    
    /**
     * Default recover password method, called when there are no action
     *
     * @param array $parameters
     * @return array
     */
    public function defaultPassword(array $parameters): array
    {
        $sessionInformations = $this->session->getInformations();

        if (isset($parameters['GET']['password'])) {
            $sessionInformations['password'] = $parameters['GET']['password'];
        } elseif(isset($parameters['GET']['code'])) {
            if ($this->setNewPassword($parameters['GET'])) {
                $sessionInformations['password'] = 'success';
            } else {
                $sessionInformations['password'] = 'error';
            }
        }
        
        return $sessionInformations;
    }
    

    /**
     * Log into the game
     * 
     * @param array $parameters The parameters for the login
     * @throws InvalidParametersException Thrown if there are some invalid input
     * @return bool Returns true if the login was successful, false otherwise
     */
    public function logIn(array $parameters): bool
    {
        // Get the valid inputs        
        $informationsArray = $this->getValidInputs($parameters, self::LOGIN_INPUT_RULES);

        // All inputs are valid, try to log in
        $userName = $parameters['Username'];
        $password = $parameters['Password'];        

        // Create the user who wants to log in
        $user = new User(Database::getInstance(), $userName, true);

        // Assign it to the Session
        $this->session->setUser($user);
        
        // Check if the user has been activated
        if ($user->getState() == UserEnums::ACTIVATED) {
            // Check if the user is on vacation
            if (!$user->isOnVacation()) {
                // Check if the password is correct
                if ($this->session->logIn($password)) {
                    return true;
                } else {
                    $informationsArray['Password' . Validator::CUSTOM_ERROR_STRING] = LOGIN_PW_ERROR;
                }
            } else {
                $informationsArray['Vacation' . Validator::CUSTOM_ERROR_STRING] = VAC_MODE_STILL_ENABLED;
            }
        } else {
            if ($user->getState() == UserEnums::DOES_NOT_EXIST) {
                $informationsArray['Username' . Validator::CUSTOM_ERROR_STRING] = USR_NT_FOUND;
            } else {
                $informationsArray['Email' . Validator::CUSTOM_ERROR_STRING] = EMAIL_NOT_VERIFIED;
            }     
        }    

        // If the login wasn't successful, throw an exception
        throw new InvalidParametersException($informationsArray);
    }

    /**
     * Register an account in the game
     *
     * @param array $parameters The parameters for the new account
     * @throws InvalidParametersException Thrown if there are some invalid input
     * @return bool Returns an unempty string if the account creation was successful
     *              and didn't need the activation, 
     *              empty if the account still needs to be activated
     */
    public function register(array $parameters): string
    {
        // Get the valid inputs and the Session informations
        $informationsArray = $this->getValidInputs($parameters, self::REGISTER_INPUT_RULES);

        // Set the variables
        $parameters['Password'] = password_hash($parameters['Password'], PASSWORD_BCRYPT, ['cost' => 12]);
        
        // Check if the username and email are unique
        $checkUserName = new User(Database::getInstance(), $parameters['Username']);
        $checkEmail = new User(Database::getInstance(), $parameters['Email']);
        
        // Check if the referer user exist
        if (isset($parameters['Ref'])) {
            $checkRef = new User(Database::getInstance(), $parameters['Ref']);
        } else {
            $parameters['Ref'] = 0;
        }

        // Check if the User already exists
        if ($checkUserName->getState() == UserEnums::DOES_NOT_EXIST && 
            $checkEmail->getState() == UserEnums::DOES_NOT_EXIST &&
            (!isset($checkRef) || (isset($checkRef) && $checkRef->getState() != UserEnums::DOES_NOT_EXIST))
        ) {
            if(AUTH_EMAIL) {
                $act = Generator::generateRandStr(10);
                $checkUserName->addActivation(
                    $parameters['Password'], 
                    $parameters['Email'], 
                    $parameters['Tribe'], 
                    $parameters['Sector'],
                    $act,
                    $parameters['Ref'],
                    $this->time
                );

                Mailer::sendActivate($parameters['Email'], $parameters['Username'], $parameters['Password'], $act);

                return '?activate='.$checkUserName->username;
            } elseif(!AUTH_EMAIL) {
                $this->registerUser(
                    $parameters['Password'],
                    $parameters['Email'],
                    $parameters['Tribe'],
                    '',
                    $parameters['Sector'],
                    $parameters['Ref'],
                    $this->time
                    );

                return '';
            } else {
                $informationsArray['Activate' . Validator::CUSTOM_ERROR_STRING] = NOT_OPENED_YET;
            }
        } else {
            if ($checkUserName->getState() != UserEnums::DOES_NOT_EXIST) {
                $informationsArray['Username' . Validator::CUSTOM_ERROR_STRING] = USRNM_TAKEN;
            }

            if ($checkEmail->getState() != UserEnums::DOES_NOT_EXIST) {
                $informationsArray['Email' . Validator::CUSTOM_ERROR_STRING] = EMAIL_TAKEN;
            }

            if (isset($checkRef) && $checkRef->getState() == UserEnums::DOES_NOT_EXIST) {
                $informationsArray['Ref' . Validator::CUSTOM_ERROR_STRING] = REF_NT_FOUND;
            }
        }
        
        throw new InvalidParametersException($informationsArray);
    }

    /**
     * Register a new User
     * 
     * @param string $username
     * @param string $password
     * @param string $email
     * @param int $tribe
     * @param string $act
     * @param int $sector
     * @param string $ref
     * @return bool
     */
    private function registerUser(
        string $username, 
        string $password, 
        string $email, 
        int $tribe, 
        string $act,
        int $sector,
        string $ref
    ): bool {
        // Create the user
        $user = new User(Database::getInstance(), $username);
        
        // Register it
        $user->register(
            $password,
            $email,
            $tribe,
            $act,
            $sector,
            $ref,
            $this->time
            );
        
        // Set the cookies
        setcookie("COOKUSR", $user->username, $this->time + COOKIE_EXPIRE, COOKIE_PATH);
        
        // Create the capital
        $village = new Village(Database::getInstance(), $user, 0, $user->username.'\'s village', false, false, $sector);
        $villages = new Villages(Database::getInstance(), [$village]);
        $villages->create();

        // Send the welcome message
        $message = new Message(Database::getInstance(), $user->id, 1);
        $message->sendWelcome($user->username, $this->time);

        return true;
    }
    
    /**
     * Delete an activation row from the database
     * 
     * @param string $username
     * @return array Returns an array
     */
    public function deleteActivation(array $parameters): bool
    {
        // Get the valid inputs and the Session informations
        $informationsArray = $this->getValidInputs($parameters, self::DELETE_ACTIVATION_INPUT_RULES);

        $user = new User(Database::getInstance(), $parameters['del']);

        if ($user->getState() == UserEnums::NOT_ACTIVATED) {
            if (password_verify($parameters['Password'], $user->getActivationData()['password'])) {
                return $user->deActivate();
            } else {
                $informationsArray['Password' . Validator::CUSTOM_ERROR_STRING] = PASS_MISMATCH;
            }
        } else {
            $informationsArray['del' . Validator::CUSTOM_ERROR_STRING] = USR_NT_FOUND;
        }
        
        throw new InvalidParametersException($informationsArray);
    }
    
    
    /**
     * Activate an user
     *
     * @param string $parameters The parameters, containing the activation code
     * @return bool
     */
    public function activate(array $parameters): bool
    {
        // Get the valid inputs and the Session informations
        $informationsArray = $this->getValidInputs($parameters, self::ACTIVATE_USER_INPUT_RULES);

        // Create a new user
        $user = new User(Database::getInstance(), $parameters['code']);

        // Verify if it exists and he's not already activated
        if ($user->getState() == UserEnums::NOT_ACTIVATED) {
            $activationData = $user->getActivationData();
            $this->registerUser(
                $activationData['username'],
                $activationData['password'], 
                $activationData['email'],
                $activationData['tribe'],
                $activationData['act'],
                $activationData['location'],
                $activationData['invite']
            );

            $user->deActivate();
            
            return true;
        } else {
            $informationsArray['code' . Validator::CUSTOM_ERROR_STRING] = INVALID_CODE;
        }

        throw new InvalidParametersException($informationsArray);
    }
    
    /**
     * Generate a new password method
     */
    public function generateNewPassword(array $parameters)
    {
        // Get the valid inputs and the Session informations
        $informationsArray = $this->getValidInputs($parameters, self::GENERATE_NEW_PASSWORD_INPUT_RULES);   
        
        // Create a new user
        $user = new User(Database::getInstance(), $parameters['Email'], true);

        $newPassword = Generator::generateRandStr(7);
        $codePassword = Generator::generateRandStr(10);
        
        // Check if the password was generated correctly
        if ($user->generateNewPassword($newPassword, $codePassword, $this->time)) {
            // Send the email with the new password
            Mailer::sendPassword($parameters['Email'], $user->id, $user->username, $newPassword, $codePassword);
        }
    }
    
    /**
     * Set a new password
     * 
     * @param $parameters array The parameters
     * @return bool Returns true if the password was set, false otherwise
     */
    public function setNewPassword(array $parameters): bool
    {
        // Check if there are some invalid inputs
        $invalidInputs = $this->validator->validateInputs($parameters, self::SET_NEW_PASSWORD_INPUT_RULES);

        if (!empty($invalidInputs)) {
            return false;
        }
        
        $user = new User(Database::getInstance(), $parameters['id']);
        
        // Check if the user has already been activated
        return $user->setNewPassword($parameters['code']);
    }
    
    /**
     * Get the valid inputs
     * 
     * @param array $parameters The User's parameters
     * @param array $inputRules The input rules
     * @throws InvalidParametersException Thrown if there are some invalid inputs
     * @return array Returns the invalid inputs, merged with the session inputs and the passed parameters
     */
    private function getValidInputs(array $parameters, array $inputRules): array
    {
        // Variables initialization
        $informationsArray = [];
        
        // Validate the user inputs
        $invalidInputs = $this->validator->validateInputs($parameters, $inputRules);
        
        // Add the parameters and Session informations
        $informationsArray = array_merge(
            $invalidInputs,
            array_combine(array_keys($parameters), array_values($parameters)),
            $this->session->getInformations()
            );

        // Check if all user's inputs are valid, if not, throw an exception with the reasons
        if (!empty($invalidInputs)) {
            throw new InvalidParametersException($informationsArray);
        }

        return $informationsArray;
    }
}
