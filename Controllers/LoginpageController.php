<?php

class LoginpageController
{
    function __construct(){

    }

    /**
     * Sets the webpageTitle and loads the corresponding view.
     * Requests all posts to be displayed on the view.
     * @return void
     */
    public function index(): void
    {
        $webpageTitle = 'Login';
        require_once "./views/loginpage.view.php";
    }

    /**
     * Sends the user to the about page on login
     * @return void
     */
    public function login(): void {
        Header('Location: /aboutpage');
    }
}