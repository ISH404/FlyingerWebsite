<?php

class ProjectpageController
{
    private ProjectModel $projectModel; //model related to projects

    function __construct() {
        require_once './models/ProjectModel.php';
        $this->projectModel = new ProjectModel();
    }

    /**
     * Sets the webpageTitle and loads the corresponding view.
     * Requests all projects to be displayed on the view.
     * @return void
     */
    public function index() : void {
        $webpageTitle = 'My Projects';
        $projects = $this->projectModel->getProjects();
        require_once './views/projectpage.view.php';
    }

    /**
     * Determines which method needs to be called based on which value the form had on _submit in the POST request.
     * @return void
     */
    public function determineAction() : void {
        switch ($_POST['_submit']) {
            case 'createProject':
                self::createProject();
                break;
            case 'editProject':
                self::editProject();
                break;
            case 'deleteProject':
                self::deleteProject();
                break;
        }
    }

    /**
     * Forwards the request to create a project to the correct model.
     * @return void
     */
    private function createProject() : void {
        //Form input type="file" is not stored in $_POST so $_FILES is required.
        $this->projectModel->createProject($_POST['projectName'], $_POST['projectDescription'], $_FILES['projectThumbnail']);
        header('Location: /projectpage');
    }

    /**
     * Forwards the request to edit a project to the correct model.
     * @return void
     */
    private function editProject() : void {
        //TODO:
    }

    /**
     * Forwards the request to delete a project to the correct model.
     * @return void
     */
    private function deleteProject() : void {
        $this->projectModel->deleteProject($_POST['projectId'], $_POST['thumbnailName']);
        header('Location: /projectpage');
    }
}