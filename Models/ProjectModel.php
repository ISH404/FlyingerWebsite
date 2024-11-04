<?php
require_once './DatabaseItems/Database.php';

class ProjectModel extends Database {

    /**
     * Pulls all the projects from the database.
     * If nothing is found returns an empty array.
     * @return array
    */
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

    /**
     * @param $name $name of the project.
     * @param $description $description of the project.
     * @param $thumbnail $thumbnail of the project.
     * Prepares a sql query with the given parameters to create a project and executes it.
     * @return void
    */
    public function createProject($name, $description, $thumbnail) : void {
            try {
                $query = $this->get_dbConnection()->prepare("INSERT INTO projects (name, description, thumbnail_name) VALUES (:name, :description :thumbnail)");
                $query->bindParam(":name", $name);
                $query->bindParam(":description", $description);
                $query->bindParam(":thumbnail", $thumbnail);
                $query->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
    }

    public function updateProject() : void {

    }

    /**
     * Prepares a sql query with the given parameters to delete every project with an id higher than 0 from the database and executes it.
     * @return void
     */
    public function deleteEveryProject() : void {
        //I know I could just change :value to 0 and avoid the variable here,
        // but I wanted it to remain consistent with the createPost method.
        $value = 0;

        try{
            $query = $this->get_dbConnection()->prepare("DELETE FROM projects WHERE id > :value;");
            $query->bindParam(":value", $value);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Currently not used due to file name not appearing in the database.
    //Stepped over to thumbnail_urls from file names in the database and images stored locally in the project.
    /**
     * @param $file $uploaded project thumbnail.
     * Validates the uploaded file. Checks if file extension and size are supported and checks if it already exists.
     * @return bool
     */
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
}