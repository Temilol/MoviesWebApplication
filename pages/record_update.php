<?php
    if(isset($_POST['submit'])){
        extract($_POST);
        require_once('../config/collection.php');
        
        //Distribute the date into an array
        $parts = explode('/', $date);
        
        //Transform the month number to its respective month name
        if($parts[0] == 01){$month = 'January';}
        else if($parts[0] == 02){$month = 'February';}
        else if($parts[0] == 03){$month = 'March';}
        else if($parts[0] == 04){$month = 'April';}
        else if($parts[0] == 05){$month = 'May';}
        else if($parts[0] == 06){$month = 'June';}
        else if($parts[0] == 07){$month = 'July';}
        else if($parts[0] == 08){$month = 'August';}
        else if($parts[0] == 09){$month = 'September';}
        else if($parts[0] == 10){$month = 'October';}
        else if($parts[0] == 11){$month = 'November';}
        else if($parts[0] == 12){$month = 'December';}
        
        //Create a new Date format 
        $newDate = $parts[1]." ".$month." ".$parts[2]." (USA)";
        
        //Array of stars
        $stars = array($star1, $star2, $star3, $star4);
        //Transform watch toggle to bool
        if($watched == on){
            $watched = true;
        }else{
            $watched = false;
        }
        //get the find query
        $searchQuery = array('_id' => new MongoId($id));
//         print_r($searchQuery);
        //Data to be updated
        $input = array(
            "name" => $movieName,
            "year" => (int)$parts[2],
            "rating" => (int)$rating,
            "date" => $newDate,
            "genre" => $genre,
            "link" => $link,
            "details" => array(
                        array("director" => $director),
                        array("writer" => $writer),
                        array("stars" => $stars)),
            "seen" => $watched);
        
        $newdata = array('$set' => $input);
        
        //Update
        $result = $collection->update($searchQuery, $newdata);
        
        if($result){
            header("Location: home.php?flag=4");
        }else{
            header("Location: home.php?flag=2");
        }
    }else if(!empty($_GET['id'])){
        //Extract all variables from the get request
        extract($_GET);
        
        require_once('../config/collection.php');
        
        $searchQuery = array(
            "_id" => new MongoId($id));
        
        $cursor = $collection->findOne($searchQuery);
        
        $date = substr($cursor["date"], 0, -6);
        $year = substr($date, -4);
        $date = substr($date, 0, -5);
        $day = substr($date, 0, 2);
        $month1 = substr($date,2);
        
        $day = str_replace(' ', '', $day);
        $month = str_replace(' ', '', $month1);
        
        //Transform the month number to its respective month name
        if($month == 'January'){$month = 1;}
        else if($month == 'February'){$month = 2;}
        else if($month == 'March'){$month = 3;}
        else if($month == 'April'){$month = 4;}
        else if($month == 'May'){$month = 5;}
        else if($month == 'June'){$month = 6;}
        else if($month == 'July'){$month = 7;}
        else if($month == 'August'){$month = 8;}
        else if($month == 'September'){$month = 9;}
        else if($month == 'October'){$month = 10;}
        else if($month == 'November'){$month = 11;}
        else if($month == 'December'){$month = 12;}
        $date = $month."/".$day."/".$year;
        if(empty($cursor)){
            header("Location: home.php?flag=2");
        }
     }else{
        header("Location: home.php?flag=2");
    }   
?>

