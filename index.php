<?php
session_start();


?>
<php>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Poliklinik</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/styles.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    </head>

    <body>
        <!-- header -->
        <div class="navbar bg-base-100 navbar fixed top-0 left-0 w-full z-50 border-b-4 border-blue-500">
            <div class="navbar-start lg:pl-24 ">
                <a href="#home">
                    <img src="images/logoo.png" alt="logo" class="img-fluid m-4">
                </a>
                <!-- navbar small -->
                <div class="navbar-end lg:hidden flex justify-end">
                    <div class="dropdown navbar-end lg:hidden">
                        <div tabindex="0" role="button" class="btn btn-ghost hidden">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h8m-8 6h16" />
                            </svg>
                        </div>
                        <ul
                            tabindex="0"
                            class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                            <li><a>Beranda</a></li>
                            <details>
                                <summary>Layanan</summary>
                                <ul class="p-2">
                                    <li><a>Konsultasi Dokter</a></li>
                                    <li><a>Informasi Obat Obatan</a></li>
                                    <li><a>Jadwal Dokter</a></li>
                                </ul>
                            </details>
                            <li><a>Blog Kesehatan</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- navbar mode lg -->
            <div class="navbar-end lg:pr-28 hidden lg:flex">
                <ul class="menu menu-horizontal px-1">
                    <li><a class="text-lg hover:text-white hover:bg-info p-2 rounded" href="#home">Beranda</a></li>
                        <li><a class="text-lg hover:text-white hover:bg-info p-2 rounded" href="daftarpasien.php">Registrasi Pasien</a></li>
                    <li>
                        <details>
                            <summary class="text-lg hover:text-white hover:bg-info p-2 rounded">Layanan</summary>
                            <ul class="p-2">
                                <li><a class="text-md hover:text-white hover:bg-info p-2 rounded">Konsultasi Dokter</a></li>
                                <li><a class="text-md hover:text-white hover:bg-info p-2 rounded">Informasi Obat Obatan</a></li>
                                <li><a class="text-md hover:text-white hover:bg-info p-2 rounded">Jadwal Dokter</a></li>
                            </ul>
                        </details>
                    </li>
                    <li><a href="blog.php" class="text-lg hover:text-white hover:bg-info p-2 rounded">Blog Kesehatan</a></li>
                </ul>
            </div>
        </div>
        <!--endheader-->

        <!-- Hero 1 -->
        <section id="home">
            <!-- Hero -->
            <div class="hero min-h-screen relative overflow-hidden">
                <!-- Gambar latar belakang yang akan berubah -->
                <div id="background-slider" class="absolute inset-0 w-full h-full bg-cover bg-center transition-opacity duration-1000 ease-in-out"></div>

                <!-- Overlay tetap -->
                <div class="hero-overlay bg-opacity-60"></div>

                <!-- Konten teks -->
                <div class="hero-content text-neutral-content text-center relative z-10 mt-24">
                    <div class="max-w-md">
                        <h1 class="mb-5 text-3xl text-white  font-extrabold text-shadow-lg">Selamat Datang di</h1>
                        <h1 class="mb-5 text-7xl font-extrabold text-white text-shadow-lg">
                            POLIKLINIK <span class="text-info">TRIHARSI</span>
                        </h1>
                        <p class="mb-5 text-white text-lg text-shadow-lg">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas, velit odit voluptate natus nobis,
                        </p>

                        <button
                            id="cekLayananButton"
                            class="btn btn-info btn-circle rounded-full !text-white glass mr-2 w-100 transition-transform transform hover:scale-105" style="background: linear-gradient(90deg, #3B82F6, #6F3AFA);">
                            <img src="images/icon1.png" />
                            Cek Layanan
                        </button>
                        <button
                            class="btn btn-info btn-circle rounded-full !text-white glass ml-2 w-full px-8 transition-transform transform hover:scale-105"
                            style="background: linear-gradient(90deg, #3B82F6, #6F3AFA);"
                            onclick="window.location.href='daftarpasien.php';">

                            <img src="images/wa.png" alt="WhatsApp" />
                            Daftar Konsultasi
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Hero -->
        </section>

        <!-- Hero 2 -->
        <section class="bg-gradient-to-r from-sky-300 to-blue-400 rounded-b-[10rem]">
            <!-- Clients -->
            <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                <!-- Title -->
                <div class="w-2/3 sm:w-1/2 lg:w-1/3 mx-auto text-center mb-6">
                    <p class="mb-5 text-white font-bold text-xl">Telah Bekerja Sama Dengan Beberapa Pihak</p>
                </div>
                <!-- End Title -->

                <!-- Grid -->
                <div class="grid grid-cols-3 md:grid-cols-6 gap-x-6">
                    <img class="py-3 lg:py-6 w-16 h-auto md:w-20 lg:w-28 mx-auto text-gray-500 dark:text-neutral-500" src="images/client/bpjs1.png" alt="description of the image">
                    <img class="py-3 lg:py-5 w-16 h-auto md:w-20 lg:w-20 mx-auto text-gray-500 dark:text-neutral-500" src="images/client/jiwasraya.png" alt="description of the image">
                    <img class="py-3 lg:py-5 w-16 h-auto md:w-20 lg:w-28 mx-auto text-gray-500 dark:text-neutral-500" src="images/client/sinarmas.png" alt="description of the image">
                    <img class="py-3 lg:py-10 w-16 h-auto md:w-20 lg:w-28 mx-auto text-gray-500 dark:text-neutral-500" src="images/client/adira.png" alt="description of the image">
                    <img class="py-3 lg:py-10 w-16 h-auto md:w-20 lg:w-28 mx-auto text-gray-500 dark:text-neutral-500" src="images/client/alianz.png" alt="description of the image">
                    <img class="py-3 lg:py-3 w-16 h-15 md:w-20 lg:w-28 mx-auto text-gray-500 dark:text-neutral-500" src="images/client/prudential.png" alt="description of the image">


                </div>
                <!-- End Grid -->

                <!-- Grid -->
                <div class="grid grid-cols-3 md:grid-cols-5 gap-x-6 sm:gap-x-6">
                    <img class="py-3 lg:py-5 w-16 h-auto md:w-20 lg:w-28 mx-auto text-gray-500 dark:text-neutral-500" src="images/client/mandiri.png" alt="description of the image">
                    <img class="py-3 lg:py-1 w-16 h-auto md:w-20 lg:w-28 mx-auto text-gray-500 dark:text-neutral-500" src="images/client/bri.png" alt="description of the image">
                    <img class="py-3 lg:py-5 w-16 h-auto md:w-20 lg:w-28 mx-auto text-gray-500 dark:text-neutral-500" src="images/client/bni.png" alt="description of the image">
                    <img class="py-3 lg:py-1 w-16 h-auto md:w-20 lg:w-28 mx-auto text-gray-500 dark:text-neutral-500" src="images/client/bca.png" alt="description of the image">
                    <img class="py-3 lg:py-1 w-16 h-auto md:w-20 lg:w-32 mx-auto text-gray-500 dark:text-neutral-500" src="images/client/cimb.png" alt="description of the image">

                </div>
                <!-- End Grid -->
            </div>
            <!-- End Clients -->
        </section>


        <!-- Hero 3 -->
        <section id="layanan">
            <!-- Hero -->
            <!-- Features -->
            <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                <div class="relative p-6 md:p-16">
                    <!-- Grid -->
                    <div class="relative z-10 lg:grid lg:grid-cols-12 lg:gap-16 lg:items-center">
                        <div class="mb-10 lg:mb-0 lg:col-span-6 lg:col-start-8 lg:order-2 text-center">
                            <h2 class="text-2xl text-white font-bold sm:text-3xl dark:text-neutral-200">
                                Layanan Unggulan di<br>Rumah Sakit <span class="text-gray-700">Triharsi</span> Surakarta
                            </h2>
                            <!-- Tab Navs -->
                            <nav class="grid gap-4 mt-5 md:mt-10" aria-label="Tabs" role="tablist" aria-orientation="vertical">
                                <!-- buton1 -->
                                <button class="hs-tab-active:bg-white hs-tab-active:shadow-md hs-tab-active:hover:border-transparent text-start  focus:outline-none  p-4 md:p-5 rounded-xl dark:hs-tab-active:bg-neutral-700 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 active" id="tabs-with-card-item-1" aria-selected="true" data-hs-tab="#tabs-with-card-1" aria-controls="tabs-with-card-1" role="tab" disabled>
                                    <span class="flex gap-x-6">
                                        <img src="images/icon/layanan.png"
                                            alt="Deskripsi gambar"
                                            class="shrink-0 mt-2 size-6 md:size-7 hs-tab-active:text-blue-600 text-gray-800 dark:hs-tab-active:text-blue-500 dark:text-neutral-200"
                                            width="24"
                                            height="24" />
                                        <span class="grow">
                                            <span class="block text-lg font-semibold hs-tab-active:text-blue-600 text-white dark:hs-tab-active:text-blue-500 dark:text-neutral-200">Konsultasi Dokter</span>
                                            <span class="block mt-1 text-white dark:hs-tab-active:text-gray-200 dark:text-neutral-200 text-justify">Konsultasi dokter adalah layanan medis yang memungkinkan pasien berdiskusi tentang kesehatan dan menerima saran perawatan dari tenaga medis profesional.</span>
                                        </span>
                                    </span>
                                </button>

                                <!-- buton2 -->
                                <button type="button" class="hs-tab-active:bg-white hs-tab-active:shadow-md hs-tab-active:hover:border-transparent text-start focus:outline-none p-4 md:p-5 rounded-xl dark:hs-tab-active:bg-neutral-700 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" id="tabs-with-card-item-2" aria-selected="false" data-hs-tab="#tabs-with-card-2" aria-controls="tabs-with-card-2" role="tab" disabled>
                                    <span class="flex gap-x-6">
                                        <img src="images/icon/medicine.png"
                                            alt="Deskripsi gambar"
                                            class="shrink-0 mt-2 size-6 md:size-7 hs-tab-active:text-blue-600 text-gray-800 dark:hs-tab-active:text-blue-500 dark:text-neutral-200"
                                            width="24"
                                            height="24" />
                                        <span class="grow">
                                            <span class="block text-lg font-semibold hs-tab-active:text-blue-600 text-white dark:hs-tab-active:text-blue-500 dark:text-neutral-200">Informasi Obat Obatan</span>
                                            <span class="block mt-1 text-white dark:hs-tab-active:text-gray-200 dark:text-neutral-200 text-justify">Informasi obat-obatan mencakup petunjuk tentang nama,penggunaan, dosis, efek samping, dan interaksi untuk memastikan penggunaan yang aman dan efektif.</span>
                                        </span>
                                    </span>
                                </button>

                                <!-- buton3 -->
                                <button type="button" class="hs-tab-active:bg-white hs-tab-active:shadow-md hs-tab-active:hover:border-transparent text-start focus:outline-none p-4 md:p-5 rounded-xl dark:hs-tab-active:bg-neutral-700 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" id="tabs-with-card-item-3" aria-selected="false" data-hs-tab="#tabs-with-card-3" aria-controls="tabs-with-card-3" role="tab" disabled>
                                    <span class="flex gap-x-6">
                                        <img src="images/icon/jadwal.png"
                                            alt="Deskripsi gambar"
                                            class="shrink-0 mt-2 size-6 md:size-7 hs-tab-active:text-blue-600 text-gray-800 dark:hs-tab-active:text-blue-500 dark:text-neutral-200"
                                            width="24"
                                            height="24" />
                                        <span class="grow">
                                            <span class="block text-lg font-semibold hs-tab-active:text-blue-600 text-white dark:hs-tab-active:text-blue-500 dark:text-neutral-200">Jadwal Dokter</span>
                                            <span class="block mt-1 text-white dark:hs-tab-active:text-gray-200 dark:text-neutral-200 text-justify">Jadwal dokter adalah daftar waktu dan hari ketika dokter tersedia untuk melakukan konsultasi dan pemeriksaan pasien.</span>
                                        </span>
                                    </span>
                                </button>
                            </nav>
                            <!-- End Tab Navs -->
                        </div>
                        <!-- End Col -->

                        <div class="lg:col-span-6">
                            <div class="relative">
                                <!-- Tab Content -->
                                <div>
                                    <div id="tabs-with-card-1" role="tabpanel" aria-labelledby="tabs-with-card-item-1">
                                        <img class="shadow-xl shadow-gray-200 rounded-xl dark:shadow-gray-900/20 w-[800px] h-auto" src="images/hero3.png" alt="Features Image">
                                    </div>
                                </div>
                                <!-- End Tab Content -->

                                <!-- SVG Element -->
                                <div class="hidden absolute top-0 end-0 translate-x-20 md:block lg:translate-x-20">
                                    <svg class="w-16 h-auto text-orange-500" width="121" height="135" viewBox="0 0 121 135" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 16.4754C11.7688 27.4499 21.2452 57.3224 5 89.0164" stroke="currentColor" stroke-width="10" stroke-linecap="round" />
                                        <path d="M33.6761 112.104C44.6984 98.1239 74.2618 57.6776 83.4821 5" stroke="currentColor" stroke-width="10" stroke-linecap="round" />
                                        <path d="M50.5525 130C68.2064 127.495 110.731 117.541 116 78.0874" stroke="currentColor" stroke-width="10" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <!-- End SVG Element -->
                            </div>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Grid -->

                    <!-- Background Color -->
                    <div class="absolute inset-0 grid grid-cols-12 size-full">
                        <div class="col-span-full lg:col-span-7 lg:col-start-6 bg-gradient-to-r from-sky-300 to-blue-500 w-full h-5/6 rounded-[5rem] sm:h-3/4 lg:h-full dark:bg-neutral-1000"></div>
                    </div>
                    <!-- End Background Color -->
                </div>
            </div>
            <!-- End Features -->
            <!-- End Hero -->
        </section>

        <!-- hero4 -->
        <section>
            <div class="hero min-h-screen flex flex-col items-center justify-center">
                <div class="hero-content flex-col lg:flex-row-reverse">
                    <img
                        src="images/hero4.png"
                        class="max-w-sm rounded-lg mr-12" />
                    <div class="pr-24 ml-12 mr-18">
                        <h1 class="text-4xl font-bold">Fasilitas Mewah yang<br>Memanusiakan Manusia</h1>
                        <p class="py-6 text-justify">
                            RS Triharsi menawarkan fasilitas medis modern, ruang operasi berstandar internasional, dan tenaga medis profesional, memastikan perawatan kesehatan berkualitas tinggi dan nyaman bagi pasien.
                        </p>
                        <button class="btn btn-circle rounded-full !text-white transition-transform transform hover:scale-105" style="background: linear-gradient(90deg, #3B82F6, #6F3AFA);">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAA3dJREFUSEvllmvo3XMcx1/vNlbum0vG5pJsRCbXchdi057MWkumXGZ7Yg9QlJI8QCgJNcwDockl0jJR2tgkJVKU5Dq3uQ4jl7W373t9fzr77Zzz+59Ha+3z5HTO+X4+78/l/bmI7STaTrjsWMC29wOmAuOBdcB6SR4le2OO2PZ04EpgATC5BfI7sBZ4sTj0qKR/upzoBLZ9MHAbcAX8X5o/gc+ARHlsC+QbYKGkl4aBDwW2fTHwBLAP8D3wALBC0ruNUdt7AKcAZwA3ArtVh66V9OAg8IHAti8CVlbFu4BbJP09LArbhyTVwPn13WJJD/XT6Qts+1DgfWAv4DpJ93bVrPd/2zcAdxdnNwNnS1rT1h8EnEgT8e2Sbo6S7V2B04DVY2FwIeNyYH4CkDSjE9h20vQq8BVwRBhqO3V7E4iBBZJS96FiO7z4sHbAXEnP9SpsE7HtpcAiYImk+2u0S4D7qmIiPqcLuOrNLMQLu0PI2V3AXwAhyWRJ31UDjTON7kGSvh0jeDK3PzBJ0h+NzlYR254A/AV8JOmonpa5Hrinfl8u6dKxgFan3yrdcWoZLif0tmEbOGPwy0whSenLLWJ7SpypPXqNpEdGAH4WuKSy+/VBESfFSfU7kk5qtUiGw52l9j+H3ZLiSKf0sPt0SSHoFmlHvDuwEdggaWLbqu3G+1+ARJ7vyUjm9zjgsXar2V4NnAUcJilBbQtcjXxaDBxeWDxR0oZW1Bko8fqYpt5A+jUOpM8/DxeaUWl7F+DH+nZfSZuGATcMvlpSxt9WYntvIG2WKPvJM5Lm1SCasfu4pMt7H/fr4wyJ92qtjyyT699+1ussvwAIww+sb7K1zpX0dgXO58n1t1VDgavCG3XbXCjplWEMsj0JOK6++VjS19XGTcAdpb6vSTqvbWPQrE5dMvJS5yz5kcT2QuBhIAdB+veDTmDbTarXSDqzep82y3nTtRZzCmWp3FqBLpP0ZD+v+9W4WWkvFAJ9AswCji7zOyMyi32ppJ9abN+z3F5XlVaMbi6WtGSukKcGpaofcLMSe3WSqtxciSjnzg+lj3Pi/FofhUDZYJHn40BhcdpyoLQHSPrut2o8qzFRv5yFYDuDPi0xBzixECdzvZH1wNPAMkk5IDqlDXxAATseWDXsUrQdvWlAUrxOUoBHks4rcyRrIzze+YD/A+QUSC4iXvK4AAAAAElFTkSuQmCC" />
                            Reservasi
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <!-- Container -->
            <div class="mx-auto w-full max-w-7xl px-5 py-12 md:px-10 md:py-16 lg:py-20">
                <!-- Component -->
                <div class="flex flex-col items-center">
                    <!-- Heading Content -->
                    <div class="mb-8 md:mb-12 lg:mb-16">
                        <h2 class="mb-5 text-3xl font-bold md:text-5xl w-full max-w-3xl text-center"> What our clients are saying </h2>
                    </div>
                    <!-- Reviews -->
                    <div class="mb-12 md:mb-16 lg:mb-20">
                        <div class="grid grid-cols-1 justify-items-center gap-5 sm:grid-cols-1 md:grid-cols-2">
                            <!-- Review Item -->
                            <div class="flex flex-col gap-6 rounded-lg bg-gray-100 p-8 md:flex-row md:gap-16">
                                <div class="flex flex-none flex-col items-start justify-between">
                                    <div class="flex flex-col items-start gap-4">
                                        <div class="relative">
                                            <img src="https://firebasestorage.googleapis.com/v0/b/flowspark-1f3e0.appspot.com/o/Tailspark%20Images%2FPLaceholder%20Image%20Secondary.svg?alt=media&token=b8276192-19ff-4dd9-8750-80bc5f7d6844" alt="" class="h-14 w-14 rounded-full object-cover" />
                                            <svg class="absolute bottom-0 -right-3" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="17" cy="17" r="16" fill="black" stroke="#F2F2F7" stroke-width="2" />
                                                <path d="M24.2227 16.7246H21.0977C21.6872 15.9187 22.0035 14.9454 22.0004 13.9468C21.9986 12.695 21.5005 11.4949 20.6153 10.6097C19.7301 9.72455 18.5301 9.22645 17.2782 9.22461C17.1309 9.22461 16.9896 9.28314 16.8854 9.38733C16.7812 9.49151 16.7227 9.63282 16.7227 9.78016V12.9052C15.9167 12.3156 14.9434 11.9993 13.9449 12.0024C12.693 12.0042 11.493 12.5023 10.6078 13.3875C9.7226 14.2727 9.22449 15.4728 9.22266 16.7246C9.22266 16.872 9.28119 17.0133 9.38537 17.1174C9.48956 17.2216 9.63087 17.2802 9.77821 17.2802H12.9032C12.3137 18.0861 11.9974 19.0594 12.0004 20.0579C12.0023 21.3098 12.5004 22.5098 13.3856 23.395C14.2708 24.2802 15.4708 24.7783 16.7227 24.7802C16.87 24.7802 17.0113 24.7216 17.1155 24.6174C17.2197 24.5133 17.2782 24.372 17.2782 24.2246V21.0996C18.0841 21.6891 19.0575 22.0055 20.056 22.0024C21.3078 22.0005 22.5079 21.5024 23.3931 20.6173C24.2783 19.7321 24.7764 18.532 24.7782 17.2802C24.7782 17.1328 24.7197 16.9915 24.6155 16.8873C24.5113 16.7831 24.37 16.7246 24.2227 16.7246ZM13.9449 13.1135C14.4758 13.1113 15.0005 13.2273 15.4809 13.4531C15.9614 13.679 16.3856 14.0089 16.7227 14.4191V16.1691H10.3754C10.5093 15.3182 10.9424 14.5431 11.5967 13.983C12.251 13.4229 13.0836 13.1146 13.9449 13.1135ZM20.056 20.8913C19.5251 20.8935 19.0004 20.7775 18.5199 20.5516C18.0395 20.3258 17.6153 19.9959 17.2782 19.5857V17.8357H23.6254C23.4915 18.6865 23.0585 19.4617 22.4042 20.0218C21.7499 20.5819 20.9173 20.8902 20.056 20.8913Z" fill="white" />
                                            </svg>
                                        </div>
                                        <div class="flex flex-col items-start">
                                            <h6 class="text-sm font-bold md:text-base"> Jonathan Smith </h6>
                                            <p class="text-sm tracking-[0.2px] text-gray-500"> Small Business Owner </p>
                                            <div class="flex text-black mt-4">
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <p class="text-gray-500"> Using this payment app has been a game-changer for my business. It's incredibly user-friendly and secure. I can easily manage transactions, send invoices, and track payments all in one place. It has truly simplified my financial </p>
                            </div>
                            <!-- Review Item -->
                            <div class="flex flex-col gap-6 rounded-lg bg-gray-100 p-8 md:flex-row md:gap-16">
                                <div class="flex flex-none flex-col items-start justify-between">
                                    <div class="flex flex-col items-start gap-4">
                                        <div class="relative">
                                            <img src="https://firebasestorage.googleapis.com/v0/b/flowspark-1f3e0.appspot.com/o/Tailspark%20Images%2FPLaceholder%20Image%20Secondary.svg?alt=media&token=b8276192-19ff-4dd9-8750-80bc5f7d6844" alt="" class="h-14 w-14 rounded-full object-cover" />
                                            <svg class="absolute bottom-0 -right-3" width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="17" cy="17" r="16" fill="black" stroke="#F7F6F2" stroke-width="2" />
                                                <path d="M22.5564 15.0551V10.3329C22.5564 10.1856 22.4979 10.0442 22.3937 9.94006C22.2895 9.83588 22.1482 9.77734 22.0009 9.77734H12.0009C11.8898 9.77748 11.7814 9.81089 11.6895 9.87325C11.5977 9.93561 11.5266 10.0241 11.4855 10.1272C11.4444 10.2304 11.4351 10.3435 11.4589 10.4519C11.4827 10.5604 11.5384 10.6592 11.6189 10.7357L15.605 14.4996H12.0009C11.8535 14.4996 11.7122 14.5581 11.608 14.6623C11.5038 14.7665 11.4453 14.9078 11.4453 15.0551V19.7773C11.445 19.8528 11.4602 19.9275 11.4901 19.9968C11.52 20.0661 11.5638 20.1285 11.6189 20.1801L16.6189 24.9023C16.7228 24.9991 16.859 25.0536 17.0009 25.0551C17.0776 25.0557 17.1536 25.0391 17.2231 25.0065C17.3224 24.9642 17.4069 24.8935 17.4662 24.8033C17.5255 24.7131 17.5569 24.6075 17.5564 24.4996V20.3329H22.0009C22.1119 20.3328 22.2204 20.2994 22.3122 20.237C22.4041 20.1746 22.4752 20.0862 22.5163 19.983C22.5574 19.8799 22.5666 19.7668 22.5428 19.6583C22.5191 19.5499 22.4633 19.451 22.3828 19.3746L18.3967 15.6107H22.0009C22.1482 15.6107 22.2895 15.5521 22.3937 15.448C22.4979 15.3438 22.5564 15.2025 22.5564 15.0551Z" fill="white" />
                                            </svg>
                                        </div>
                                        <div class="flex flex-col items-start">
                                            <h6 class="text-sm font-bold md:text-base"> Jonathan Smith </h6>
                                            <p class="text-sm tracking-[0.2px] text-gray-500"> Small Business Owner </p>
                                            <div class="flex text-black mt-4">
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <p class="text-gray-500"> Using this payment app has been a game-changer for my business. It's incredibly user-friendly and secure. I can easily manage transactions, send invoices, and track payments all in one place. It has truly simplified my financial </p>
                            </div>
                            <!-- Review Item -->
                            <div class="flex flex-col gap-6 rounded-lg bg-gray-100 p-8 md:flex-row md:gap-16">
                                <div class="flex flex-none flex-col items-start justify-between">
                                    <div class="flex flex-col items-start gap-4">
                                        <div class="relative">
                                            <img src="https://firebasestorage.googleapis.com/v0/b/flowspark-1f3e0.appspot.com/o/Tailspark%20Images%2FPLaceholder%20Image%20Secondary.svg?alt=media&token=b8276192-19ff-4dd9-8750-80bc5f7d6844" alt="" class="h-14 w-14 rounded-full object-cover" />
                                            <svg class="absolute bottom-0 -right-3" width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="17" cy="17" r="16" fill="black" stroke="#F7F6F2" stroke-width="2" />
                                                <path d="M24.6605 18.7004L22.7646 11.5824C22.7202 11.4101 22.6218 11.2565 22.4838 11.1441C22.3458 11.0318 22.1754 10.9665 21.9977 10.958C21.8199 10.9495 21.6441 10.998 21.4959 11.0967C21.3478 11.1953 21.2351 11.3387 21.1744 11.506L19.7438 15.3324H14.2577L12.8271 11.506C12.7664 11.3387 12.6537 11.1953 12.5056 11.0967C12.3574 10.998 12.1816 10.9495 12.0038 10.958C11.8261 10.9665 11.6557 11.0318 11.5177 11.1441C11.3797 11.2565 11.2813 11.4101 11.2369 11.5824L9.34103 18.7004C9.28309 18.9221 9.29465 19.1562 9.37414 19.3711C9.45363 19.586 9.59722 19.7712 9.78547 19.9018L16.3688 24.4574C16.5151 24.5598 16.6845 24.6243 16.8619 24.6449H17.1396C17.317 24.6243 17.4864 24.5598 17.6327 24.4574L24.216 19.9018C24.4043 19.7712 24.5479 19.586 24.6274 19.3711C24.7068 19.1562 24.7184 18.9221 24.6605 18.7004ZM10.4174 18.9852L11.091 16.4435H13.4938L15.8549 22.756L10.4174 18.9852ZM18.1466 22.756L20.5077 16.4435H22.9105L23.5841 18.9852L18.1466 22.756Z" fill="white" />
                                            </svg>
                                        </div>
                                        <div class="flex flex-col items-start">
                                            <h6 class="text-sm font-bold md:text-base"> Jonathan Smith </h6>
                                            <p class="text-sm tracking-[0.2px] text-gray-500"> Small Business Owner </p>
                                            <div class="flex text-black mt-4">
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <p class="text-gray-500"> Using this payment app has been a game-changer for my business. It's incredibly user-friendly and secure. I can easily manage transactions, send invoices, and track payments all in one place. It has truly simplified my financial </p>
                            </div>
                            <!-- Review Item -->
                            <div class="flex flex-col gap-6 rounded-lg bg-gray-100 p-8 md:flex-row md:gap-16">
                                <div class="flex flex-none flex-col items-start justify-between">
                                    <div class="flex flex-col items-start gap-4">
                                        <div class="relative">
                                            <img src="https://firebasestorage.googleapis.com/v0/b/flowspark-1f3e0.appspot.com/o/Tailspark%20Images%2FPLaceholder%20Image%20Secondary.svg?alt=media&token=b8276192-19ff-4dd9-8750-80bc5f7d6844" alt="" class="h-14 w-14 rounded-full object-cover" />
                                            <svg class="absolute bottom-0 -right-3" width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="17" cy="17" r="16" fill="black" stroke="#F7F6F2" stroke-width="2" />
                                                <path d="M25.1744 13.5068L23.0772 15.5971C22.6606 20.4512 18.5633 24.2221 13.6675 24.2221C12.6606 24.2221 11.8272 24.0623 11.1953 23.7498C10.6883 23.4929 10.48 23.2221 10.4244 23.1387C10.3785 23.0689 10.3489 22.9896 10.3378 22.9068C10.3267 22.8239 10.3345 22.7396 10.3605 22.6602C10.3866 22.5808 10.4302 22.5083 10.4881 22.448C10.5461 22.3878 10.6169 22.3414 10.6953 22.3123C10.7092 22.3054 12.3481 21.6804 13.4106 20.479C12.7516 20.0098 12.1725 19.4377 11.6953 18.7846C10.7439 17.4929 9.73695 15.2498 10.3411 11.9026C10.3601 11.8031 10.4056 11.7106 10.4728 11.6348C10.5401 11.559 10.6265 11.5028 10.7231 11.4721C10.8199 11.4404 10.9236 11.4359 11.0228 11.4592C11.122 11.4824 11.2129 11.5325 11.2856 11.604C11.3064 11.6318 13.6189 13.9096 16.4453 14.6457V14.2221C16.448 13.7816 16.5375 13.346 16.7086 12.9401C16.8796 12.5342 17.129 12.1659 17.4424 11.8564C17.7558 11.5469 18.1271 11.3021 18.5351 11.1361C18.9431 10.97 19.3798 10.886 19.8203 10.8887C20.3984 10.897 20.9645 11.0548 21.4635 11.3469C21.9625 11.639 22.3773 12.0553 22.6675 12.5554H24.7786C24.8883 12.5551 24.9956 12.5872 25.0871 12.6477C25.1785 12.7083 25.25 12.7946 25.2925 12.8957C25.3325 12.9983 25.3427 13.1102 25.3218 13.2183C25.3009 13.3264 25.2498 13.4265 25.1744 13.5068Z" fill="white" />
                                            </svg>
                                        </div>
                                        <div class="flex flex-col items-start">
                                            <h6 class="text-sm font-bold md:text-base"> Jonathan Smith </h6>
                                            <p class="text-sm tracking-[0.2px] text-gray-500"> Small Business Owner </p>
                                            <div class="flex text-black mt-4">
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                                <div class="mr-1 w-3.5 flex-none">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.68021 0.92574C6.31574 -0.00157559 7.68426 -0.00157684 8.31979 0.925739L9.49972 2.6474C9.70777 2.95097 10.0141 3.17354 10.3671 3.27759L12.3691 3.86775C13.4474 4.18562 13.8703 5.48717 13.1848 6.37815L11.912 8.03235C11.6876 8.32402 11.5706 8.68415 11.5807 9.05203L11.6381 11.1384C11.669 12.2622 10.5618 13.0666 9.50263 12.6899L7.53608 11.9906C7.18933 11.8673 6.81067 11.8673 6.46392 11.9906L4.49738 12.6899C3.43816 13.0666 2.331 12.2622 2.3619 11.1384L2.41929 9.05203C2.4294 8.68415 2.31239 8.32402 2.08797 8.03235L0.815197 6.37815C0.129656 5.48717 0.552554 4.18562 1.63087 3.86775L3.63289 3.27759C3.98589 3.17354 4.29223 2.95097 4.50028 2.6474L5.68021 0.92574Z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <p class="text-gray-500"> Using this payment app has been a game-changer for my business. It's incredibly user-friendly and secure. I can easily manage transactions, send invoices, and track payments all in one place. It has truly simplified my financial </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </section>

        <!-- hero5 -->
        <section class="flex items-center justify-center">
            <div class="hero-content text-center ">
                <div class="card flex-shrink-0 lg:w-[1000px] lg:h-[300px] md:w-[700px] md:h-[300px] sm:w-[400px] sm:h-[400px] shadow-2xl bg-base-100 bg-gradient-to-r from-sky-400 to-blue-600 lg:mt-8 mb-24 md:-mt-12 ">
                    <div class="card-body text-white">
                        <h1 class="items-center font-bold text-3xl text-white mt-8">Reservasi Pelayanan Kami Sekarang</h1>
                        <p class="text-lg text-white mt-4">Rumah sakit adalah bagian integral dari suatu organisasi sosial dan kesehatan<br> dengan fungsi menyediakan pelayanan paripurna (komprehensif).</p>
                        <div class="card-actions justify-center ">
                            <button class="btn btn-circle !text-white transition-transform transform hover:scale-105" style="background: linear-gradient(90deg, #3B82F6, #6F3AFA);">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAghJREFUSEvtlj1rVUEQhp9XRYkoSrqghY1YKQZjkRRGC0EIohaKiPaWmp8hSMh/UEiqFKJJUPAjAQsJpMgPUBA7CwvBYHS8I3tl7+Tcw56bXFLELc+ZnWff2ZnZETu0tENc+go2szHgg6SfUWAl2MyOAmeAPYURceffc1szuwAsAkst+ESEbwKb2UPgEbCvEDot6UGAngPetfwcTN9fRngH2MyOAZ8LgW42JWkyQPcCH4Hjwc88cK2tPII9PG/TBle+WnOIDUnLVf/NbDj5OZz993selbTi3yL4IvA6GV+S9KZUvZmNAKckPfU9Af67JeK6pGdtf9sCNrPzwCvAFd6RNJPgZ5OQ+5JmcxFbBpvZaMrePKz3JD1J8COSvtWWk5k1CnWqUy+ZQ8Gx5cqrrqtnxQnq4R2ocPwLuNsO+baBC6A3Jc3VJWZjxek6XtQo3QRNe9Ylve8pq5ODBeBAhZoN4FZUmu25kpdnsWIzuwx4HXaDep0+D13sJLAG7G81lI6+0AT8owvUE+lG3hza8LoqaQL2EonL26BDO5T2G+xQf+785alc/VC8Dlytg6au1bUhFYe69LEIyfUf/O+Z3cogUBJ9fxankuG4JB+H/q4IHgK+lHjsweaEpE+V4JSJPrg9bjBhlpxhVtLt3LDbeDsInI4RKSEEG286a5K+xr19HejrDrr7wH8AOp0lLgroS2YAAAAASUVORK5CYII=" />
                                Jadwal Dokter
                            </button>
                            <button class="btn btn-circle !text-white transition-transform transform hover:scale-105" style="background: linear-gradient(90deg, #3B82F6, #6F3AFA);">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAA3dJREFUSEvllmvo3XMcx1/vNlbum0vG5pJsRCbXchdi057MWkumXGZ7Yg9QlJI8QCgJNcwDockl0jJR2tgkJVKU5Dq3uQ4jl7W373t9fzr77Zzz+59Ha+3z5HTO+X4+78/l/bmI7STaTrjsWMC29wOmAuOBdcB6SR4le2OO2PZ04EpgATC5BfI7sBZ4sTj0qKR/upzoBLZ9MHAbcAX8X5o/gc+ARHlsC+QbYKGkl4aBDwW2fTHwBLAP8D3wALBC0ruNUdt7AKcAZwA3ArtVh66V9OAg8IHAti8CVlbFu4BbJP09LArbhyTVwPn13WJJD/XT6Qts+1DgfWAv4DpJ93bVrPd/2zcAdxdnNwNnS1rT1h8EnEgT8e2Sbo6S7V2B04DVY2FwIeNyYH4CkDSjE9h20vQq8BVwRBhqO3V7E4iBBZJS96FiO7z4sHbAXEnP9SpsE7HtpcAiYImk+2u0S4D7qmIiPqcLuOrNLMQLu0PI2V3AXwAhyWRJ31UDjTON7kGSvh0jeDK3PzBJ0h+NzlYR254A/AV8JOmonpa5Hrinfl8u6dKxgFan3yrdcWoZLif0tmEbOGPwy0whSenLLWJ7SpypPXqNpEdGAH4WuKSy+/VBESfFSfU7kk5qtUiGw52l9j+H3ZLiSKf0sPt0SSHoFmlHvDuwEdggaWLbqu3G+1+ARJ7vyUjm9zjgsXar2V4NnAUcJilBbQtcjXxaDBxeWDxR0oZW1Bko8fqYpt5A+jUOpM8/DxeaUWl7F+DH+nZfSZuGATcMvlpSxt9WYntvIG2WKPvJM5Lm1SCasfu4pMt7H/fr4wyJ92qtjyyT699+1ussvwAIww+sb7K1zpX0dgXO58n1t1VDgavCG3XbXCjplWEMsj0JOK6++VjS19XGTcAdpb6vSTqvbWPQrE5dMvJS5yz5kcT2QuBhIAdB+veDTmDbTarXSDqzep82y3nTtRZzCmWp3FqBLpP0ZD+v+9W4WWkvFAJ9AswCji7zOyMyi32ppJ9abN+z3F5XlVaMbi6WtGSukKcGpaofcLMSe3WSqtxciSjnzg+lj3Pi/FofhUDZYJHn40BhcdpyoLQHSPrut2o8qzFRv5yFYDuDPi0xBzixECdzvZH1wNPAMkk5IDqlDXxAATseWDXsUrQdvWlAUrxOUoBHks4rcyRrIzze+YD/A+QUSC4iXvK4AAAAAElFTkSuQmCC" />
                                Reservasi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>





        <footer class="footer text-base-content p-24 bg-gradient-to-r from-sky-400 to-blue-600 text-white">
            <aside>
                <h1 class="text-2xl font-bold text-white">
                    Rumah Sakit Triharsi<br>Surakarta
                </h1>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.1571952622867!2d110.82240851083284!3d-7.557833274600829!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a1692069b4941%3A0x2e97c06a32afa777!2sRS%20Triharsi!5e0!3m2!1sid!2sid!4v1729348019598!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <p class="text-lg text-white">
                    Motto.
                    <br />
                    <span class="font-bold">"Karena Anda Berharga"</span>
                </p>
            </aside>
            <nav class="ml-48 text-white">
                <h6 class="footer-title">Telepon IGD</h6>
                <a class="link link-hover">(0271) 656903, 646061</a>
                <h6 class="footer-title mt-6">Alamat</h6>
                <a class="link link-hover">Jalan Monginsidi No. 82 Gilingan,<br>Banjarsari, Surakarta 57134</a>
                <div class="grid grid-flow-col gap-4 mt-6">
                    <a>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            class="fill-current">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                        </svg>
                    </a>
                    <a>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            class="fill-current">
                            <path
                                d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
                        </svg>
                    </a>
                    <a>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            class="fill-current">
                            <path
                                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
                        </svg>
                    </a>
                </div>
            </nav>
            <nav class="-ml-12 text-white">
                <h6 class="footer-title">Telepon</h6>
                <a class="link link-hover">TELPON
                    (0271) 656903, 646061<br>
                    Fax. (0271) 643931<br>
                    HOTLINE 2936000</a>
                <h6 class="footer-title mt-6">Email</h6>
                <a class="link link-hover">kontak_kami@rstriharsi.com</a>
            </nav>
        </footer>
        <footer class="footer footer-center bg-gradient-to-r from-sky-400 to-blue-600 text-base-content p-4 -mt-20 ">
            <aside>
                <p class="text-white">Copyright © 2024 - This website was created and developed by Khoirul Rohim Arif Rifa'i</p>
            </aside>
        </footer>
    </body>












    <script>
        // Array gambar untuk background
        const images = [
            'images/bg1.png',
            'images/bg22.png',
            'images/bg33.png'
        ];

        let currentIndex = 0; // Indeks gambar saat ini
        const backgroundSlider = document.getElementById('background-slider');

        // Set gambar pertama
        backgroundSlider.style.backgroundImage = `url(${images[currentIndex]})`;

        // Fungsi untuk mengganti background dengan animasi fade langsung tanpa jeda
        function changeBackground() {
            // Tambahkan kelas untuk animasi fade out
            backgroundSlider.classList.add('fade-out');

            setTimeout(() => {
                // Ganti gambar dan langsung fade in setelah fade out selesai
                currentIndex = (currentIndex + 1) % images.length;
                backgroundSlider.style.backgroundImage = `url(${images[currentIndex]})`;

                // Setelah fade-out selesai, langsung fade-in gambar baru
                backgroundSlider.classList.remove('fade-out');
                backgroundSlider.classList.add('fade-in');
            }, 0); // Tidak ada jeda, fade langsung

            setTimeout(() => {
                // Hapus kelas fade-in agar siap untuk animasi berikutnya
                backgroundSlider.classList.remove('fade-in');
            }, 1000); // Durasi fade in
        }

        // Ganti background setiap 3 detik
        setInterval(changeBackground, 3000);

        document.getElementById('cekLayananButton').addEventListener('click', function() {
            document.getElementById('layanan').scrollIntoView({
                behavior: 'smooth'
            });
        });
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
    </script>


    </html>

</php>