<!DOCTYPE HTML>
<!--
        Halcyonic 1.0 by nodethirtythree + FCT
        http://nodethirtythree.com | @nodethirtythree
        Released under the Creative Commons Attribution 3.0 license (nodethirtythree.com/license)
-->
<html>
    <head>
        <title>Don't get Kicked! - Pesquisa de veículos</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <!--5grid--><script src="css/5grid/viewport.js"></script><!--[if lt IE 9]><script src="css/5grid/ie.js"></script><![endif]--><link rel="stylesheet" href="css/5grid/responsive.css" /><!--/5grid-->
        <link rel="stylesheet" href="css/style.css" />
        <!--[if lte IE 9]><link rel="stylesheet" href="css/style-ie9.css" /><![endif]-->
    </head>
    <body class="subpage">

        <!-- Header -->
        <div id="header-wrapper">
            <?php include 'stuff/header.php' ?>
        </div>

        <!-- Content -->
        <div id="content-wrapper">
            <div id="content">
                <div class="5grid">
                    <div class="12u-first">

                        <!-- Main Content -->
                        <section>
                            <?php
                            $vehId = (int) $_GET["idVeiculo"];
                            $erro = 0;

                            if ($vehId != 0) {
                                $sql = "select isbadbuy FROM dontgetkicked WHERE veiculoId=" . $vehId;
                                $result = mysql_query($sql);
                                if ($row = mysql_fetch_array($result)) {
                                    $classif = $row["isbadbuy"];
                                    if ($classif == 1 || $classif == 0) {
                                        if ($classif == 1) {
                                            $compra = 'má';
                                        } else if ($classif == 0) {
                                            $compra = 'boa';
                                        } 
                                        echo '<header><h2>Resultados</h2><h3>';
                                        echo 'O veículo ' . $vehId . ' foi classificado como uma ' . $compra . ' compra.';
                                        echo '</header><p>Clique abaixo para voltar ao inicio.</p><p><a href="index.php" class="button-small"><font color="FFFFFF">Voltar a início</font></a></p>';
                                    } else {
                                        //$erro = 2; //nao esta classificado BD

                                        include 'stuff/javaBridge.php';
                                        $classif = getResultDgkJava("evaluate " . $vehId);
                                        //echo $classif;

                                        if ($classif == 1 || $classif == 0) {
                                            if ($classif == 1) {
                                                $compra = 'má';
                                            } else
                                                $compra = 'boa';
                                        }
                                        $classif = $compra;
                                        echo '<header><h2>Resultados</h2><h3>';
                                        echo "Segundo o nosso classificador automático trata-se de " . $compra . " compra </h3>";
                                        echo '</header><p>Clique abaixo para voltar ao inicio.</p><p><a href="index.php" class="button-small"><font color="FFFFFF">Voltar a início</font></a></p>';
                                    }
                                } else {
                                    $erro = 1; //nao existe BD
                                    $mensagemErro = "O veículo não se encontra registado.</h3>";
                                }
                            } else {
                                $erro = 3;
                                $mensagemErro = "O id do veículo dado indicado não é válido.</h3>";
                            }
                            if ($erro == 1 || $erro == 3) {
                                echo '<header><h2>Erro</h2><h3>';
                                echo $mensagemErro;
                                echo '</header><p>Clique abaixo para tentar de novo.</p><p><a href="pesquisa.php" class="button-small"><font color="FFFFFF">Voltar a início</font></a></p>';
                            }
                            //echo "erro" . $erro;
                            ?>

                        </section>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer --> 
        <?php include 'stuff/footer.php'; ?>
    </body>
</html>