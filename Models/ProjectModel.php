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
     * If validation on the thumbnail succeeds, store file name in database.
     * @return void
    */
    public function createProject($name, $description, $thumbnail) : void {
        //validate file
        if($this->validateFile($thumbnail)) {
            try {
                $query = $this->get_dbConnection()->prepare("INSERT INTO projects (name, description, thumbnail_name) VALUES (:name, :description, :thumbnail)");
                $query->bindParam(":name", $name);
                $query->bindParam(":description", $description);
                $query->bindParam(":thumbnail", $thumbnail['name']);
                $query->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    public function updateProject() : void {

    }

    /**
     * @param $project_id $id of the project that needs to be deleted.
     * @param $thumbnail_name $name of the thumbnail that needs to be deleted.
     * Prepares a sql query with the given parameters to delete a project with a matching id from the database and executes it.
     * @return void
     */
    public function deleteProject($project_id, $thumbnail_name) : void {
        try {
            $query = $this->get_dbConnection()->prepare("DELETE FROM projects WHERE id = :value;");
            $query->bindParam(":value", $project_id);
            $query->execute();

            //Delete the locally stored thumbnail linked with this project
            $this->deleteLocalThumbnail($thumbnail_name);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
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

            //Delete all locally stored thumbnails
            $this->deleteLocalThumbnails();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param $file $uploaded project thumbnail.
     * Validates the uploaded file. Checks if file extension and size are supported and checks if it already exists.
     * If validation succeeds, stores the file locall in uploaded_images folder.
     * @return bool
     */
    private function validateFile($file) : bool {
        //CREDIT: https://www.w3schools.com/php/php_file_upload.asp
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

    /**
     * Loops through the locally stored thumbnails in the map 'uploaded_images'.
     * Deletes every thumbnail in that map.
     * @return void
    */
    private function deleteLocalThumbnails() : void {
        //CREDIT: https://www.geeksforgeeks.org/deleting-all-files-from-a-folder-using-php/
        $folder_path = './uploaded_images/'; //Specify location of thumbnail folder.
        $thumbnails = glob($folder_path.'/*'); //Get an array of all the thumbnails in the selected folder path.

        //Loop through each thumbnail in the array.
        foreach($thumbnails as $thumbnail) {
            if(is_file($thumbnail)) {
                //Delete the current thumbnail from the folder.
                unlink($thumbnail);
            }
        }
    }

    /**
     * @param $thumbnail_name $name of the thumbnail that is getting removed.
     * Loops through the locally stored thumbnails in the map 'uploaded_images'.
     * Deletes every thumbnail in that map.
     * @return void
     */
    private function deleteLocalThumbnail($thumbnail_name) : void {
        //CREDIT: https://www.geeksforgeeks.org/deleting-all-files-from-a-folder-using-php/
        $folder_path = './uploaded_images'; //Specify location of thumbnail folder.
        $thumbnails = glob($folder_path.'/*'); //Get an array of all the thumbnails in the selected folder path.

        //Loop through each thumbnail in the array.
        foreach($thumbnails as $thumbnail) {
            //Look for a matching file name after removing the filepath from the thumbnail.
            if(is_file($thumbnail) && basename($thumbnail) == $thumbnail_name) {
                //Delete the current thumbnail from the folder.
                unlink($thumbnail);
            }
        }
    }
}