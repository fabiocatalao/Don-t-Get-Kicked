<?php

function getResultDgkJava($args) {
    //$dgkJava = 'java -Xmx10m -jar "DGK_Java/DGK_Java.jar" evaluate 2';
    $dgkJava = 'java -Xmx100m -jar "D:/FabioUserFiles/Dropbox/Universidade/MEI/SI_Meu/PI/DGK_Java/dist/DGK_Java.jar" ' . $args;
    exec($dgkJava, $output);
    //echo "Exec Java: " . $dgkJava;
    //echo "<br><br>Output : $output[0]";

    $vehicle = '';
    $classification = 0;
    preg_match('/evaluation:vehicle(?P<vehicle>\w+);classification(?P<classification>\d+)/', $output[0], $matches);
    //echo '<br>Veiculo: ' . $matches['vehicle'] . ' Classification: ' . $matches['classification'] . '<br>';
    //print_r($matches);
    return $matches['classification'];
}

?>
