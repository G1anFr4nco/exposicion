<?php
if (isset ($_GET["id"])){
    $id=$_GET["id"];

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "exposicion";

    $connection = new mysqli($server, $username, $password, $database);

    $sql = "DELETE FROM exposicion WHERE id=$id";
    $connection->query($sql);
}

header("location: /expo/index.php");
exit;

?>