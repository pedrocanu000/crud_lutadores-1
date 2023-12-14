const baseUrl = "/WEB/crud_lutadores";
const inputBuscarId = document.getElementById('idDetalhes');

function mostrarDetalhes(idDetalhes, id) {
    //Requisição AJAX para trazer os dados da avaliação
    var xhttp = new XMLHttpRequest();

    var url = baseUrl + "/api/detalhes.php" + "?id=" + id;
    xhttp.open("GET", url);


    xhttp.onload = function() {
        //Resposta da requisição

        console.log("Resposta recebida do servidor!");

        var detalhes = document.getElementById("mostrarDetalhes");
        if (detalhes.style.display === 'none') {
            detalhes.style.display = 'block'; // Mostra a descrição correspondente ao botão clicado
        }
        var json = xhttp.responseText;
        console.log(json);

        var lutador = JSON.parse(json);

         const idPe = document.querySelector("#idPe");
         idPe.innerHTML = lutador.peso;
         const idAlt = document.querySelector("#idAlt");
         idAlt.innerHTML = lutador.altura;
         const idCate = document.querySelector("#idCate");
         idCate.innerHTML = lutador.categoria.nome;


    }
    xhttp.send();

}