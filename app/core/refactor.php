<?php
$publicFiles = ['beranda.php', 'fasilitas.php', 'gazebo.php', 'informasi.php', 'pricelist.php', 'faq.php'];
$adminFiles = ['dashboard_admin.php', 'status_gazebo.php', 'kelola_harga.php', 'kelola_fasilitas.php'];

foreach ($publicFiles as $f) {
    if (!file_exists($f)) continue;
    $content = file_get_contents($f);
    
    $orig = $content;
    
    // replace nav
    $content = preg_replace('/<!--\s*Navigation Bar\s*-->\s*<nav.*?<\/nav>/si', "<?php include 'includes/navbar.php'; ?>", $content);
    if ($content === $orig) {
        $content = preg_replace('/<!--\s*NAVIGATION\s*(?:SECTION|BAR)\s*-->\s*<nav.*?<\/nav>/si', "<?php include 'includes/navbar.php'; ?>", $content);
        if ($content === $orig) {
            $content = preg_replace('/<nav.*?<\/nav>/si', "<?php include 'includes/navbar.php'; ?>", $content);
        }
    }
    
    $orig2 = $content;

    // replace footer
    $content = preg_replace('/<!--\s*FOOTER.*?\s*-->\s*<footer.*?<\/footer>/si', "<?php include 'includes/footer.php'; ?>", $content);
    if ($content === $orig2) {
        $content = preg_replace('/<footer.*?<\/footer>/si', "<?php include 'includes/footer.php'; ?>", $content);
    }

    file_put_contents($f, $content);
    echo "Refactored $f\n";
}

foreach ($adminFiles as $f) {
    if (!file_exists($f)) continue;
    $content = file_get_contents($f);
    $orig = $content;
    
    // replace sidebar
    $content = preg_replace('/<!--\s*SIDEBAR\s*-->\s*<aside.*?<\/aside>/si', "<?php include 'includes/sidebar.php'; ?>", $content);
    if ($content === $orig) {
        $content = preg_replace('/<aside.*?<\/aside>/si', "<?php include 'includes/sidebar.php'; ?>", $content);
    }

    file_put_contents($f, $content);
    echo "Refactored Admin $f\n";
}
?>
