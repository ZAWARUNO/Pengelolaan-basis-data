<?php
include 'config/database.php';

$sql = "SELECT * FROM pelanggan";
$result = mysqli_query($koneksi, $sql);

?>
<link rel="stylesheet" href="style.css">
<div class="w-full overflow-x-auto mt-10">
    <table class="min-w-full table-auto">
        <!-- table header start -->
        <thead>
            <tr class="border-gray-100 border-y dark:border-gray-800">
                <th class="py-3">
                    <div class="flex items-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Pelanggan</p>
                    </div>
                </th>
                <th class="py-3">
                    <div class="flex items-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Tanggal</p>
                    </div>
                </th>
                <th class="py-3">
                    <div class="flex items-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Total</p>
                    </div>
                </th>
            </tr>
        </thead>
        <!-- table header end -->
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM penjualan LEFT JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan");
        while ($data = mysqli_fetch_array($query)) {
        ?>
            <form method="POST" action="">
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    <tr>
                        <td class="py-3">
                            <div class="flex items-center">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400"><?php echo $data['nama_pelanggan']; ?></p>
                            </div>
                        </td>
                        <td class="py-3">
                            <div class="flex items-center">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400"><?php echo $data['tanggal_penjualan']; ?></p>
                            </div>
                        </td>
                        <td class="py-3">
                            <div class="flex items-center">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400"><?php echo number_format($data['total_harga'], 0, ',', '.'); ?></p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </form>
        <?php
        }
        ?>
    </table>
</div>
<script>
    window.print();
</script>