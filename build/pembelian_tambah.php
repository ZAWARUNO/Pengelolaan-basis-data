<?php
if (isset($_POST['id_pelanggan'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $produk = $_POST['produk'];
    $total = 0;
    $tanggal = date('Y/m/d');

    $query = mysqli_query($koneksi, "INSERT INTO penjualan(tanggal_penjualan, id_pelanggan) values ('$tanggal', '$id_pelanggan')");
    $idTerakhir = mysqli_fetch_array(mysqli_query($koneksi, "SELECT*FROM penjualan ORDER BY id_penjualan DESC"));
    $id_penjualan = $idTerakhir['id_penjualan'];

    foreach ($produk as $key=>$val) {
        $pr = mysqli_fetch_array(mysqli_query($koneksi, "SELECT*FROM produk WHERE id_produk = $key"));

        if($val > 0){
            $sub = $val * $pr['harga'];
            $total += $sub;
            $query = mysqli_query($koneksi, "INSERT INTO detail_penjualan(id_penjualan, id_produk, jumlah_produk, sub_total ) values ('$id_penjualan', '$key', '$val', '$sub')");

            $updateProduk = mysqli_query($koneksi, "UPDATE produk SET stock = stock - $val WHERE id_produk = $key");
        }

    }

    $query = mysqli_query($koneksi, "UPDATE penjualan SET total_harga = $total WHERE id_penjualan = $id_penjualan");

    if ($query) {
        echo '<div id="successAlert" class="fixed top-4 left-0 right-0 mx-auto w-full max-w-md z-999999 rounded-xl border border-success-500 bg-success-50 p-4 dark:border-success-500/30 dark:bg-success-500/15">
    <div class="flex items-start gap-3">
      <div class="-mt-0.5 text-success-500">
        <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M3.70186 12.0001C3.70186 7.41711 7.41711 3.70186 12.0001 3.70186C16.5831 3.70186 20.2984 7.41711 20.2984 12.0001C20.2984 16.5831 16.5831 20.2984 12.0001 20.2984C7.41711 20.2984 3.70186 16.5831 3.70186 12.0001ZM12.0001 1.90186C6.423 1.90186 1.90186 6.423 1.90186 12.0001C1.90186 17.5772 6.423 22.0984 12.0001 22.0984C17.5772 22.0984 22.0984 17.5772 22.0984 12.0001C22.0984 6.423 17.5772 1.90186 12.0001 1.90186ZM15.6197 10.7395C15.9712 10.388 15.9712 9.81819 15.6197 9.46672C15.2683 9.11525 14.6984 9.11525 14.347 9.46672L11.1894 12.6243L9.6533 11.0883C9.30183 10.7368 8.73198 10.7368 8.38051 11.0883C8.02904 11.4397 8.02904 12.0096 8.38051 12.3611L10.553 14.5335C10.7217 14.7023 10.9507 14.7971 11.1894 14.7971C11.428 14.7971 11.657 14.7023 11.8257 14.5335L15.6197 10.7395Z" fill=""/>
        </svg>
      </div>
      <div>
        <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">Tambah pembelian Berhasil</h4>
<p class="text-sm text-gray-500 dark:text-gray-400">Penjualan produk ' . implode(', ', array_map(function($idProduk) use ($produk, $koneksi) {
    $rowProduk = mysqli_fetch_array(mysqli_query($koneksi, "SELECT nama_produk FROM produk WHERE id_produk = $idProduk"));
    return $rowProduk['nama_produk'] . ' sebanyak ' . $produk[$idProduk];
}, array_keys($produk))) . ' dengan total ' . $total . ' berhasil ditambahkan</p>
      </div>
    </div>
  </div>
  <script>
    setTimeout(function() {
      document.getElementById("successAlert").style.display = "none";
    }, 3000);
  </script>';
    } else {
        echo '<div id="errorAlert" class="fixed top-4 left-0 right-0 mx-auto w-full max-w-md z-9999 rounded-xl border border-warning-500 bg-warning-50 p-4 dark:border-warning-500/30 dark:bg-warning-500/15">
      <div class="flex items-start gap-3">
        <div class="-mt-0.5 text-warning-500 dark:text-orange-400">
          <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.6501 12.0001C3.6501 7.38852 7.38852 3.6501 12.0001 3.6501C16.6117 3.6501 20.3501 7.38852 20.3501 12.0001C20.3501 16.6117 16.6117 20.3501 12.0001 20.3501C7.38852 20.3501 3.6501 16.6117 3.6501 12.0001ZM12.0001 1.8501C6.39441 1.8501 1.8501 6.39441 1.8501 12.0001C1.8501 17.6058 6.39441 22.1501 12.0001 22.1501C17.6058 22.1501 22.1501 17.6058 22.1501 12.0001C22.1501 6.39441 17.6058 1.8501 12.0001 1.8501ZM10.9992 7.52517C10.9992 8.07746 11.4469 8.52517 11.9992 8.52517H12.0002C12.5525 8.52517 13.0002 8.07746 13.0002 7.52517C13.0002 6.97289 12.5525 6.52517 12.0002 6.52517H11.9992C11.4469 6.52517 10.9992 6.97289 10.9992 7.52517ZM12.0002 17.3715C11.586 17.3715 11.2502 17.0357 11.2502 16.6215V10.945C11.2502 10.5308 11.586 10.195 12.0002 10.195C12.4144 10.195 12.7502 10.5308 12.7502 10.945V16.6215C12.7502 17.0357 12.4144 17.3715 12.0002 17.3715Z" fill=""/>
          </svg>
        </div>
        <div>
          <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">Menambahkan Pembelian Gagal</h4>
          <p class="text-sm text-gray-500 dark:text-gray-400">Coba lagi Atau tunggu beberapa saat</p>
        </div>
      </div>
    </div>
    <script>
      setTimeout(function() {
        document.getElementById("errorAlert").style.display = "none";
      }, 3000);
    </script>';
    }
}
?>
<!-- ===== Page Wrapper Start ===== -->
<div class="flex h-screen overflow-hidden">

    <!-- ===== Content Area Start ===== -->
    <div
        class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
        <!-- Small Device Overlay Start -->
        <div
            @click="sidebarToggle = false"
            :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
            class="fixed w-full h-screen z-9 bg-gray-900/50"></div>
        <!-- Small Device Overlay End -->

        <!-- ===== Main Content Start ===== -->
        <main>
            <div class="p-4 mx-auto w-full md:p-6">

                <div class="space-y-5 sm:space-y-6">
                    <div
                        class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
                            <h3
                                class="text-base font-medium text-gray-800 dark:text-white/90">
                                Tambah pembelian
                            </h3>
                            <button
                                class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600"
                                onclick="window.location.href='?page=pembelian'">
                                Kembali
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M4 10L3.29289 10.7071L2.58579 10L3.29289 9.29289L4 10ZM21 18C21 18.5523 20.5523 19 20 19C19.4477 19 19 18.5523 19 18L21 18ZM8.29289 15.7071L3.29289 10.7071L4.70711 9.29289L9.70711 14.2929L8.29289 15.7071ZM3.29289 9.29289L8.29289 4.29289L9.70711 5.70711L4.70711 10.7071L3.29289 9.29289ZM4 9L14 9L14 11L4 11L4 9ZM21 16L21 18L19 18L19 16L21 16ZM14 9C17.866 9 21 12.134 21 16L19 16C19 13.2386 16.7614 11 14 11L14 9Z" fill="#ffffff"></path>
                                    </g>
                                </svg>
                            </button>
                        </div>
                        <form method="POST" action=""
                            class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                            <div
                                class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                                <!-- Elements -->
                                <div>
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Nama pelanggan
                                    </label>
                                    <div
                                        x-data="{ isOptionSelected: false }"
                                        class="relative z-20 bg-transparent">
                                        <select
                                            name="id_pelanggan"
                                            required
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                            :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                            @change="isOptionSelected = true">
                                            <option
                                                selected
                                                disabled
                                                required
                                                class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                                Pilih pelanggan
                                            </option>
                                            <?php
                                            $p = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                                            while ($pel = mysqli_fetch_array($p)) {
                                            ?>
                                                <option
                                                    value="<?php echo $pel['id_pelanggan']; ?>"
                                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                                    <?php echo $pel['nama_pelanggan']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <span
                                            class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                            <svg
                                                class="stroke-current"
                                                width="20"
                                                height="20"
                                                viewBox="0 0 20 20"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396"
                                                    stroke=""
                                                    stroke-width="1.5"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <?php $pro = mysqli_query($koneksi, "SELECT * FROM produk");
                                while ($produk = mysqli_fetch_array($pro)) {
                                ?>
                                    <div>
                                        <label
                                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            <?php echo $produk['nama_produk'] . ' ( Stok ' . $produk['stock'] . ' Harga ' . $produk['harga'] . ' )'; ?>
                                        </label>
                                        <div class="relative">
                                            <span
                                                class="absolute top-1/2 left-0 -translate-y-1/2 border-r border-gray-200 px-3.5 py-3 text-gray-500 dark:border-gray-800 dark:text-gray-400">
                                                <svg fill="#000000" width="20px" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M19,23a1,1,0,0,0,1-1V8a1,1,0,0,0-.349-.759l-7-6a1,1,0,0,0-1.3,0l-7,6A1,1,0,0,0,4,8V22a1,1,0,0,0,1,1ZM6,8.46l6-5.143L18,8.46V21H6ZM14,9a2,2,0,1,1-2-2A2,2,0,0,1,14,9Z"></path>
                                                    </g>
                                                </svg>
                                            </span>
                                            <input
                                                type="number"
                                                name="produk[<?php echo $produk['id_produk']; ?>]"
                                                step="0"
                                                value="0"
                                                min="0"
                                                max="<?php echo $produk['stock']; ?>"
                                                placeholder="Masukan jumlah..."
                                                required
                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pl-[62px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <!-- Elements -->
                                <div class="mt-10"> <!-- Menambahkan margin top untuk jarak -->
                                    <button
                                        type="reset"
                                        class="mr-1 inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-warning-500 shadow-theme-xs hover:bg-warning-600">
                                        Reset
                                        <svg fill="#ffffff" width="20px" height="20px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M960 0v213.333c411.627 0 746.667 334.934 746.667 746.667S1371.627 1706.667 960 1706.667 213.333 1371.733 213.333 960c0-197.013 78.4-382.507 213.334-520.747v254.08H640V106.667H53.333V320h191.04C88.64 494.08 0 720.96 0 960c0 529.28 430.613 960 960 960s960-430.72 960-960S1489.387 0 960 0" fill-rule="evenodd"></path>
                                            </g>
                                        </svg>
                                    </button>
                                    <button
                                        type="submit"
                                        class="ml-1 inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600">
                                        Simpan
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M10.3009 13.6949L20.102 3.89742M10.5795 14.1355L12.8019 18.5804C13.339 19.6545 13.6075 20.1916 13.9458 20.3356C14.2394 20.4606 14.575 20.4379 14.8492 20.2747C15.1651 20.0866 15.3591 19.5183 15.7472 18.3818L19.9463 6.08434C20.2845 5.09409 20.4535 4.59896 20.3378 4.27142C20.2371 3.98648 20.013 3.76234 19.7281 3.66167C19.4005 3.54595 18.9054 3.71502 17.9151 4.05315L5.61763 8.2523C4.48114 8.64037 3.91289 8.83441 3.72478 9.15032C3.56153 9.42447 3.53891 9.76007 3.66389 10.0536C3.80791 10.3919 4.34498 10.6605 5.41912 11.1975L9.86397 13.42C10.041 13.5085 10.1295 13.5527 10.2061 13.6118C10.2742 13.6643 10.3352 13.7253 10.3876 13.7933C10.4468 13.87 10.491 13.9585 10.5795 14.1355Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
    </div>
    </main>
    <!-- ===== Main Content End ===== -->
</div>
<!-- ===== Content Area End ===== -->
</div>