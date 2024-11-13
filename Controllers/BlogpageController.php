<?php

class BlogpageController {
    private PostModel $postModel; //model related to posts.
    private CommentModel $commentModel; //model related to comments on posts.

    function __construct() {
        require_once "./Models/PostModel.php";
        require_once "./Models/CommentModel.php";
        $this->postModel = new PostModel();
        $this->commentModel = new CommentModel();
    }

    /**
     * Sets the webpageTitle and loads the corresponding view.
     * Requests all posts to be displayed on the view.
     * @return void
     */
    public function index() : void {
        $webpageTitle = 'Blog';
        $posts = $this->postModel->getPosts();
        require_once "./views/blogpage.view.php";
    }

    /**
     * Determines which method needs to be called based on which value the form had on _submit in the POST request.
     * @return void
    */
    public function determineAction() : void {
        switch ($_POST['_submit']) {
            case 'createPost':
                self::createPost();
                break;
            case 'createComment':
                self::createComment();
                break;
            case 'updatePost':
                self::updatePost();
                break;
            case 'deletePost':
                self::deletePost();
                break;
            case 'deleteComment':
                self::deleteComment();
                break;
            case 'deleteEveryPost':
                self::deleteEveryPost();
                break;
            case 'reload':
                Header("Location: /blogpage");
                break;
        }
    }

    /**
     * Forwards the request to create a post to the correct model.
     * @return void
     */
    private function createPost() : void {
        $this->postModel->createPost($_POST['postTitle'], $_POST['postAuthor'], $_POST['postContent']);
        //Wanted to use self::index(); instead of header, but that doesn't remove the form action from the url.
        //Could probably be fixed with a proper router.
        //Counts for all methods with this header.
        header('Location: /blogpage');
    }

    /**
     * Forwards the request to create a comment to the correct model.
     * @return void
     */
    private function createComment() : void {
        $this->commentModel->createComment($_POST['commentAuthor'], $_POST['commentContent'], $_POST['commentPostId']);
        header('Location: /blogpage');
    }

    /**
     * Forwards the request to edit a comment to the correct model.
     * @return void
     */
    private function updatePost() : void{
        $this->postModel->updatePost($_POST['editedTitle'], $_POST['editedAuthor'], $_POST['editedContent'], $_POST['editPostId']);
        header('Location: /blogpage');
    }

    /**
     * Forwards the request to delete a post to the correct model.
     * @return void
     */
    private function deletePost() : void {
        $this->postModel->deletePost($_POST['postId']);
        header('Location: /blogpage');
    }

    /**
     * Forwards the request to delete a comment to the correct model.
     * @return void
     */
    private function deleteComment() : void {
        $this->commentModel->deleteComment($_POST['commentId']);
        header('Location: /blogpage');
    }

    /**
     * Forwards the request to delete every post to the correct model.
     * @return void
     */
    private function deleteEveryPost() : void {
        $this->postModel->deleteEveryPost();
        header('Location: /blogpage');
    }
}
?>