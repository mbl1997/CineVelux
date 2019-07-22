var urlws = "http://localhost/wscinevelux/filme";


    function buscarPorId (){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState ===4 && this.status === 200){
                var filme = JSON.parse(this.responseText);
                document.querySelector("#titulo").value = filme.titulo;
                document.querySelector("#generofilme").value = filme.genero;
            }
        };
        xhttp.open ("GET", urlws,true);
        xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
        xhttp.send();
    }

        function excluirFilme(id){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(this.readyState === 4 && this.status === 200){
                    listarFilme(); 
                }
            };
            xhttp.open("DELETE", urlws + "/" + id, true);
            xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
            xhttp.send();
        }


        function editarFilme(id){

            console.log("editar");
            console.log(id);

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(this.readyState === 4 && this.status === 200){ 
                    console.log(this.responseText);
                    var filme = JSON.parse(this.responseText);
                    console.log(filme);
                    document.querySelector("#titulo").value = filme.titulo;
                    document.querySelector("#generofilme").value = filme.genero;
                    document.querySelector("#txtid").value = filme.id;
                }
            };
            xhttp.open("GET", urlws + "/" + id, true);
            xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
            xhttp.send();
        }

       function atualizarDadosFilme(filme, id){
           var xhttp = new XMLHttpRequest();
           xhttp.onreadystatechange = function(){
               if(this.readyState === 4 && this.status === 200){
                   console.log("Response Recebido!");
                   limparFilme();
                   listarFilme();
               }
           };
           xhttp.open("PUT", urlws + "/" + id, true);
           xhttp.setRequestHeader("Content-Type", "application/json");
           xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
           xhttp.send(JSON.stringify(filme));
       }     

      function limparFilme(){
            document.querySelector("#titulo").value = "";
            document.querySelector("#generofilme").value = "";
        }
    

     function confirmarExcluir(id){
         if(confirm("Tem certeza que deseja excluir?"))
         excluirFilme(id);
         else
         false
     }

     function montarTabela(filme){
        var str = "";
        str+= "<table>";
        str+= "<tr>";
        str+= "<th>Titulo</th>";
        str+= "<th>Genero</th>";
        str+= "</tr>"; 

            for(var i in filme){
                str+= "<tr>";
                str+= "<td>" + filme[i].titulo + "</td>";
                str+= "<td>" + filme[i].genero + "</td>";
                str+="<td onclick='confirmarExcluir(" + filme[i].id + ")' class='excluir'>Excluir</a></td>";
                str+= "<td onclick='editarFilme(" + filme[i].id + ")' class='editar'>Editar</a></td>";
                str+="</tr>";
            }

            str+= "</table>";
            var tabela = document.querySelector("#tabela");
            tabela.innerHTML = str;
     }  

   function listarFilme(){

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


    function inserirFilme(filme){

        console.log("Inserir");
        console.log(filme);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState ===4 && this.status === 201){
                console.log("Responde recebido!");
                limparFilme();
                listarFilme();
            }
        };
            xhttp.open("POST", urlws, true);
            xhttp.setRequestHeader("Content-Type","application/json");
            xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
            xhttp.send(JSON.stringify(filme));
    }



    var body = document.querySelector("body");
    body.onload = function () {
        listarFilme();
    }


    document.querySelector('#enviarFilme').addEventListener("click", function() { 

        console.log("Entrou");
        var filme = {};
        filme.titulo = document.querySelector("#titulo").value;
        filme.genero = document.querySelector("#generofilme").value;

        console.log(filme);

        var id = document.querySelector("#txtid").value;
        
        if(id == "")
            inserirFilme(filme);
        else
        atualizarDadosFilme(filme, id);
    });






   

