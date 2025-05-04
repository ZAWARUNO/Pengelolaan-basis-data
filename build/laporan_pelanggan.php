<?php
include 'config/database.php';

$sql = "SELECT * FROM pelanggan";
$result = mysqli_query($koneksi, $sql);

?>
<link rel="stylesheet" href="style.css">
<table class="min-w-full mt-10">
    <thead>
        <tr>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>No Telepon</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM pelanggan");
        while ($data = mysqli_fetch_array($query)) {
        ?>
    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
        <tr>
            <td class="py-3">
                <div class="flex items-center">
                    <p class="text-gray-500 text-theme-sm dark:text-gray-400"><?php echo $data['nama_pelanggan']; ?></p>
                </div>
            </td>
            <td class="py-3">
                <div class="flex items-center">
                    <p class="text-gray-500 text-theme-sm dark:text-gray-400"><?php echo $data['alamat']; ?></p>
                </div>
            </td>
            <td class="py-3">
                <div class="flex items-center">
                    <p class="text-gray-500 text-theme-sm dark:text-gray-400"><?php echo $data['no_telepon']; ?></p>
                </div>
            </td>
        </tr>
    </tbody>
<?php
        }
?>
</table>

<script>
    window.print();
</script>