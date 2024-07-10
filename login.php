<?php
require "../connect.php";
session_start();

if (isset($_POST['proses'])) {
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Query untuk memeriksa apakah email dan password sesuai, serta status in_active = 1
    $query = "SELECT * FROM user WHERE email = :email AND password = :password AND is_active = '1'";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Memeriksa apakah ada baris yang sesuai
    if ($stmt->rowCount() > 0) {
        // Jika ada, simpan data pengguna ke sesi
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $user['username']; // Asumsikan ada kolom 'username' dalam tabel user
        // Redirect ke halaman dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Email atau password salah";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; D'bouquet</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="https://demo.getstisla.com/assets/css/style.css">
    <link rel="stylesheet" href="https://demo.getstisla.com/assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="img/logoo.jpg" width="100" class="shadow-light rounded-circle">LOGO
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="#" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control form-control-user" name="email" 
                                            placeholder="Email" autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>

                                        </div>
                                        <input type="password" class="form-control form-control-user" name="pass"
                                            placeholder="Password">
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <button type="submit" name="proses" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>


                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Don't have an account? <a href="auth-register.html">Create One</a>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; Dea Puspita 2018
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://demo.getstisla.com/assets/modules/jquery.min.js"></script>
    <script src="https://demo.getstisla.com/assets/modules/popper.js"></script>
    <script src="https://demo.getstisla.com/assets/modules/tooltip.js"></script>
    <script src="https://demo.getstisla.com/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://demo.getstisla.com/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="https://demo.getstisla.com/assets/modules/moment.min.js"></script>
    <script src="https://demo.getstisla.com/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="https://demo.getstisla.com/assets/js/scripts.js"></script>
    <script src="https://demo.getstisla.com/assets/js/custom.js"></script>
</body>

</html>