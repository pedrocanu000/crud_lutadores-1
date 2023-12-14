<?php 
//Classe service para luta$lutador

require_once(__DIR__ . "/../model/Lutadores.php");

class LutadorService {

    public function validarDados(Lutador $lutador) {
        $erros = array();
        
        //Validar o nome
        if(! $lutador->getNome()) {
            array_push($erros, "Informe o nome!");
        }

        //validar altura
        if(! $lutador->getAltura()) {
            array_push($erros, "Informe a altura!");
        }

        if(! $lutador->getPeso()) {
            array_push($erros, "Informe peso!");
        }

        if(! $lutador->getOrganizacao()) {
            array_push($erros, "Informe a organização!");
        }
        
        if(! $lutador->getCategoria()) {
            array_push($erros, "Informe a categoria!");
        }
        return $erros;
    }

}