<?php
session_start();


?> 

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../logstyle.css">
</head>
<body>

<?php

    include 'dbcon.php';

  if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email_search = "select *from registration where email='$email' ";
    $query = mysqli_query($con,$email_search);

    $email_count = mysqli_num_rows($query);

    if($email_count){
        $email_pass = mysqli_fetch_assoc($query);

        $db_pass = $email_pass['password'];
        $_SESSION['name'] = $email_pass['name'];

        $pass_decode = password_verify($password,$db_pass);
        if($pass_decode){
            
                echo "Login successful";
             
                ?>
                 <script>
                    location.replace("index.php");
                 </script>
                <?php

           
        }else{
            echo "password Incorrect";

        }
    }else{
        echo "invalid";
    }


  }

?>

    <div class="container">
        <h2>Login</h2>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="./regis.php">Register here</a></p>
    </div>
</body>
</html>
