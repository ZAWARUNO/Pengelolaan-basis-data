<?php
if (isset($_POST['nama_pelanggan'])) {
   $nama = $_POST['nama_pelanggan'];
   $alamat = $_POST['alamat'];
   $no_telepon = $_POST['no_telepon'];

   $query = mysqli_query($koneksi, "INSERT INTO pelanggan (nama_pelanggan, alamat, no_telepon) values ('$nama', '$alamat', '$no_telepon')");
   if($query) {
      
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
                           <button
                              class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600"
                              onclick="window.location.href='?page=pelanggan'">
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
                        <div
                           class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                           <div
                              class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                              <!-- Elements -->
                              <div>
                                 <label
                                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Nama pelanggan
                                 </label>
                                 <div class="relative">
                                    <span
                                       class="absolute top-1/2 left-0 -translate-y-1/2 border-r border-gray-200 px-3.5 py-3 text-gray-500 dark:border-gray-800 dark:text-gray-400">
                                       <svg
                                          width="20"
                                          height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                          <g id="SVGRepo_iconCarrier">
                                             <path d="M5 21C5 17.134 8.13401 14 12 14C15.866 14 19 17.134 19 21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                          </g>
                                       </svg>
                                    </span>
                                    <input
                                       type="text"
                                       placeholder="Masukan nama pelanggan..."
                                       class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pl-[62px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                 </div>
                              </div>

                              <div>
                                 <label
                                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Alamat
                                 </label>
                                 <textarea
                                    placeholder="Masukan alamat..."
                                    type="text"
                                    rows="6"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                              </div>
                              <!-- Elements -->
                              <div
                                 x-data="{
                                       selectedCountry: 'ID',
                                       countryCodes: {
                                             'SG': '+65',
                                             'JP': '+81',
                                             'ID': '+62'
                                       },
                                       phoneNumber: '+62'
                                 }">
                                 <label
                                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    No. Telepon
                                 </label>
                                 <div class="relative">
                                    <div class="absolute">
                                       <select
                                          x-model="selectedCountry"
                                          @change="phoneNumber = countryCodes[selectedCountry]"
                                          class="focus:border-brand-300 focus:ring-brand-500/10 appearance-none rounded-l-lg border-0 border-r border-gray-200 bg-transparent bg-none py-3 pr-8 pl-3.5 leading-tight text-gray-700 focus:ring-3 focus:outline-hidden dark:border-gray-800 dark:text-gray-400">
                                          <option
                                             value="ID"
                                             class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                             ID
                                          </option>
                                          <option
                                             value="JP"
                                             class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                             JP
                                          </option>
                                          <option
                                             value="SG"
                                             class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                             SG
                                          </option>
                                          <!-- Add more country codes as needed -->
                                       </select>
                                       <div
                                          class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-700 dark:text-gray-400">
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
                                       </div>
                                    </div>
                                    <input
                                       placeholder="+62 XXX"
                                       x-model="phoneNumber"
                                       type="tel"
                                       class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent py-3 pr-4 pl-[84px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                 </div>
                                 <div class="mt-10"> <!-- Menambahkan margin top untuk jarak -->
                                    <button
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
                        </div>
                     </div>
                  </div>
               </div>
            </main>
            <!-- ===== Main Content End ===== -->
         </div>
         <!-- ===== Content Area End ===== -->
      </div>