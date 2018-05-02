<?php
    require_once('../config/collection.php');
    $cursor = $collection->find()->limit(15);
    $flag    = isset($_GET['flag'])?intval($_GET['flag']):0;
    $message ='';
    if($flag){
      $message = $messages[$flag];
    }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Temilol</title>

    <!-- CSS File -->
    <link href="../asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="../asset/css/homeonly.css" rel="stylesheet">
    <style>
        .bg-edited {
          background-color: #194F65 !important;
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
                <li class="nav-item active">
                  <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Genre <span class="caret"></span></a>
                  <ul class="dropdown-menu multi-column columns-3">
                      <li>
                        <div class="col-sm-3">
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
      <div class="container">
        <?php if($flag == 2 || $flag == 5 || $flag == 6 || $flag == 7 || $flag == 10){ ?>
        <div class="alert-danger"><?php echo $message; ?></div>
        <?php  } elseif($flag && $flag != 2 ){ ?>
        <div class="alert-success"><?php echo $message; ?></div>
        <?php  } ?>
        <p></p>
        <div class="clear"></div>
        <div class="overflow-x:auto p53" style="margin-top:-50">
          <table class="table table-hover table-striped table-dark">
              <thead>
                <tr class="bg-edited">
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Released Date</th>
                  <th scope="col">Genre</th>
                  <th scope="col">Stars</th>
                  <th scope="col">Crew</th>
                  <th scope="col">Ratings<th>
                  <th scope="col">Watched</th>
                  <th scope="col">Link</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody style="overflow-y: auto, height: 230px, width:100%">
                <?php $sn = 0; foreach ($cursor as $id => $value){ ?>
                <tr>
                  <th scope="row"><?php $sn = $sn + 1; echo $sn; ?></th>
                  <td width="14%"><?php echo $value["name"]; ?></td>
                  <td width="15%"><?php echo $value["date"]; ?></td>
                  <td>
                      <div>
                          <?php $array = $value["genre"]; $string=implode("</div><div>",$array); echo $string;?>
                      </div>
                  </td>
                  <td width="29%">
                      <?php $json = $value["details"][2]; $array = $json["stars"];?>
                      <div>
                          <?php $string=implode("</div><div>",$array); echo $string; ?>
                      </div>
                  </td>
                  <td width="19%">
                      <?php $json = $value["details"][0]; $director = $json["director"];?>
                      <?php $json = $value["details"][1]; $writer = $json["writer"];?>
                      <div>
                          <b>Director: </b><?php echo $director; ?>
                      </div>
                      <br/>
                      <div>
                          <b>Writer: </b><?php echo $writer; ?>
                      </div>
                  </td>
                  <td><?php echo $value["rating"]; ?></td>
                  <td></td>
                  <td>
                      <?php $seen = $value["seen"];?>
                      <?php if($seen){echo '&#9989'; } else{ echo '&#10060';} ?>
                  </td>
                  <td>
                      <?php $link = $value["link"]; ?>
                      <a target="_blank" href="<?php echo $link ?>"> Watch...</a>
                  </td>
                  <td class="text-center" width="25%">
                      <a class='btn btn-info btn-sm' href='record_update.php?id=<?php echo $value[_id]; ?>'> Edit </a> 
                      <a onClick ='return confirm("Delete this movie?");' href='record_delete.php?id=<?php echo $value[_id]; ?>' class="btn btn-danger btn-sm"> Del </a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                  <tr>
                      <div class="row">
                          <td colspan="10">
<!--                               <button href="#" class="btn btn-info btn-md" type="submit" style="color: white;">
                                  Previous Page
                              </button> -->
                          </td>
                          <td>
                              <button  onclick='location.href="home2.php"' class="btn btn-info btn-md" style="color: white;">
                                  Next Page <img src="../asset/img/next.png" />
                              </button>
                          </td>
                      </div>
                  </tr>
              </tfoot>
            </table>
          </div>
      </div>

    <!-- JavaScript File
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="../asset/js/jquery-ui.js"></script>
    <script src="../asset/js/bootstrap.min.js"></script>
  </body>
</html>