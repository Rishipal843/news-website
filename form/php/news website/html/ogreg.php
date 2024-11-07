<?php
session_start();

?> 

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../regisstyle.css">
    
    
</head>
<body>

<?php

include 'dbcon.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

   $pass = password_hash($password , PASSWORD_BCRYPT);
   $cpass = password_hash($cpassword , PASSWORD_BCRYPT);

   $emailquery = " select * from registration where email = '$email' ";
   $query = mysqli_query($con,$emailquery);

   $emailcount = mysqli_num_rows($query);

   if($emailcount>0){
    echo "email already exist";
   }else{
          if($password === $cpassword){
                   
               $insertquery = "insert into registration(name,email,password,cpassword) values('$name','$email','$pass','$cpass')";

               $iquery = mysqli_query($con, $insertquery);

               if($iquery){
               
                 echo "Inserted successful";

            }
            else{
            
               echo "no connection";
            }

          }else{
          
           echo "Password are not matching";
          }
   }

}

?>

    <div class="container">
        <h2>Registration Form</h2>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"  method="POST">  
    


            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="cpassword" required>

            <button type="submit" name="submit">Register</button>
        </form>
        <p>Have an account? <a href="./login.php">Login</a></p>
    </div>
</body>
</html>
