<div class="footer">
    <!-- footer halaman publik -->
    <?php if (!isset($_SESSION["isLogin"])):?>
        <img src="./gambar/logo.jpg" alt="logo">
        <div>
            <img src="./gambar/logo_name.jpg" alt="logo tulisan"><br>
            <small>Ruang Konsultasi Karya ilmian / penelitian Terpercaya</small>
        </div>
        <a href="./index.php">Home</a>
        <a href="./authentication/login.php">Login</a>
        <a href="./authentication/register.php">Daftar</a>
        <span>@ 2026 ReasearchMate website Indonesia<br>Dirancang unutk membantu Mahasiswa</span>

    <!-- footer halaman private -->
    <?php else:?>
        <img src="../gambar/logo.jpg" alt="logo">
        <div>
            <img src="../gambar/logo_name.jpg" alt="logo tulisan"><br>
            <small>Ruang Konsultasi Karya ilmian / penelitian Terpercaya</small>
        </div>
        <?php if($_SESSION['id_role'] == 1): ?>
            <a href="../client/dashboard_client.php">Home</a>
        <?php else:?>
            <a href="../expert/dashboard_expert.php">Home</a>
        <?php endif;?>
        <a href="../authentication/login.php">Login</a>
        <a href="../authentication/register.php">Daftar</a>
        <span>@ 2026 ReasearchMate website Indonesia<br>Dirancang unutk membantu Mahasiswa</span>
    <?php endif;?>
</div>