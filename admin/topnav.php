<?php
if(!isset($page)){
    $page = "0";
}
switch($page){
    case 'index': $navLink = "1"; break;
    case 'pengiriman': $navLink = "2"; break;
    case 'pengiriman-modTambah' : $navLink = "2"; break;
    case 'pengiriman-modEdit' : $navLink = "2"; break;
    case 'datafilter' : $navLink = "2"; break;
    case 'akun' : $navLink = "3"; break;
    default: $navLink = "1"; break;
}

?>
<nav class="navbar navbar-light navbar-expand-md navigation-clean">
    <div class="container">
        <a class="navbar-brand" href="index.php">KASUARI CARGO</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><i class="fa fa-navicon"></i></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?php if($navLink == '1') echo 'active'; ?>" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?php if($navLink == '2') echo 'active'; ?>" href="pengiriman.php">Pengiriman</a>
                </li>
                <li class="nav-item" role="presentation">
                    <?php $tipeAkun = $_SESSION['status']; ?>
                    <a class="nav-link <?php if($navLink == '3') echo 'active'; ?>" href="akun_manage.php" onclick="return linkAdmin('<?=$tipeAkun?>', 'Manajemen Akun')">Manajemen Akun</a>
                </li>
                <li class="nav-item dropdown"><a class="dropdown-toggle nav-link shadow" data-toggle="dropdown" aria-expanded="false" href="#">
                    <?=$_SESSION['nama']?>
                    </a>
                    <div class="dropdown-menu" role="menu" style="z-index: 9998;">
                        <a class="dropdown-item" role="presentation" href="akun.php"><i class="fa fa-user-circle"></i>&nbsp;Edit Akun Saya</a>
                        <a class="dropdown-item" role="presentation" href="akun.php?act=hapus" onclick="return askDel('akun')"><i class="fa fa-user-times"></i>&nbsp;Hapus Akun Saya</a><a href="akun.php?act=logout" class="dropdown-item" role="presentation" href="#"><i class="fa fa-power-off"></i>&nbsp;Log Out</a>
                    </div>
                </li>
            </ul>
            <div id="liSearch"></div>
        </div>
    </div>
</nav>