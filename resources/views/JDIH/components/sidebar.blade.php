<link rel="stylesheet" href="{{ asset('css/JDIH/components/sidebar.css') }}">

<body>
    <main class="main-content">
        <div class="main">
            <h2>Pencabutan Peraturan Wali Kota Batu Nomor 63 Tahun 2017</h2>
            <div class="document">
                <div class="info">
                    <span>Tanggal Terbit:</span> <span>1 Februari 2024</span>
                </div>
                <div class="info">
                    <span>Nomor:</span> <span>Peraturan Wali Kota Batu Nomor 63 Tahun 2017</span>
                </div>
                <div class="info">
                    <span>Jenis Dokumen:</span> <span>Peraturan Wali Kota</span>
                </div>
                <div class="info">
                    <span>TE.U:</span> <span>Jawa Timur</span>
                </div>
                <div class="info">
                    <span>Singkatan Jenis:</span> <span>PERWALI</span>
                </div>
                <div class="info">
                    <span>Tahun:</span> <span>2017</span>
                </div>
                <div class="info">
                    <span>Tempat Penetapan:</span> <span>-</span>
                </div>
                <div class="info">
                    <span>Tanggal Penetapan:</span> <span>01/02/2004</span>
                </div>
                <div class="info">
                    <span>Subjek:</span> <span>PERWALI</span>
                </div>
                <div class="info">
                    <span>Status:</span> <span>Berlaku</span>
                </div>
                <div class="info">
                    <span>Sumber:</span> <span>Bagian Hukum</span>
                </div>
                <div class="info">
                    <span>Bidang Hukum:</span> <span>Hukum</span>
                </div>
                <div class="info">
                    <span>Urusan Pemerintahan:</span> <span>Pemerintah Kota Batu</span>
                </div>
                <div class="info">
                    <span>Bahasa:</span> <span>Indonesia</span>
                </div>
                <div class="info">
                    <span>SKPD Pemrakarsa:</span> <span>INSPEKTORAT</span>
                </div>
                <div class="info">
                    <span>Penandatanganan:</span> <span>Walikota</span>
                </div>
                <div class="info">
                    <span>Lokasi:</span> <span>Kota Batu</span>
                </div>
                <div class="buttons">
                    <button>Abstrak</button>
                    <button>Unduh</button>
                </div>
            </div>

            <h2>Dokumen Terkait</h2>
            <div class="document">
                <div class="info">
                    <span>Tanggal Terbit:</span> <span>19 Januari 2004</span>
                </div>
                <div class="info">
                    <span>Nomor:</span> <span>PERWALI</span>
                </div>
                <h2>Pedoman Pelaksanaan Pemberian Bantuan Langsung Tunai</h2>
                <div class="description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras fermentum erat hendrerit quam porta, quis laoreet lectus pellentesque. Suspendisse potenti. Aliquam quis ligula tempus, vulputate quam non, imperdiet elit.
                </div>
                <div class="buttons">
                    <button>Lihat</button>
                </div>
            </div>
            <div class="document">
                <div class="info">
                    <span>Tanggal Terbit:</span> <span>22 April 2024</span>
                </div>
                <div class="info">
                    <span>Nomor:</span> <span>PERWALI</span>
                </div>
                <h2>Peraturan Wali Kota Batu Nomor 7 Tahun 2024</h2>
                <div class="description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras fermentum erat hendrerit quam porta, quis laoreet lectus pellentesque. Suspendisse potenti. Aliquam quis ligula tempus, vulputate quam non, imperdiet elit.
                </div>
                <div class="buttons">
                    <button>Lihat</button>
                </div>
            </div>
            <button>Lihat Semua</button>
        </div>
        <div class="sidebar">
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
    </main>
</body>

</html>