<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Temilol</title>

    <!-- CSS Files -->
    <link href="../asset/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../asset/css/jquery-ui.css"/>
    <link href="../asset/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="../asset/css/homeonly.css" rel="stylesheet">
    <link href="../asset/css/rate.css" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>
        .bg-edited {
          background-color: #194F65 !important;
        }
        *, *::before, *::after {
            box-sizing: unset;
        }
    </style>

  </head>
  <body>
    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-edited">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Temilol</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Genre <span class="caret"></span></a>
                  <ul class="dropdown-menu multi-column columns-3">
                      <li>
                        <div class="col-sm-4">
                            <ul class="multi-column-dropdown">
                                <li><a href="../genre/action.php">Action</a></li>
                                <li><a href="../genre/adventure.php">Adventure</a></li>
                                <li><a href="../genre/animation.php">Animation</a></li>
                                <li><a href="../genre/biography.php">Biography</a></li>
                                <li><a href="../genre/comedy.php">Comedy</a></li>
                                <li><a href="../genre/crime.php">Crime</a></li>
                                <li><a href="../genre/drama.php">Drama</a></li>
                                <li><a href="../genre/family.php">Family</a></li>
                                <li><a href="../genre/fantasy.php">Fantasy</a></li>
                                <li><a href="../genre/history.php">History</a></li>
                                <li><a href="../genre/horror.php">Horror</a></li>
                                <li><a href="../genre/musical.php">Musical</a></li>
                                <li><a href="../genre/mystery.php">Mystery</a></li>
                                <li><a href="../genre/romance.php">Romance</a></li>
                                <li><a href="../genre/Sci-Fi.php">SciFi</a></li>
                                <li><a href="../genre/thriller.php">Thriller</a></li>
                                <li><a href="../genre/War.php">War</a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Year <span class="caret"></span></a>
                  <ul class="dropdown-menu multi-column columns-3">
                      <li>
                        <div class="col-sm-4">
                            <ul class="multi-column-dropdown">
                                <li><a href="../year/2012.php">2012 <span class="sr-only">(current)</span></a></li>
                                <li><a href="../year/2013.php">2013 <span class="sr-only">(current)</span></a></li>
                                <li><a href="../year/2014.php">2014 <span class="sr-only">(current)</span></a></li>
                                <li><a href="../year/2015.php">2015 <span class="sr-only">(current)</span></a></li>
                                <li><a href="../year/2016.php">2016 <span class="sr-only">(current)</span></a></li>
                                <li><a href="../year/2017.php">2017 <span class="sr-only">(current)</span></a></li>
                                <li><a href="../year/2018.php">2018 <span class="sr-only">(current)</span></a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="new.php">New <span class="sr-only">(current)</span></a>
                </li>
              </ul>
              <form role="search" class="form-inline mt-2 mt-md-0" method="post" action="search.php">
                  <input class="form-control mr-sm-2" type="search" placeholder="Searching..." aria-label="Search" name="q" required="" autocomplete="off">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search" autocom>Search</button>
              </form>
              <form class="form-inline mt-2 mt-md-0" action="login.php" method="post">
                  <button class="btn btn-dark" style="margin-left: 10;" type="submit" href="login.php">Logout</button>
              </form>
            </div>
        </div>
      </nav>
    </header>
      
    <div class="w3l-main">
	<h2>Add New Movie</h2>
        <div class="w3l-from">
            <h3 style="color: #352222; text-shadow: 1px 1px #11C45F;">Movie Information <span class="w3l-star">*<small style = "color: #0ED765; text-shadow: 0px 0px #11C45F; "><b>(required)</b></small></span></h3>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">	
                <div class="w3l-user">
                    <label class="head">Movie's Name<span class="w3l-star"> * </span></label>
                    <input class="form-control" type="text" name="movieName" placeholder="Enter the movie title here" value='<?php echo $cursor["name"]; ?>' required="" autocomplete="off">
                </div>
                <div class="clear"></div>	
                <div class="w3l-user">
                    <label class="head">Genre<span class="w3l-star"> * </span></label>	
                    <select class="form-control js-genre-multiple" name="genre[]" value="Test" multiple="multiple">
                      <option value="Action" <?php if (in_array("Action", $cursor["genre"])){ echo "selected";} ?>>Action</option>
                      <option value="Adventure" <?php if (in_array("Adventure", $cursor["genre"])){ echo "selected";} ?>>Adventure</option>
                      <option value="Animation" <?php if (in_array("Animation", $cursor["genre"])){ echo "selected";} ?>>Animation</option>
                      <option value="Biography" <?php if (in_array("Biography", $cursor["genre"])){ echo "selected";} ?>>Biography</option>
                      <option value="Comedy" <?php if (in_array("Comedy", $cursor["genre"])){ echo "selected";} ?>>Comedy</option>
                      <option value="Crime" <?php if (in_array("Crime", $cursor["genre"])){ echo "selected";} ?>>Crime</option>
                      <option value="Drama" <?php if (in_array("Drama", $cursor["genre"])){ echo "selected";} ?>>Drama</option>
                      <option value="Family" <?php if (in_array("Family", $cursor["genre"])){ echo "selected";} ?>>Family</option>
                      <option value="Fantasy" <?php if (in_array("Fantasy", $cursor["genre"])){ echo "selected";} ?>>Fantasy</option>
                      <option value="History" <?php if (in_array("History", $cursor["genre"])){ echo "selected";} ?>>History</option>
                      <option value="Horror" <?php if (in_array("Horror", $cursor["genre"])){ echo ("selected");} ?>>Horror</option>
                      <option value="Musical" <?php if (in_array("Musical", $cursor["genre"])){ echo "selected";} ?>>Musical</option>
                      <option value="Mystery" <?php if (in_array("Mystery", $cursor["genre"])){ echo "selected";} ?>>Mystery</option>
                      <option value="Romance" <?php if (in_array("Romance", $cursor["genre"])){ echo "selected";} ?>>Romance</option>
                      <option value="Sci-Fi" <?php if (in_array("Sci-Fi", $cursor["genre"])){ echo "selected";} ?>>Sci-Fi</option>
                      <option value="Thriller" <?php if (in_array("Thriller", $cursor["genre"])){ echo "selected";} ?>>Thriller</option>
                      <option value="War" <?php if (in_array("War", $cursor["genre"])){ echo "selected";} ?>>War</option>
                    </select>
                </div>
                <div class="w3l-details1">
                    <div class="w3l-num">
                        <label class="head">Link</label>
                        <input class="form-control" type="text" name="link" placeholder="Enter the external link here" value='<?php echo $cursor["link"]; ?>' autocomplete="off">
                    </div>
                    <div class="form-group w3l-date">
                        <label class="head">Released Date<span class="w3l-star"> * </span></label>
                        <div class="input-group date styled-input">
                          <input type="form-control text" id="datepicker" name="date" class="form-control" placeholder="MM/DD/YYYY" value='<?php echo $date; ?>' required="" autocomplete="off">
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-th"></span>
                          </span>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="w3l-user rating">
                    <legend class="head">Ratings</legend>
                    <input type="radio" id="star5" name="rating" value="10" <?php if($cursor["rating"] >= 10){ echo "checked";} ?>/><label for="star5" title="Rocks!">5 stars</label>
                    <input type="radio" id="star4" name="rating" value="8" <?php if($cursor["rating"] >= 8 && $cursor["rating"] < 10){ echo "checked";} ?>/><label for="star4" title="Pretty good">4 stars</label>
                    <input type="radio" id="star3" name="rating" value="6" <?php if($cursor["rating"] >= 6 && $cursor["rating"] < 8){ echo "checked";} ?>/><label for="star3" title="Meh">3 stars</label>
                    <input type="radio" id="star2" name="rating" value="4" <?php if($cursor["rating"] >= 4 && $cursor["rating"] < 6){ echo "checked";} ?>/><label for="star2" title="Kinda bad">2 stars</label>
                    <input type="radio" id="star1" name="rating" value="2" <?php if($cursor["rating"] >= 2 && $cursor["rating"] < 4){ echo "checked";} ?>/><label for="star1" title="Sucks big time">1 star</label>
                </div>
                <br>
                <div class="w3l-sym onoffswitch">
                <input type="checkbox" name="watched" class="onoffswitch-checkbox" id="myonoffswitch" <?php if($cursor["seen"] == true){ echo "checked";}else{echo "unchecked";} ?>>
                    <label class="onoffswitch-label" for="myonoffswitch">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
                <input type="hidden" name="id" value='<?php echo $cursor["_id"] ?>'>
                <div class="clear"></div>
                <div class="w3l-lef1">
                    <h3 style="color: #352222; text-shadow: 2px 2px #11C45F;">Crew Information <span class="w3l-star">*<small style = "color: #352222; text-shadow: 0px 0px #11C45F; "><b>(required)</b></small></span></h3>
                    <div class="w3l-num">
                        <label class="head">Director<span class="w3l-star"> * </span></label>
                        <input class="form-control" type="text" name="director" placeholder="Enter the Movie's Director Name" value='<?php echo $cursor["details"][0]["director"]; ?>' required="" autocomplete="off">
                    </div>
                    <div class="w3l-sym">
                        <label class="head">Writer<span class="w3l-star"> * </span></label>
                        <input class="form-control" type="text"  name="writer" placeholder="Enter the Movie's Writer Name" value='<?php echo $cursor["details"][1]["writer"]; ?>' required="" autocomplete="off">
                    </div>
                </div>
                <div class="clear"></div>
                <div class="w3l-lef1">
                    
                </div>
                <div class="clear"></div>
                <div class="w3l-rem">
                    <div class="w3l-right">
                        <label class="head">Stars</label>
                        <div class="w3l-details1">
                            <div class="w3l-num">
                                <input class="form-control" type="text" name="star1" placeholder="Star1" value='<?php echo $cursor["details"][2]["stars"][0]; ?>' autocomplete="off">
                            </div>
                            <div class="w3l-sym">
                                <input class="form-control" type="text"  name="star2" placeholder="Star2" value='<?php echo $cursor["details"][2]["stars"][1]; ?>' autocomplete="off">
                            </div>
                        <div class="clear"></div>
                            <div class="w3l-num">
                                <input class="form-control" type="text" name="star3" placeholder="Star3" value='<?php echo $cursor["details"][2]["stars"][2]; ?>' autocomplete="off">
                            </div>
                            <div class="w3l-sym">
                                <input class="form-control" type="text"  name="star4" placeholder="Star4" value='<?php echo $cursor["details"][2]["stars"][3]; ?>' autocomplete="off">
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="btn">
                    <button type="submit" class="btn btn-lg btn-dark btn-block bg-edited" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
  </body>
    
  <!-- JS Files -->
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script src="../asset/js/jquery-ui.js"></script>
  <script src="../asset/js/bootstrap.min.js"></script>
  <script>
      $(document).ready(function() {
          $('.js-genre-multiple').select2();
          $('#datepicker').datepicker({
            uiLibrary: 'bootstrap',
            todayHighlight: true
          });
      });
  </script>
</html>