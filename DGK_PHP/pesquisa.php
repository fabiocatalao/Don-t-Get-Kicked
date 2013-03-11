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
                            <header>
                                <h2>Pesquisa de veículos</h2>
                                <h3>De seguida introduza os dados requeridos de forma a verificar as informações relativas ao veículo.</h3>
                            </header>
                            <p>
                             <form action="pesquisaRequest.php" method="get">
                                Identificação do veículo: <input type="text" name="idVeiculo" /><br />
                                <p>                               
                                    <br>
                                    <input type="image" src="images/pesquisar.png" /> 
                                </p>
                            </form> 

                            </p>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer --> 
        <?php include 'stuff/footer.php'; ?>
    </body>
</html>