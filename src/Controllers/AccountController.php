<?php
namespace TravianZ\Controllers;

use TravianZ\Mvc\Controller;
use TravianZ\Models\AccountModel;
use TravianZ\Exceptions\InvalidParametersException;

class AccountController extends Controller
{
    /**
     * @var string default page to redirect after a successful login
     */
    const DEFAULT_LOGIN_REDIRECT = 'dorf1.php';
    
    /**
     * @var string default page to redirect after a successful account creation
     */
    const DEFAULT_REGISTER_REDIRECT = 'login.php';
    
    /**
     * @var string default page to redirect after a successful account creation, if the email was necessary
     */
    const DEFAULT_ACTIVATE_REDIRECT = 'activate.php';
    
    /**
     * @var string default page to redirect after a successful activation
     */
    const DEFAULT_SUCCESSFULLY_ACTIVATION_REDIRECT = 'activate.php?activated=success';
    
    /**
     * @var string default page to redirect after a new was set with success
     */
    const DEFAULT_NEW_PASSWORD_REDIRECT = 'password.php?password=sent';
    
    public function __construct(AccountModel $model)
    {
        parent::__construct($model);
    }

    /**
     * Called when the page is loaded with no action that needs to be executed
     *
     * @param $methodName string The method to be called
     * @param $parameters array The parameters
     */
    public function default(string $methodName, array $parameters)
    {
        try {
            // Check if the method has some parameters
            $this->model->set([__METHOD__ => $this->model->$methodName($parameters)]);
        } catch (InvalidParametersException $exception) {
            // Some parameters were invalid
            $this->model->set([__METHOD__ => $exception->getParameters()]);
        }
    }

    /**
     * Log into the game
     * 
     * @param array $parameters Contains the 'user' and 'pw' parameters
     */
    public function logIn(array $parameters)
    {
        try {
            // Try to log into the game and retrieve the datas
            $this->model->logIn($parameters['POST']);
            
            // If the login was successful, redirect
            $this->redirect(self::DEFAULT_LOGIN_REDIRECT);
        } catch (InvalidParametersException $exception) {
            // Some parameters were invalid
            $this->model->set([__METHOD__ => $exception->getParameters()]);
        }
    }
    
    /**
     * Register an account
     *
     * @param array $parameters Contains the new user parameters
     */
    public function register(array $parameters)
    {
        try {
            // Try to register an account
            // If the account creation was successful, redirect
            $data = $this->model->register($parameters['POST']);
            if ($data == '') {
                $this->redirect(self::DEFAULT_REGISTER_REDIRECT);
            } else {
                $this->redirect(self::DEFAULT_ACTIVATE_REDIRECT.$data);
            }
        } catch (InvalidParametersException $exception) {
            // Some parameters were invalid
            $this->model->set([__METHOD__ => $exception->getParameters()]);
        }
    }
    
    /**
     * Activate an account
     *
     * @param array $parameters Contains the code
     */
    public function activate(array $parameters)
    {
        try {
            // Try to account an account
            // If the account creation was successful, redirect
            if ($this->model->activate($parameters['POST'])) {
                $this->redirect(self::DEFAULT_SUCCESSFULLY_ACTIVATION_REDIRECT);
            }
        } catch (InvalidParametersException $exception) {
            // Some parameters were invalid
            $this->model->set([__METHOD__ => $exception->getParameters()]);
        }
    }
    

    /**
     * Register an account
     *
     * @param array $parameters Contains the new user parameters
     */
    public function deleteActivation(array $parameters)
    {
        try {
            // Try to delete an unactivated account
            // If the account creation was successful, redirect
            if ($this->model->deleteActivation($parameters['POST'])) {
                $this->redirect(self::DEFAULT_REGISTER_REDIRECT);
            }
        } catch (InvalidParametersException $exception) {
            // Some parameters were invalid
            $this->model->set([__METHOD__ => $exception->getParameters()]);
        }
    }
    
    /**
     * Generate a new password
     *
     * @param array $parameters Contains the user's email
     */
    public function generateNewPassword(array $parameters)
    {
        try {
            // Try to generate a new password
            $this->model->generateNewPassword($parameters['POST']);
            $this->redirect(self::DEFAULT_NEW_PASSWORD_REDIRECT);           
        } catch (InvalidParametersException $exception) {
            // Some parameters were invalid
            $this->model->set([__METHOD__ => $exception->getParameters()]);
        }
    }
}
