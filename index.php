<?php
//Grabs the path after localhost:portnumber if present, else set path to default index
$path = $_SERVER['PATH_INFO'] ?? '/';

switch($path){
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

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $blogpage->createPost();
        } else {
            $blogpage->index();
        }
        break;
    case '/blogpage/addComment':
        require_once './Controllers/BlogpageController.php';
        $blogpage = new BlogpageController();
        $blogpage->addComment();
        break;
    case '/blogpage/deleteAllPosts':
        require_once './Controllers/BlogpageController.php';
        $blogpage = new BlogpageController();
        $blogpage->deleteEveryPost();
        break;
    default:
        echo 'something went wrong';
        break;
}
