<!doctype html>
<html>
<body>

<?php  
$ingredients = $_POST["res"]; 
$ingredients_arr = explode(" ", $ingredients);
$servername = "localhost";
$username = "root";
$dbname = "test2";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

// Runs if 4 Ingredients are input
if (sizeof($ingredients_arr) == 4) {
    
    //Create SQL SELECT Query to be run. 
    $query = "SELECT rec_name, rec_instruct 
    FROM Recipe AS r 
    INNER JOIN recipe_ingredient i ON i.rec_id = r.rec_id 
    INNER JOIN Ingredient x ON x.in_id = i.in_id 
    WHERE x.in_name IN (?, ?, ?, ?) 
    GROUP BY r.rec_name 
    HAVING COUNT(*) = 4";

    //Prepare the SELECT statement using mysqli
    $statement = $conn->prepare($query);
    
    //Bind inputs from user for mysqli to use 
    $statement->bind_param("ssss", $i0, $i1, $i2, $i3);
    $i0 = $ingredients_arr[0];
    $i1 = $ingredients_arr[1];
    $i2 = $ingredients_arr[2];
    $i3 = $ingredients_arr[3];

    //Execute the SELECT Query
    $statement->execute();

    //Get the result and format it
    $result = $statement->get_result();
    $data = $result->fetch_assoc();

    //Print results and close connection
    echo $data['rec_name'];
    echo $data['rec_instruct'];
    mysqli_close($conn);
}


// Runs if 3 Ingredients are input
elseif (sizeof($ingredients_arr) == 3) {
      //Create SQL SELECT Query to be run. 
      $query = "SELECT rec_name, rec_instruct 
      FROM Recipe AS r 
      INNER JOIN recipe_ingredient i ON i.rec_id = r.rec_id 
      INNER JOIN Ingredient x ON x.in_id = i.in_id 
      WHERE x.in_name IN (?, ?, ?) 
      GROUP BY r.rec_name 
      HAVING COUNT(*) = 3";
  
      //Prepare the SELECT statement using mysqli
      $statement = $conn->prepare($query);
      
      //Bind inputs from user for mysqli to use 
      $statement->bind_param("sss", $i0, $i1, $i2);
      $i0 = $ingredients_arr[0];
      $i1 = $ingredients_arr[1];
      $i2 = $ingredients_arr[2];
  
      //Execute the SELECT Query
      $statement->execute();
  
      //Get the result and format it
      $result = $statement->get_result();
      $data = $result->fetch_assoc();
  
      //Print results and close connection
      echo $data['rec_name'];
      echo $data['rec_instruct'];
      mysqli_close($conn);
}
else {
  echo ('Incorrect Number of Ingredients Entered');
}


?>
</body>
</html>