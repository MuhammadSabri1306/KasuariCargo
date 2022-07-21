<?php
session_start();

require 'function.php';
$adm = mysqli_fetch_assoc(selectData("SELECT namal, nohp FROM akun WHERE status='admin'"));
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>KASUARI CARGO</title>
    <link rel="icon" href="assets/img/favicon.png">
    <meta name="description" content="Cek pengiriman via layanan Kasuari Cargo, jasa pengiriman barang termurah">
    <meta name="keywoards" content="kasuari cargo, kasuari, pengiriman barang, kirim barang murah">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>
<body>
    <div class="login-clean" style="background-image: url(&quot;assets/img/bg.jpg&quot;);background-repeat: no-repeat;background-size: cover;background-position: right;background-color: #c2e7f9;padding: 60px 0 100px;">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-unlocked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-block text-white" type="submit" name="login" onclick="return valLogin();">Log In</button></div><a class="forgot" href="" data-toggle="modal" data-target="#lupa-akun"><i class="fa fa-info-circle"></i>&nbsp; Lupa username atau password?</a>
            <div class="modal fade"
                role="dialog" tabindex="-1" id="lupa-akun">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bgr-primary text-white">
                            <h4 class="modal-title">Info&nbsp;<i class="fa fa-info-circle"></i></h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                        <div class="modal-body" style="padding: 26px;">
                            <p>Hubungi Administrator di <?=$adm['nohp']?><br>- <?=$adm['namal']?></p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <nav class="navbar navbar-light navbar-expand-md fixed-bottom navigation-clean-search">
        <div class="container"><a class="navbar-brand" href="#">KASUARI CARGO</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="content.php">Cek Pengiriman Saya</a></li>
                    <li class="nav-item" role="presentation">
                        <form class="form-inline mr-auto" target="_self">
                            <div class="form-group"><input class="form-control search-field" type="search" id="search-field" name="search" placeholder="Cari .."><button id="btnSearch" class="btn text-white" type="button" style="margin: 0px;padding: 0.455rem 0.75rem;"><i class="fa fa-search"></i></button></div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>

    <?php
    if(isset($_POST['login'])){
        $un = $_POST['username'];
        $ps = $_POST['password'];

        login($un, $ps);
    }?>

</body>

</html>