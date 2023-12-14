<?php 

class Organizacao implements JsonSerializable  {

    private ?int $id;
    private ?string $nome;
    private ?string $sigla;

    public function jsonSerialize() : array
    {
        return array("id" => $this->id,
            "nome" => $this->nome,
            "sigla" => $this->sigla);

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


    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

}




?>