<?php
require "Conexao.php";
require __DIR__."\..\models\Lote.php";
session_start();
class LotesDao{
    
    public function __construct()
    {
        
    }

    public function cadastrar($lote)
    {
        $conexao = Conexao::getInstance();

        //Verifica se já não existe um lote em aberto
        $verifyLote = $conexao->query("SELECT * FROM lotes WHERE evento = ".$lote->getEvento()." ORDER BY id DESC LIMIT 1");
        $verify = $verifyLote->fetch();
        
        if($verify[5] == 1){
            $_SESSION['msg'] = ["title" => "Um lote já está aberto para esse evento", "text" => "Feche o lote já aberto antes de emitir um novo!", "icon" => "error"];
            header("location: ../emitirSenha.php");
            return;
        }

                
        $sql = "INSERT INTO lotes(data_emissao, qtd_senha, valor, evento, ativo) VALUES (?,?,?,?,?)";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $lote->getDataEmissao());
        $stmt->bindParam(2, $lote->getQtdSenha());
        $stmt->bindParam(3, $lote->getValor());
        $stmt->bindParam(4, $lote->getEvento());
        $stmt->bindParam(5, $lote->getAtivo());
        $stmt->execute();

        $lastRow = $conexao->query('SELECT * FROM lotes ORDER BY id DESC LIMIT 1');

        $last = $lastRow->fetch();
        for($i = 0; $i < $last[2]; $i++){
            $codBarras = uniqid(rand(10000, 99999999));
            $stmt = $conexao->prepare("INSERT INTO senhas(lote, cod_barras) VALUES (?,?)");
            $stmt->bindParam(1, $last[0]);
            $stmt->bindParam(2, $codBarras);
            $stmt->execute();
        }
        $_SESSION["loteId"] = $last[0];
        header("location: ../senhas.php");
    }

    public function emitirSenhas($loteId)
    {
        $conexao = Conexao::getInstance();

        $sql = "SELECT * FROM senhas INNER JOIN lotes ON senhas.lote = lotes.id INNER JOIN eventos ON lotes.evento = eventos.id WHERE lotes.id = ".$loteId;

        $result = $conexao->query($sql);
        
        return $result->fetchAll();
    }

    public function listAll()
    {
        $conexao = Conexao::getInstance();

        $sql = "SELECT * FROM lotes INNER JOIN eventos on eventos.id = lotes.evento ORDER BY lotes.id DESC";

        $result = $conexao->query($sql);

        return $result->fetchAll();
    }

    public function baixarLote($loteId)
    {
        $conexao = Conexao::getInstance();

        $sql = "UPDATE lotes SET ativo = 0 WHERE id = ".$loteId;

        $stmt = $conexao->prepare($sql);
        $stmt->execute();
    }

    public function portariaConsulta($cod_barras)
    {
        $conexao = Conexao::getInstance();

        $sql = "SELECT * FROM senhas INNER JOIN lotes ON senhas.lote = lotes.id INNER JOIN eventos ON lotes.evento = eventos.id WHERE senhas.cod_barras = ".$cod_barras;

        $row = $conexao->query($sql);

        return $row->fetch();
    }
}