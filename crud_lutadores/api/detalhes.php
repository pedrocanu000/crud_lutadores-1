<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../controller/Lutadorcontroller.php");
require_once(__DIR__ . "/../dao/LutadorDAO.php");

//1- Capturar o ID da avaliação do parâmetro GET
$idLutador = $_GET['id'];

//2- Buscar o objeto avaliacao a partir do ID recebido (Controller, DAO)
$LutadorCont = new LutadorController();
$lutadores = $LutadorCont->buscarPorId($idLutador);

//3- Retornar os dados da avaliação no formato JSON
echo json_encode($lutadores, JSON_UNESCAPED_UNICODE);