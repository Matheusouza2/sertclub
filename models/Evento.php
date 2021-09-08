<?php

class Evento{

    private $id;
    private $nome;
    private $atracoes;
    private $data;
    private $hora;
    private $local;

    public function __construct()
    {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getAtracoes()
    {
        return $this->atracoes;
    }

    public function setAtracoes($atracoes)
    {
        $this->atracoes = $atracoes;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getHora()
    {
        return $this->hora;
    }

    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    public function getLocal()
    {
        return $this->local;
    }

    public function setLocal($local)
    {
        $this->local = $local;
    }
      
}