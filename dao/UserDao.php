<?php
require "Conexao.php";
require_once "../models/User.php";

class UserDao{

    public function cadastrar($user)
    {
        $conexao = Conexao::getInstance();

        $sql = "INSERT INTO usuario(nome, usuario, senha, nivel) VALUES(?,?,?,?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $user->getNome());
        $stmt->bindParam(2, $user->getUsuario());
        $stmt->bindParam(3, $user->getSenha());
        $stmt->bindParam(4, $user->getNivel());
        $stmt->execute();

        return;
    }

    public function login($user, $senha)
    {
        $conexao = Conexao::getInstance();

        $sql = "SELECT * FROM usuario WHERE usuario = '".$user."' AND senha = '".$senha."'";
        $row = $conexao->query($sql);

        return $row->fetchAll();
    }
}