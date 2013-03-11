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
                            $vehId = (int) $_GET["vehId"];
                            $vehCl = $_GET["vehCl"];
                            $erro = 0;
                            
                            if ($vehId !=0) {
                                $sql = "UPDATE dontgetkicked SET IsBadBuy=" . $vehCl . " WHERE veiculoId =" . $vehId;
                                //echo $sql
//                                $result = mysql_query($sql);
                                $result = mysql_query($sql) or die ("A MySQL error has occurred.<br />Your Query: " . $sql . "<br /> Error: (" . mysql_errno() . ") " . mysql_error());
                                //echo $result;
                                echo '<header>
                                        <h2>Agradecimento</h2>
                                        <h3>Obrigado pela sua colaboração na classificação da sua compra.</h3>
                                    </header>
                                    <p>Apenas com a colaboração de todos os utilizadores é possível o funcionamento deste projeto.</p>
                                    <p>
                                        <a href="index.php" class="button-small"><font color="FFFFFF">Voltar a início</font></a>
                                    </p>';
                            } else {
                                $erro = 1;
                            }

                            if ($erro == 1) {
                                echo '<header>
                                        <h2>Erro</h2>
                                        <h3>O id do veículo dado indicado não é válido.</h3>
                                    </header>
                                    <p>Clique abaixo para tentar de novo.</p>
                                    <p><a href="classificar.php" class="button-small"><font color="FFFFFF">Tentar de novo</font></a></p>';
                            }
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