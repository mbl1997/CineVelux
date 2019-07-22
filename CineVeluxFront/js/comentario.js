var urlws = "http://localhost/wscinevelux/comentario";


function excluirComentario(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState === 4 && this.status === 200){
           listarComentario(); 
        }
    };
    xhttp.open("DELETE", urlws + "/" + id, true);
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send();
}

function limparComentario(){
    document.querySelector("#mensagem").value = "";
}

function confirmarExcluir(id){
    if(confirm("Tem certeza que deseja excluir?"))
    excluirComentario(id);
    else
    false
}


function montarTabela(comentario){
    var str = "";
    str+= "<table>";
    str+= "<tr>";
    str+= "<th>Comentario</th>";
    str+= "</tr>";

     for(var i in comentario){
         str+= "<tr>";
         str+= "<td>" + comentario[i].mensagem + "</td>";
         str+="<td onclick='confirmarExcluir(" + comentario[i].id + ")' class='excluir'>Excluir</a></td>";
         str+="</tr>";
     }

     str+= "</table>";
     var tabela = document.querySelector("#tabela");
     tabela.innerHTML = str;
}  

function listarComentario(){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState ===4 && this.status ===200){
            montarTabela(JSON.parse(this.responseText));
        }  
    };
    xhttp.open("GET", urlws, true);
    xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
    xhttp.send();
    }

    function inserirComentario(comentario){

        console.log("Inserir");
        console.log(comentario);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState ===4 && this.status === 201){
                console.log("Responde recebido!");
                limparComentario();
                listarComentario();
            }
        };
        xhttp.open("POST", urlws, true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
        xhttp.send(JSON.stringify(comentario));
    }

    var body = document.querySelector("body");
    body.onload = function () {
    listarComentario();
}


document.querySelector('#enviar').addEventListener("click", function() { 

    console.log("Entrou");
    var comentario = {};
    comentario.mensagem = document.querySelector("#mensagem").value;


    console.log(comentario);

    //var id = document.querySelector("#id").value;
    
      //      if(id == "")
                inserirComentario(comentario);
      //       else
      //       atualizarDadosFilme(titulo, genero, id);
});
