<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=${project.encoding}">
        <title></title>
    </head>
    <body>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        ECHO "OLA";
        include 'Connect.php';

        $query = "select * from weka";
        $result = mysql_query($query);
        echo $result;

        $num = mysql_numrows($result);

        echo "Rows: $num";

        mysql_close();
        getResultDgkJava("evaluate 2");

        function getResultDgkJava($args) {
            //$dgkJava = 'java -Xmx10m -jar "DGK_Java/DGK_Java.jar" evaluate 2';
            $dgkJava = 'java -Xmx10m -jar "D:/FabioUserFiles/Dropbox/Universidade/MEI/SI_Meu/PI/DGK_Java/dist/DGK_Java.jar" ' . $args;
            exec($dgkJava, $output);
            echo "<br><br>Output : $output[0]";

            $vehicle = '';
            $classification = 0;
            preg_match('/evaluation:vehicle(?P<vehicle>\w+);classification(?P<classification>\d+)/', $output[0], $matches);
            echo '<br>Veiculo: ' . $matches['vehicle'] . ' Classification: ' . $matches['classification'] . '<br>';
            //print_r($matches);
        }
        ?>
    </body>
</html>
