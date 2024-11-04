<?php

class ContactpageController {

    private ContactModel $contactModel; // model related to sending a contact request

    function __construct() {
        require_once './models/ContactModel.php';
        $this->contactModel = new ContactModel();
    }

    /**
     * Sets the webpageTitle and loads the corresponding view.
     * @return void
    */
    public function index() : void{
        $webpageTitle = "Contact Me";
        require_once "./views/contactpage.view.php";
    }

    /**
     * Forwards the request to send an email to the correct model.
     * @return void
    */
    public function sendEmail() : void {
        //TODO: SMTP SERVER SETUP. RELOAD PAGE FOR NOW
        //$this->contactModel->sendEmail($_POST['contactEmail'], $_POST['contactName'], $_POST['contactSubject'], $_POST['contactMessage']);
        header('Location: /contactpage');
    }
}