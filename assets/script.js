// Konfirmasi saat klik tombol logout
document.addEventListener("DOMContentLoaded", function () {
    const logoutLink = document.getElementById("logout-link");

    if (logoutLink) {
        logoutLink.addEventListener("click", function (e) {
            const confirmLogout = confirm("Apakah Anda yakin ingin logout?");
            if (!confirmLogout) {
                e.preventDefault(); // Batalkan logout jika user membatalkan
            }
        });
    }
});

// Validasi form pencarian
const searchForm = document.querySelector("form[action='search.php']");
if (searchForm) {
    searchForm.addEventListener("submit", function (e) {
        const input = searchForm.querySelector("input[name='q']");
        if (input.value.trim() === "") {
            alert("Masukkan kata kunci pencarian terlebih dahulu.");
            e.preventDefault();
        }
    });
}
