<?php
$script_dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$base_path = ($script_dir === '/' || $script_dir === '.') ? '' : rtrim($script_dir, '/');

if (!function_exists('url_path')) {
    function url_path(string $path = ''): string
    {
        global $base_path;
        $path = ltrim($path, '/');
        return ($base_path ?: '') . '/' . $path;
    }
}
?>
<footer class="bg-[#2B2B43] pt-12 pb-8 px-8 md:px-16 w-full mt-auto font-sans">
    <div class="max-w-[1200px] mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-start gap-10 mb-12">

            <div class="flex flex-col gap-8">
                <div>
                    <h4 class="text-[#E88D57] text-[16px] mb-2">Alamat:</h4>
                    <p class="text-[#EAA07E] text-[15px] leading-relaxed">
                        Jl. Mugirejo RT 17 Km 4,5 Desa Lubuk Sawa,<br>
                        Sungai Pinang, Samarinda Utara, Samarinda
                    </p>
                </div>
                <div>
                    <h4 class="text-[#E88D57] text-[16px] mb-2">Kontak:</h4>
                    <p class="text-[#EAA07E] text-[15px] leading-relaxed">
                        0853-4735-2729<br>
                        salmashofasamarinda@gmail.com
                    </p>
                </div>
            </div>

            <div>
                <h4 class="text-[#E88D57] text-[16px] mb-4">Ikuti Kami di</h4>
                <div class="flex flex-wrap gap-8">
                    <a href="https://web.facebook.com/salmashofasamarinda/" target="_blank" class="flex items-center gap-2 text-[#EAA07E] hover:text-[#E88D57]">
                        <i class="fa-brands fa-facebook text-[18px]"></i>
                        <span class="text-[15px]">Taman Salma Shofa</span>
                    </a>
                    <a href="https://www.instagram.com/salmashofa.smr/" target="_blank" class="flex items-center gap-2 text-[#EAA07E] hover:text-[#E88D57]">
                        <i class="fa-brands fa-instagram text-[18px]"></i>
                        <span class="text-[15px]">@salmashofa.smr</span>
                    </a>
                    <a href="https://www.tiktok.com/@salmashofa.smr" target="_blank" class="flex items-center gap-2 text-[#EAA07E] hover:text-[#E88D57]">
                        <i class="fa-brands fa-tiktok text-[18px]"></i>
                        <span class="text-[15px]">@salmashofa.smr</span>
                    </a>
                </div>
            </div>

        </div>

        <div class="flex justify-center mb-8">
            <img src="<?= url_path('assets/logo.png') ?>" alt="Salma Shofa Logo" class="h-[80px] md:h-[100px] w-auto object-contain transform translate-x-6 -translate-y-4">
        </div>

        <div class="border-t border-[#E88D57]/40 pt-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[#EAA07E] text-[14px]">
                © 2026 Taman Salma Shofa. All rights reserved.
            </p>
            <div class="flex flex-wrap gap-6 text-[14px] text-[#EAA07E]">
                <a href="#" class="underline underline-offset-4 hover:text-[#E88D57]">Privacy Policy</a>
                <a href="#" class="underline underline-offset-4 hover:text-[#E88D57]">Terms of Service</a>
                <a href="#" class="underline underline-offset-4 hover:text-[#E88D57]">Cookies Settings</a>
            </div>
        </div>

    </div>
</footer>

<script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
<script src="<?= url_path('assets/js/vue-app.js') ?>"></script>