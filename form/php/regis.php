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
<style>
    /* Alert styling */
    .alert {
        width: 100%;
        padding: 15px;
        background-color: #ff5555; /* Red for error messages */
        color: white;
        text-align: center;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
      
        display: none; /* Hidden by default */
    }
    .alert.success {
        background-color: #5cb85c; /* Green for success messages */
    }
</style>
</head>
<body>

<?php
include 'dbcon.php';

$alert_message = '';
$alert_class = '';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    $pass = password_hash($password, PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

    $emailquery = "SELECT * FROM registration WHERE email = '$email'";
    $query = mysqli_query($con, $emailquery);
    $emailcount = mysqli_num_rows($query);

    if ($emailcount > 0) {
        $alert_message = "Email already exists";
    } else {
        if ($password === $cpassword) {
            $insertquery = "INSERT INTO registration(name, email, password, cpassword) VALUES('$name', '$email', '$pass', '$cpass')";
            $iquery = mysqli_query($con, $insertquery);

            if ($iquery) {
                $alert_message = "Registration successful";
                $alert_class = "success";
                echo "<script>setTimeout(() => { location.replace('login.php'); }, 2000);</script>";
            } else {
                $alert_message = "Connection error. Try again.";
            }
        } else {
            $alert_message = "Passwords do not match";
        }
    }
}
?>

<!-- Alert Message -->
<div class="alert <?php echo $alert_class; ?>" id="alertMessage"><?php echo $alert_message; ?></div>

<div class="container">
    <h2>Registration Form</h2>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">  
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

<script>
    // Show the alert if there's a message
    const alertBox = document.getElementById('alertMessage');
    if (alertBox.innerText.trim() !== '') {
        alertBox.style.display = 'block';
        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 3000); // Hide the alert after 3 seconds
    }
</script>

</body>
</html>
