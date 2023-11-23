<?php
require_once __DIR__."/utils/Validate.php";
require_once __DIR__."/User.php";

use src\User;
use src\utils\Validate;

$id = $_POST["id"];
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirmPassword = $_POST["confirmPassword"];

$validate = new Validate();

if(!$validate->emptyInputs($name, $email, $password)) {
    echo json_encode(["error"=>"Preencha todos os campos"]);
    die();
}

if(!$validate->validateEmail($email)) {
    echo json_encode(["error"=> "Informe um email válido"]);
    die();
}

if(!$validate->validateName($name)) {
    echo json_encode(["error"=> "É obrigatório fornecer um nome, devendo conter entre 3 a 50 caracteres"]);
    die();
}

if(!$validate->validatePassword($password)) {
    echo json_encode(["error"=> "É obrigatório fornecer uma senha, devendo conter entre 6 a 20 caracteres"]);
    die();
}

if(!$validate->equalsPassword($password, $confirmPassword)) {
    echo json_encode(["error"=> "As senhas devem ser iguais"]);
    die();
}

$user = new User();

$user->setId($id);
$user->setName($name);
$user->setEmail($email);
$user->setPassword($password);
$result = $user->edit();

if($result && !is_string($result))
{
    echo json_encode(["success"=> "Usuário editado com sucesso"]);
    die();
} else {
    echo json_encode(["error"=> $result]);
    die();
}

