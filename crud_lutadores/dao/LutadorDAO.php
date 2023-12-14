<?php 
//DAO para Lutador
require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Lutadores.php");
require_once(__DIR__ . "/../model/Categoria.php");
require_once(__DIR__ . "/../model/Organizacoes.php");


class LutadorDAO {

    private $conn;

    public function __construct() {
        $this->conn = Connection::getConnection();
    }

    public function insert(Lutador $lutador) {
        $sql = "INSERT INTO lutadores" . 
                " (nome, altura, peso, id_organizacao, id_categoria)" .
                " VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$lutador->getNome(),
                        $lutador->getAltura(),
                        $lutador->getPeso(),
                        $lutador->getorganizacao()->getId(), 
                        $lutador->getcategoria()->getId()]);
    }

    public function update(Lutador $lutador) {
        $conn = Connection::getConnection();

        $sql = "UPDATE lutadores SET nome = ?, altura = ?, peso = ?,". " id_organizacao = ?,". " id_categoria = ?".
            " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$lutador->getNome(), $lutador->getAltura(), $lutador->getPeso(), 
                        $lutador->getOrganizacao()->getId(),
                        $lutador->getCategoria()->getId(),
                        $lutador->getId()]);
    }

    public function deleteById(int $id) {
        $conn = Connection::getConnection();

        $sql = "DELETE FROM lutadores WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
    }

    public function list() {
        $sql = "SELECT l.*,".
        " c.nome AS nome_categoria,".
        " c.peso AS peso_categoria,".
        " o.nome AS nome_organizacao,".
        " o.sigla AS sigla_organizacao".
        " FROM lutadores l".
        " JOIN categorias c ON (c.id = l.id_categoria)".
        " JOIN organizacoes o ON (o.id = l.id_organizacao)".
       " ORDER BY l.nome";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapBancoParaObjeto($result);
    }

    public function findById(int $id) {
        $conn = Connection::getConnection();

        $sql = "SELECT l.*," . 
                " c.nome AS nome_categoria, c.peso AS peso_categoria, o.nome AS nome_organizacao, o.sigla AS sigla_organizacao" . 
                " FROM lutadores l" .
                " JOIN categorias c ON (c.id = l.id_categoria) JOIN organizacoes o ON (o.id = l.id_organizacao)" .
                " WHERE l.id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll();

        //Criar o objeto Lutador
        $lutadores = $this->mapBancoParaObjeto($result);

        if(count($lutadores) == 1)
            return $lutadores[0];
        elseif(count($lutadores) == 0)
            return null;

        die("LutadorDAO.findById - Erro: mais de um lu$lutadores".
                " encontrado para o ID " . $id);
    }


    
    //Converte do formato Banco (array associativo) para Objeto
    private function mapBancoParaObjeto($result) {
        $lutadores = array();

        foreach($result as $reg) {
            $lutador = new Lutador();
            $lutador->setId($reg['id'])
                ->setNome($reg['nome'])
                ->setAltura($reg['altura'])
                ->setPeso($reg['peso'])  ;              


                $organizacao = new Organizacao();
                $organizacao->setId($reg['id_organizacao'])
                ->setNome($reg['nome_organizacao'])
                ->setSigla($reg['sigla_organizacao']);

            
            $categoria = new Categoria ();
            $categoria->setId($reg['id_categoria'])
            ->setNome($reg['nome_categoria'])
            ->setPeso($reg['peso_categoria']) ;

            $lutador->setOrganizacao($organizacao);
            $lutador->setCategoria($categoria);
            array_push($lutadores, $lutador);
        }

        return $lutadores;
    }

}