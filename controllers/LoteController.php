<?php

require __DIR__."\..\dao\LotesDao.php";
require_once __DIR__."\..\models\Lote.php";

if(isset($_POST['cadastrar'])){
    LoteController::cadastrar();
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

    public function emitirSenhas()
    {
        $loteDao = new LotesDao();

        return $loteDao->emitirSenhas();
    }
}
