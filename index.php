<?php
require_once __DIR__ . '../src/core/Router.php';

$router = new Router();

$router->add('send-mail', 'MailController', 'sendMail');
$router->add('feyzullah', 'MailController', 'test');

$router->run();
?>
