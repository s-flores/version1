<?php


class Account
{
    private $con;
    private $errorArray;

    public function __construct($con){
        $this->con = $con;
        $this->errorArray = array();
    }

    public function login($un, $pw){
        $pw = md5($pw);
        $query = mysqli_query($this->con, "SELECT * FROM Users WHERE username='$un' AND password='$pw'" );

        if(mysqli_num_rows($query) == 1){
            return true;
        }
        else{
            array_push($this->errorArray, Constants::loginFailed);
            return false;
        }
    }

    public function register($un,$fn,$ln,$em,$em2,$pw,$pw2, $pic){
        $this->validateUsername($un); 
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateEmails($em,$em2);
        $this->validatePasswords($pw,$pw2);

        if(empty($this->errorArray)){
            //Insert into DB
            return $this->insertUserDetails($un,$fn,$ln,$em,$pw, $pic);
        }
        else{
            return false;
        }
    }

    // If the error message is not in the array, then echo empty string
    public function getError($error){
        if(!in_array($error, $this->errorArray)){
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }
    private function insertUserDetails($un,$fn,$ln,$em,$pw, $pic){
        $encryptedPw = md5($pw);
        //$profilePic = "assets/images/profile-pics/no-image.jpg";
        $profilePic = "images/" . basename($pic);
        $date = date("Y-m-d");

        $sql ="INSERT INTO Users VALUES(NULL,'$un','$fn','$ln','$em','$encryptedPw','$date','$profilePic')";
        return mysqli_query($this->con, $sql);
    }

    private function validateUsername($un){
        if(strlen($un) > 25 || strlen($un) < 5){
            array_push($this->errorArray, Constants::usernameCharacters);
            return;
        }
        //check if username exist
        $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM Users WHERE username='$un'");
        if(mysqli_num_rows( $checkUsernameQuery) != 0){
            array_push($this->errorArray, Constants::usernameTaken);
        }
    }
    private function validateFirstName($fn){
        if(strlen($fn) > 25 || strlen($fn) < 2){
            array_push($this->errorArray, Constants::firstNameCharacters);
            return;
        }
    }
    private function validateLastName($ln){
        if(strlen($ln) > 25 || strlen($ln) < 2){
            array_push($this->errorArray, Constants::lastNameCharacters);
            return;
        }
    }
    private function validateEmails($em, $em2){
        if($em != $em2){
            array_push($this->errorArray, Constants::emailNotMatch);
            return;
        }
        if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArray, Constants::emailInvalid);
            return;
        }
        //check that email is not taken
        $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM Users WHERE email='$em'");
        if(mysqli_num_rows( $checkEmailQuery) != 0){
            array_push($this->errorArray, Constants::emailTaken);
        }
    }
    private  function validatePasswords($pw, $pw2){
        if($pw != $pw2){
            array_push($this->errorArray, Constants::passwordsNotMatch);
            return;
        }
        if(preg_match('/[^A-Za-z0-9]/', $pw)){
            array_push($this->errorArray, Constants::passwordsNotAlphanumeric);
            return;
        }
        if(strlen($pw) > 20 || strlen($pw) < 5){
            array_push($this->errorArray, Constants::passwordCharacters);
            return;
        }


    }
}
