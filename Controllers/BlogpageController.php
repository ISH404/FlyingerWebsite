<?php

class BlogpageController {
    private PostModel $postModel; //model used related to posts.
    private CommentModel $commentModel; //model used related to comments on posts.

    function __construct() {
        require_once "./Models/PostModel.php";
        require_once "./Models/CommentModel.php";
        $this->postModel = new PostModel();
        $this->commentModel = new CommentModel();
    }

    public function index() : void {
        $webpageTitle = 'Blog Page';
        $results = $this->postModel->getPosts();
        require_once "./views/blogpage.view.php";
    }

    public function determineAction() : void {
        switch ($_POST['_submit']) {
            case 'createPost':
                self::createPost();
                break;
            case 'createComment':
                self::createComment();
                break;
            case 'deleteEveryPost':
                self::deleteEveryPost();
                break;
        }
    }

    private function createPost() : void {
        $this->postModel->createPost($_POST['postTitle'], $_POST['postAuthor'], $_POST['postContent']);
        //Wanted to use self::index(); instead of header, but that doesn't remove the form action from the url.
        //Could probably be fixed with a proper router.
        header('Location: /blogpage');
    }

    private function createComment() : void {
        $this->commentModel->createComment($_POST['commentAuthor'], $_POST['commentContent'], $_POST['commentPostId']);
        //Wanted to use self::index(); instead of header, but that doesn't remove the form action from the url.
        //Could probably be fixed with a proper router.
        header('Location: /blogpage');
    }

    private function deleteEveryPost() : void {
        $this->postModel->deleteEveryPost();
        //Wanted to use self::index(); instead of header, but that doesn't remove the form action from the url.
        //Could probably be fixed with a proper router.
        header('Location: /blogpage');
    }
}
?>