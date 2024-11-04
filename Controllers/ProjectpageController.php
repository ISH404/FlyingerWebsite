<?php

/*TODO:
 * setup project database: V
 * think about sessions: x
 * add project: V
 * show projects: v
 * add thumbnail to projects: x
 * edit project: x
 * delete all projects: v
 * */

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
        $webpageTitle = 'Project Page';
        $projects = $this->projectModel->getProjects();
        require_once './views/projectpage.view.php';
    }

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

    private function createProject() : void {
        //Form input type="file" is not stored in $_POST so $_FILES is required.
        $this->projectModel->createProject($_POST['projectName'], $_POST['projectDescription'], $_FILES['projectThumbnail']);
        header('Location: /projectpage');
    }

    private function editProject() : void {

    }

    private function deleteProject() : void {

    }
}