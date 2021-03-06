<?php
    session_start();
    require_once '../classes/movieSQL.php';
    require_once '../classes/userSQL.php';
    $movie = new Movie;
    $user = new User;
    $movieid = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Agency - Start Bootstrap Theme</title>

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="../css/agency.css" rel="stylesheet">

</head>

<body style="background-color: #161B21;" id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Enjoy your Movie Life</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
              <!-- <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="adminMain.php">Home</a>
              </li> -->
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="adminEditTimeline.php">Timeline</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="adminDisplayAllUsers.php">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="adminhighlyRatedMovies.php">Movie Rating</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="adminAddMovie.php">Add Movie</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="adminAddCategory.php">Add Category</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <section>
        <div class="container-fluid" style="width:80%;">
          <!-- <form action="../action/movieAction.php" method="post">
              <div class="row">
                  <input class="col-md-11 form-control" type="text" name="keyword" placeholder="Search  Movie/Cast/Director">
                  <input style="background-color:#F5A431; color:#161B21;" class="col-md-1 form-control " type="submit" name="searchLatest" value="Search">
              </div>
          </form> -->
        <h1 class="my-5 text-center" style="color:#F5A431;">Rate Detail</h1>
        <?php
        $rows = $movie->displayMoviesDetail($movieid);
        foreach($rows as $row){
            $movieid = $row['movie_id'];
            $title = $row['title']; 
            $category = $row['category_name']; 
            $country = $row['country']; 
            $playdate = $row['playdate']; 
            $summary = $row['summary']; 
            $performer = $row['performer'];
            $director = $row['director'];
            $picture = $row['picture'];
            $allWatched = $user->countAllAlreadyWatched($movieid);
            $allWishlist = $user->countAllWish($movieid);
            $rateAverage = $movie->reviewAvg($movieid);
           
            echo 
            "<div class='card w-50 mx-auto mb-4 p-0'>
            <h4 class='card-title text-center mt-3'>$title</h4>
            <img class='card-img-top mx-auto' style='width:320px; height:500px;' src='../img/portfolio/$picture' alt=''>

                <div class='card-footer'>
                    <div class='row mx-1 mb-2'>
                        <div class='col-md-6 m-0 p-3 border-right border-dark text-center'>
                            <h4 class='m-0'>Average Rating</h4>
                        </div>
                        <div class='col-md-4 py-3 mx-auto' style='font-size:23px;'>";
                
                    
                    if($rateAverage == 0) {
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>No Rating</span>";
                    } elseif($rateAverage >= 0.1 AND $rateAverage < 1) {
                        echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                    } elseif($rateAverage == 1) {
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                    } elseif($rateAverage >= 1.1 AND $rateAverage < 2) {
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                    } elseif($rateAverage == 2) {
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                    } elseif($rateAverage >= 2.1 AND $rateAverage < 3) {
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                    } elseif($rateAverage == 3) {
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                    } elseif($rateAverage >= 3.1 AND $rateAverage < 4) {
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                    } elseif($rateAverage == 4) {
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                        echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                    } elseif($rateAverage >= 4.1 AND $rateAverage < 5) {
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                        echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                    } elseif($rateAverage == 5) {
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                        echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                    }

                    echo " 
                    </div>
            </div>
        </div>
                ";
                    
                    $rows = $movie->displayAllUsersRating($movieid);
                    foreach($rows as $row){
                        $icon = $row['icon'];
                        $username = $row['username'];
                        $ratingNumber = $row['rating_number'];
                        $date = $row['review_date'];

                        echo "<div class='card-footer p-1'>
                                <div class='container'>
                                    <div class='row mx-1 mb-2'>
                                <div class='col-md-2 m-0 py-1'>
                                    <img src='../img/portfolio/$icon' style='width:55px; height:55px;' class=''>
                                </div>
                                <div class='col-md-4 m-0 p-1 border-right border-dark'>
                                    <p class='card-text' style='margin-bottom:0;'> $username's Rating</p>
                                    <p class='card-text' style='margin-bottom:0;'> $date</p>
                                </div>
                                <div class='col-md-4 py-3 mx-auto' style='font-size:23px;'>";

                                if($ratingNumber == 0) {
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>No Rating</span>";
                                  } elseif($ratingNumber >= 0.1 AND $ratingNumber < 1) {
                                    echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$ratingNumber</span>";
                                  } elseif($ratingNumber == 1) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$ratingNumber</span>";
                                  } elseif($ratingNumber >= 1.1 AND $ratingNumber < 2) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$ratingNumber</span>";
                                  } elseif($ratingNumber == 2) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$ratingNumber</span>";
                                  } elseif($ratingNumber >= 2.1 AND $ratingNumber < 3) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$ratingNumber</span>";
                                  } elseif($ratingNumber == 3) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$ratingNumber</span>";
                                  } elseif($ratingNumber >= 3.1 AND $ratingNumber < 4) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$ratingNumber</span>";
                                  } elseif($ratingNumber == 4) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$ratingNumber</span>";
                                  } elseif($ratingNumber >= 4.1 AND $ratingNumber < 5) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$ratingNumber</span>";
                                  } elseif($ratingNumber == 5) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$ratingNumber</span>";
                                  }
                                    
                                echo "</div>
                            </div>
                            </div>
                </div>";
                    }
                        
                echo "
            </div>";                 
        }
        ?>     
        </div>

    </section> 

  <!-- Contact -->
  <section class="page-section" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Contact Us</h2>
          <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form id="contactForm" name="sentMessage" novalidate="novalidate">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" id="name" type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required="required" data-validation-required-message="Please enter your phone number.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <textarea class="form-control" id="message" placeholder="Your Message *" required="required" data-validation-required-message="Please enter a message."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Send Message</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
          <span class="copyright">Copyright &copy; Your Website 2019</span>
        </div>
        <div class="col-md-4">
          <ul class="list-inline social-buttons">
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul class="list-inline quicklinks">
            <li class="list-inline-item">
              <a href="#">Privacy Policy</a>
            </li>
            <li class="list-inline-item">
              <a href="#">Terms of Use</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Contact form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/agency.min.js"></script>

</body>

</html>
