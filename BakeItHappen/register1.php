
<?php
include("includes/config.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");

$account = new Account($con);

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}

?>



<!doctype html>
<html lang="en">

    <!-- URL http://nrs-projects.humboldt.edu/~dmb851/bakeithappen/version2/BakeItHappen/home.html -->
  
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

  <?php   
            if(isset($_POST['registerButton'])){
                echo '<script>
                        $(document).ready(function(){  
                        $("#loginForm").hide();
                        $("#registerForm").show();
                        });
                    </script>';
            }
            else {
               echo '<script>
                        $(document).ready(function(){  
                        $("#loginForm").show();
                        $("#registerForm").hide();
                        });
                    </script>';
            }
            ?>
    

    <div class="overlay">
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
                            <a class="nav-link  " href="home.html"> 
                            Home 
                            </a> 
                        </li> 
                        <li class="nav-item "> 
                            <a class="nav-link rounded-right " href="register.php" > 
                            Login/Signup 
                            </a> 
                        </li> 
                       
                    </ul> 
                </nav> 
            </div>  
        </header>

        <section>
            <div class="container">
                <!--Page title, just above search bar-->
                <h1 class="alt-font" id="title">Bake It Happen</h1> 
				
				<!--Page title, just above search bar-->
				<h2 class="alt-font" id="subtitle">Submit Recipe</h2>

                <!--Search bar and search buttons group-->
                <div class="row justify-content-center mt-4 search-group">
                    <div class="col-md-10">
                        <div class="input-group shadow md-form form-sm pl-0"> 

                <form id="loginForm" action="register1.php" method="POST" enctype="multipart/form-data">
                    <h2>Login to your account</h2>
                    <p>
                        <?php echo $account->getError(Constants::loginFailed);?>
                        <label for="loginUsername">Username</label>
                        <input id="loginUsername" name="loginUsername" type="text" placeholder="e.g bartSimpson" required>
                    </p>
                    <p>
                        <label for="loginPassword">Password</label>
                        <input id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required>
                    </p>
                    <button type="submit" name="loginButton">LOG IN</button>
                    <div class="hasAccountText">
                        <span id="hideLogin">Don't have an account yet? Click here to sign up.</span>
                    </div>
            
                </form>

                <form id="registerForm" action="register1.php" method="POST" enctype="multipart/form-data" >
                    <h2>Create your free account</h2>
                    <p>
                        <?php echo $account->getError(Constants::usernameCharacters); ?>
                        <?php echo $account->getError(Constants::usernameTaken); ?>
                        <label for="username">Username</label>
                        <input id="username" name="username" type="text" placeholder="e.g bartSimpson"
                            value="<?php getInputValue('username') ?>" required>
                    </p>
            
                    <p>
                        <?php echo $account->getError(Constants::firstNameCharacters); ?>
                        <label for="firstName">First name</label>
                        <input id="firstName" name="firstName" type="text" placeholder="e.g Bart"
                            value="<?php getInputValue('firstName') ?>" required>
                    </p>
            
                    <p>
                        <?php echo $account->getError(Constants::lastNameCharacters); ?>
                        <label for="lastName">Last name</label>
                        <input id="lastName" name="lastName" type="text" placeholder="e.g Simpson"
                            value="<?php getInputValue('lastName') ?>" required>
                    </p>
                   
                    
                        <p>
                        <label class="custom-file-upload">
                        Select image to upload:
                        <input type="file" name="image" id="image">
                        </p>
                        </label>
                    <p>
                        <?php echo $account->getError(Constants::emailTaken) ?>
                        <?php echo $account->getError(Constants::emailNotMatch) ?>
                        <?php echo $account->getError(Constants::emailInvalid) ?>
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" placeholder="e.g bart@gmail.com"
                            value="<?php getInputValue('email') ?>" required>
                    </p>
            
                    <p>
                        <label for="email2">Confirm email</label>
                        <input id="email2" name="email2" type="email" placeholder="e.g bart@gmail.com"
                            value="<?php getInputValue('email2') ?>" required>
                    </p>
            
                    <p>
                        <?php echo $account->getError(Constants::passwordsNotMatch) ?>
                        <?php echo $account->getError(Constants::passwordsNotAlphanumeric) ?>
                        <?php echo $account->getError(Constants::passwordCharacters) ?>
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" placeholder="Your password" required>
                    </p>
            
                    <p>
                        <label for="password2">Confirm password</label>
                        <input id="password2" name="password2" type="password" placeholder="Your password" required>
                    </p>
            
            
                    <button type="submit" name="registerButton">SIGN UP</button>
                    <div class="hasAccountText">
                        <span id="hideRegister">Already have an account? Click here to login.</span>
                    </div>
            
                </form>  
                
             
            
                </form> 
                            <!-- RECIPE FORM 
							<form>
							  <div class="form-group">
								<label for="recipeTitle">Recipe Title</label>
								<input type="form-control" class="form-control" id="recipeTitle" aria-describedby="emailHelp">

							  </div>
							  <div class="form-group">
								<label for="servingSize">Serving Size</label>
								<input type="form-control" class="form-control" id="servingSize">
							  </div>
							  
							  <div class="form-group">
								<label for="recipeDesc">Recipe Description</label>
								<textarea class="form-control" id="recipeDesc" rows="3"></textarea>
							  </div>

							  <div class="form-group">
								<label for="recipeIngr">Ingredients</label>
								<textarea class="form-control" id="recipeIngr" rows="3"></textarea>
							  </div>

							  <div class="form-group">
								<label for="recipeDir">Directions</label>
								<textarea class="form-control" id="recipeDir" rows="3"></textarea>
							  </div>								  
							  
							  <button type="submit" class="btn btn-primary">Submit</button>
							</form>
							-->
                           
                            </div>
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
		
    
    <!-- Optional JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
