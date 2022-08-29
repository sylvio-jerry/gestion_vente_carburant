<?php 
    $error = null;
    $mysqli = new mysqli('localhost','root',null,'gestion'); 
        
    //Creating table //
    $sql1 = "CREATE TABLE IF NOT EXISTS client(
        codecli VARCHAR(255) NOT NULL PRIMARY  KEY,
        nomcli VARCHAR(255)
    );";
    $mysqli->query($sql1);

    $sql2 = "CREATE TABLE IF NOT EXISTS carburant(
        numcarburant VARCHAR(255) NOT NULL PRIMARY KEY,
        design VARCHAR(255),
        pu FLOAT,
        stock INT(255) 
    );";
    $mysqli->query($sql2);

    $sql3 = "CREATE TABLE IF NOT EXISTS achat(
        codecli VARCHAR(255) NOT NULL,
        numcarburant VARCHAR(255) NOT NULL,
        qte FLOAT,
        dateachat date,
        modepaie CHAR(255),
        PRIMARY KEY(codecli, numcarburant)
    );";
    $mysqli->query($sql3);

    $sql4 = "CREATE TABLE IF NOT EXISTS admin(
        username VARCHAR(255) NOT NULL,
        passwd VARCHAR(255) NOT NULL,
        email VARCHAR(255),
        profile VARCHAR(255) 
    );"; 
    $mysqli->query($sql4);
?>