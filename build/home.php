<?php
// Ensure $koneksi is available here. Since index.php includes database.php and then includes home.php, it should be.

// Ambil total penjualan BULAN INI
$totalPenjualanBulanan = 0;
$sqlBulanan = "SELECT SUM(total_harga) as total FROM penjualan WHERE MONTH(tanggal_penjualan) = MONTH(CURDATE()) AND YEAR(tanggal_penjualan) = YEAR(CURDATE())";
$resultBulanan = $koneksi->query($sqlBulanan);
if ($resultBulanan && $resultBulanan->num_rows > 0) {
   $rowBulanan = $resultBulanan->fetch_assoc();
   // Ensure 'total' exists and handle null case
   $totalPenjualanBulanan = $rowBulanan["total"] ?? 0;
}

// Ambil total penjualan HARI INI
$totalPenjualanHariIni = 0;
$sqlHariIni = "SELECT SUM(total_harga) as total FROM penjualan WHERE DATE(tanggal_penjualan) = CURDATE()";
$resultHariIni = $koneksi->query($sqlHariIni);
if ($resultHariIni && $resultHariIni->num_rows > 0) {
   $rowHariIni = $resultHariIni->fetch_assoc();
   // Ensure 'total' exists and handle null case
   $totalPenjualanHariIni = $rowHariIni["total"] ?? 0;
}


// Tentukan target bulanan
$targetBulanan = 100000000; // Rp 10 Juta (Diubah dari 300 Juta)

// Hitung persentase pencapaian
$persentasePencapaian = 0;
// Ensure totalPenjualanBulanan is numeric before division
$numericTotalPenjualanBulanan = filter_var($totalPenjualanBulanan, FILTER_VALIDATE_FLOAT);

if ($targetBulanan > 0 && $numericTotalPenjualanBulanan !== false) {
   $persentasePencapaian = ($numericTotalPenjualanBulanan / $targetBulanan) * 100;
}

// Note: Don't close connection here if index.php needs it later ($koneksi->close();)

// --- Data untuk Chart Batang (Penjualan per Bulan) ---
$dataPenjualanPerBulan = array_fill(1, 12, 0);
$bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

$tahunSekarang = date('Y');
$sql = "SELECT MONTH(tanggal_penjualan) as bulan, SUM(total_harga) as total 
        FROM penjualan 
        WHERE YEAR(tanggal_penjualan) = $tahunSekarang
        GROUP BY bulan";
$result = $koneksi->query($sql);

if ($result) {
   while ($row = $result->fetch_assoc()) {
      $bulan = (int)$row['bulan'];
      $total = (float)($row['total'] ?? 0);
      if ($bulan >= 1 && $bulan <= 12) {
         $dataPenjualanPerBulan[$bulan] = $total;
      }
   }
}
$dataSeriesChartBatang = array_values($dataPenjualanPerBulan);
// --- Akhir Data Chart Batang ---

?>

