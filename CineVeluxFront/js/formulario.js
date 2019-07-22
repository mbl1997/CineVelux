        // event
            document.querySelector("#enviar").addEventListener('click', function() {
            // get entires
            //Dados pessoais
            let object = {};
            object.name = document.getElementById('nome').value;
            
            generos = document.getElementsByName("genero");
            for(var i = 0; i < generos.length; i++){
                if(generos[i].checked) 
                object.genero = generos[i].value;
             }    
          
                object.datanascimento = document.getElementById ('data').value;
                object.mail = document.getElementById('contato').value;
                object.password = document.getElementById ('password').value;
                object.tel = document.getElementById('telefone').value;

                // Endereço
                object.rua = document.getElementById("rua").value;
                object.numero = document.getElementById("numero").value;
                object.complemento = document.getElementById("complemento").value;
                object.cidade = document.getElementById("cidade").value;
                object.estado = document.getElementById("estado").value;
                object.pais = document.getElementById("pais").value;

                        
            console.log(object);

        });

           