<?php
    if(!empty($_GET['id'])){
        require_once('../config/collection.php');
        
        extract($_GET);
        
        $deleteQuery = array(
            "_id" => new MongoId($id));
        
       $result = $collection->remove($deleteQuery, array("justOne" => true));
     
        if($result){
            header("Location: home.php?flag=1");
        }else{
            header("Location: home.php?flag=2");
        }
    }else{
        header("Location: home.php?flag=5");
    }
?>	