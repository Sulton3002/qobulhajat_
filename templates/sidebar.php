<!-- Form Pencarian -->
<div class="mb-4">
    <form action="search.php" method="get" class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Cari artikel...">
        <button class="btn btn-primary" type="submit">Cari</button>
    </form>
</div>
<!-- Menu Kategori -->
<div class="mb-4">
    <h5>Kategori</h5>
    <ul class="list-group">
        <?php
        include 'config/koneksi.php';
        $kategori = mysqli_query($conn, "SELECT * FROM category ORDER BY name");
        while ($kat = mysqli_fetch_assoc($kategori)) {
            echo '<li class="list-group-item"><a href="kategori.php?id=' . $kat['id'] . '">' . htmlspecialchars($kat['name']) . '</a></li>';
        }
        ?>
    </ul>
</div>

<?php if (isset($sidebarType) && $sidebarType === 'utama'): ?>
    <!-- Tentang -->
    <div class="mb-4">
        <h5>Tentang</h5>
        <p>Selamat datang di My Blog. Temukan artikel menarik seputar topik favorit Anda!</p>
    </div>
    <hr>
<?php else: ?>
    <!-- Sidebar Tentang -->
    <div class="sidebar-section">
        <h3>Tentang</h3>
        <p>
            Blog ini berisi artikel menarik seputar teknologi, pemrograman, dan informasi terbaru lainnya.
        </p>
    </div>
<?php endif; ?>
