<?php

Class CommentModel {
    private $dbConn;
    function __construct() {
//        $this->dbConn = (new Database())->get_dbConnection();
        $database = new Database();
        $this->dbConn = $database->get_dbConnection();
    }

    public function addComment($author, $content, $post_id) : void {
        try{
            $query = $this->dbConn->prepare("INSERT INTO comments (author, content, post_id) VALUES (:author, :content, :post_id)");
            $query->bindParam(':author', $author);
            $query->bindParam(':content', $content);
            $query->bindParam(':post_id', $post_id);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteComment($comment_id) : void {
        try {
            $query = $this->dbConn->prepare("DELETE FROM comments WHERE id = :comment_id");
            $query->bindParam(':comment_id', $comment_id);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}