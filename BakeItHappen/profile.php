
<?php
include("includes/config.php");
include("includes/handlers/register-handler.php");

// session_destroy();
session_start();

if(isset($_SESSION['userLoggedIn'])){
    $userLoggedIn = $_SESSION['userLoggedIn'];
}
else{
    header("Location: register.php");
}
$email ="";
$firstName = "";
$lastName = "";
$servername = "localhost";
  $username = "root";
  $dbname = "bakeithappen";
  $password = "";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
  }

  //CREATE QUERY
$query = "SELECT firstName, lastName, email
      FROM users
      WHERE username IN (?)";

// prepare and bind
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $userLoggedIn);

//Execute the SELECT Query
$stmt->execute();

//Get the result and save to variables
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$email = $row["email"];
$firstName = $row["firstName"];
$lastName = $row["lastName"];

?>

<!doctype html>
<html lang="en">

    <!-- URL http://nrs-projects.humboldt.edu/~dmb851/bakeithappen/version2/BakeItHappen/home.html -->
  
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">

    <!-- Custom Css -->
    <link rel="stylesheet" href="Css/mystyle-submit.css">

    <title >Bake It Happen!</title>
  </head>

  <body>
    <div class="container-fluid overlay">
        <header>
            <!--Front page banner image-->
            <img src="Pictures/banner2.png" class="img-long" width="1000" height="" alt="">

            <!--Top navigation bar-->
            <div class="container-fluid ">
                <nav class="navbar navbar-expand  bg-transparent"> 
                    <ul class="navbar-nav ml-auto "> 
                        <!-- <li class="nav-item  "> 
                            <a class="nav-link rounded-left" href="foodmap.html"> 
                            Find Restaurants 
                            </a> 
                        </li>  -->

                        <li class="nav-item"> 
                            <a class="nav-link  " href="home-loggedin.php"> 
                            Home 
                            </a> 
                        </li> 
                        <li class="nav-item"> 
                            <a class="nav-link  " href="/submit.html"> 
                            Submit Recipe 
                            </a> 
                        </li> 
                       
                    </ul> 
                </nav> 
            </div>  
        </header>

		<?php
			//$query = mysqli_query($this->con, "SELECT * FROM Users WHERE username='$un' AND password='$pw'" );
		?>

        <section>
            <div class="container">
                <!--Page title, just above search bar-->
                <h1 class="alt-font" id="title">Bake It Happen</h1> 
				
				<!--Page title, just above search bar-->
				<h2 class="alt-font" id="subtitle">Profile</h2>

                <!--Search bar and search buttons group-->
                <div class="row justify-content-center mt-4 search-group">
                    <div class="col-md-10">
                        <div class="float-left pr-3 pb-3">
							<img src="Pictures/Profile_avatar.png">
						</div>
							<p id="username">Username: </p>
							<p id="email">Email:</p>
							<p id="name">Name:</p><br>
							<p id="recipes_submitted">Recipes Submitted: 0</p><br>
                            </div>
                        
                    </div>
                </div>

                <!--Bottom section of page, contains silly quote-->
                <div class="row justify-content-center text-center m-5 ">
                    <div class="col-md-8 quote ">
                        <h7>"I hate when I go to the kitchen for food and all I find are ingredients."
                            - Anonymous</h7>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
    // ACCESS PHP VARIABLES AND SAVE TO JS VARIABLES
    var phpusername = "<?php if (isset($userLoggedIn)) {echo $userLoggedIn;} ?>";
    var phpemail = "<?php echo $email; ?>"; 
    var phpfirstName = "<?php echo $firstName; ?>"; 
    var outusername = document.getElementById("username");
    var outemail = document.getElementById("email");
    var outname = document.getElementById("name");
    
    // ADD TO PAGE
    outusername.innerHTML += String(phpusername);
    outemail.innerHTML += String(phpemail);
    outname.innerHTML += String(phpfirstName);

    </script>
		
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>