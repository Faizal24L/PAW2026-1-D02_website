<div class="content">
    <!-- pembuka -->
    <div>
        <h1>Hallo, <?= $_SESSION['username']?></h1>
        <?php if($_SESSION['id_role'] == 1): ?>
            <span>Kelola Pertanyaanmu, Jelahi diskusi Pelajar Lain dan Baca Solusi dari Pakar </span>
        <?php else:?>
            <span>Bantu para pelajar dengan memberikan jawaban terbaik sesuai bidang keahlianmu. </span>
        <?php endif;?>

        <!-- if = client, ada navigasi untuk membuat topik -->
        <?php if($_SESSION['id_role'] == 1): ?>
            <a href="../client/create_topik.php?id_user=<?=$id_user?>">+buat topik</a>
        <?php endif;?>
    </div>

    <!-- filter kategori -->
    <h2>SEMUA TOPIK</h2>
    <form action="dashboard_expert.php" method="GET">
        <label>kategori</label>
        <select name="kategori">
            <option value="">semua kategori</option>
            <?php foreach($kategori as $kat): ?>
                <option value="<?= $kat['id_kategori'] ?>"><?= htmlspecialchars($kat['kategori'])?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">filter</button>
    </form>

    <!-- daftar topik -->
    <br>
    <?php if (count($topik) > 0): ?>
        <?php foreach ($topik as $top):?>
            <div>
                <!-- pengarahan ke halaman lanjutan jika klik topik -->
                <?php if($_SESSION['id_role'] == 2): ?>
                    <?php?>
                        <div>
                            <span><?= $top["username"]?></span>
                            <a href="../expert/reply.php?id_topic=<?= $top['id_topic'] ?>"><?= htmlspecialchars($top['topic']) ?></a>
                        </div>
                <?php else:?>
                    <?php if ($_SESSION['id_user'] == $top['id_user']):?>
                        <div>
                            <span>Topic Anda</span>
                            <span><?= $top["kategori"] ?></span><br>
                            <span><?= $_SESSION["username"]?></span><br>
                            <a href="../client/topic_detail.php?id_topic=<?= $top['id_topic'] ?>"><?= htmlspecialchars($top['topic']) ?></a>
                        </div>
                    <?php else:?>
                            <div>
                                <span><?= $top["kategori"] ?></span><br>
                                <span><?= $top["username"]?></span><br>
                                <a href="../client/topic_detail.php?id_topic=<?= $top['id_topic'] ?>"><?= htmlspecialchars($top['topic']) ?></a>
                            </div>
                    <?php endif;?>
                <?php endif;?>
                
            </div>
        <?php endforeach;?>
    <?php else: ?>
        <p>Belum ada topik pada kategori ini.</p>
    <?php endif; ?>
</div>