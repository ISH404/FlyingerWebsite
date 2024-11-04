<?php
require_once './DatabaseItems/Database.php'; // Required class for the database connection.

Class PostModel extends Database {
    /**
     * Return all data from currently existing posts and related comments from the database.
     * @return array
     */
    public function getPosts() : array {
        $posts = [];

        //Prepare and execute the query to pull all posts and related comments(if they exist) to those posts from the database.
        $query = $this->get_dbConnection()->prepare("SELECT posts.id as post_id, posts.title as post_title, posts.content as post_content, posts.author as post_author, posts.created_at as post_date, 
                                                comments.id as comment_id, comments.author as comment_author, comments.content as comment_content, comments.created_at as comment_date
                                                FROM posts LEFT JOIN comments ON posts.id = comments.post_id ORDER BY posts.created_at DESC
                                                ");
        $query->execute();

        //I wanted to see every post and comment loaded onto the blogpage by default.
        //Otherwise, the code below could've been avoided by only fetching the comments when a specific post gets selected
        //Solution credits: Brighton
        while($record = $query->fetch(PDO::FETCH_ASSOC)) {
            $id = $record['post_id'];
            $posts[$id]['id'] = $record['post_id'];
            $posts[$id]['title'] = $record['post_title'];
            $posts[$id]['content'] = $record['post_content'];
            $posts[$id]['author'] = $record['post_author'];
            $posts[$id]['created_at'] = $record['post_date'];
            //If the current post has comments, store those comments in an array linked to the current post
            if(isset($record['comment_id'])) {
                $posts[$id]['comments'][] = [
                    'comment_id' => $record['comment_id'],
                    'author' => $record['comment_author'],
                    'content' => $record['comment_content'],
                    'created_at' => $record['comment_date']
                ];
            }
        }
        return $posts;
    }

    /**
     * @param $title $title of the post
     * @param $author $author of the post
     * @param $content $content of the post
     * Prepares a sql query with the given parameters to create a post and executes it.
     * @return void
     */
    public function createPost($title, $author, $content) : void {
        try {
            $query = $this->get_dbConnection()->prepare("INSERT INTO posts (title, author, content) VALUES (:title, :author, :content)");
            $query->bindParam(":title", $title);
            $query->bindParam(":author", $author);
            $query->bindParam(":content", $content);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Prepares a sql query with the given parameters to delete every post with an id higher than 0 from the database and executes it.
     * @return void
     */
    public function deleteEveryPost() : void {
        //I know I could just change :value to 0 and avoid the variable here,
        // but I wanted it to remain consistent with the createPost method.
        $value = 0;

        try{
            $query = $this->get_dbConnection()->prepare("DELETE FROM posts WHERE id > :value;");
            $query->bindParam(":value", $value);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
