<?php
include './DatabaseItems/Database.php'; // Required class for the database connection

Class PostModel {
    private $dbConn;

    function __construct() {
        $database = new Database();
        $this->dbConn = $database->get_dbConnection();
    }

    /**
     * Fetch all data from currently existing posts and their comments in the database
     * @return array
     */
    public function getPosts() : array {
        //TO DO array [][] solution
        $query = $this->dbConn->prepare("SELECT posts.id, posts.title, posts.content, posts.author, posts.created_at, 
                                                comments.author as commentAuthor, comments.content as commentContent, comments.created_at as commentDate
                                                FROM posts LEFT JOIN comments ON posts.id = comments.post_id
                                                ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $title
     * @param $author
     * @param $content
     * prepare a sql statement with the given parameters to create a post and execute it
     * @return void
     */
    public function createPost($title, $author, $content) : void {
        try{
            $query = $this->dbConn->prepare("INSERT INTO posts (title, author, content) VALUES (:title, :author, :content)");
            $query->bindParam(":title", $title);
            $query->bindParam(":author", $author);
            $query->bindParam(":content", $content);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteEveryPost() : void {
        try{
            $query = $this->dbConn->prepare("DELETE FROM posts WHERE id > 0;");
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
