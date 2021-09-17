<?php
?>
<!Doctype html  lang="e">
<html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>
            Cadastro
        </title>

        <script type="text/javascript">
            function validar(){
                var email = formul.email.value;
                var senha = formul.senha.value;

                if(email == ""){
                    alert('Preencha o campo email');
                    formul.email.focus();
                    return false;
                }
                if(senha == ""){
                    alert('Preencha o campo senha');
                    formul.senha.focus();
                    return false;
                }
            }
        </script>
        
    </head>

    <body>
        <p>------------------------------ Login ------------------------------</p>
        <div id="area" class="center-form">
            <form name = "formul" id="formulario" autocomplete="off" action="?class=usuario&action=sigin" method="post">
                <fieldset>
                    <div>
                        <font>-Email:</font></b>
                        <input type="e-mail" name="email" id="iEmail">
                    </div>
                    <div>
                        <font>-Senha:</font></b>
                        <input type="password" name="senha" id="senha">
                    </div>
                    <br>
                    <button class="bt" onclick="return validar()">Enviar</button>
                    <div class="vocative">
                        <span>Não tem cadastro</span>
                        <a href=>Cadaste-se</a>
                    </div>    
                </fieldset>
            </form>
        </div>
    </body>
</html>