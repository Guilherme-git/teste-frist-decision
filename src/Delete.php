<?php
require_once __DIR__."/User.php";

use src\User;

$id = $_POST['id'];

$user = new User();
$user->setId($id);
$result = $user->delete();

if($result && !is_string($result)) {
    echo json_encode(["success"=> "Usuário deletado com sucesso"]);
    die();
} else {
    echo json_encode(["error"=> $result]);
    die();
}
