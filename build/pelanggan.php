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
                        $query = mysqli_query($koneksi, "SELECT*FROM pelanggan");
                        while ($data = mysqli_fetch_array($query)) :
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
                                  @click="isOpen = true"
                                  class="flex w-full items-center justify-center gap-2 rounded-full text-sm shadow-theme-xs bg-warning-400 dark:bg-warning-500/15 dark:text-warning-500 px-4 py-3 font-medium text-white hover:bg-warning-500 lg:inline-flex lg:w-auto">
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
                                  Hapus
                                </button>
                              </div>
                            </td>
                          </tr>
                        <?php
                        ;endwhile
                        ?>
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
    x-show="isOpen"
    class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
    <div
      class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
    <div
      @click.outside="isOpen = false"
      class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
      <!-- close btn -->
      <button
        @click="isOpen = false"
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
          Edit Personal Information
        </h4>
        <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
          Update your details to keep your profile up-to-date.
        </p>
      </div>
      <form class="flex flex-col">
        <div class="custom-scrollbar h-[450px] overflow-y-auto px-2">
          <div>
            <h5
              class="mb-5 text-lg font-medium text-gray-800 dark:text-white/90 lg:mb-6">
              Social Links
            </h5>

            <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
              <div>
                <label
                  class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                  Facebook
                </label>
                <input
                  type="text"
                  value="https://facebook.com/PimjoHQ"
                  class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
              </div>

              <div>
                <label
                  class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                  X.com
                </label>
                <input
                  type="text"
                  value="https://x.com/PimjoHQ"
                  class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
              </div>

              <div>
                <label
                  class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                  Linkedin
                </label>
                <input
                  type="text"
                  value="https://linkedin.com/PimjoHQ"
                  class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
              </div>

              <div>
                <label
                  class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                  Instagram
                </label>
                <input
                  type="text"
                  value="https://instagram.com/PimjoHQ"
                  class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
              </div>
            </div>
          </div>
          <div class="mt-7">
            <h5
              class="mb-5 text-lg font-medium text-gray-800 dark:text-white/90 lg:mb-6">
              Personal Information
            </h5>

            <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
              <div class="col-span-2 lg:col-span-1">
                <label
                  class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                  First Name
                </label>
                <input
                  type="text"
                  value="Musharof"
                  class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
              </div>

              <div class="col-span-2 lg:col-span-1">
                <label
                  class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                  Last Name
                </label>
                <input
                  type="text"
                  value="Chowdhury"
                  class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
              </div>

              <div class="col-span-2 lg:col-span-1">
                <label
                  class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                  Email Address
                </label>
                <input
                  type="text"
                  value="randomuser@pimjo.com"
                  class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
              </div>

              <div class="col-span-2 lg:col-span-1">
                <label
                  class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                  Phone
                </label>
                <input
                  type="text"
                  value="+09 363 398 46"
                  class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
              </div>

              <div class="col-span-2">
                <label
                  class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                  Bio
                </label>
                <input
                  type="text"
                  value="Team Manager"
                  class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
              </div>
            </div>
          </div>
        </div>
        <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
          <button
            @click="isOpen = false"
            type="button"
            class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
            Close
          </button>
          <button
            type="button"
            class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>
  <div
    x-show="isProfileAddressModal"
    class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
    <div
      class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
    <div
      @click.outside="isProfileAddressModal = false"
      class="no-scrollbar relative flex w-full max-w-[700px] flex-col overflow-y-auto rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-11">
      <!-- close btn -->
      <button
        @click="isProfileAddressModal = false"
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
          Edit Address
        </h4>
        <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
          Update your details to keep your profile up-to-date.
        </p>
      </div>
      <form class="flex flex-col">
        <div class="px-2 overflow-y-auto custom-scrollbar">
          <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
            <div>
              <label
                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                Country
              </label>
              <input
                type="text"
                value="United States"
                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
            </div>

            <div>
              <label
                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                City/State
              </label>
              <input
                type="text"
                value="Arizona, United States"
                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
            </div>

            <div>
              <label
                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                Postal Code
              </label>
              <input
                type="text"
                value="ERT 2489"
                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
            </div>

            <div>
              <label
                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                TAX ID
              </label>
              <input
                type="text"
                value="AS4568384"
                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
            </div>
          </div>
        </div>
        <div class="flex items-center gap-3 mt-6 lg:justify-end">
          <button
            @click="isProfileAddressModal = false"
            type="button"
            class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
            Close
          </button>
          <button
            type="button"
            class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>
  <!-- END MODAL -->

  <script defer src="bundle.js"></script>
