<?php

class Lote{
    private $id;
    private $data_emissao;
    private $qtd_senha;
    private $valor;
    private $evento;
    private $ativo;

    public function getId() {
        return $this->id;
    }

    public function getDataEmissao()
    {
        return $this->data_emissao;
    }

    public function setDataEmissao($data_emissao)
    {
        $this->data_emissao = $data_emissao;
    }

    public function getQtdSenha()
    {
        return $this->qtd_senha;
    }

    public function setQtdSenha($qtd_senha)
    {
        $this->qtd_senha = $qtd_senha;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getEvento()
    {
        return $this->evento;
    }

    public function setEvento($evento)
    {
        $this->evento = $evento;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }
}