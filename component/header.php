<div class="header">
    <!-- header halaman publik -->
    <?php if (!isset($_SESSION["isLogin"])):?>

        <!-- jika di halamn index -->
        <?php if ($header == "index"):?>
            <div>
                <img src="./gambar/logo.png" alt="logo">
                <img src="./gambar/logo_name.png" alt="logo tulisan" class="logo_header">
            </div>
            <div>
                <a href="./index.php">Home</a>
                <a href="./authentication/login.php">Login</a>
                <a href="./authentication/register.php">Daftar</a>
            </div>
            
        <!-- jika bukan di halaman index -->
        <?php else:?>
            <div>
                <img src="../gambar/logo.png" alt="logo">
                <img src="../gambar/logo_name.png" alt="logo tulisan" class="logo_header">
            </div>
            <div>
                <a href="../index.php">Home</a>
                <a href="../authentication/login.php">Login</a>
                <a href="../authentication/register.php">Daftar</a>
            </div>
        <?php endif;?>

    <!-- header halaman private -->
    <?php else:?>
        <div>
            <img src="../gambar/logo.png" alt="logo">
            <img src="../gambar/logo_name.png" alt="logo tulisan" class="logo_header">
        </div>
        <div>
            <?php if($_SESSION['id_role'] == 1): ?>
                <a href="../client/dashboard_client.php" class="<?= $halaman == 'dashboard_client.php' ? 'active' : '' ?>">Home</a>
            <?php else:?>
                <a href="../expert/dashboard_expert.php" class="<?= $halaman == 'dashboard_expert.php' ? 'active' : '' ?>">Home</a>
            <?php endif;?>
            <a href="../authentication/profile.php" class="<?= $halaman == 'profile.php' ? 'active' : '' ?>">Profile</a>
            <a href="../authentication/logout.php">Logout</a>
        </div>
    <?php endif;?>
</div>