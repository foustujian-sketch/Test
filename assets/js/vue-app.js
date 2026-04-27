const app = Vue.createApp({
    data() {
        return {
            mobileOpen: false,
            faqOpen: null,
            // Carousel states
            carouselUtama: {
                current: 0,
                slides: []
            },
            carouselPendukung: {
                current: 0,
                slides: []
            }
        };
    },
    methods: {
        toggleMenu() {
            this.mobileOpen = !this.mobileOpen;
        },
        closeMenu() {
            this.mobileOpen = false;
        },
        toggleFaq(index) {
            this.faqOpen = this.faqOpen === index ? null : index;
        },
        // Carousel navigation
        initCarousel(carouselName, slides) {
            if (carouselName === 'utama') {
                this.carouselUtama.slides = slides;
                this.carouselUtama.current = 0;
            } else if (carouselName === 'pendukung') {
                this.carouselPendukung.slides = slides;
                this.carouselPendukung.current = 0;
            }
        },
        nextSlide(carouselName) {
            const carousel = carouselName === 'utama' ? this.carouselUtama : this.carouselPendukung;
            carousel.current = (carousel.current + 1) % carousel.slides.length;
        },
        prevSlide(carouselName) {
            const carousel = carouselName === 'utama' ? this.carouselUtama : this.carouselPendukung;
            carousel.current = (carousel.current - 1 + carousel.slides.length) % carousel.slides.length;
        },
        goToSlide(carouselName, index) {
            const carousel = carouselName === 'utama' ? this.carouselUtama : this.carouselPendukung;
            if (index >= 0 && index < carousel.slides.length) {
                carousel.current = index;
            }
        }
    },
    mounted() {
        // Auto-initialize carousels if data attributes exist
        const carouselUltramaEl = document.querySelector('[data-carousel="utama"]');
        const carouselPendukungEl = document.querySelector('[data-carousel="pendukung"]');
        
        if (carouselUltramaEl) {
            try {
                const data = JSON.parse(carouselUltramaEl.getAttribute('data-slides'));
                this.initCarousel('utama', data);
            } catch (e) {
                console.log('No carousel utama data');
            }
        }
        
        if (carouselPendukungEl) {
            try {
                const data = JSON.parse(carouselPendukungEl.getAttribute('data-slides'));
                this.initCarousel('pendukung', data);
            } catch (e) {
                console.log('No carousel pendukung data');
            }
        }
    }
});

app.mount(document.body);
