<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Admin - Taman Salma Shofa</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-[#E88D57] p-6 text-center">
            <h2 class="text-2xl font-bold text-white">Registrasi Admin</h2>
            <p class="text-white/80 text-sm mt-1">Buat akun admin Taman Salma Shofa</p>
        </div>
        
        <div class="p-8">
            <?php if (isset($data['error']) && $data['error']): ?>
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm mb-6 flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation text-lg"></i>
                    <?= htmlspecialchars($data['error_msg']) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($data['success']) && $data['success']): ?>
                <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl text-sm mb-6 flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-lg"></i>
                    <?= htmlspecialchars($data['success_msg']) ?>
                </div>
                <a href="/Salma/login" class="w-full block text-center bg-[#E88D57] hover:bg-[#D97C45] text-white font-bold py-3 px-4 rounded-xl transition-colors mb-4">
                    Ke Halaman Login
                </a>
            <?php else: ?>
                <form action="proses_register" method="POST" class="space-y-5">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Username
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-regular fa-user"></i>
                            </div>
                            <input class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#E88D57] focus:border-transparent transition-all" 
                                id="username" name="username" type="text" required placeholder="Masukkan username">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <input class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#E88D57] focus:border-transparent transition-all" 
                                id="password" name="password" type="password" required placeholder="Masukkan password">
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm_password">
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <input class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#E88D57] focus:border-transparent transition-all" 
                                id="confirm_password" name="confirm_password" type="password" required placeholder="Ulangi password">
                        </div>
                    </div>
                    
                    <button class="w-full bg-[#E88D57] hover:bg-[#D97C45] text-white font-bold py-3 px-4 rounded-xl transition-colors mt-2" type="submit">
                        Daftar Akun
                    </button>
                </form>
                <div class="mt-6 text-center text-sm text-gray-600">
                    Sudah punya akun? <a href="/Salma/login" class="text-[#E88D57] hover:underline font-semibold">Login di sini</a>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="bg-gray-50 border-t border-gray-100 p-4 text-center">
            <a href="/Salma/index" class="text-sm text-gray-500 hover:text-gray-800 transition-colors">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>
