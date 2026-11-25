<div class="content">
    <!-- pembuka -->
    <div class="box_awal">
        <div>
            <?php if($_SESSION['id_role'] == 1): ?>
                <small class="box_putih">Halaman Client / Pelajar</small>
            <?php else:?>
                <small class="box_putih">Halaman Expert / Pakar</small>
            <?php endif;?>
            <h1>Hallo, <?= $_SESSION['username']?>!</h1>
            <?php if($_SESSION['id_role'] == 1): ?>
                <span>Kelola Pertanyaanmu, Jelahi diskusi Pelajar Lain dan Baca Solusi dari Pakar </span>
            <?php else:?>
                <span>Bantu para pelajar dengan memberikan jawaban terbaik sesuai bidang keahlianmu. </span>
            <?php endif;?>
        </div>
        <!-- if = client, ada navigasi untuk membuat topik -->
        <?php if($_SESSION['id_role'] == 1): ?>
            <a href="../client/create_topik.php?id_user=<?=$id_user?>" class="box_pinktua">+buat topik</a>
        <?php endif;?>
    </div>

    <!-- filter kategori -->
    <div class="box_kat">
        <div>
            <h2 class="box_putih"><span class="box_pinkmuda">Kategori</span> Untuk Topik Diskusi</h2>
            <small>Jelajahi pertanyaan dari pelajar serta jawaban pakar</small>
        </div>

        <!-- pengecekan role apakah dia expert atau client -->
        <?php if ($id_role == 2):?>
        <!-- jika expert, form di submit ke dasboard expert -->
        <form action="dashboard_expert.php" method="GET">
            <select name="kategori">
                <option value="">semua kategori</option>
                <?php foreach($kategori as $kat): ?>
                    <option value="<?= $kat['id_kategori'] ?>"><?= htmlspecialchars($kat['kategori'])?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">filter</button>
        </form>
        <?php else:?>
            <!-- jika client, form di submit ke dasboard client -->
            <form action="dashboard_client.php" method="GET">
                <select name="kategori">
                    <option value="">semua kategori</option>
                    <?php foreach($kategori as $kat): ?>
                        <option value="<?= $kat['id_kategori'] ?>"><?= htmlspecialchars($kat['kategori'])?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">filter</button>
            </form>
        <?php endif;?>
    </div>

    <!-- daftar topik -->
    <?php if (count($topik) > 0): ?>
        <?php foreach ($topik as $top):?>
            <!-- pengarahan ke halaman lanjutan jika klik topik -->
            <?php if($_SESSION['id_role'] == 2): ?>
                <!-- unutk role expert -->
                <div class="box">
                    <small class="box_pinkmuda"><?= $top["kategori"] ?></small><br>
                    <small>oleh: @<?= $top["username"]?></small><br>
                    <a href="../expert/reply.php?id_topic=<?= $top['id_topic'] ?>"><?= htmlspecialchars($top['topic']) ?></a>
                </div>
            <?php else:?>
                <!-- untuk role client -->
                <?php if ($_SESSION['id_user'] == $top['id_user']):?>
                    <!-- jika di topiknya punya user di session -->
                    <div class="box">
                        <small class="box_pinkmuda"><?= $top["kategori"] ?></small>
                        <small class="box_hijau">Topic Anda</small><br>
                        <small>oleh: @<?= $_SESSION["username"]?></small><br>
                        <a href="../client/topic_detail.php?id_topic=<?= $top['id_topic'] ?>"><?= htmlspecialchars($top['topic']) ?></a>
                    </div>
                <?php else:?>
                    <!-- jika di topiknya bukan punya user di session -->
                    <div class="box">
                        <small class="box_pinkmuda"><?= $top["kategori"] ?></small><br>
                        <small>oleh: @<?= $top["username"]?></small><br>
                        <a href="../client/topic_detail.php?id_topic=<?= $top['id_topic'] ?>"><?= htmlspecialchars($top['topic']) ?></a>
                    </div>
                <?php endif;?>
            <?php endif;?>
        <?php endforeach;?>
    <?php else: ?>
        <div class="box">Belum ada topik pada kategori ini.</div>
    <?php endif; ?>
</div>