// Isi form saat klik Edit
        document.querySelectorAll('.btnEditUser').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('id_user').value = this.dataset.id;
                document.querySelector('select[name=tipe_user]').value = this.dataset.tipe_user;
                document.querySelector('input[name=nama]').value = this.dataset.nama;
                document.querySelector('input[name=alamat]').value = this.dataset.alamat;
                document.querySelector('input[name=telpon]').value = this.dataset.telpon;
                document.querySelector('input[name=username]').value = this.dataset.username;
                document.querySelector('input[name=password]').value = this.dataset.password; // tampilkan password
                document.getElementById('btnTambah').disabled = true;
                document.getElementById('btnEdit').disabled = false;
                document.getElementById('btnHapus').disabled = false;
                document.getElementById('mode').value = 'edit';
            });
        });

        // Reset form saat tombol "Tambah" di-klik (sebelum submit)
        // Ini untuk memastikan form bersih jika pengguna sebelumnya mengklik edit
        document.getElementById('btnTambah').addEventListener('click', function() {
            // Jangan reset form saat klik tombol Tambah
        });

        // Saat klik tombol Edit di form
        document.getElementById('btnEdit').addEventListener('click', function() {
            document.getElementById('userForm').submit();
        });

        // Saat klik tombol Hapus di form
        // Perlu disinkronkan dengan tombol hapus di tabel jika ingin fungsionalitas yang sama
        // Namun, tombol hapus di tabel sudah punya form sendiri, jadi ini bisa dipertimbangkan ulang
        document.getElementById('btnHapus').addEventListener('click', function() {
            const idUser = document.getElementById('id_user').value;
            if (idUser && confirm('Yakin hapus pengguna ini?')) {
                // Buat form dinamis untuk request DELETE
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ url('admin/kelola-user') }}/${idUser}`; // Sesuaikan dengan rute hapus Anda

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        });

        // Reset form dan tombol saat halaman dimuat atau setelah submit
        document.addEventListener('DOMContentLoaded', (event) => {
            // Periksa apakah ada ID user di hidden input, jika ada berarti ini mode edit dari request sebelumnya
            const idUserHidden = document.getElementById('id_user').value;
            if (!idUserHidden) {
                document.getElementById('btnEdit').disabled = true;
                document.getElementById('btnHapus').disabled = true;
            } else {
                // Jika ada ID, mungkin dari old() input, biarkan tombol edit/hapus aktif
                document.getElementById('btnTambah').disabled = true;
                document.getElementById('btnEdit').disabled = false;
                document.getElementById('btnHapus').disabled = false;
            }
        });

        document.getElementById('searchUser').addEventListener('input', function() {
            const filter = this.value.trim().toLowerCase();
            const rows = document.querySelectorAll('#userTable tbody tr');
            rows.forEach(row => {
                const nama = row.children[2].textContent.trim().toLowerCase();
                // Jika filter kosong, tampilkan semua baris
                if (!filter) {
                    row.style.display = '';
                } else {
                    // Cek apakah nama diawali dengan filter
                    row.style.display = nama.startsWith(filter) ? '' : 'none';
                }
            });
        });

        // Biar klik baris tabel langsung isi form (seperti klik tombol Edit)
        document.querySelectorAll('#userTable tbody tr').forEach(row => {
            row.addEventListener('click', function(e) {
                // Jangan trigger kalau yang diklik adalah tombol Hapus (biar tidak bentrok)
                if (e.target.classList.contains('btn-danger')) return;
                const btn = this.querySelector('.btnEditUser');
                if (btn) btn.click();
            });
        });

        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => el.classList.add('fade'));
        }, 2000);

        // Set mode tambah saat halaman dimuat
        document.getElementById('mode').value = 'tambah';
        document.addEventListener('DOMContentLoaded', function () {
    const alertBox = document.getElementById('customAlert');
    if (alertBox) {
        setTimeout(() => {
            alertBox.classList.add('hide');
            setTimeout(() => alertBox.remove(), 600);
        }, 2200); // alert tampil 2.2 detik lalu menghilang dengan animasi
    }
});