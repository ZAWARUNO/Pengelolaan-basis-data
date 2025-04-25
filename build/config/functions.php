<?php
// Fungsi untuk menampilkan pesan alert
function showAlert($message, $type = 'success') {
    $alertClass = '';
    switch($type) {
        case 'success':
            $alertClass = 'bg-green-100 border-green-400 text-green-700';
            break;
        case 'error':
            $alertClass = 'bg-red-100 border-red-400 text-red-700';
            break;
        case 'warning':
            $alertClass = 'bg-yellow-100 border-yellow-400 text-yellow-700';
            break;
        case 'info':
            $alertClass = 'bg-blue-100 border-blue-400 text-blue-700';
            break;
    }
    
    return '<div class="border-l-4 p-4 mb-4 ' . $alertClass . '" role="alert">
                <p>' . htmlspecialchars($message) . '</p>
            </div>';
}

// Fungsi untuk membersihkan input
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Fungsi untuk memformat tanggal
function formatDate($date) {
    return date('d M Y', strtotime($date));
}

// Fungsi untuk memformat angka ke format rupiah
function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

// Fungsi untuk memeriksa apakah user sudah login
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Fungsi untuk redirect
function redirect($url) {
    header("Location: " . $url);
    exit();
}
?> 