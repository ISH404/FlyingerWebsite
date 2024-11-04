<?php
require 'functions.php';

//If you wanted to use paramaters from the url for whatever reason parse_url($_SERVER['REQUEST_URI'])['path'][];
$path = $_SERVER['PATH_INFO'] ?? '/'; //Grabs the path after localhost:portnumber if present, else set path to default index

//Switch that determines where to redirect to based on the url path.
switch ($path) {
    case '/':
        require_once './Controllers/LoginpageController.php';
        $loginpage = new LoginpageController();
        $loginpage->index();
        break;

    case '/loginpage/submit':
        require_once './Controllers/LoginpageController.php';
        $loginpage = new LoginpageController();
        $loginpage->login();
        break;

    case '/aboutpage':
        require_once './Controllers/AboutpageController.php';
        $aboutpage = new AboutpageController();
        $aboutpage->index();
        break;

    case '/projectpage':
        require_once './Controllers/ProjectpageController.php';
        $projectpage = new ProjectpageController();
        $projectpage->index();
        break;

    case '/projectpage/submit':
        require_once './Controllers/ProjectpageController.php';
        $projectpage = new ProjectpageController();
        $projectpage->determineAction();
        break;

    case '/blogpage':
        require_once './Controllers/BlogpageController.php';
        $blogpage = new BlogpageController();
        $blogpage->index();
        break;

    case '/blogpage/submit':
        require_once './Controllers/BlogpageController.php';
        $blogpage = new BlogpageController();
        $blogpage->determineAction();
        break;

    case '/contactpage':
        require_once './Controllers/ContactpageController.php';
        $contactpage = new ContactpageController();
        $contactpage->index();
        break;

    case '/contactpage/submit':
        require_once './Controllers/ContactpageController.php';
        $contactpage = new ContactpageController();
        $contactpage->sendEmail();
        break;

    default:
        echo 'something went wrong';
        break;
}
