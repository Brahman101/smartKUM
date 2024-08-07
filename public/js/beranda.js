// Tipe Dokumen
document.addEventListener("DOMContentLoaded", function () {
    // Dapatkan elemen tombol dan item dropdown
    var dropdownTipe = document.getElementById("dropdownTipe");
    var dropdownItemsTipe = document.querySelectorAll(
        ".dropdown-item.item-tipe-dokumen"
    );

    // Tambahkan event listener untuk setiap item dropdown
    dropdownItemsTipe.forEach(function (item) {
        item.addEventListener("click", function (e) {
            e.preventDefault(); // Mencegah navigasi default

            // Ambil nilai dari data attribute
            var selectedValue = item.getAttribute("data-value");

            // Perbarui teks tombol dropdown
            dropdownTipe.textContent = selectedValue;
        });
    });
});

// Jenis Dokumen
document.addEventListener("DOMContentLoaded", function () {
    // Dapatkan elemen tombol dan item dropdown
    var dropdownJenis = document.getElementById("dropdownJenis");
    var dropdownItemsJenis = document.querySelectorAll(
        ".dropdown-item.item-jenis-dokumen"
    );

    // Tambahkan event listener untuk setiap item dropdown
    dropdownItemsJenis.forEach(function (item) {
        item.addEventListener("click", function (e) {
            e.preventDefault(); // Mencegah navigasi default

            // Ambil nilai dari data attribute
            var selectedValue = item.getAttribute("data-value");

            // Perbarui teks tombol dropdown
            dropdownJenis.textContent = selectedValue;
        });
    });
});

// Status Dokumen
document.addEventListener("DOMContentLoaded", function () {
    // Dapatkan elemen tombol dan item dropdown
    var dropdownStatus = document.getElementById("dropdownStatus");
    var dropdownItemsStatus = document.querySelectorAll(
        ".dropdown-item.item-status"
    );

    // Tambahkan event listener untuk setiap item dropdown
    dropdownItemsStatus.forEach(function (item) {
        item.addEventListener("click", function (e) {
            e.preventDefault(); // Mencegah navigasi default

            // Ambil nilai dari data attribute
            var selectedValue = item.getAttribute("data-value");

            // Perbarui teks tombol dropdown
            dropdownStatus.textContent = selectedValue;
        });
    });
});
