document.addEventListener('DOMContentLoaded', function () {
    const appRoot = document.getElementById('adminFasilitasApp');
    if (!appRoot) {
        return;
    }

    const adminApp = Vue.createApp({
        data() {
            return {
                facilities: [],
                loading: false,
                error: null,
                success: null,
                form: {
                    id: '',
                    nama: '',
                    kategori: 'utama',
                    deskripsi: '',
                    gambar: null
                },
                editing: false
            };
        },
        methods: {
            resetAlerts() {
                this.error = null;
                this.success = null;
            },
            fetchFacilities() {
                this.loading = true;
                fetch('../api/fasilitas.php')
                    .then(response => response.json())
                    .then(data => {
                        this.facilities = data.data || [];
                    })
                    .catch(() => {
                        this.error = 'Tidak dapat memuat data fasilitas.';
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },
            editFacility(item) {
                this.resetAlerts();
                this.editing = true;
                this.form.id = item.id;
                this.form.nama = item.nama;
                this.form.kategori = item.kategori;
                this.form.deskripsi = item.deskripsi;
                this.form.gambar = null;
                window.scrollTo({ top: appRoot.offsetTop, behavior: 'smooth' });
            },
            deleteFacility(id) {
                if (!confirm('Yakin ingin menghapus fasilitas ini?')) {
                    return;
                }
                this.loading = true;
                const formData = new FormData();
                formData.append('action', 'delete');
                formData.append('id', id);

                fetch('../api/fasilitas.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            this.error = data.error;
                        } else {
                            this.success = data.message || 'Berhasil dihapus.';
                            this.fetchFacilities();
                        }
                    })
                    .catch(() => {
                        this.error = 'Gagal menghapus fasilitas.';
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },
            handleFileUpload(event) {
                this.form.gambar = event.target.files[0] || null;
            },
            submitForm() {
                this.resetAlerts();
                if (!this.form.nama.trim()) {
                    this.error = 'Nama fasilitas harus diisi.';
                    return;
                }
                this.loading = true;
                const formData = new FormData();
                formData.append('nama', this.form.nama);
                formData.append('kategori', this.form.kategori);
                formData.append('deskripsi', this.form.deskripsi);
                if (this.form.gambar) {
                    formData.append('gambar', this.form.gambar);
                }

                if (this.editing && this.form.id) {
                    formData.append('action', 'update');
                    formData.append('id', this.form.id);
                } else {
                    formData.append('action', 'create');
                }

                fetch('../api/fasilitas.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            this.error = data.error;
                        } else {
                            this.success = data.message || 'Perubahan berhasil disimpan.';
                            this.resetForm();
                            this.fetchFacilities();
                        }
                    })
                    .catch(() => {
                        this.error = 'Gagal menyimpan data fasilitas.';
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },
            resetForm() {
                this.editing = false;
                this.form.id = '';
                this.form.nama = '';
                this.form.kategori = 'utama';
                this.form.deskripsi = '';
                this.form.gambar = null;
                const fileInput = appRoot.querySelector('input[type=file]');
                if (fileInput) {
                    fileInput.value = '';
                }
            }
        },
        mounted() {
            this.fetchFacilities();
        }
    });

    adminApp.mount(appRoot);
});
