<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="{{ asset('assetslp/css/style.css') }}" rel="stylesheet">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'>
    <link rel="shortcut icon" href="{{ asset('assetslp/images/favicon.png') }}" type="image/webp">
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon.png">
    <link rel="icon" href="{{ asset('assetslp/images/favicon.png') }}" type="image/webp">
    <title>Linktree template</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <style>
        /* Loader Styling */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #191d2b;
            z-index: 9999;
        }

        .loader .block {
            width: 20%;
            height: 100%;
            background: #161616;
            transform-origin: top;
        }

        /* Pastikan halaman tersembunyi di awal */
        .page-full-wrap {
            opacity: 0;
        }

        .navigasi {
            display: flex;
            justify-content: center;
            font-family: "Poppins", sans-serif;
            font-weight: 500;
        }

        .navigasi a {
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Snowfall Background Animation -->
    <section class="animated-background">
        <div id="stars1"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
    </section>
    <!-- End of Snowfall Background Animation -->

    <div class="min-h-full flex-h-center" id="background_div">
        <input type="hidden" value="https://bio.link" id="app-url">
        <input type="hidden" value="null" id="is-featured">
        <canvas id="bg-canvas" class="background-overlay"></canvas>
        </input>
        </input>

        <div class="mt-48 page-full-wrap relative body">
            <div class="">
                <input type="hidden" value="creator-page" id="page-type">
                <img class="display-image m-auto" data-src="{{ asset('assetslp/images/logo.png') }}"
                    src="{{ asset('assetslp/images/manzstr.jpg') }}" alt="Manz Str" />
                <h2 class="page-title page-text-color page-text-font mt-16 text-center">Manz Str</h2>
                <p class="desk" style="color: aliceblue;">Hati Hati terhadap Penipuan Yang Mengatas Namakan Store
                    Kami, Cek Keaslian Sosmed Kami Klik Link Di Bawah</p>
                <div class="navigasi" style="text-decoration: none;">
                    <a href="{{ route('welcome') }}">Lihat Sosmed Kami</a>
                </div>
            </div>
            <div class="page-item-wrap relative">
                <div class="page-item flex-both-center absolute"></div>
                <a target="_blank" class="page-item-each py-10 flex-both-center" href="https://wa.me/6281223937340"
                    data-id="261685" data-type="page_item">
                    <img class="link-each-image" height="500px" data-src="{{ asset('assetslp/images/wa.png') }}"
                        src="{{ asset('assetslp/images/wa.png') }}" alt="Instagram @manzweb" />
                    <span class=" item-title text-center">WA Rekber (Aktif)</span>
                </a>
            </div>
            <div class="page-item-wrap relative">
                <div class="page-item flex-both-center absolute"></div>
                <a target="_blank" class="page-item-each py-10 flex-both-center" href="https://wa.me/6283836310430"
                    data-id="261685" data-type="page_item">
                    <img class="link-each-image" height="500px" data-src="{{ asset('assetslp/images/wa.png') }}"
                        src="{{ asset('assetslp/images/wa.png') }}" alt="Instagram @manzweb" />
                    <span class=" item-title text-center">WA Japost 1 (Kenon)</span>
                </a>
            </div>
            <div class="page-item-wrap relative">
                <div class="page-item flex-both-center absolute"></div>
                <a target="_blank" class="page-item-each py-10 flex-both-center" href="https://wa.me/6283844800138"
                    data-id="261685" data-type="page_item">
                    <img class="link-each-image" height="500px" data-src="{{ asset('assetslp/images/wa.png') }}"
                        src="{{ asset('assetslp/images/wa.png') }}" alt="Instagram @manzweb" />
                    <span class=" item-title text-center">WA Japost 2 (Kenon)</span>
                </a>
            </div>
            <div class="page-item-wrap relative">
                <div class="page-item flex-both-center absolute"></div>
                <a target="_blank" class="page-item-each py-10 flex-both-center"
                    href="https://chat.whatsapp.com/J2ofZuqR2ox5yoJDDThFIB" data-id="261685" data-type="page_item">
                    <img class="link-each-image" height="500px" data-src="{{ asset('assetslp/images/wa.png') }}"
                        src="{{ asset('assetslp/images/wa.png') }}" alt="Instagram @manzweb" />
                    <span class=" item-title text-center">GRUP STOK¹ MANZ STORE</span>
                </a>
            </div>
            <div class="page-item-wrap relative">
                <div class="page-item flex-both-center absolute"></div>
                <a target="_blank" class="page-item-each py-10 flex-both-center"
                    href="https://chat.whatsapp.com/J2ofZuqR2ox5yoJDDThFIB" data-id="261685" data-type="page_item">
                    <img class="link-each-image" height="500px" data-src="{{ asset('assetslp/images/wa.png') }}"
                        src="{{ asset('assetslp/images/wa.png') }}" alt="Instagram @manzweb" />
                    <span class=" item-title text-center">GRUP STOK¹ MANZ STORE</span>
                </a>
            </div>
            <div class="page-item-wrap relative">
                <div class="page-item flex-both-center absolute"></div>
                <a target="_blank" class="page-item-each py-10 flex-both-center"
                    href="https://chat.whatsapp.com/HzmDZ34jp2e58knqC0kZBz" data-id="261685" data-type="page_item">
                    <img class="link-each-image" height="500px" data-src="{{ asset('assetslp/images/wa.png') }}"
                        src="{{ asset('assetslp/images/wa.png') }}" alt="Instagram @manzweb" />
                    <span class=" item-title text-center">GRUP STOK³ MANZ STORE </span>
                </a>
            </div>
            <div class="page-item-wrap relative">
                <div class="page-item flex-both-center absolute"></div>
                <a target="_blank" class="page-item-each py-10 flex-both-center"
                    href="https://chat.whatsapp.com/FXuHelsbOdOBkSRos5yAinl" data-id="261685" data-type="page_item">
                    <img class="link-each-image" height="500px" data-src="{{ asset('assetslp/images/wa.png') }}"
                        src="{{ asset('assetslp/images/wa.png') }}" alt="Instagram @manzweb" />
                    <span class=" item-title text-center">GRUP JB¹ MANZ STORE</span>
                </a>
            </div>
        </div>
    </div>
    </div>

    <!-- Loader -->
    <div class="loader">
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
        <div class="block"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        // Pastikan loader terlihat di awal
        gsap.set(".loader", {
            display: "flex",
            opacity: 1
        });
        gsap.set(".block", {
            scaleY: 1
        });

        // Pastikan isi halaman tersembunyi di awal
        gsap.set(".page-full-wrap", {
            opacity: 0,
            y: 20
        });

        // Animasi loader
        gsap.to(".block", {
            duration: 1.2,
            scaleY: 0,
            stagger: 0.2,
            ease: "power4.inOut",
            onComplete: () => {
                gsap.to(".loader", {
                    duration: 0.6,
                    opacity: 0,
                    ease: "power2.out",
                    onComplete: () => {
                        document.querySelector(".loader").style.display = "none";

                        // Pastikan elemen sudah muncul tapi tetap transparan dulu
                        const pageContent = document.querySelector(".page-full-wrap");
                        pageContent.style.display = "block";

                        // Animasi muncul dengan delay setelah loader hilang
                        gsap.to(pageContent, {
                            opacity: 1,
                            y: 0,
                            duration: 2,
                            delay: 0, // Delay supaya tidak muncul tiba-tiba
                            ease: "elastic"
                        });

                        // Animasi bagian sosial media
                        gsap.from(".social", {
                            opacity: 0,
                            y: 20,
                            duration: 2,
                            delay: 0.2, // Muncul setelah halaman utama
                            ease: "elastic"
                        });
                    }
                });
            }
        });
    </script>



</body>

<!--
    A different snowfall
    <script src="{{ asset('assetslp/js/snowfall.js') }}"></script>
    -->

</html>
