<?php 
$login=0;
$invalid=0;
//Connect with the server by checking if request method is post and connecting to the php connect file
if ($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';

//Post the data using the post method
    $username=$_POST['username'];
    $password=$_POST['password'];
//Make an sql query and store the result in the result variable

//Make a query to the database to read the username and store the result 
       $sql="Select * from `registration` where 
       username='$username' and password='$password'";
       $result=mysqli_query($con,$sql);
//logic to check whether the username exists in the database else insert the user into the database
//If there is a result, make a query to the database on whether the record exists
       if($result){
            $num=mysqli_num_rows($result);
            if($num>0){
               $login=1;
               session_start();
               $_SESSION['username']= $username;
               header('location:home.php');
            }else{
                $invalid=1;                
            }       
        }     
}      
    

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
  </head>
  <body>  
    <?php 
    if($invalid){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error</strong> Invalid credentials.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <?php 
    if($login){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        You are successfully logged in.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
        <h1 class="text-center"> Login to our page </h1> 
        <div class="container mt-5">
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1 " class="form-label">Name</label>
                    <input type="text" class="form-control" placeholder="Enter your username" name="username">
                    
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Enter your password" name="password">
                </div>
            
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
</body>
</html>