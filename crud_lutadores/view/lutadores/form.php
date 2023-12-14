<?php 
// Formulário para Lutadores

require_once(__DIR__ . "/../../controller/OrganizacoesController.php");
require_once(__DIR__ . "/../../controller/CategoriasController.php");
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../../util/config.php");

$categoriaCont = new CategoriasController();
$categorias = $categoriaCont->listar();
$organizaCont = new OrganizacoesController();
$organizacoes = $organizaCont->listar();

?>

<h2><?php echo (!$lutador || $lutador->getId() <= 0 ? 'Inserir' : 'Alterar') ?> Lutador</h2>

<div class="row mb-3">
    <div class="col-6">
        <form id="frmLutador" method="POST" >

            <div class="form-group">
                <label for="txtNome">Nome:</label>
                <input type="text" name="nome" id="txtNome" class="form-control"
                    value="<?php echo ($lutador ? $lutador->getNome() : ''); ?>" />
            </div>

            <div class="form-group">
                <label for="txtPeso">Peso:</label>
                <input type="number" name="peso" id="txtPeso" class="form-control" oninput="selecionarCategoria()"
                    value="<?php echo ($lutador ? $lutador->getPeso() : ''); ?>" />
            </div>

            <div class="form-group">
                <label for="txtAltura">Altura:</label>
                <input type="number" name="altura" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" id="txtAltura" class="form-control"
                    value="<?php echo ($lutador ? $lutador->getAltura() : ''); ?>" />
            </div>

            <div class="form-group">
                <label for="selOrganizacao">Organização:</label>
                <select id="selOrganizacao" name="organizacao" class="form-control">
                    <option value="">---Selecione---</option>
                    
                    <?php foreach($organizacoes as $organizacao): ?>
                        <option value="<?= $organizacao->getId(); ?>"
                            <?php 
                                if($lutador && $lutador->getOrganizacao() && 
                                    $lutador->getOrganizacao()->getId() == $organizacao->getId())
                                    echo 'selected';
                            ?>
                        >
                            <?= $organizacao->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="selCategoria">Categoria:</label>
                <select id="selCategoria" name="categoria" class="form-control">
                    <option value="">---Selecione---</option>
                    
                    <?php foreach($categorias as $categoria): ?>
                        <option value="<?= $categoria->getId(); ?>"
                            <?php 
                                if($lutador && $lutador->getCategoria() && 
                                    $lutador->getCategoria()->getId() == $categoria->getId())
                                    echo 'selected';
                            ?>
                        >
                            <?= $categoria->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="hidden" id="hddBaseUrl" value="<?= BASE_URL ?>" />
            <input type="hidden" name="id" 
                value="<?php echo ($lutador ? $lutador->getId() : 0); ?>" />
            
            <input type="hidden" name="submetido" value="1" />

            <button type="button" class="btn btn-success" onclick="inserirLutador();">Gravar AJAX</button>
            <button type="submit" class="btn btn-success">Gravar</button>
            <button type="reset" class="btn btn-info">Limpar</button>
        </form>
    </div>

    <div class="col-6" id="divMsgErro">
        <?php if($msgErro): ?>
            <div class="alert alert-danger">
                <?php echo $msgErro; ?>
            </div>
        <?php endif; ?>
    </div>    
</div>

<a href="listar.php" class="btn btn-outline-secondary">Voltar</a>
<script src="lutadores.js"></script>
<?php require_once(__DIR__ . "/../include/footer.php"); ?>
