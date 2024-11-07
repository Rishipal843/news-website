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
<style>
    /* Alert styling */
    .alert {
        width: 100%;
        padding: 15px;
        color: white;
        text-align: center;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        
        display: none; /* Hidden by default */
    }
    .alert.error {
        background-color: #ff5555; /* Red background for error */
    }
    .alert.success {
        background-color: #5cb85c; /* Green background for success */
    }
</style>
</head>
<body>

<?php
include 'dbcon.php';

$alert_message = '';
$alert_class = 'error'; // Default to error class

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email_search = "SELECT * FROM registration WHERE email='$email'";
    $query = mysqli_query($con, $email_search);

    $email_count = mysqli_num_rows($query);

    if ($email_count) {
        $email_pass = mysqli_fetch_assoc($query);
        $db_pass = $email_pass['password'];
        $_SESSION['name'] = $email_pass['name'];

        $pass_decode = password_verify($password, $db_pass);
        if ($pass_decode) {
            $alert_message = "Login successful";
            $alert_class = 'success'; // Set class to success for green color
            echo "<script>setTimeout(() => { location.replace('index.php'); }, 1000);</script>";
        } else {
            $alert_message = "Password Incorrect";
        }
    } else {
        $alert_message = "Invalid email";
    }
}
?>

<!-- Alert Message -->
<div class="alert <?php echo $alert_class; ?>" id="alertMessage"><?php echo $alert_message; ?></div>

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

<script>
    // Show the alert if there's a message
    const alertBox = document.getElementById('alertMessage');
    if (alertBox.innerText) {
        alertBox.style.display = 'block';
        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 1000); // Hide the alert after 1 seconds
    }
</script>

</body>
</html>
