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

        $sql = "INSERT INTO eventos(nome, data, hora, atracoes, local) VALUES (?,?,?,?,?)";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $evento->getNome());
        $stmt->bindParam(2, $evento->getData());
        $stmt->bindParam(3, $evento->getHora());
        $stmt->bindParam(4, $evento->getAtracoes());
        $stmt->bindParam(5, $evento->getLocal());

        $stmt->execute();

        header("location: ../admin.php");
    }

    public static function listar(){
        $conexao = Conexao::getInstance();

        $sql = "SELECT eventos.*, count(eventos.id) as qtd_lotes FROM eventos INNER JOIN lotes on lotes.evento = eventos.id GROUP BY eventos.id;";

        $result = $conexao->query($sql);
        
        return $result->fetchAll();
    }

    public function listAll()
    {
        $conexao = Conexao::getInstance();
        $hoje = date('Y/m/d');
        $sql = "SELECT * FROM eventos WHERE data > '".$hoje."'";

        $result = $conexao->query($sql);
        
        return $result->fetchAll();
    }
}