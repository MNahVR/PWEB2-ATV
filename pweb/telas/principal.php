<?php
require_once "pweb/usuario.php";
$user = $_SESSION["loggedUser"];
if(isset($_GET["pesquisa"])){
    $usuarios = usuario::pesquisa($_GET["pesquisa"]);
}else{
    $usuarios = usuario::listUsuario();
}
function logOut(){
    session_destroy();
    header("Location: /");
}
?>
<!Doctype html>

<html lang="e">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Principal
        </title>    
    </head>

    <body>
        <div class="container">
            <section>
                <form action="?tela=principal" methos="GET">
                    <label for="pesquisa">Pesquisar usuário:</label>
                    <input id="pesquisa" name="pesquisa" type="text">
                    <button type="submit">Enviar</button>
                </form>
                <h1> SEJA BEM-VINDO! <?= $user['nomeu'] ?></h1>
                <table>
                    <thead>
                        <th>Id</th>
                        <th>Nome completo</th>
                        <th>Nome de usuário</th>
                        <th>Email</th>
                    </thead>
                    <?php foreach($usuarios as $key => $value) : ?>
                        <tr>
                            <td><?= $value->getId() ?></td>
                            <td><?= $value->getNome() ?></td>
                            <td><?= $value->getNomeu() ?></td>
                            <td><?= $value->getEmail() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <form action="?class=usuario&action=logout" method="post" required>
                    <button type="submit">Sair</button>
                    </form>
            </section>
        </div>
    </body>
<html>