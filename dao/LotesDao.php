<?php
require "Conexao.php";
require __DIR__."\..\models\Lote.php";
class LotesDao{

    public function __construct()
    {
        
    }

    public function cadastrar($lote)
    {
        $conexao = Conexao::getInstance();

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
            $codBarras = uniqid($last[0]);
            $stmt = $conexao->prepare("INSERT INTO senhas(lote, cod_barras) VALUES (?,?)");
            $stmt->bindParam(1, $last[0]);
            $stmt->bindParam(2, $codBarras);
            $stmt->execute();
        }

        header("location: ../emitirSenha.php");
    }

    public function emitirSenhas()
    {
        $conexao = Conexao::getInstance();

        $sql = "SELECT * FROM senhas INNER JOIN lotes ON senhas.lote = lotes.id INNER JOIN eventos ON lotes.evento = eventos.id";

        $result = $conexao->query($sql);
        
        return $result->fetchAll();
    }
}