<?php
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $q = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
  $editData = mysqli_fetch_assoc($q);
}

if (isset($_POST['nama_pelanggan'])) {
  $nama = $_POST['nama_pelanggan'];
  $alamat = $_POST['alamat'];
  $no_telepon = $_POST['no_telepon'];

  $result = mysqli_query($koneksi, "UPDATE pelanggan SET nama_pelanggan='$nama', alamat='$alamat', no_telepon='$no_telepon' WHERE id_pelanggan='$id'");

  if ($result) {
    echo '
  <div id="successAlert" class="fixed top-4 left-0 right-0 mx-auto w-full max-w-md z-999999 rounded-xl border border-success-500 bg-success-50 p-4 dark:border-success-500/30 dark:bg-success-500/15">
    <div class="flex items-start gap-3">
      <div class="-mt-0.5 text-success-500">
        <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M3.70186 12.0001C3.70186 7.41711 7.41711 3.70186 12.0001 3.70186C16.5831 3.70186 20.2984 7.41711 20.2984 12.0001C20.2984 16.5831 16.5831 20.2984 12.0001 20.2984C7.41711 20.2984 3.70186 16.5831 3.70186 12.0001ZM12.0001 1.90186C6.423 1.90186 1.90186 6.423 1.90186 12.0001C1.90186 17.5772 6.423 22.0984 12.0001 22.0984C17.5772 22.0984 22.0984 17.5772 22.0984 12.0001C22.0984 6.423 17.5772 1.90186 12.0001 1.90186ZM15.6197 10.7395C15.9712 10.388 15.9712 9.81819 15.6197 9.46672C15.2683 9.11525 14.6984 9.11525 14.347 9.46672L11.1894 12.6243L9.6533 11.0883C9.30183 10.7368 8.73198 10.7368 8.38051 11.0883C8.02904 11.4397 8.02904 12.0096 8.38051 12.3611L10.553 14.5335C10.7217 14.7023 10.9507 14.7971 11.1894 14.7971C11.428 14.7971 11.657 14.7023 11.8257 14.5335L15.6197 10.7395Z" fill=""/>
        </svg>
      </div>
      <div>
        <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">Tambah Pelanggan Berhasil</h4>
        <p class="text-sm text-gray-500 dark:text-gray-400">Pelanggan ' . $nama . ' berhasil ditambahkan</p>
      </div>
    </div>
  </div>
  
  <script>
    setTimeout(function() {
      document.getElementById("successAlert").style.display = "none";
    }, 3000);
    window.location.href = "?page=pelanggan";
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
          <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">Menambahkan Pelanggan Gagal</h4>
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
      <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">

        <div class="space-y-5 sm:space-y-6">
          <div
            class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
              <h3
                class="text-base font-medium text-gray-800 dark:text-white/90">
                Data Pelanggan
              </h3>
              <div class="flex items-center gap-2">
                <button
                  class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600"
                  onclick="window.open('laporan_pelanggan.php', '_blank')">
                  Laporan
                  <svg
                    class="fill-current"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M19 8H5C3.89 8 3 8.9 3 10V16H5V20H19V16H21V10C21 8.9 20.1 8 19 8Z"
                      fill="currentColor" />
                    <path
                      d="M7 5H17V8H7V5Z"
                      fill="currentColor" />
                  </svg>
                </button>
                <button
                  class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600"
                  onclick="window.location.href='?page=pelanggan_tambah'">
                  Tambah
                  <svg
                    class="fill-current"
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M10 2C10.5523 2 11 2.44772 11 3V9H17C17.5523 9 18 9.44772 18 10C18 10.5523 17.5523 11 17 11H11V17C11 17.5523 10.5523 18 10 18C9.44772 18 9 17.5523 9 17V11H3C2.44772 11 2 10.5523 2 10C2 9.44772 2.44772 9 3 9H9V3C9 2.44772 9.44772 2 10 2Z"
                      fill="" />
                  </svg>
                </button>
              </div>
            </div>
            <div
              class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
              <!-- ====== Table Start -->
              <div
                class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="max-w-full overflow-x-auto">
                  <table class="min-w-full">
                    <!-- table header start -->
                    <thead>
                      <tr
                        class="border-b border-gray-100 dark:border-gray-800">
                        <th class="px-5 py-3 sm:px-6">
                          <div class="flex items-center">
                            <p
                              class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                              Nama Pelanggan
                            </p>
                          </div>
                        </th>
                        <th class="px-5 py-3 sm:px-6">
                          <div class="flex items-center">
                            <p
                              class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                              Alamat
                            </p>
                          </div>
                        </th>
                        <th class="px-5 py-3 sm:px-6">
                          <div class="flex items-center">
                            <p
                              class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                              No Telepon
                            </p>
                          </div>
                        </th>
                        <th class="px-5 py-3 sm:px-6">
                          <div class="flex items-center">
                            <p
                              class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                              Aksi
                            </p>
                          </div>
                        </th>
                      </tr>
                    </thead>
                    <!-- table header end -->
                    <!-- table body start -->
                    <tbody
                      class="divide-y divide-gray-100 dark:divide-gray-800">
                      <!-- Example row, replace with dynamic data -->
                      <?php
                      $cari = $_GET['cari'] ?? '';
                      $sql = "SELECT * FROM pelanggan";
                      if (!empty($cari)) {
                        $sql .= " WHERE nama_pelanggan LIKE '%$cari%'";

                        $result = mysqli_query($koneksi, $sql);
                        while ($data = mysqli_fetch_array($result)) {
                      ?>
                          <tr>
                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <p
                                  class="text-gray-500 text-theme-sm dark:text-gray-400">
                                  <?php echo $data['nama_pelanggan']; ?>
                                </p>
                              </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <p
                                  class="text-gray-500 text-theme-sm dark:text-gray-400">
                                  <?php echo $data['alamat']; ?>
                                </p>
                              </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <p
                                  class="text-gray-500 text-theme-sm dark:text-gray-400">
                                  <?php echo $data['no_telepon']; ?>
                                </p>
                              </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <button
                                  onclick="window.location.href='?page=pelanggan&edit=<?php echo $data['id_pelanggan']; ?>'"
                                  class="flex w-full items-center justify-center gap-2 rounded-full text-sm shadow-theme-xs bg-warning-400 dark:bg-warning-500/15 dark:text-warning-500 px-4 py-3 font-medium text-white hover:bg-warning-500 lg:inline-flex lg:w-auto" type="button">
                                  <svg
                                    class="fill-current"
                                    width="18"
                                    height="18"
                                    viewBox="0 0 18 18"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
                                      fill="" />
                                  </svg>
                                  Edit
                                </button>
                                <button
                                  class="ml-1 flex w-full items-center justify-center gap-2 rounded-full text-sm shadow-theme-xs bg-red-400 dark:bg-error-500/15 dark:text-error-500 px-4 py-3 font-medium text-white hover:bg-red-500 lg:inline-flex lg:w-auto"
                                  onclick="window.location.href='?page=hapus_pelanggan&&id=<?php echo $data['id_pelanggan']; ?>'">
                                  <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6 2a1 1 0 00-1 1v1h10V3a1 1 0 00-1-1H6zm-2 4v9a2 2 0 002 2h8a2 2 0 002-2V6H4z" fill="currentColor" />
                                  </svg>
                                  Hapus
                                </button>
                              </div>
                            </td>
                          </tr>
                        <?php
                        }
                      } else {
                        $sql = "SELECT * FROM pelanggan";
                        $result = mysqli_query($koneksi, $sql);
                        while ($data = mysqli_fetch_array($result)) {
                        ?>
                          <tr>
                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <p
                                  class="text-gray-500 text-theme-sm dark:text-gray-400">
                                  <?php echo $data['nama_pelanggan']; ?>
                                </p>
                              </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <p
                                  class="text-gray-500 text-theme-sm dark:text-gray-400">
                                  <?php echo $data['alamat']; ?>
                                </p>
                              </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <p
                                  class="text-gray-500 text-theme-sm dark:text-gray-400">
                                  <?php echo $data['no_telepon']; ?>
                                </p>
                              </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <button
                                  onclick="window.location.href='?page=pelanggan&edit=<?php echo $data['id_pelanggan']; ?>'"
                                  class="flex w-full items-center justify-center gap-2 rounded-full text-sm shadow-theme-xs bg-warning-400 dark:bg-warning-500/15 dark:text-warning-500 px-4 py-3 font-medium text-white hover:bg-warning-500 lg:inline-flex lg:w-auto" type="button">
                                  <svg
                                    class="fill-current"
                                    width="18"
                                    height="18"
                                    viewBox="0 0 18 18"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
                                      fill="" />
                                  </svg>
                                  Edit
                                </button>
                                <button
                                  class="ml-1 flex w-full items-center justify-center gap-2 rounded-full text-sm shadow-theme-xs bg-red-400 dark:bg-error-500/15 dark:text-error-500 px-4 py-3 font-medium text-white hover:bg-red-500 lg:inline-flex lg:w-auto"
                                  onclick="window.location.href='?page=hapus_pelanggan&&id=<?php echo $data['id_pelanggan']; ?>'">
                                  <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6 2a1 1 0 00-1 1v1h10V3a1 1 0 00-1-1H6zm-2 4v9a2 2 0 002 2h8a2 2 0 002-2V6H4z" fill="currentColor" />
                                  </svg>
                                  Hapus
                                </button>
                              </div>
                            </td>
                          </tr>
                      <?php
                        }
                      } ?>
                      <!-- End of example row -->
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- ====== Table End -->
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- ===== Main Content End ===== -->
  </div>
  <!-- ===== Content Area End ===== -->
</div>

<!-- BEGIN MODAL -->
<div
  id="modalEdit"
  x-show="isOpen"
  <?php if ($editData) : ?>
  x-data="{ isOpen: true }"
  <?php else : ?>
  x-data="{ isOpen: false }"
  <?php endif; ?>
  class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
  <div
    class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
  <div
    @click.outside="isOpen = false"
    class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
    <!-- close btn -->
    <button
      @click="isOpen = false"
      onclick="window.location.href='?page=pelanggan'"
      class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
      <svg
        class="fill-current"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path
          fill-rule="evenodd"
          clip-rule="evenodd"
          d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z"
          fill="" />
      </svg>
    </button>
    <div class="px-2 pr-14">
      <h4
        class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
        Edit Pelanggan
      </h4>
    </div>
    <form method="POST" action="" class="flex flex-col">
      <div class="custom-scrollbar h-[250px] overflow-y-auto px-2">
        <div class="mt-7">
          <h5
            class="mb-5 text-lg font-medium text-gray-800 dark:text-white/90 lg:mb-6">
            Informasi Pelanggan
          </h5>

          <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
            <div class="col-span-2 lg:col-span-1">
              <label
                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                Nama Pelanggan
              </label>
              <input
                type="text"
                name="nama_pelanggan"
                value="<?php echo $editData['nama_pelanggan'] ?? ''; ?>"
                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
            </div>

            <div class="col-span-2 lg:col-span-1">
              <label
                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                Alamat
              </label>
              <input
                type="text"
                name="alamat"
                required
                value="<?php echo $editData['alamat'] ?? ''; ?>"
                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
            </div>
            <div class="col-span-2">
              <label
                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                No Telepon
              </label>
              <input
                type="tel"
                name="no_telepon"
                pattern="^[\+]?\s*\d(?:\s*\d)*\s*$"
                value="<?php echo $editData['no_telepon'] ?? ''; ?>"
                required
                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
            </div>
          </div>
        </div>
      </div>
      <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
        <button
          @click="isOpen = false"
          onclick="window.location.href='?page=pelanggan'"
          type="button"
          required
          class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
          Tutup
        </button>
        <button
          type="submit"
          class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>
<!-- END MODAL -->