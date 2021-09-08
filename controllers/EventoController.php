<?php
require __DIR__."\..\dao\EventosDao.php";
require_once __DIR__."\..\models\Evento.php";

if(isset($_POST['cadastrar'])){
    EventoController::cadastrar();
}

class EventoController{
    private $eventoDao;
    
    public function __construct()
    {
        
    }

    public function cadastrar(){
        $evento = new Evento();
        $evento->setNome($_POST['nome']);
        $evento->setAtracoes($_POST['atracoes']);
        $evento->setHora($_POST['hora']);
        $evento->setData($_POST['data']);

        $eventoDao = new EventosDao();
        $eventoDao->cadastrar($evento);
    }

    public function listar(){
        $eventoDao = new EventosDao();
        return $eventoDao->listar();
    }

    public function listarTodos()
    {
        $eventoDao = new EventosDao();
        return $eventoDao->listAll();
    }
}