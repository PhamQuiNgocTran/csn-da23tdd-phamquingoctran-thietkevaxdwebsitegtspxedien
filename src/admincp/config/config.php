<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webxedien_mysql";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Ket noi MYSQLi loi: " . $conn->connect_error);
    }
?>