<?php

require __DIR__."\..\dao\LotesDao.php";
require_once __DIR__."\..\models\Lote.php";

if(isset($_POST['cadastrar'])){
    LoteController::cadastrar();
}else if(isset($_GET['loteId'])){
    LoteController::encerrarLote($_GET['loteId']);
}else if(isset($_GET['cod_barras'])){
    LoteController::portariaConsulta($_GET['cod_barras']);
}

class LoteController{

    public function cadastrar()
    {
        $hoje = date('Y/m/d');
        $lote = new Lote();
        $lote->setDataEmissao($hoje);
        $lote->setQtdSenha($_POST['qtd_senhas']);
        $lote->setValor($_POST['valor']);
        $lote->setEvento($_POST['evento']);
        $lote->setAtivo(1);

        $loteDao = new LotesDao();

        $loteDao->cadastrar($lote);
    }

    public function listarTodos()
    {
        $loteDao = new LotesDao();

        return $loteDao->listAll();
    }

    public function emitirSenhas($loteId)
    {
        $loteDao = new LotesDao();

        return $loteDao->emitirSenhas($loteId);
    }

    public function encerrarLote($loteId)
    {
        $loteDao = new LotesDao();

        $loteDao->baixarLote($loteId);

        echo "Lote Encerrado com sucesso !";
    }

    public function portariaConsulta($cod_barras)
    {
        $loteDao = new LotesDao();
        $cod = substr($cod_barras, 0, -1);
        echo json_encode($loteDao->portariaConsulta($cod));
    }
}
