<?php
require_once './DatabaseItems/Database.php';

Class ContactModel extends Database {

    /**
     * @param $senderEmail sender's emailaddress
     * @param $senderName sender's name
     * @param $subject sender's email subject
     * @param $message sender's message for the recipient
     * Sends an email to the recipient.
     * @return void
    */
    public function sendEmail($senderEmail, $senderName, $subject, $message) : void {
        $recipientEmail = 'tzhawai@gmail.com'; // My trash spam email.
        $senderEmail = trim($senderEmail);
        $senderName = trim($senderName);
        $subject = trim($subject);
        $message = trim($message);

        //specify additional header to also pass the sender's name and email.
        $headers = "From: $senderName <$senderEmail>\r\n";

        //send email
        mail($recipientEmail, $subject, $message, $headers);
    }
}