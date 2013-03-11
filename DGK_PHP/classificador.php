<!DOCTYPE HTML>
<!--
        Halcyonic 1.0 by nodethirtythree + FCT
        http://nodethirtythree.com | @nodethirtythree
        Released under the Creative Commons Attribution 3.0 license (nodethirtythree.com/license)
-->

<?php //include 'stuff/mail.php'?>
<html>
    <head>
        <title>Don't get Kicked! - Classificação de veículos</title>
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
                                <h2>Classificação de veículos</h2>
                                <h3>De seguida insira os dados relativos ao seu veículo para o podermos classificar.</h3>
                            </header>
                            <p>
                            <form action="classificadorRequest.php" method="get">

                                E-mail de contacto: 
                                <input type="text" name="MAIL" /><br>


                                Vendedor: 
                                <?php
                                $sql = "select DISTINCT vendedor FROM dontgetkicked  WHERE vendedor!=\"\" AND vendedor!=\"OUTRO\" AND vendedor!=\"OTHER\" ORDER BY vendedor";
                                $result = mysql_query($sql);
                                $options = "";
                                while ($row = mysql_fetch_array($result)) {
                                    $id = $row["vendedor"];
                                    $thing = ucfirst(strtolower($id));
                                    $options.="<option value=\"$id\">" . $thing;
                                }
                                ?>  
                                <select name="VENDEDOR" size="1" onchange="document.ex.VENDEDOROUTRO.value = document.ex.VENDEDOR.options[document.ex.VENDEDOR.selectedIndex].value;document.ex.VENDEDOR.value='Outro'">
                                    <?php echo $options ?>
                                    <option value="OUTRO" selected="selected">Outro</option>
                                </select> <input type="text" name="VENDEDOROUTRO" value="" size="10" /><br>

                                Mês de compra: 
                                <select name=MES>
                                    <option value=1>Janeiro    
                                    <option value=2>Fevereiro
                                    <option value=3>Março
                                    <option value=4>Abril
                                    <option value=5>Maio
                                    <option value=6>Junho
                                    <option value=7>Julho
                                    <option value=8>Agosto
                                    <option value=9>Setembro
                                    <option value=10>Outubro
                                    <option value=11>Novembro
                                    <option value=12>Dezembro
                                </select> <br>

                                Idade do veículo (anos): 
                                <?php
                                $idade = 0;
                                $options = "";
                                while ($idade <= 32) {
                                    $id = $idade;
                                    $thing = $idade;
                                    $idade++;
                                    $options.="<option value=\"$id\">" . $thing;
                                }
                                ?>  
                                <select name=IDADE>
                                    <?php echo $options; ?>
                                </select> <br>

                                Ano de fabrico: 
                                <?php
                                $ano = 1980;
                                $options = "";
                                while ($ano <= 2012) {
                                    $id = $ano;
                                    $thing = $ano;
                                    $ano++;
                                    $options.="<option value=\"$id\">" . $thing;
                                }
                                ?>  
                                <select name=ANOFABRICO>
                                    <?php echo $options; ?>
                                </select> <br>

                                Marca: 
                                <?php
                                $sql = "select DISTINCT fabricante FROM dontgetkicked WHERE fabricante!=\"\" AND fabricante!=\"OUTRO\" AND fabricante!=\"OTHER\" ORDER BY fabricante";
                                $result = mysql_query($sql);
                                $options = "";
                                while ($row = mysql_fetch_array($result)) {
                                    $id = $row["fabricante"];
                                    $thing = ucfirst(strtolower($id));
                                    $options.="<option value=\"$id\">" . $thing;
                                }
                                ?>   
                                <select name="FABRICANTE" size="1" onchange="document.ex.state.value = document.ex.s.options[document.ex.s.selectedIndex].value;document.ex.s.value='Outro'">
                                    <?php echo $options ?>
                                    <option value="OUTRO" selected="selected">Outro</option>
                                </select> <input type="text" name="FABRICANTEOUTRO" value="" size="10" /><br>


                                Grupo: 
                                <?php
                                $sql = "select DISTINCT grupoveiculo FROM dontgetkicked WHERE grupoveiculo!=\"\" AND grupoveiculo!=\"OUTRO\" AND grupoveiculo!=\"OTHER\" ORDER BY grupoveiculo";
                                $result = mysql_query($sql);
                                $options = "";
                                while ($row = mysql_fetch_array($result)) {
                                    $id = $row["grupoveiculo"];
                                    if ($id == 'OTHER')
                                        $thing = "Outro";
                                    else {
                                        $thing = ucfirst(strtolower($id));
                                        $options.="<option value=\"$id\">" . $thing;
                                    }
                                }
                                ?>  
                                <select name="GRUPO" size="1" onchange="document.ex.state.value = document.ex.s.options[document.ex.s.selectedIndex].value;document.ex.s.value='Outro'">
                                    <?php echo $options ?>
                                    <option value="OUTRO" selected="selected">Outro</option>
                                </select> <input type="text" name="GRUPOOUTRO" value="" size="10" /><br>


                                Modelo: 
                                <input type="text" name="MODELO" /> (ex:MUSTANG V6) <br>

                                SubModelo: 
                                <input type="text" name="SUBMODELO" /> (ex:2D COUPE) <br>

                                Cor: 
                                <select name=COR>
                                    <option value=NULL>Não disponível    
                                    <option value=YELLOW>Amarelo
                                    <option value=BLUE>Azul
                                    <option value=BEIGE>Bege
                                    <option value=WHITE>Branco
                                    <option value=BROWN>Castanho
                                    <option value=Grey>Cinzento
                                    <option value=GOLD>Dourado
                                    <option value=ORANGE>Laranja
                                    <option value=SILVER>Prateado
                                    <option value=BLACK>Preto
                                    <option value=PURPLE>Rosa                                   
                                    <option value=GREEN>Verde
                                    <option value=RED>Vermelho
                                    <option value=OTHER>Outra
                                </select> <br>

                                Transmissão:
                                <select name=TRANSMISSAO>
                                    <option value=NULL>Não disponível
                                    <option value=AUTO>Automática
                                    <option value=MANUAL>Manual
                                </select> <br>

                                Tipo de Rodas:
                                <select name=TIPORODAS>                                   
                                    <option value=NULL>Não disponível
                                    <option value=ALLOY>Jantes
                                    <option value=COVERS>Tampões
                                    <option value=SPECIAL>Jantes especiais
                                </select> <br>

                                Odómetro (km): 
                                <input type="text" name="ODOMETRO" /> <br>

                                Fabrico: 
                                <select name=AREAFABRICO>                                   
                                    <option value=EUROPEAN>Europeu
                                    <option value=ASIAN>Ásia
                                    <option value=AMERICAN>Americano
                                </select> <br>

                                Tamanho:
                                <select name="TAMANHO">
                                    <option value=MEDIUM>Médio
                                    <option value=LARGE TRUCK>Carrinha Grande
                                    <option value=COMPACT>Compacto 
                                    <option value=LARGE>Grande
                                    <option value=VAN>VAN
                                    <option value=MEDIUM SUV>SUV Médio
                                    <option value=LARGE SUV>SUV Grande
                                    <option value=SPECIALTY>Especial
                                    <option value=SPORTS>Desportivo
                                    <option value=CROSSOVER>Crossover
                                    <option value=SMALL SUV>SUV Pequeno
                                    <option value=SMALL TRUCK>Carrinha Pequena
                                    <option value=NULL>Outro
                                </select> <br>

                                Garantia:   
                                <select name=GARANTIA>
                                    <option value=NULL>Não disponível
                                    <option value=GREEN>Sim
                                    <option value=RED>Não
                                </select> <br>

                                Custo do veículo: 
                                <input type="text" name="CUSTO" /><br>

                                Compra online: 
                                <select name=COMPRAONLINE>
                                    <option value=0>Não
                                    <option value=1>Sim    
                                </select> <br>

                                Custo mínimo veículo semelhante:
                                <input type="text" name="CUSTOMAX" /><br>

                                Custo máximo veículo semelhante:
                                <input type="text" name="CUSTOMIN" /><br>
                                <p>                               
                                    <br>
                                    <input type="image" src="images/submeter.png" /> 
                                </p>
                            </form> 
                            </p>
                            <p>

                        </section>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer --> 
        <?php include 'stuff/footer.php'; ?>
    </body>
</html>