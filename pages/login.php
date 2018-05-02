<?php
    //call the connection file
    require_once('../config/db.php');
    $flag = isset($_GET['flag'])?intval($_GET['flag']):0;
    $message ='';
    if($flag){
      $message = $messages[$flag];
    }
    if(isset($_POST['submit'])){
        //call the connection file
        require_once('../config/db.php');

        //Select the collection
        $mycol = "users";
        $collection = $db->$mycol;
        if(!$collection){
            die("Collection was not selected succsessfully");
        }
        extract($_POST);
        
        $searchQuery = array("email" => $email,
                            "password" => $password);
        
        if($collection->count($searchQuery) <= 0){
            header("Location: login.php?flag=8");
        }else{
            header("Location: home.php?flag=9");
        }
    }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Temilol</title>

    <!-- CSS Files -->
    <link href="../asset/css/bootstrap.css" rel="stylesheet">
    <link href="../asset/css/signin.css" rel="stylesheet">
<!--     <script type="text/javascript" src="../asset/js/modernizr.custom.86080.js"></script> -->
  </head>

  <body class="text-center">
    <ul class="cb-slideshow">
        <li><span>Image 01</span></li>
        <li><span>Image 02</span></li>
        <li><span>Image 03</span></li>
        <li><span>Image 04</span></li>
        <li><span>Image 05</span></li>
        <li><span>Image 06</span></li>
    </ul>
    <form class="form-signin" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <?php if($flag == 8){ ?>
        <div class="alert-danger"><?php echo $message; ?></div>
      <?php  } ?>
      <h1 id="blinking" style="color: #DF2510; text-shadow: 1px 1px #FF0000;">LOGIN HERE</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus autocomplete="off">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      <button style="border-color: #E7F7EE; background-color: #194F65" class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Hit Enter to Login</button>
    </form>
  </body>
  <!-- JS Files -->
  <script src="asset/js/signin.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script>
    function blinker(){
        $('#blinking').fadeOut("slow");
        $('#blinking').fadeIn("slow");
    }
    setInterval(blinker, 1000);
  </script>
</html>