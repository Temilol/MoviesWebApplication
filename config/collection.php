<?php
    //call the connection file
    require_once('db.php');
    
    //Select the collection
    $mycol = "movie";
    $collection = $db->$mycol;
    if(!$collection){
        die("Collection was not selected succsessfully");
    }

?>
