<!DOCTYPE HTML>
<!--
        Halcyonic 1.0 by nodethirtythree + FCT
        http://nodethirtythree.com | @nodethirtythree
        Released under the Creative Commons Attribution 3.0 license (nodethirtythree.com/license)
-->
<html>
    <head>
        <title>Don't get Kicked! - Classificação de veículo</title>
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
            <?php
            include 'stuff/header.php';
            include 'stuff/sendMail.php'
            ?>
        </div>

        <!-- Content -->
        <div id="content-wrapper">
            <div id="content">
                <div class="5grid">
                    <div class="12u-first">

                        <!-- Main Content -->
                        <section>
                            <?php
                            $vendedor = strtoupper($_GET["VENDEDOR"]);
                            $vendedorOutro = strtoupper($_GET["VENDEDOROUTRO"]);
                            if ($vendedor == "OUTRO" && $vendedorOutro != "")
                                $vendedor = $vendedorOutro;
                            //echo "Vendedor" . $vendedor . "\n";
                            $mes = $_GET["MES"];
                            $idade = $_GET["IDADE"];
                            $anofabrico = $_GET["ANOFABRICO"];
                            $fabricante = strtoupper($_GET["FABRICANTE"]);
                            $fabricanteOutro = strtoupper($_GET["FABRICANTEOUTRO"]);
                            if ($fabricante == "OUTRO" && $fabricanteOutro != "")
                                $fabricante = $fabricanteOutro;
                            //echo "fabricante" . $fabricante . "\n";
                            $grupo = strtoupper($_GET["GRUPO"]);
                            $grupoOutro = strtoupper($_GET["GRUPOOUTRO"]);
                            //echo "XX" .$grupoOutro . "XX";
                            if ($grupo == "OUTRO" && $grupoOutro != "")
                                $grupo = $grupoOutro;
                            //echo "grupo" . $grupo . "\n";
                            $modelo = strtoupper($_GET["MODELO"]);
                            $submodelo = strtoupper($_GET["SUBMODELO"]);
                            $cor = strtoupper($_GET["COR"]);
                            $transmissao = strtoupper($_GET["TRANSMISSAO"]);
                            $tiporodas = strtoupper($_GET["TIPORODAS"]);
                            $odometro = round((float) ((int) $_GET["ODOMETRO"]) / 10000, 0) * 10;
                            $areafabrico = strtoupper($_GET["AREAFABRICO"]);
                            $tamanho = strtoupper($_GET["TAMANHO"]);
                            $garantia = strtoupper($_GET["GARANTIA"]);
                            $custo = round((float) ((int) $_GET["ODOMETRO"]) / 1000, 0);
                            $compraonline = $_GET["COMPRAONLINE"];
                            $customax = (int) ($_GET["CUSTOMAX"]);
                            $ratioMax = "NULL";
                            if ($customax > 500) {
                                $ratioMax = round(($custo / $customax) * 10, 0);
                            }
                            $customin = (int) ($_GET["CUSTOMIN"]);
                            $ratioMin = "NULL";
                            if ($customax > 500) {
                                $ratioMin = round(($custo / $customin) * 10, 0);
                                if ($ratioMin > 20) {
                                    $ratioMin = round($ratioMin / 10, 0) * 10;
                                }
                            }
                            $sql = "INSERT INTO `dontgetkicked`.`dontgetkicked`(`MesCompra`,`Vendedor`,`AnoFabrico`,`Idade`,`Fabricante`,`Modelo`,`SubModelo`,`Cor`,`Transmissao`,`TipoRodas`,`OdometroMKm`,`OrigemVeiculo`,`Tamanho`,`GrupoVeiculo`,`Garantia`,`Custo`,`CompraOnline`,`RacioCustoMinimo`,`RacioCustoMaximo`,`IsBadBuy`)";
                            $sql = $sql . " VALUES ('" . $mes . "','" . $vendedor . "','" . $anofabrico . "','" . $idade . "','" . $fabricante . "','" . $modelo . "','" . $submodelo . "','" . $cor . "','" . $transmissao . "','" . $tiporodas . "','" . $odometro . "','" . $areafabrico . "','" . $tamanho . "','" . $grupo . "','" . $garantia . "','" . $custo . "','" . $compraonline . "','" . $ratioMin . "','" . $ratioMax . "','3');";
                            mysql_query($sql);

                            $sql = "SELECT veiculoid FROM dontgetkicked ORDER BY veiculoid DESC LIMIT 1";
                            $result = mysql_query($sql);
                            //$vehId = "LOL";
                            $row = mysql_fetch_array($result);
                            $vehId = $row["veiculoid"];
                            //echo $vehId;

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

                            $to = $_GET["MAIL"];
                            $subject = "Classificação efetuada";
                            $body = "Olá,\n\n" .
                                    "O seu veículo foi classificado como uma " . $classif . " compra. Ao seu pedido foi atribuido o id: " . $vehId . "\n\n" .
                                    "Se decidir pela compra do veículo pedimos que após a compra classifique o estado do seu veículo de forma a permitir uma melhor resposta em casos futuros.\n\n" .
                                    "Caso esteja satisfeito com a sua compra siga o link: http://127.0.0.1/DGK_PHP/classificarRequest.php?vehId=" . $vehId . "&vehCl=0 \n\n" .
                                    "No caso de não se encontrar satisfeito com o veículo que comprou por favor carregue no link seguinte: http://127.0.0.1/DGK_PHP/classificarRequest.php?vehId=" . $vehId . "&vehCl=1 \n\n" .
                                    "--\n Obrigado, \n Dont Get Kicked";
                            sendMail($to, $subject, $body);
                            ?>
                            <header>
                                <h2>Classificação</h2>
                                <h3>O seu carro foi classificado como uma <?php echo $classif ?> compra!</h3>
                            </header>
                            <p>
                                Ao seu pedido foi atribuido o id: <?php echo $vehId ?><br>
                                Por favor siga as instruções que recebeu no seu e-mail se optar por comprar a viatura.
                            </p>
                            <p><a href="classificador.php" class="button-small"><font color="FFFFFF">Tentar de novo</font></a></p>

                        </section>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer --> 
        <?php include 'stuff/footer.php'; ?>
    </body>
</html>