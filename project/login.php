<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Taxi Rank Web App</title>
    <link rel="stylesheet" href="css/styleslo.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Taxi Rank Web App</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="login-form">
        <div class="container">
            <h2>Login</h2>
            <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateLogin()">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" name="login">Login</button>
            </form>
            <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Taxi Rank Web App. All rights reserved.</p>
        </div>
    </footer>

   <!-- <script>
        function validateLogin() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            // You need to implement logic to validate the username and password here
            // For demonstration, let's assume the username is "admin" and the password is "password"

            if (username === "" && password === "") {
                // Redirect to admin dashboard page if login is successful
                window.location.href = "dashboard.html";
                return false; // Prevent form submission
            } else {
                alert("Invalid username or password. Please try again.");
                return false; // Prevent form submission
            }
        }
    </script>
    -->
    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['login'])) {
            // Retrieve username and password from the form
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Database connection details
            $dbservername = "localhost";
            $dbusername = "root";
            $dbpassword = ""; // Change this to your database password
            $dbname = "sa_ranks"; // Change this to your database name

            // Create connection
            $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and execute a query to fetch the user's password hash
            $stmt = $conn->prepare("SELECT password_hash FROM admins WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Username exists, fetch password hash
                $stmt->bind_result($hashed_password);
                $stmt->fetch();

                // Verify password
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, redirect to admin dashboard
                    $_SESSION['username'] = $username; // Store username in session for future use
                    header("Location: dashboard.php");
                    exit;
                } else {
                    // Password is incorrect
                    echo "<p class='error-message'>Invalid username or password. Please try again.</p>";
                }
            } else {
                // Username does not exist
                echo "<p class='error-message'>Invalid username or password. Please try again.</p>";
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        }
    }
    ?>
    
</body>
</html>
