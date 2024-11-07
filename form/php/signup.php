<?php
session_start();
include 'dbcon.php';
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
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>Invalid email format.</p>";
    } else {
        // Check if email already exists
        $emailQuery = "SELECT * FROM registration WHERE email = '$email'";
        $query = mysqli_query($con, $emailQuery);
        
        if (mysqli_num_rows($query) > 0) {
            echo "<p>Email already exists. Please try another.</p>";
        } else {
            // Check if passwords match
            if ($password === $cpassword) {
                $passHash = password_hash($password, PASSWORD_BCRYPT);
                $insertQuery = "INSERT INTO registration(name, email, password) VALUES('$name', '$email', '$passHash')";

                if (mysqli_query($con, $insertQuery)) {
                    echo "<p>Registration successful!</p>";
                } else {
                    echo "<p>Registration failed: " . mysqli_error($con) . "</p>";
                }
            } else {
                echo "<p>Passwords do not match. Please try again.</p>";
            }
        }
    }
}
?>

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
</body>
</html>
