<?php

class AboutpageController {
    public function index() : void {
        $webpageTitle = "About Me";
        require_once "./views/aboutpage.view.php";
    }
}