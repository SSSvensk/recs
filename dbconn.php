<?php

//PHP-tiedosto alustamaan tietokantayhteys, jota kutsutaan require_oncella aina tarvittaessa.

$GLOBALS['servername'] = "localhost";
$GLOBALS['username'] = "localhost";
$GLOBALS['password'] = "";
$GLOBALS['dbname'] = "test";

$GLOBALS['conn'] = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>