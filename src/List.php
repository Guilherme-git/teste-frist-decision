<?php
require_once __DIR__."/User.php";

use src\User;

$user = new User();
if(is_array($user->getAll())){
    echo json_encode(["data"=> $user->getAll()]);
    die();
}
echo json_encode(["error"=> "Ocorreu um problema, tente novamente"]);
die();