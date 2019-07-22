var tokenEndPoint = "http://localhost/wscinevelux/auth";

document.querySelector('#buscarTokenBtn').addEventListener("click", function(){ buscarToken() });

function buscarToken(){

    var login = document.querySelector("#username").value;
    var senha = document.querySelector("#password").value;   

    console.log(login + " " + senha);

        if(login != "" && senha != "") {
            
            console.log("ENTROU 1");

            dados = {
                login:login,
                senha:senha
            };

            console.log("dados!");
            console.log(dados);

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){

                console.log("readystate");
                //console.log(this.responseText);

                if (this.readyState === 4 && this.responseText === "401"){
                    console.log("entrouuu 401");
                    document.querySelector("#mensagem").innerHTML = "Erro no usuário e/ou senha";
                }else{
                    if(this.readyState === 4 && this.status === 200){
                        retorno = JSON.parse(this.responseText);
                        //console.log(retorno);
                        console.log("===> " + retorno.token);
                        
                        sessionStorage.setItem('token', retorno.token);
                        window.location.href= "detalhesfilmes.html";
                    }
                }
            };       
            xhttp.open("POST", tokenEndPoint, true);
            xhttp.setRequestHeader("Content-Type","application/json");
            xhttp.send(JSON.stringify(dados));

        } else {
            document.querySelector("#mensagem").innerHTML = "Por favor, preecha todos os campos corretamente";
        }     
}

