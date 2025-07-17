<?php
declare(strict_types=1);

require_once("database.php");
require_once("../model/register_model.php");
require_once("../controller/register_contrl.php");

$db = new Database();
$userModel = new UserModel($db->getConnection());
$registerController = new RegisterController($userModel);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $registerController->handle($_POST);
}
