<?php
$servername = "3f76a808e00d";
$username = "root";
$password = "root";
$dbname = "test";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql ="CREATE TABLE UTMLinks (
                          url varchar(45) NOT NULL,
                          source varchar(45) NOT NULL,
                          medium varchar(45) NOT NULL,
                          campaign varchar(45) NOT NULL,
                          content varchar(45) NOT NULL,
                          term varchar(45) NOT NULL,
                          tiny varchar(45) NOT NULL
)";
   $conn->exec($sql);
    echo "Table UTMLinks created successfully";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;