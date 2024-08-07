<link rel="stylesheet" href="{{ asset('css/JDIH/components/sidebar.css') }}">

<body>
    <main class="main-content sidebar">
        <div class="sidebar d-flex flex-column justify-content-between align-items-start">
            <div class="side-search">
                <form class="search-form">
                    <h2>Cari Produk Hukum</h2>
                    <label for="judul">Judul</label>
                    <input type="text" placeholder="Judul">
                    <label for="tipe_dokumen">Tipe Dokumen</label>
                    <select>
                        <option value="">-Pilih Tipe Dokumen-</option>
                        <option value="">Peraturan Wali Kota</option>
                        <option value="">Peraturan Daerah</option>
                    </select>
                    <label for="jenis_dokumen">Jenis Dokumen</label>
                    <select>
                        <option value="">-Pilih Jenis Dokumen-</option>
                        <option value="">Peraturan Wali Kota</option>
                        <option value="">Peraturan Daerah</option>
                    </select>
                    <label for="tahun">Tahun</label>
                    <input type="text" placeholder="Tahun">
                    <label for="nomor">Nomor</label>
                    <input type="text" placeholder="Nomor">
                    <label for="status">Status</label>
                    <select>
                        <option value="">-Status-</option>
                        <option value="">Berlaku</option>
                        <option value="">Tidak Berlaku</option>
                    </select>
                    <button type="submit">Cari</button>
                </form>
            </div>
            <div class="side-portal">
                <h2>Link Portal</h2>
                <div class="link-portal">
                    <a href="{{ url('https://jdihn.go.id/') }}">
                        <div class="card-content">
                            <img src="{{ asset('/img/bg/LogoJDIH.png') }}" alt="JDIH Nasional">
                            <h3>Nasional</h3>
                        </div>
                    </a>
                </div>

                <div class="link-portal">
                    <a href="{{ url('http://103.211.82.11/') }}">
                        <div class="card-content">
                            <img src="{{ asset('/img/bg/LogoKotaBatu.png') }}" alt="PPID Kota Batu">
                            <h3>PPID Kota Batu</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>