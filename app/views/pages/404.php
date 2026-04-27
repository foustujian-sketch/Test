<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/webp" href="/assets/logo.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan - Taman Salma Shofa</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-[#FAFAFB] text-gray-800 flex flex-col min-h-screen">

    <?php include __DIR__ . '/../shared/includes/navbar.php'; ?>

    <main class="flex-grow flex items-center justify-center py-20 px-6">
        <div class="text-center max-w-lg">
            <h1 class="text-[120px] font-extrabold text-[#E88D57] leading-none mb-4 tracking-tighter drop-shadow-sm">404</h1>
            <h2 class="text-[32px] font-bold text-[#1a1a24] mb-4">Ups! Halaman Tidak Ditemukan</h2>
            <p class="text-gray-500 mb-8 text-[15px] leading-relaxed">
                Maaf, halaman yang Anda cari mungkin telah dihapus, namanya diubah, atau sementara tidak tersedia. Mari kembali ke beranda dan mulai lagi.
            </p>
            <a href="/index" class="inline-flex items-center gap-2 bg-[#E88D57] hover:bg-[#D97C45] text-white font-bold py-3.5 px-8 rounded-full transition-all shadow-md hover:shadow-lg">
                <i class="fa-solid fa-home"></i> Kembali ke Beranda
            </a>
        </div>
    </main>

    <?php include __DIR__ . '/../shared/includes/footer.php'; ?>

</body>
</html>
