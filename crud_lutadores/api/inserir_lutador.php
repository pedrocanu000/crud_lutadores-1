<?php
// API para inserir um lutador
require_once(__DIR__ . "/../controller/LutadorController.php");
require_once(__DIR__ . "/../model/Lutadores.php");
require_once(__DIR__ . "/../model/Categoria.php");
require_once(__DIR__ . "/../model/Organizacoes.php");

$msgErro = '';
$lutador = null;

    // Captura os campos do formulário

    $nome = ($_POST['nome']) ? $_POST['nome'] : 0;
    $peso = is_numeric ($_POST['peso']) ? $_POST['peso'] : 0;
    $altura = is_numeric ($_POST['altura']) ? $_POST['altura'] : 0;
    $organizacaoId = is_numeric ($_POST['idOrganizacao']) ? $_POST['idOrganizacao'] : 0;
    $categoriaId = is_numeric ($_POST['idCategoria']) ? $_POST['idCategoria'] : 0;


//    $nome = trim($_POST['nome']) ?? null;
//    $altura = $_POST['altura'] ?? null;
//    $peso = $_POST['peso'] ?? null;
//    $categoriaId = $_POST['idCategoria'] ?? null;
//    $organizacaoId = $_POST['idOrganizacao'] ?? null;

    // Criar o objeto lutador
    $lutador = new Lutador();
    $lutador->setNome($nome);
    $lutador->setAltura($altura);
    $lutador->setPeso($peso);

    if($categoriaId) {
        $categoria = new Categoria();
        $categoria->setId($categoriaId);
        $lutador->setCategoria($categoria);
    }
    if ($organizacaoId) {
    $organizacao = new Organizacao();
    $organizacao->setId($organizacaoId);

    $lutador->setOrganizacao($organizacao);
    }
    // Chama o controller para salvar o lutador
    $lutadorCont = new LutadorController();
    $erros = $lutadorCont->inserir($lutador);

$msgErro = "";
if($erros)
    $msgErro = implode("<br>", $erros);

echo $msgErro;

