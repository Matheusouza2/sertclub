<?php
require "Conexao.php";
require __DIR__."\..\models\Evento.php";

class EventosDao{

    public function __construct()
    {
        
    }

    public function cadastrar($evento)
    {
        $conexao = Conexao::getInstance();

        $sql = "INSERT INTO eventos(nome, data, hora, atracoes) VALUES (?,?,?,?)";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $evento->getNome());
        $stmt->bindParam(2, $evento->getData());
        $stmt->bindParam(3, $evento->getHora());
        $stmt->bindParam(4, $evento->getAtracoes());

        $stmt->execute();

        header("location: ../admin.php");
    }

    public static function listar(){
        $conexao = Conexao::getInstance();

        $sql = "SELECT eventos.*, count(lotes.id) FROM eventos INNER JOIN lotes ON lotes.evento = eventos.id GROUP BY lotes.id;";

        $result = $conexao->query($sql);
        
        return $result->fetchAll();
    }

    public function listAll()
    {
        $conexao = Conexao::getInstance();

        $sql = "SELECT * FROM eventos";

        $result = $conexao->query($sql);
        
        return $result->fetchAll();
    }
}