<?php

require_once(__DIR__ . "/../dao/OrganizacaoDAO.php");

class OrganizacoesController {

    private OrganizacaoDAO $organizacaoDAO;

    public function __construct() {
        $this->organizacaoDAO = new OrganizacaoDAO();
    }

    public function listar() {
        return $this->organizacaoDAO->list();
    }

}