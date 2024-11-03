<?php
require 'functions.php';

//If you wanted to use paramaters from the url for whatever reason parse_url($_SERVER['REQUEST_URI'])['path'][];
$path = $_SERVER['PATH_INFO'] ?? '/'; //Grabs the path after localhost:portnumber if present, else set path to default index

switch ($path) {
    case '/':
    case '/frontpage':
        require_once './Controllers/FrontpageController.php';
        $frontpage = new FrontpageController();
        $frontpage->index();
        break;

    case '/backpage':
        require_once './Controllers/BackpageController.php';
        $backpage = new BackpageController();
        $backpage->index();
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

    default:
        echo 'something went wrong';
        break;
}
