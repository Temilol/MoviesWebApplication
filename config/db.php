<?php 
   // connect to mongodb
   $m = new MongoClient();
    if(!$m){
        die("MongoDB Not Connected");
    }
    // select a database
    $mydb = "finals";
    $db = $m->selectDb($mydb);
    if(!$db){
         die("The Database could not be selected");
    }
    
    //create an array of both success and error messages for the application
    $messages = array(
        1 => "Record deleted succsessfully.",
        2 => "Error occured. Please try again.",
        3 => "New record succsessfully added.",
        4 => "Record updated succsessfully.",
        5 => "No record selected for delete.",
        6 => "The record doesn't exist in the database",
        7 => "Movie of that year doesn't exist yet. Add a new movie",
        8 => "Incorrect login details. Please try again",
        9 => "Welcome :)",
        10 => "Movie of that genre doesn't exist yet. Add a new movie",
    );
?>
