<?php
    mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
    /*
        localhost - it's location of the mysql server, usually localhost
        root - your username
        third is your password
         
        if connection fails it will stop loading the page and display an error
    */
     
    mysql_select_db("course") or die(mysql_error());
    /* courses is the name of database we've created */
?>
 
<html>
<head>
    <title>Search results</title>
</head>
<body>
<?php
require_once("results.php");
    
?>
</body>
</html>