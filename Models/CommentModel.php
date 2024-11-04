<?php
require_once './DatabaseItems/Database.php'; // Required class for the database connection

Class CommentModel extends Database {

    /**
     * @param $author $creator of the comment.
     * @param $content $conte of the comment.
     * @param $post_id $id of the post which the comment is made on.
     * Prepare a sql query with the given parameters to create a comment and execute it.
     * @return void
    */
    public function createComment($author, $content, $post_id) : void {
        try{
            $query = $this->get_dbConnection()->prepare("INSERT INTO comments (author, content, post_id) VALUES (:author, :content, :post_id)");
            $query->bindParam(':author', $author);
            $query->bindParam(':content', $content);
            $query->bindParam(':post_id', $post_id);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param $comment_id $id of the comment that is getting deleted.
     * Prepare a sql query with the given parameters to delete a comment and execute it.
     * @return void
    */
    public function deleteComment($comment_id) : void {
        try {
            $query = $this->get_dbConnection()->prepare("DELETE FROM comments WHERE id = :comment_id");
            $query->bindParam(':comment_id', $comment_id);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}