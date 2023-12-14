<?php 
//View para alterar alunos

require_once(__DIR__ . "/../../controller/LutadorController.php");
require_once(__DIR__ . "/../../model/Lutadores.php");
require_once(__DIR__ . "/../../model/Categoria.php");
require_once(__DIR__ . "/../../model/Organizacoes.php");


$msgErro = '';
$lutador = null;

$lutadorCont = new LutadorController();

if(isset($_POST['submetido'])) {
    //Usuário clicou no botão gravar (submeteu o formulário)
    //Captura os campo do formulário
    $nome = trim($_POST['nome']) ? trim($_POST['nome']) : null;
    $altura = $_POST['altura'] ? $_POST['altura'] : null;
    $peso = $_POST['peso'] ? $_POST['peso'] : null;
    $idOrganizacao = is_numeric($_POST['organizacao']) ? $_POST['organizacao'] : null;
    $idCategoria = is_numeric($_POST['categoria']) ? $_POST['categoria'] : null;

    $idLutador = $_POST['id'];
    
    //Criar um objeto Aluno para persistência
    $lutador = new Lutador();
    $lutador->setId($idLutador);
    $lutador->setNome($nome);
    $lutador->setAltura($altura);
    $lutador->setPeso($peso);
    if($idOrganizacao) {
        $organizacao = new Organizacao();
        $organizacao->setId($idOrganizacao);
        $lutador->setOrganizacao($organizacao);
    }
    if($idCategoria) {
        $categoria = new Categoria();
        $categoria->setId($idCategoria);
        $lutador->setCategoria($categoria);
    }

    //Criar um alunoController 
    $lutadorCont = new LutadorController();
    $erros = $lutadorCont->atualizar($lutador);

    if(! $erros) { //Caso não tenha erros
        //Redirecionar para o listar
        header("location: listar.php");
        exit;
    } else { //Em caso de erros, exibí-los
        $msgErro = implode("<br>", $erros);
        //print_r($erros);
    }



} else {
    //Usuário apenas entrou na página para alterar
    $idLutador = 0;
    if(isset($_GET['idLutador']))
        $idLutador = $_GET['idLutador'];
    
    $lutador = $lutadorCont->buscarPorId($idLutador);
    if(! $lutador) {
        echo "Lutador não encontrado!<br>";
        echo "<a href='listar.php'>Voltar</a>";
        exit;
    }

}

//Inclui o formulário
include_once(__DIR__ . "/form.php");