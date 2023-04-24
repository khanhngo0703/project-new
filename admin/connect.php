<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connect failed: " . $conn->connect_error);
}

try {
    $sql = "CREATE DATABASE IF NOT EXISTS project1";

    $res = $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating database" . $e->getMessage();
    die();
}

$conn->select_db("project1");

try {
    $sql = "CREATE TABLE IF NOT EXISTS collections (
        id INT NOT NULL AUTO_INCREMENT,
        collection_name VARCHAR(50) NOT NULL,
        PRIMARY KEY (id)
    )";

    $res = $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating table" . $e->getMessage();
}

try {
    $sql = "CREATE TABLE IF NOT EXISTS stylists (
        id INT NOT NULL AUTO_INCREMENT,
        stylist_name VARCHAR(50) NOT NULL,
        PRIMARY KEY (id)
    )";

    $res = $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating table" . $e->getMessage();
}

try {
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT NOT NULL AUTO_INCREMENT,
        product_name VARCHAR(50) NOT NULL,
        price FLOAT NOT NULL,
        num INT NOT NULL,
        thumbnail VARCHAR(100) NOT NULL,
        collection_id INT NOT NULL,
        stylist_id INT NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (collection_id) REFERENCES collections(id),
        FOREIGN KEY (stylist_id) REFERENCES stylists(id)
    )";

    $res = $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating table" . $e->getMessage();
}

try {
    $sql = "CREATE TABLE IF NOT EXISTS admincp (
        id INT NOT NULL AUTO_INCREMENT,
        admin_username VARCHAR(50) NOT NULL,
        admin_password VARCHAR(50) NOT NULL,
        PRIMARY KEY (id)
    )";

    $res = $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating table" . $e->getMessage();
}

try {
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT NOT NULL AUTO_INCREMENT,
        fullname VARCHAR(50) NOT NULL,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        phone_number VARCHAR(50) NOT NULL,
        password_hash VARCHAR(50) NOT NULL,
        PRIMARY KEY (id)
    )";

    $res = $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating table" . $e->getMessage();
}
