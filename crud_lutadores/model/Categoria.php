<?php
class Categoria implements JsonSerializable {

    private ?int $id;
    private ?string $nome;
    private ?string $peso;

    public function jsonSerialize() : array {
        return array("id" => $this->id,
            "nome" => $this -> nome,
            "peso" => $this->peso,);

    }
    public function __toString()
    {
        return $this->nome;
    }
    
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }


    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set the value of peso
     *
     * @return  self
     */ 
    public function setPeso($peso)
    {
        $this->peso = $peso;

        return $this;
    }
}




?>

