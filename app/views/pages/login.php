<?php
// Data passed from AuthController - login logic is handled in the controller

// Initialize default values if not provided
$error = $error ?? false;
$error_msg = $error_msg ?? "";

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" type="image/webp" href="/assets/logo.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Taman Salma Shofa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif']
                    },
                    colors: {
                        brand: {
                            orange: '#E88D57',
                            dark: '#1A1A24',
                            input: '#2B2B3A'
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-[#FAFAFB] font-sans h-screen flex items-center justify-center p-4 relative">

    <a href="/index" class="absolute top-6 left-6 md:top-8 md:left-8 w-12 h-12 bg-white border border-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-brand-orange hover:shadow-md transition-all z-50 group">
        <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
    </a>

    <div class="w-full max-w-[1000px] bg-white rounded-[32px] shadow-2xl flex flex-col md:flex-row overflow-hidden min-h-[600px] relative z-10">

        <div class="w-full md:w-1/2 relative hidden md:block">
            <img src=image_tss/login_admin.webp>
            <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/90 via-brand-dark/40 to-transparent"></div>

            <div class="absolute bottom-10 left-10 right-10 text-white">
                <h2 class="text-3xl font-bold mb-2">Taman Salma Shofa</h2>
                <p class="text-sm text-gray-300 opacity-90">Sistem Manajemen Portal Administrator</p>
            </div>
        </div>

        <div class="w-full md:w-1/2 bg-brand-dark p-10 lg:p-14 flex flex-col justify-center relative">

            <div class="absolute top-0 right-0 w-32 h-32 bg-brand-orange/10 blur-3xl rounded-full"></div>

            <div class="mb-10 relative z-10">
                <div class="w-12 h-12 bg-brand-orange/20 text-brand-orange rounded-xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-shield-halved text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">Selamat Datang Kembali</h1>
                <p class="text-gray-400 text-sm">Silakan masuk menggunakan kredensial Anda.</p>
            </div>

            <?php if ($error) : ?>
                <div class="bg-red-500/10 border border-red-500/50 rounded-xl p-4 mb-6 flex items-start gap-3">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 mt-0.5"></i>
                    <p class="text-red-500 text-xs font-bold leading-relaxed"><?= $error_msg; ?></p>
                </div>
            <?php endif; ?>

            <form action="proses_login" method="POST" class="space-y-5 relative z-10">

                <div>
                    <label class="block text-gray-400 text-[10px] font-bold uppercase mb-2 ml-1 tracking-widest">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-regular fa-user text-gray-500"></i>
                        </div>
                        <input type="text" name="username" placeholder="Masukkan username" required
                            class="w-full bg-brand-input text-white text-sm rounded-xl py-4 pl-12 pr-4 outline-none focus:ring-1 focus:ring-brand-orange border border-transparent transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-gray-400 text-[10px] font-bold uppercase mb-2 ml-1 tracking-widest">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-gray-500"></i>
                        </div>
                        <input type="password" id="password" name="password" placeholder="••••••••" required
                            class="w-full bg-brand-input text-white text-sm rounded-xl py-4 pl-12 pr-12 outline-none focus:ring-1 focus:ring-brand-orange border border-transparent transition-all">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer" onclick="togglePassword()">
                            <i id="eye-icon" class="fa-solid fa-eye-slash text-gray-500 hover:text-brand-orange transition-colors"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" name="login" class="w-full bg-brand-orange hover:bg-[#D97C45] text-white font-bold text-sm py-4 rounded-xl transition-all uppercase tracking-widest shadow-lg shadow-brand-orange/20 mt-4 flex items-center justify-center gap-2">
                    Masuk Ke Sistem <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </button>
            </form>

            <div class="mt-10 flex flex-col items-center justify-center gap-4 relative z-10">
                <p class="text-[10px] text-gray-500/50 font-bold uppercase tracking-[3px]">
                    <i class="fa-solid fa-lock text-[8px] mr-1"></i> Secured Access Only
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>

</html>