<main>
   <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
      <div class="grid grid-cols-12 gap-4 md:gap-6">
         <div class="col-span-12 space-y-6 xl:col-span-7">
            <!-- Metric Group One -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6">
               <!-- Metric Item Start -->
               <div
                  class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                  <div
                     class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                     <svg
                        class="fill-gray-800 dark:fill-white/90"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                           fill-rule="evenodd"
                           clip-rule="evenodd"
                           d="M8.80443 5.60156C7.59109 5.60156 6.60749 6.58517 6.60749 7.79851C6.60749 9.01185 7.59109 9.99545 8.80443 9.99545C10.0178 9.99545 11.0014 9.01185 11.0014 7.79851C11.0014 6.58517 10.0178 5.60156 8.80443 5.60156ZM5.10749 7.79851C5.10749 5.75674 6.76267 4.10156 8.80443 4.10156C10.8462 4.10156 12.5014 5.75674 12.5014 7.79851C12.5014 9.84027 10.8462 11.4955 8.80443 11.4955C6.76267 11.4955 5.10749 9.84027 5.10749 7.79851C5.10749 6.58517 6.60749 5.60156 8.80443 5.60156C10.0178 5.60156 11.0014 6.58517 11.0014 7.79851C11.0014 8.80443 10.0178 9.78804 8.80443 9.78804C7.59109 9.78804 6.60749 8.80443 6.60749 7.79851ZM4.86252 15.3208C4.08769 16.0881 3.70377 17.0608 3.51705 17.8611C3.48384 18.0034 3.5211 18.1175 3.60712 18.2112C3.70161 18.3141 3.86659 18.3987 4.07591 18.3987H13.4249C13.6343 18.3987 13.7992 18.3141 13.8937 18.2112C13.9797 18.1175 14.017 18.0034 13.9838 17.8611C13.7971 17.0608 13.4132 16.0881 12.6383 15.3208C11.8821 14.572 10.6899 13.955 8.75042 13.955C6.81096 13.955 5.61877 14.572 4.86252 15.3208ZM3.8071 14.2549C4.87163 13.2009 6.45602 12.455 8.75042 12.455C11.0448 12.455 12.6292 13.2009 13.6937 14.2549C14.7397 15.2906 15.2207 16.5607 15.4446 17.5202C15.7658 18.8971 14.6071 19.8987 13.4249 19.8987H4.07591C2.89369 19.8987 1.73504 18.8971 2.05628 17.5202C2.28015 16.5607 2.76117 15.2906 3.8071 14.2549ZM15.3042 11.4955C14.4702 11.4955 13.7006 11.2193 13.0821 10.7533C13.3742 10.3314 13.6054 9.86419 13.7632 9.36432C14.1597 9.75463 14.7039 9.99545 15.3042 9.99545C16.5176 9.99545 17.5012 9.01185 17.5012 7.79851C17.5012 6.58517 16.5176 5.60156 15.3042 5.60156C14.7039 5.60156 14.1597 5.84239 13.7632 6.23271C13.6054 5.73284 13.3741 5.26561 13.082 4.84371C13.7006 4.37777 14.4702 4.10156 15.3042 4.10156C17.346 4.10156 19.0012 5.75674 19.0012 7.79851C19.0012 9.84027 17.346 11.4955 15.3042 11.4955ZM19.9248 19.8987H16.3901C16.7014 19.4736 16.9159 18.969 16.9827 18.3987H19.9248C20.1341 18.3987 20.2991 18.3141 20.3936 18.2112C20.4796 18.1175 20.5169 18.0034 20.4837 17.861C20.2969 17.0607 19.913 16.088 19.1382 15.3208C18.4047 14.5945 17.261 13.9921 15.4231 13.9566C15.2232 13.6945 14.9995 13.437 14.7491 13.1891C14.5144 12.9566 14.262 12.7384 13.9916 12.5362C14.3853 12.4831 14.8044 12.4549 15.2503 12.4549C17.5447 12.4549 19.1291 13.2008 20.1936 14.2549C21.2395 15.2906 21.7206 16.5607 21.9444 17.5202C22.2657 18.8971 21.107 19.8987 19.9248 19.8987Z"
                           fill="" />
                     </svg>
                  </div>

                  <div class="mt-5 flex items-end justify-between">
                     <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Pelanggan</span>
                        <h4
                           class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                           <?php
                           // Fetch total customers
                           $totalPelanggan = 0;
                           $resultPelanggan = mysqli_query($koneksi, "SELECT COUNT(*) as count FROM pelanggan");
                           if ($resultPelanggan) {
                              $dataPelanggan = mysqli_fetch_assoc($resultPelanggan);
                              $totalPelanggan = $dataPelanggan['count'] ?? 0;
                           }
                           echo $totalPelanggan;
                           ?>
                        </h4>
                     </div>

                     <?php
                     // Example: Fetch previous month's customers for comparison
                     $pelangganSebelumnya = 0; // Placeholder - Needs real data calculation if desired
                     // Example:
                     // $bulanSebelumnya = date('m', strtotime('-1 month'));
                     // $tahunSebelumnya = date('Y', strtotime('-1 month'));
                     // $queryPelangganSebelumnya = "SELECT COUNT(*) as count FROM pelanggan WHERE MONTH(created_at) = $bulanSebelumnya AND YEAR(created_at) = $tahunSebelumnya"; // Assuming a 'created_at' column


                     // Perhitungan persentase perubahan pelanggan
                     $persentasePerubahanPelanggan = 0;
                     if ($pelangganSebelumnya > 0) {
                        $persentasePerubahanPelanggan = (($totalPelanggan - $pelangganSebelumnya) / $pelangganSebelumnya) * 100;
                     } elseif ($totalPelanggan > 0 && $pelangganSebelumnya == 0) {
                        $persentasePerubahanPelanggan = 100; // Indicate increase if prev was 0
                     }


                     $warnaPelanggan = $persentasePerubahanPelanggan >= 0 ? 'success' : 'error';
                     $ikonPelanggan = $persentasePerubahanPelanggan >= 0 ? 'M5.56462 1.62393C5.70193 1.47072 5.90135 1.37432 6.12329 1.37432C6.1236 1.37432 6.12391 1.37432 6.12422 1.37432C6.31631 1.37415 6.50845 1.44731 6.65505 1.59381L9.65514 4.5918C9.94814 4.88459 9.94831 5.35947 9.65552 5.65246C9.36273 5.94546 8.88785 5.94562 8.59486 5.65283L6.87329 3.93247L6.87329 10.125C6.87329 10.5392 6.53751 10.875 6.12329 10.875C5.70908 10.875 5.37329 10.5392 5.37329 10.125L5.37329 3.93578L3.65516 5.65282C3.36218 5.94562 2.8873 5.94547 2.5945 5.65248C2.3017 5.35949 2.30185 4.88462 2.59484 4.59182L5.56462 1.62393Z' : 'M5.31462 10.3761C5.45194 10.5293 5.65136 10.6257 5.87329 10.6257C5.8736 10.6257 5.8739 10.6257 5.87421 10.6257C6.0663 10.6259 6.25845 10.5527 6.40505 10.4062L9.40514 7.4082C9.69814 7.11541 9.69831 6.64054 9.40552 6.34754C9.11273 6.05454 8.63785 6.05438 8.34486 6.34717L6.62329 8.06753L6.62329 1.875C6.62329 1.46079 6.28751 1.125 5.87329 1.125C5.45908 1.125 5.12329 1.46079 5.12329 1.875L5.12329 8.06422L3.40516 6.34719C3.11218 6.05439 2.6373 6.05454 2.3445 6.34752C2.0517 6.64051 2.05185 7.11538 2.34484 7.40818L5.31462 10.3761Z';
                     ?>

                     <span
                        class="flex items-center gap-1 rounded-full bg-<?= $warnaPelanggan ?>-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-<?= $warnaPelanggan ?>-600 dark:bg-<?= $warnaPelanggan ?>-500/15 dark:text-<?= $warnaPelanggan ?>-500">
                        <svg
                           class="fill-current"
                           width="12"
                           height="12"
                           viewBox="0 0 12 12"
                           fill="none"
                           xmlns="http://www.w3.org/2000/svg">
                           <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="<?= $ikonPelanggan ?>"
                              fill="" />
                        </svg>
                        <!-- Only show percentage if comparison data exists -->
                        <?php if ($pelangganSebelumnya != 0 || $totalPelanggan > 0): ?>
                           <?= number_format(abs($persentasePerubahanPelanggan), 2) ?>%
                        <?php else: ?>
                           - % <!-- Placeholder if no data -->
                        <?php endif; ?>
                     </span>
                  </div>
               </div>
               <!-- Metric Item End -->

               <!-- Metric Item Start -->
               <div
                  class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                  <div
                     class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                     <svg
                        class="fill-gray-800 dark:fill-white/90"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                           fill-rule="evenodd"
                           clip-rule="evenodd"
                           d="M11.665 3.75621C11.8762 3.65064 12.1247 3.65064 12.3358 3.75621L18.7807 6.97856L12.3358 10.2009C12.1247 10.3065 11.8762 10.3065 11.665 10.2009L5.22014 6.97856L11.665 3.75621ZM4.29297 8.19203V16.0946C4.29297 16.3787 4.45347 16.6384 4.70757 16.7654L11.25 20.0366V11.6513C11.1631 11.6205 11.0777 11.5843 10.9942 11.5426L4.29297 8.19203ZM12.75 20.037L19.2933 16.7654C19.5474 16.6384 19.7079 16.3787 19.7079 16.0946V8.19202L13.0066 11.5426C12.9229 11.5844 12.8372 11.6208 12.75 11.6516V20.037ZM13.0066 2.41456C12.3732 2.09786 11.6277 2.09786 10.9942 2.41456L4.03676 5.89319C3.27449 6.27432 2.79297 7.05342 2.79297 7.90566V16.0946C2.79297 16.9469 3.27448 17.726 4.03676 18.1071L10.9942 21.5857L11.3296 20.9149L10.9942 21.5857C11.6277 21.9024 12.3732 21.9024 13.0066 21.5857L19.9641 18.1071C20.7264 17.726 21.2079 16.9469 21.2079 16.0946V7.90566C21.2079 7.05342 20.7264 6.27432 19.9641 5.89319L13.0066 2.41456Z"
                           fill="" />
                     </svg>
                  </div>

                  <div class="mt-5 flex items-end justify-between">
                     <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Penjualan (Bulan Ini)</span>
                        <h4
                           class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                           <?php
                           // Fetch total sales count for the current month
                           $totalPenjualanCount = 0;
                           $resultPenjualanCount = mysqli_query($koneksi, "SELECT COUNT(*) as count FROM penjualan WHERE MONTH(tanggal_penjualan) = MONTH(CURDATE()) AND YEAR(tanggal_penjualan) = YEAR(CURDATE())");
                           if ($resultPenjualanCount) {
                              $dataPenjualanCount = mysqli_fetch_assoc($resultPenjualanCount);
                              $totalPenjualanCount = $dataPenjualanCount['count'] ?? 0;
                           }
                           echo $totalPenjualanCount;
                           ?> </h4>
                     </div>

                     <?php
                     // Example: Fetch previous month's sales count for comparison
                     $penjualanSebelumnyaCount = 0; // Placeholder - Needs real data calculation if desired
                     // Example:
                     // $queryPenjualanSebelumnyaCount = "SELECT COUNT(*) as count FROM penjualan WHERE MONTH(tanggal_penjualan) = $bulanSebelumnya AND YEAR(tanggal_penjualan) = $tahunSebelumnya";

                     // Perhitungan persentase perubahan penjualan count
                     $persentasePerubahanPenjualan = 0;
                     if ($penjualanSebelumnyaCount > 0) {
                        $persentasePerubahanPenjualan = (($totalPenjualanCount - $penjualanSebelumnyaCount) / $penjualanSebelumnyaCount) * 100;
                     } elseif ($totalPenjualanCount > 0 && $penjualanSebelumnyaCount == 0) {
                        $persentasePerubahanPenjualan = 100;
                     }

                     $warnaPenjualan = $persentasePerubahanPenjualan >= 0 ? 'success' : 'error';
                     $ikonPenjualan = $persentasePerubahanPenjualan >= 0 ? 'M5.56462 1.62393C5.70193 1.47072 5.90135 1.37432 6.12329 1.37432C6.1236 1.37432 6.12391 1.37432 6.12422 1.37432C6.31631 1.37415 6.50845 1.44731 6.65505 1.59381L9.65514 4.5918C9.94814 4.88459 9.94831 5.35947 9.65552 5.65246C9.36273 5.94546 8.88785 5.94562 8.59486 5.65283L6.87329 3.93247L6.87329 10.125C6.87329 10.5392 6.53751 10.875 6.12329 10.875C5.70908 10.875 5.37329 10.5392 5.37329 10.125L5.37329 3.93578L3.65516 5.65282C3.36218 5.94562 2.8873 5.94547 2.5945 5.65248C2.3017 5.35949 2.30185 4.88462 2.59484 4.59182L5.56462 1.62393Z' : 'M5.31462 10.3761C5.45194 10.5293 5.65136 10.6257 5.87329 10.6257C5.8736 10.6257 5.8739 10.6257 5.87421 10.6257C6.0663 10.6259 6.25845 10.5527 6.40505 10.4062L9.40514 7.4082C9.69814 7.11541 9.69831 6.64054 9.40552 6.34754C9.11273 6.05454 8.63785 6.05438 8.34486 6.34717L6.62329 8.06753L6.62329 1.875C6.62329 1.46079 6.28751 1.125 5.87329 1.125C5.45908 1.125 5.12329 1.46079 5.12329 1.875L5.12329 8.06422L3.40516 6.34719C3.11218 6.05439 2.6373 6.05454 2.3445 6.34752C2.0517 6.64051 2.05185 7.11538 2.34484 7.40818L5.31462 10.3761Z';
                     ?>

                     <span
                        class="flex items-center gap-1 rounded-full bg-<?= $warnaPenjualan ?>-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-<?= $warnaPenjualan ?>-600 dark:bg-<?= $warnaPenjualan ?>-500/15 dark:text-<?= $warnaPenjualan ?>-500">
                        <svg
                           class="fill-current"
                           width="12"
                           height="12"
                           viewBox="0 0 12 12"
                           fill="none"
                           xmlns="http://www.w3.org/2000/svg">
                           <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="<?= $ikonPenjualan ?>"
                              fill="" />
                        </svg>
                        <?php if ($penjualanSebelumnyaCount != 0 || $totalPenjualanCount > 0): ?>
                           <?= number_format(abs($persentasePerubahanPenjualan), 2) ?>%
                        <?php else: ?>
                           - % <!-- Placeholder -->
                        <?php endif; ?>
                     </span>
                  </div>
               </div>
               <!-- Metric Item End -->
            </div>
            <!-- Metric Group One -->

            <!-- ====== Chart One Start -->
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">
               <div class="flex items-center justify-between">
                  <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                     Penjualan Bulanan (<?= $tahunSekarang ?>)
                  </h3>
               </div>
               <div class="max-w-full overflow-x-auto custom-scrollbar">
                  <canvas id="chartBarPenjualan" style="min-height:220px"></canvas>
               </div>
            </div>
            <!-- ====== Chart One End -->
         </div>
         <div class="col-span-12 xl:col-span-5">
            <!-- ====== Chart Two Start -->
            <div
               class="rounded-2xl border border-gray-200 bg-gray-100 dark:border-gray-800 dark:bg-white/[0.03]">
               <div
                  class="shadow-default rounded-2xl bg-white px-5 pb-11 pt-5 dark:bg-gray-900 sm:px-6 sm:pt-6">
                  <div class="flex justify-between">
                     <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                           Target Bulanan
                        </h3>
                        <p class="mt-1 text-theme-sm text-gray-500 dark:text-gray-400">
                           Target yang Anda tetapkan untuk setiap bulan
                        </p>
                     </div>
                  </div>
                  <div class="relative max-h-[195px]">
                     <canvas id="chartTwoDynamic" class="h-full"></canvas>
                  </div>
               </div>

               <div
                  class="flex items-center justify-center gap-5 px-6 py-3.5 sm:gap-8 sm:py-5">
                  <div>
                     <p
                        class="mb-1 text-center text-theme-xs text-gray-500 dark:text-gray-400 sm:text-sm">
                        Target
                     </p>
                     <p
                        class="flex items-center justify-center gap-1 text-base font-semibold text-gray-800 dark:text-white/90 sm:text-lg">
                        Rp <?= number_format($targetBulanan, 0, ',', '.') ?>
                        <svg
                           width="16"
                           height="16"
                           viewBox="0 0 16 16"
                           fill="none"
                           xmlns="http://www.w3.org/2000/svg">
                           <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M7.26816 13.6632C7.4056 13.8192 7.60686 13.9176 7.8311 13.9176C7.83148 13.9176 7.83187 13.9176 7.83226 13.9176C8.02445 13.9178 8.21671 13.8447 8.36339 13.6981L12.3635 9.70076C12.6565 9.40797 12.6567 8.9331 12.3639 8.6401C12.0711 8.34711 11.5962 8.34694 11.3032 8.63973L8.5811 11.36L8.5811 2.5C8.5811 2.08579 8.24531 1.75 7.8311 1.75C7.41688 1.75 7.0811 2.08579 7.0811 2.5L7.0811 11.3556L4.36354 8.63975C4.07055 8.34695 3.59568 8.3471 3.30288 8.64009C3.01008 8.93307 3.01023 9.40794 3.30321 9.70075L7.26816 13.6632Z"
                              fill="#D92D20" />
                        </svg>
                     </p>
                  </div>

                  <div class="h-7 w-px bg-gray-200 dark:bg-gray-800"></div>

                  <div>
                     <p
                        class="mb-1 text-center text-theme-xs text-gray-500 dark:text-gray-400 sm:text-sm">
                        Pendapatan (Bulan Ini)
                     </p>
                     <p
                        class="flex items-center justify-center gap-1 text-base font-semibold text-gray-800 dark:text-white/90 sm:text-lg">
                        Rp <?= number_format($totalPenjualanBulanan, 0, ',', '.') ?>
                        <svg
                           width="16"
                           height="16"
                           viewBox="0 0 16 16"
                           fill="none"
                           xmlns="http://www.w3.org/2000/svg">
                           <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M7.60141 2.33683C7.73885 2.18084 7.9401 2.08243 8.16435 2.08243C8.16475 2.08243 8.16516 2.08243 8.16556 2.08243C8.35773 2.08219 8.54998 2.15535 8.69664 2.30191L12.6968 6.29924C12.9898 6.59203 12.9899 7.0669 12.6971 7.3599C12.4044 7.6529 11.9295 7.65306 11.6365 7.36027L8.91435 4.64004L8.91435 13.5C8.91435 13.9142 8.57856 14.25 8.16435 14.25C7.75013 14.25 7.41435 13.9142 7.41435 13.5L7.41435 4.64442L4.69679 7.36025C4.4038 7.65305 3.92893 7.6529 3.63613 7.35992C3.34333 7.06693 3.34348 6.59206 3.63646 6.29926L7.60141 2.33683Z"
                              fill="#039855" />
                        </svg>
                     </p>
                  </div>

                  <div class="h-7 w-px bg-gray-200 dark:bg-gray-800"></div>

                  <div>
                     <p
                        class="mb-1 text-center text-theme-xs text-gray-500 dark:text-gray-400 sm:text-sm">
                        Hari Ini
                     </p>
                     <p
                        class="flex items-center justify-center gap-1 text-base font-semibold text-gray-800 dark:text-white/90 sm:text-lg">
                        Rp <?= number_format($totalPenjualanHariIni, 0, ',', '.') ?>
                        <svg
                           width="16"
                           height="16"
                           viewBox="0 0 16 16"
                           fill="none"
                           xmlns="http://www.w3.org/2000/svg">
                           <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M7.60141 2.33683C7.73885 2.18084 7.9401 2.08243 8.16435 2.08243C8.16475 2.08243 8.16516 2.08243 8.16556 2.08243C8.35773 2.08219 8.54998 2.15535 8.69664 2.30191L12.6968 6.29924C12.9898 6.59203 12.9899 7.0669 12.6971 7.3599C12.4044 7.6529 11.9295 7.65306 11.6365 7.36027L8.91435 4.64004L8.91435 13.5C8.91435 13.9142 8.57856 14.25 8.16435 14.25C7.75013 14.25 7.41435 13.9142 7.41435 13.5L7.41435 4.64442L4.69679 7.36025C4.4038 7.65305 3.92893 7.6529 3.63613 7.35992C3.34333 7.06693 3.34348 6.59206 3.63646 6.29926L7.60141 2.33683Z"
                              fill="#039855" />
                        </svg>
                     </p>
                  </div>
               </div>
            </div>
            <!-- ====== Chart Two End -->
         </div>
      </div>
   </div>
   <!-- Script untuk membuat chart Chart.js secara dinamis -->
   <script>
      window.addEventListener('load', function() {
         // Gunakan variabel PHP yang sudah dihitung di awal home.php
         <?php
         $jsPercentage = is_numeric($persentasePencapaian) ? $persentasePencapaian : 0;
         $jsPercentageClamped = max(0, min(100, $jsPercentage));
         $sisaPercentage = 100 - $jsPercentageClamped;
         // Pastikan sisa tidak negatif jika Clamp > 100 (seharusnya tidak terjadi karena clamp)
         $sisaPercentage = max(0, $sisaPercentage);
         ?>

         // Targetkan ID baru
         var ctx = document.getElementById('chartTwoDynamic'); // Targetkan ID baru

         if (ctx) {
            // Pastikan library Chart.js tersedia
            if (typeof Chart !== 'undefined') {
               try {
                  // Buat instance chart Chart.js baru
                  var myChart = new Chart(ctx.getContext('2d'), {
                     type: 'doughnut',
                     data: {
                        labels: ['Pencapaian', 'Sisa Target'],
                        datasets: [{
                           // Gunakan persentase dinamis & sisanya
                           data: [<?= json_encode($jsPercentageClamped) ?>, <?= json_encode($sisaPercentage) ?>],
                           backgroundColor: [
                              '#465FFF', // Warna pencapaian (biru template)
                              '#E4E7EC' // Warna sisa (abu-abu template)
                           ],
                           borderColor: [
                              '#ffffff', // Warna border
                              '#ffffff'
                           ],
                           borderWidth: 1
                        }]
                     },
                     options: {
                        responsive: true,
                        maintainAspectRatio: false, // Penting agar chart mengisi tinggi div
                        cutout: '75%', // Sesuaikan ketebalan doughnut
                        plugins: {
                           legend: {
                              display: false // Sembunyikan legenda bawaan
                           },
                           tooltip: {
                              enabled: true // Aktifkan tooltip saat hover
                           }
                        }
                     }
                  });
               } catch (e) {
                  console.error("Error rendering dynamic Chart.js #chartTwoDynamic:", e);
               }
            } else {
               console.error("Chart.js library not found for dynamic chart creation.");
            }
         } else {
            console.warn("Element #chartTwoDynamic not found for Chart.js initialization.");
         }
      });
   </script>

   <!-- CDN ApexCharts -->
   <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
   <script>
      document.addEventListener('DOMContentLoaded', function() {
         var options = {
            series: [{
               name: 'Penjualan',
               data: <?= json_encode($dataSeriesChartBatang) ?>
            }],
            chart: {
               type: 'bar',
               height: 220,
               toolbar: {
                  show: false
               }
            },
            colors: ['#465fff'],
            plotOptions: {
               bar: {
                  horizontal: false,
                  columnWidth: '40%',
                  borderRadius: 5
               }
            },
            dataLabels: {
               enabled: false
            },
            xaxis: {
               categories: <?= json_encode($bulanLabels) ?>,
               axisBorder: {
                  show: false
               },
               axisTicks: {
                  show: false
               }
            },
            yaxis: {
               title: {
                  text: 'Total Penjualan (Rp)'
               }
            },
            grid: {
               yaxis: {
                  lines: {
                     show: true
                  }
               }
            },
            tooltip: {
               y: {
                  formatter: function(val) {
                     return 'Rp ' + val.toLocaleString('id-ID');
                  }
               }
            }
         };
         var chart = new ApexCharts(document.querySelector("#chartPenjualanBulanan"), options);
         chart.render();
      });
   </script>

   <!-- CDN Chart.js -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script>
      document.addEventListener('DOMContentLoaded', function() {
         var ctx = document.getElementById('chartBarPenjualan').getContext('2d');
         var chart = new Chart(ctx, {
            type: 'bar',
            data: {
               labels: <?= json_encode($bulanLabels) ?>,
               datasets: [{
                  label: 'Penjualan',
                  data: <?= json_encode($dataSeriesChartBatang) ?>,
                  backgroundColor: '#465FFF'
               }]
            },
            options: {
               responsive: true,
               plugins: {
                  legend: {
                     display: false
                  },
                  tooltip: {
                     callbacks: {
                        label: function(context) {
                           return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                     }
                  }
               },
               scales: {
                  y: {
                     beginAtZero: true,
                     title: {
                        display: true,
                        text: 'Total Penjualan (Rp)'
                     }
                  }
               }
            }
         });
      });
   </script>

</main>