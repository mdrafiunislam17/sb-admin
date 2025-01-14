<?php
// Include database configuration
require 'includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $password = md5($_POST['password']);  // Ideally, use more secure methods like password_hash

    // Validation
    if (empty($email) || empty($password)) {
        echo '<h4 class="text-danger text-center pt-3" > All fields are required.<h4>';
    } else {
        try {
            // Query to check user credentials
            $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':email' => $email,
                ':password' => $password,
            ]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // User is authenticated, you can set session and redirect
                session_start();
                $_SESSION['user_id'] = $user['id'];  // Assuming 'id' is the user's ID in the database
                header('Location: index.php');  // Redirect to the dashboard or any protected page
                exit();
            } else {
                echo '<h4 class="text-danger text-center pt-3">Invalid credentials.<h4>';
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Display detailed error message
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-login-image pt-lg-5">
                        <img src="img/sms.png" alt="" width="100%">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>
                            <form class="user" method="POST" action="">

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail"
                                        placeholder="Enter Email Address" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword"
                                        placeholder="Password" required>
                                </div>
                                <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="register.php">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
