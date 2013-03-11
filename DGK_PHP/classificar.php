<!DOCTYPE HTML>
<!--
        Halcyonic 1.0 by nodethirtythree + FCT
        http://nodethirtythree.com | @nodethirtythree
        Released under the Creative Commons Attribution 3.0 license (nodethirtythree.com/license)
-->
<html>
    <head>
        <title>Don't get Kicked! - Classificar veículo</title>
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
                                <h2>Classificação de véiculo</h2>
                                <h3>De seguida introduza os dados relativos ao veículo que adquiriu.</h3>
                            </header>
                            <p>
                            <form action="classificarRequest.php" method="get">
                                Identificação do veículo: 
                                <input type="text" name="vehId" /><br />
                                Classificação da compra: 
                                <select name=vehCl>
                                    <option value=0>Boa compra
                                    <option value=1>Má compra
                                </select>
                                <p>                               
                                    <br>
                                    <input type="image" src="images/classificar.png" /> 
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