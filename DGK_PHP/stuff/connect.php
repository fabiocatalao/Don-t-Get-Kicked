<?php
$username = "root";
$password = "";
$database = "dontgetkicked";
$server = "localhost";
$link;

function dbOpen() {
    global $username, $password, $database, $server, $link;
    $link = mysql_connect($server, $username, $password);
    @mysql_select_db($database) or die("Unable to select database");
}

function dbClose() {
    global $link;
    mysql_close($link);
}
?> 