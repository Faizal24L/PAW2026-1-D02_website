<!-- Lihat profile -->
<a href="../authentication/profile.php">PROFILE</a>

<!-- daftar topik sendiri -->
<?php if($_SESSION['id_role'] == "1"):?>
    <h1>Topik ku</h1>
    <?php if (count($topik) > 0): ?>
        <?php foreach ($topik as $top): ?>
            <?php if ($top['id_user'] == $_SESSION['id_user']):?>
                <div>
                    <a href="../client/topic_detail.php?id_topic=<?= $top['id_topic'] ?>"><?= htmlspecialchars($top['topic']) ?></a>
                </div>
            <?php endif;?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Belum ada topik pada kategori ini.</p>
    <?php endif; ?>
<?php endif;?>

<h1>SEMUA TOPIK</h1><br>

<!-- filter kategori -->
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
				<a href="../expert/reply.php?id_topic=<?= $top['id_topic'] ?>"><?= htmlspecialchars($top['topic']) ?></a>
            <?php else:?>
				<a href="../client/topic_detail.php?id_topic=<?= $top['id_topic'] ?>"><?= htmlspecialchars($top['topic']) ?></a>
			<?php endif;?>
            
        </div>
    <?php endforeach;?>
<?php else: ?>
    <p>Belum ada topik pada kategori ini.</p>
<?php endif; ?>

<!-- ke Halaman membuat topik client-->
<?php if($_SESSION['id_role'] == 1): ?>
    <a href="../client/create_topik.php?id_user=<?=$id_user?>">buat topik</a>
<?php endif;?>