<?php
//namespace Controllers;

class BlogpageController
{
    private $postModel;
    private $commentModel;

    function __construct() {
        require_once "./Models/PostModel.php";
        require_once "./Models/CommentModel.php";
        $this->postModel = new PostModel();
        $this->commentModel = new CommentModel();
    }
    public function index() : void{
        $webpageTitle = 'Blog Page';
        $results = $this->postModel->getPosts();
        require_once "./views/blogpage.view.php";
    }

    public function createPost() : void {
        $this->postModel->createPost($_POST['postTitle'], $_POST['postAuthor'], $_POST['postContent']);
        self::index();
    }

    public function deleteEveryPost() : void {
        $this->postModel->deleteEveryPost();
        self::index();
    }

    public function addComment() : void {
        $this->commentModel->addComment($_POST['commentAuthor'], $_POST['commentContent'], $_POST['commentPostId']);
        self::index();
    }

//    public function inClassExample(){
//        switch ($_GET['action']) {
//            case 'save':
//                createPost();
//                break;
//            case 'edit':
//                updatePost();
//                break;
//            case 'delete':
//                deletePost($_GET['id']);
//                break;
//            case 'list':
//                break;
//        }
//    }
//
//    function updatePostExample($id, $title, $author, $content){
//        include './Controllers/DatabaseItems.php';
//        try {
//            $sql = $this->conn->prepare("UPDATE posts SET title = :title, author = :author, content = :content WHERE id = :id");
//            $sql->bindParam(":title", $title);
//            $sql->bindParam(":author", $author);
//            $sql->bindParam(":content", $content);
//            $sql->bindParam(":id", $id);
//            $sql->execute();
//        } catch (PDOException $e) {
//            "Error: " . $sql . $e->getMessage();
//        }
//    }
}
?>