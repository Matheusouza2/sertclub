<?php
session_start();

require "../dao/UserDao.php";
require_once "../models/User.php";

if(isset($_GET['logout'])){
    unset($_SESSION['user']);
    header("location: ../index.php");
}

if(isset($_POST['cadastrar'])){
    UserController::cadastrar();
}else if(isset($_POST['login'])){
    UserController::login();
}

class UserController{

    public function cadastrar()
    {
        $user = new User();

        $user->setNome($_POST['nome']);
        $user->setUsuario($_POST['usuario']);
        $user->setSenha(md5($_POST['senha']));
        $user->setNivel($_POST['nivel']);

        $userDao = new UserDao();
        $userDao->cadastrar($user);

        $_SESSION['msg'] = ["title" => "Usuario Cadastrado", "text" => "O usuário foi cadastrado com sucesso e já tem acesso ao sistema", "icon" => "success"];
        header("location: ../usuarios.php");
    }

    public function listarTodos()
    {
        
    }

    public function login()
    {
        $user = $_POST['usuario'];
        $senha = md5($_POST['senha']);

        $userDao = new UserDao();
        $login = $userDao->login($user, $senha);
        
        if(count($login) == 1){
            $_SESSION['user'] = $login;
            header("location: ../admin.php");
            return;
        }
        
        $_SESSION['msg'] = ["title" => "Credenciais invalidas", "text" => "Usuário e senha não encontrados na base de dados", "icon" => "error"];
        header("location: ../index.php");
        return;
    }
}