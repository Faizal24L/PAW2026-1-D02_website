<div>
    <!-- header halman publik -->
    <?php if (!isset($_SESSION["isLogin"])):?>
        <div>
            <img src="../gambar/logo.jpg" alt="logo">
            <img src="../gambar/logo_name.jpg" alt="logo tulisan">
        </div>
        <div>
            <a href="../index.php">Home</a>
            <a href="../authentication/login.php">Login</a>
            <a href="../authentication/register.php">Daftar</a>
        </div>

    <!-- header halaman private -->
    <?php else:?>
        <div>
            <img src="logo.jpg" alt="logo">
            <img src="logo_name.jpg" alt="logo tulisan">
        </div>
        <div>
            <?php if($_SESSION['id_role'] == 1): ?>
                <a href="../client/dashboard_client.php">Home</a>
            <?php else:?>
                <a href="../expert/dashboard_expert.php">Home</a>
            <?php endif;?>
            <a href="../authentication/profile.php">Profile</a>
            <a href="../authentication/logout.php">Logout</a>
        </div>
    <?php endif;?>
</div>