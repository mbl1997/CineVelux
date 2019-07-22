function validaAcesso(){
    if(sessionStorage.getItem('token')== null){
        location.href = "index.html";
    }
}

function encerraAcesso(){
    sessionStorage.clear();
    location.href = "index.html";
}

document.onload = validaAcesso();
document.querySelector("#logoutBtn").addEventListener("click", function(){ encerraAcesso() });
