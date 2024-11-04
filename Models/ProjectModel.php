<?php
require_once './DatabaseItems/Database.php';

class ProjectModel extends Database {

    public function getProjects() : array {
        try {
            $query = $this->get_dbConnection()->prepare("SELECT * FROM projects");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        return [];
    }

    private function validateFile($file) : bool {
        //https://www.w3schools.com/php/php_file_upload.asp
        $file_name = $file['name'];// Get file name
        $file_size = $file['size']; //Get file size
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION); //Get extension from file

        $allowedExtensions = array("jpeg", "jpg", "png"); //Allowed file types to be stored.
        $targetPath = './uploaded_images/'.$file_name; //Path where file will be stored if validation succeeds

        //Validate if file doesn't already exist, the extension is valid and the file size is not over 1MB.
            if(!file_exists($targetPath) && in_array($file_ext, $allowedExtensions) && $file_size <= 1000000) {
                //Store the provided file in the giving path
                move_uploaded_file($file['tmp_name'], $targetPath);
                return true;
            }
        return false;
    }

    public function createProject($name, $description, $thumbnail) : void {
        if($this->validateFile($thumbnail)) {
            try {
                $query = $this->get_dbConnection()->prepare("INSERT INTO projects (name, description, thumbnail_name) VALUES (:name, :description :thumbnail)");
                $query->bindParam(":name", $name);
                $query->bindParam(":description", $description);
                $query->bindParam(":thumbnail", $thumbnail['name']);
                $query->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            //Display error and sleep for 4 seconds so it can be read before page redirect.
            echo "File failed to validate, please try a different one. <br>
                  Max file size 1MB.<br>
                  Allowed extensions: jpeg, jpg, png.<br> 
                  Duplicate file names are not allowed.";
        }
    }
    public function updateProject() : void {

    }

    public function deleteProject() : void {

    }
}