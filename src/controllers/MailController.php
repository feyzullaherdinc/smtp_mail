<?php
require_once __DIR__ . '/../models/MailModel.php';

class MailController {
    public function sendMail() {
            header('Content-Type: application/json');
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $subject = $_POST['subject'] ?? '';
            $message = $_POST['message'] ?? '';

            $mailModel = new MailModel();
            $response = $mailModel->sendMail($name, $email, $subject, $message);

            echo json_encode($response);
        }
    }
}
?>
