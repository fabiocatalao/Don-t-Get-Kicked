<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

include 'stuff/connect.php';
dbOpen();
?>
<header id="header" class="5grid">
    <div class="12u-first">

        <!-- Logo -->
        <h1><a href="index.php">Don't get kicked!</a></h1>

        <!-- Nav -->
        <nav>
            <a href="classificador.php">Requerer avaliação de veículo</a>
            <a href="classificar.php">Classificar veículo</a>
            <a href="pesquisa.php">Pesquisar veículo</a>
        </nav>

    </div>
</header>