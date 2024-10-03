<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Vesperr Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css" rel="stylesheet') }}">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Vesperr
  * Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename">SIPENMAS</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda<br></a></li>
                    <li class="dropdown"><a href="#"><span>Seputar Ormas</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Dasar Hukum</a></li>
                            <li><a href="#">Pengertian</a></li>
                            <li><a href="#">Tujuan & Fungsi</a></li>
                            <li><a href="#">Hak & Kwajiban </a></li>
                        </ul>
                    </li>
                    <li><a href="#services">Layanan Ormas</a></li>
                    <li><a href="#alt-services">Sebaran Ormas</a></li>
                    <li><a href="#portfolio">Data Ormas</a></li>

                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            {{-- <a class="btn-getstarted" href="index.html#about">Login</a> --}}

            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-getstarted">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-getstarted">
                            Login
                        </a>

                        {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Register
                            </a>
                        @endif --}}
                    @endauth
                </nav>
            @endif

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1>SIPENMAS</h1>
                        <p>Sistem Pendataan Ormas</p>
                        <div class="d-flex">
                            <a href="#about" class="btn-get-started">Next</a>
                            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                                class="glightbox btn-watch-video d-flex align-items-center"></a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img">
                        <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->



        <!-- About Section -->
        <section id="about" class="about section">
            <div class="container section-title">
                <h2>Tentang SIPENMAS</h2>
                <p>Dalam era digitalisasi yang berkembang pesat saat ini, pemanfaatan teknologi informasi menjadi suatu
                    keharusan untuk meningkatkan efisiensi, transparansi, dan akuntabilitas dalam pengelolaan berbagai
                    aspek kegiatan organisasi kemasyarakatan. Memahami pentingnya hal ini, Badan Kesatuan Bangsa dan
                    Politik (Kesbangpol) Kabupaten Magelang bermaksud untuk mengembangkan Sistem Informasi Layanan
                    Organisasi Kemasyarakatan (SIPENMAS).</p>
                <p>SIPENMAS merupakan suatu platform berbasis teknologi informasi yang dirancang untuk membantu proses
                    pengelolaan data dan informasi terkait organisasi kemasyarakatan (ORMAS) di wilayah Kabupaten
                    Magelang. Melalui SIPENMAS, diharapkan akan tercipta sistem yang terintegrasi dan terpusat untuk
                    memantau, mengelola, dan mengkoordinasikan berbagai kegiatan serta informasi terkait ORMAS secara
                    lebih efektif dan efisien.</p>
                <p>Pembuatan SIPENMAS ini dipandang sebagai langkah strategis untuk memperkuat peran dan fungsi Badan
                    Kesatuan Bangsa dan Politik Kabupaten Magelang dalam mendukung pembangunan dan pemberdayaan
                    masyarakat, serta dalam menjaga stabilitas dan kedamaian di tengah-tengah pluralitas dan keragaman
                    sosial masyarakat.</p>
                <p>Melalui pengembangan SIPENMAS, Badan Kesatuan Bangsa dan Politik Kabupaten Magelang berharap dapat
                    mencapai beberapa tujuan, antara lain:</p>
                <ul>
                    <li>Meningkatkan efisiensi administrasi: Mempercepat proses pengelolaan administrasi ORMAS, mulai
                        dari pendataan, pemantauan, hingga pelaporan, sehingga waktu dan sumber daya yang digunakan
                        dapat dimanfaatkan secara optimal;</li>
                    <li>Memperkuat koordinasi dan komunikasi: Memfasilitasi komunikasi antara Badan Kesatuan Bangsa dan
                        Politik dengan ORMAS secara lebih efektif, sehingga informasi terkait kegiatan dan kebijakan
                        dapat disampaikan dengan cepat dan tepat kepada seluruh pihak terkait;</li>
                    <li>Meningkatkan transparansi dan akuntabilitas: Memungkinkan pemantauan dan evaluasi yang lebih
                        baik terhadap berbagai kegiatan ORMAS, serta memastikan bahwa pengelolaan sumber daya dan
                        informasi dilakukan secara transparan dan akuntabel;</li>
                    <li>Memperkuat keamanan dan privasi data: Menjamin keamanan dan privasi data ORMAS yang terkelola
                        dalam sistem, sehingga informasi sensitif dan penting dapat terlindungi dengan baik dari akses
                        yang tidak sah;</li>
                    <li>Mendorong inovasi dan pengembangan berkelanjutan: Menjadi landasan untuk pengembangan lebih
                        lanjut dalam meningkatkan kualitas layanan dan pemanfaatan teknologi informasi dalam mendukung
                        berbagai kegiatan ORMAS di masa mendatang.</li>
                </ul>
                <p>Dengan demikian, pembuatan SIPENMAS ini diharapkan dapat memberikan kontribusi yang signifikan dalam
                    memperkuat peran dan fungsi Badan Kesatuan Bangsa dan Politik Kabupaten Magelang dalam mendukung
                    terwujudnya masyarakat yang berkeadilan, sejahtera, dan berbudaya. Selain itu, pengembangan SIPENMAS
                    juga diharapkan dapat meningkatkan efektivitas pelayanan publik dan pembangunan berkelanjutan.</p>
            </div>
        </section>


        <!-- Stats Section -->

        <!-- Services Section -->
        <section id="services" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Layanan</h2>

            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4 justify-content-center text-center">

                    {{-- <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <i class="bi bi-activity"></i>
                            <h4><a href="" class="stretched-link">Pendaftaran Ormas</a></h4>
                            <p>Ormas baru/ Lama dapat mendaftar langsung di Rumah Dhanan</p>
                        </div>
                    </div> --}}

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <i class="bi bi-activity"></i>
                            <h4><a href="{{ route('login') }}" class="stretched-link">Pendaftaran Ormas</a></h4>
                            <!-- Ganti href dengan route login -->
                            <p>Ormas baru/ Lama dapat mendaftar langsung di Rumah Dhanan</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <i class="bi bi-bounding-box-circles"></i>
                            <h4><a href="" class="stretched-link">Penerbitan SKT</a></h4>
                            <p>Ormas Kabupaten mana yaa?? disitu deh</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <i class="bi bi-calendar4-week"></i>
                            <h4><a href="" class="stretched-link">Pelaporan kegiatan</a></h4>
                            <p>Ormas wajib melampirkan bukti pembayaran biaya kegiatan ke Dhanan baik secara langsung
                                atau tidak</p>
                        </div>
                    </div><!-- End Service Item -->

                </div>
            </div>

            <!-- Alt Services Section -->
            <section id="alt-services" class="alt-services section">

                <div class="container" data-aos="fade-up" data-aos-delay="100">

                    <div class="row gy-4">

                        <!-- Left Column: Google Maps Embed -->
                        <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                            <div class="service-item position-relative">
                                <div class="img">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31685.633176167335!2d115.21696253167642!3d-8.67045896368152!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2391bfa3780a5%3A0x8cf7553e5b1f1d96!2sDenpasar%2C%20Bali!5e0!3m2!1sen!2sid!4v1693923394006!5m2!1sen!2sid"
                                        width="100%" height="450" style="border:0;" allowfullscreen=""
                                        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            </div>
                        </div><!-- End Google Maps Embed -->

                        <!-- Right Column: Table of Provinces and Ormas -->
                        <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="300">
                            <div class="service-item position-relative">
                                <div class="details">
                                    <h3>Daftar Provinsi dan Jumlah Ormas</h3>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Provinsi</th>
                                                <th>Jumlah Ormas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Bali</td>
                                                <td>50</td>
                                            </tr>
                                            <tr>
                                                <td>Jawa Barat</td>
                                                <td>120</td>
                                            </tr>
                                            <tr>
                                                <td>Jawa Timur</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td>Sumatera Utara</td>
                                                <td>80</td>
                                            </tr>
                                            <!-- Tambahkan lebih banyak provinsi sesuai kebutuhan -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- End Table -->

                    </div>

                </div>

            </section><!-- /Alt Services Section -->



            <!-- Portfolio Section -->
            <section id="portfolio" class="portfolio section">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>Data Ormas</h2>
                </div><!-- End Section Title -->
            
                <div class="container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ormas</th>
                                <th>Bentuk Organisasi</th>
                                <th>Status</th>
                                <th>Alamat Sekretariat</th>
                                <th>Kontak Person</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ormas as $index => $orma)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $orma->nama_ormas }}</td>
                                    <td>
                                        @if(is_array($orma->bentuk_organisasi))
                                            @foreach ($orma->bentuk_organisasi as $bentuk)
                                                <span class="badge badge-secondary">{{ $bentuk }}</span>
                                            @endforeach
                                        @else
                                            {{ $orma->bentuk_organisasi ?? 'Tidak ada' }}
                                        @endif
                                    </td>
                                    <td>{{ $orma->status->status ?? 'Unknown' }}</td>
                                    <td>{{ $orma->alamat_sekretariat }}</td>
                                    <td>{{ $orma->kontak_person }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $ormas->links() }} <!-- Pastikan ini ada di luar <tbody> --> --}}
                </div>
            
            </section>
            <!-- /Portfolio Section -->



            <!-- Contact Section -->
            {{-- <section id="contact" class="contact section">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>Contact</h2>
                    <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
                </div><!-- End Section Title -->

                <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

                    <div class="row gy-4">

                        <div class="col-lg-5">
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h3>Address</h3>
                                    <p>A108 Adam Street, New York, NY 535022</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-telephone flex-shrink-0"></i>
                                <div>
                                    <h3>Call Us</h3>
                                    <p>+1 5589 55488 55</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h3>Email Us</h3>
                                    <p>info@example.com</p>
                                </div>
                            </div><!-- End Info Item -->

                        </div>

                        <div class="col-lg-7">
                            <form action="forms/contact.php" method="post" class="php-email-form"
                                data-aos="fade-up" data-aos-delay="500">
                                <div class="row gy-4">

                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Your Name" required="">
                                    </div>

                                    <div class="col-md-6 ">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Your Email" required="">
                                    </div>

                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="subject"
                                            placeholder="Subject" required="">
                                    </div>

                                    <div class="col-md-12">
                                        <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <div class="loading">Loading</div>
                                        <div class="error-message"></div>
                                        <div class="sent-message">Your message has been sent. Thank you!</div>

                                        <button type="submit">Send Message</button>
                                    </div>

                                </div>
                            </form>
                        </div><!-- End Contact Form -->

                    </div>

                </div>

            </section> --}}
            <!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer">

        <div class="container">
            <div class="copyright text-center ">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">DhananWeb</strong> <span>All Rights
                        Reserved</span></p>
            </div>
            <div class="social-links d-flex justify-content-center">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="">TRPLBOOST</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
