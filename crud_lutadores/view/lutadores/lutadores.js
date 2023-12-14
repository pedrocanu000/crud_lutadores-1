const baseUrl = document.getElementById('hddBaseUrl').value;

const inputNome = document.getElementById('txtNome');
const inputPeso = document.getElementById('txtPeso');
const inputAltura = document.getElementById('txtAltura');
const inputOrganizacao = document.getElementById('selOrganizacao');
const inputCategoria = document.getElementById('selCategoria');

const divErros = document.getElementById('divMsgErro');

function selecionarCategoria(){
	
	var xhttp = new XMLHttpRequest();

    var url = baseUrl + "/api/selecionar_categoria.php";
	xhttp.open("GET", url);
	xhttp.onload = function () {
        var resposta = xhttp.responseText;
		var categorias = JSON.parse(resposta);
			for(let i = 0; i <= categorias.length - 1; i++){
				if(parseInt(inputPeso.value) >= parseInt(categorias[i].peso)){
					inputCategoria.value = i+1;
				}else if(i == 0){
					inputCategoria.value = 1;
					break;
				}else{
					break;
				}
		};
		
        
    };
    xhttp.send();
}
function inserirLutador() {
    // Estrutura FormData para enviar os parâmetros no corpo da requisição do tipo POST
    var dados = new FormData();
    dados.append("nome", inputNome.value);
    dados.append("peso", inputPeso.value);
    dados.append("altura", inputAltura.value);
    dados.append("idOrganizacao", inputOrganizacao.value);
    dados.append("idCategoria", inputCategoria.value);

    // Requisição AJAX
    var xhttp = new XMLHttpRequest();

    var url = baseUrl + "/api/inserir_lutador.php";

    xhttp.open("POST", url);
    xhttp.onload = function () {
        var resposta = xhttp.responseText;

        if (resposta.trim()) {
            divErros.innerHTML = resposta;
            divErros.style.display = "block";
        } else {
            // Redirecionar para a listagem
            window.location = "listar.php";
        }
    };
    xhttp.send(dados);
}
