@extends('layouts.bubble')

@section('content')
    {{-- navbar --}}
    <div class="navbar-container">
        <div class="navbar d-flex align-items-center justify-content-around me-2">
            <a href="#">
                <img src="{{ asset('images/web-icon.jpg') }}" class="nav-logo rounded" alt="logo">
            </a>
            <div class="nav-menu gap-3">
                <a href="#home" class="nav-link fw-semibold text-uppercase">home</a>
                <a href="#about" class="nav-link fw-semibold text-uppercase">about us</a>
                {{-- <a href="#products" class="nav-link fw-semibold text-uppercase">products</a> --}}
                <a href="#services" class="nav-link fw-semibold text-uppercase">services</a>
                <a href="#testimony" class="nav-link fw-semibold text-uppercase">testimony</a>
                {{-- <a href="#contact" class="nav-link fw-semibold text-uppercase">contact</a> --}}
            </div>
            <div class="btn-group gap-3">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Welcome back, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/my-dashboard">
                                <i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard
                            </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-left"></i> Logout 
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <a href="/auth" class="btn-login">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Login
                    </a>
                @endauth
            </div>
            <div id="nav-side" class="nav-side">
                <a href="#home" class="nav-link side fw-semibold text-uppercase">home</a>
                <a href="#about" class="nav-link side fw-semibold text-uppercase">about us</a>
                <!-- <a href="#products" class="nav-link side fw-semibold text-uppercase">products</a> -->
                <a href="#services" class="nav-link side fw-semibold text-uppercase">services</a>
                <a href="#testimony" class="nav-link side fw-semibold text-uppercase">testimony</a>
                <!-- <a href="#contact" class="nav-link side fw-semibold text-uppercase">contact</a> -->
    
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown text-center">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Welcome back, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu text-center">
                            <li><a class="dropdown-item" href="/my-dashboard">
                                <i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard
                            </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-left"></i> Logout 
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                        <a href="/auth" class="btn-login side">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Login
                        </a>
                        <!-- <a href="#" class="btn-signup">Sign up</a> -->
                    @endauth
                </ul>
            </div>
            <label class="hamburger">
                <input type="checkbox">
                <svg viewBox="0 0 32 32">
                    <path class="line line-top-bottom"
                        d="M27 10 13 10C10.8 10 9 8.2 9 6 9 3.5 10.8 2 13 2 15.2 2 17 3.8 17 6L17 26C17 28.2 18.8 30 21 30 23.2 30 25 28.2 25 26 25 23.8 23.2 22 21 22L7 22">
                    </path>
                    <path class="line" d="M7 16 27 16"></path>
                </svg>
            </label>
        </div>
    </div>

    {{-- hero --}}
    <div class="swiper mySwiper hero" id="home">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="banner-slider mobile-legend" data-paroller-factor="0.5" data-paroller-factor-xs="0.2">
                    <div class="text-banner text-light" data-aos="fade-up">
                        <h1 class="text-uppercase">Selamat datang di <span class="primary-txt">gamedrive</span></h1>
                        <p>Gamedrive menyediakan berbagai jenis jasa untuk para player yang ingin merasakan instan untuk
                            mencapai sebuah pencapain</p>
                        @auth
                        <a href="/my-dashboard" class="btn-banner">Pesan jasa kami sekarang</a>
                        @else
                        <a href="#" class="btn-banner">Pesan jasa kami sekarang</a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="banner-slider apex-legend" data-paroller-factor="0.5" data-paroller-factor-xs="0.2">
                    <div class="text-banner text-light" data-aos="fade-up">
                        <h1 class="text-uppercase">Selamat datang di <span class="primary-txt">gamedrive</span></h1>
                        <p>Gamedrive juga menyediakan berbagai macam topup untuk game game ternama! Banyak pilihan game
                            game yang menarik disini dan harga yang terjangkau.</p>
                        @auth
                        <a href="/my-dashboard" class="btn-banner">Pergi topup</a>
                        @else
                        <a href="#" class="btn-banner">Pergi topup</a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="banner-slider valorant" data-paroller-factor="0.5" data-paroller-factor-xs="0.2">
                    <div class="text-banner text-light" data-aos="fade-up">
                        <h1 class="text-uppercase">Selamat datang di <span class="primary-txt">gamedrive</span></h1>
                        <p>Gamedrive adalah website jasa yang menyediakan berbagai kebutuhan para gamers, mulai dari
                            jasa joki rank, winrate, dan jasa topup game game ternama.</p>
                        @auth
                        <a href="/my-dashboard" class="btn-banner">Pergi ke dashboard</a>
                        @else
                        <a href="#" class="btn-banner">Login sekarang</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
        <div class="autoplay-progress">
            <svg viewBox="0 0 48 48">
                <circle cx="24" cy="24" r="20"></circle>
            </svg>
            <span></span>
        </div>
    </div>

    {{-- about us --}}
    <section class="about-us" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('images/about-2.jpg') }}" data-aos="fade-right"
                        class="object-fit img-fluid rounded" alt="">
                </div>
                <div class="col-md-6 title-section">
                    <div class="content-des d-flex flex-column justify-content-evenly gap-3" data-aos="fade-left"
                        data-aos-delay="50" data-aos-duration="500">
                        <h3 class="title text-uppercase">about us</h3>
                        <p>
                            Gamedrive menyediakan layanan premium bagi gamer yang ingin meraih pencapaian instan. Kami
                            menawarkan top-up untuk game-game populer dengan harga terjangkau, serta jasa joki untuk
                            menaikkan peringkat dan winrate. Dengan banyak pilihan game menarik dan layanan profesional,
                            Gamedrive adalah solusi terbaik untuk pengalaman bermain yang lebih seru dan memuaskan.
                            Bergabunglah dan rasakan perbedaannya!
                        </p>
                        <div class="des-ex d-flex justify-content-between w-100">
                            <div class="des-content text-center w-50">
                                <h3>
                                    <strong>3</strong>
                                </h3>
                                <p class="fs-6">Years Of Experience</p>
                            </div>
                            <div class="des-content text-center w-50">
                                <h3>
                                    <strong>10k</strong>
                                </h3>
                                <p class="fs-6">Total Web Users</p>
                            </div>
                            <div class="des-content text-center w-50">
                                <h3>
                                    <strong>200</strong>
                                </h3>
                                <p class="fs-6">our number of employees</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- services --}}
    <section class="services" id="services">
        <div class="container">
            <div class="content-service d-flex justify-content-center gap-5 flex-wrap">
                <div class="card-service d-flex flex-column justify-content-evenly" data-aos="fade-up"
                    data-aos-duration="100">
                    <i class="bi bi-credit-card icon"></i>
                    <h5 class="text-capitalize mt-3">topup game populer</h5>
                    <p>Pembelian mata uang dan item dalam game seperti Mobile Legends, PUBG, Free Fire, dan banyak lagi,
                        dengan harga terjangkau dan proses cepat.</p>
                </div>
                <div class="card-service d-flex flex-column justify-content-evenly" data-aos="fade-up"
                    data-aos-duration="500">
                    <i class="bi bi-gear icon"></i>
                    <h5 class="text-capitalize mt-3">Jasa Joki Rank</h5>
                    <p>Layanan profesional untuk meningkatkan peringkat Anda dalam berbagai game, sehingga Anda bisa
                        mencapai level yang diinginkan tanpa kesulitan.</p>
                </div>
                <div class="card-service d-flex flex-column justify-content-evenly" data-aos="fade-up"
                    data-aos-duration="1000">
                    <i class="bi bi-graph-up-arrow icon"></i>
                    <h5 class="text-capitalize mt-3">Jasa Peningkatan Winrate</h5>
                    <p>Membantu Anda meningkatkan rasio kemenangan dalam game favorit Anda dengan dukungan pemain
                        berpengalaman.</p>
                </div>
                <div class="card-service d-flex flex-column justify-content-evenly" data-aos="fade-up"
                    data-aos-duration="500">
                    <i class="bi bi-cart-check icon"></i>
                    <h5 class="text-capitalize mt-3">Pembelian Item Eksklusif</h5>
                    <p>Akses ke item langka dan eksklusif dalam berbagai game yang sulit didapatkan secara reguler.</p>
                </div>
                <div class="card-service d-flex flex-column justify-content-evenly" data-aos="fade-up"
                    data-aos-duration="1000">
                    <i class="bi bi-headset icon"></i>
                    <h5 class="text-capitalize mt-3">Layanan Konsultasi Game</h5>
                    <p>Saran dan strategi dari para ahli untuk membantu Anda bermain lebih efektif dan menikmati game
                        dengan cara yang lebih maksimal.</p>
                </div>
                <div class="card-service d-flex flex-column justify-content-evenly" data-aos="fade-up"
                    data-aos-duration="1500">
                    <i class="bi bi-currency-dollar icon"></i>
                    <h5 class="text-capitalize mt-3">Event dan Promosi Khusus</h5>
                    <p>Diskon, bonus, dan penawaran eksklusif yang tersedia hanya untuk anggota Gamedrive.</p>
                </div>
            </div>
    </section>


    {{-- testimony --}}
    <section class="testimony" id="testimony">
        <div class="container">
            <h3 class="title text-uppercase mx-auto justify-content-center">testimony</h3>
            <div class="wrapper mt-5" data-aos="fade-up">
                <div
                    class="card-testimony d-flex flex-column justify-content-evenly align-items-center text-center shadow">
                    <img src="{{ asset('images/users-testimony/pp-1.png') }}" class="image-card" alt="">
                    <h4>Fulan</h4>
                    <p>
                        <i>" Jasa layanan nya baik, admin nya juga ramah "</i>
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                    </div>
                </div>
                <div
                    class="card-testimony d-flex flex-column justify-content-evenly align-items-center text-center shadow">
                    <img src="{{ asset('images/users-testimony/pp-2.png') }}" class="image-card" alt="">
                    <h4>Fulano</h4>
                    <p>
                        <i>" Pelayanan yang baik dan ramah, juga amanah 100% "</i>
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                    </div>
                </div>
                <div
                    class="card-testimony d-flex flex-column justify-content-evenly align-items-center text-center shadow">
                    <img src="{{ asset('images/users-testimony/pp-3.png') }}" class="image-card" alt="">
                    <h4>Mamang</h4>
                    <p>
                        <i>" Mantap euyy jasa nya, amanah dan juga pengerjaan yang cepat "</i>
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-half rating"></i>
                    </div>
                </div>
                <div
                    class="card-testimony d-flex flex-column justify-content-evenly align-items-center text-center shadow">
                    <img src="{{ asset('images/users-testimony/pp-annonymous.jpg') }}" class="image-card" alt="">
                    <h4>Sepuh Js</h4>
                    <p>
                        <i>" console.log('keren banyak banget pilihan jasa nya dan juga amanah') "</i>
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                    </div>
                </div>
                <div
                    class="card-testimony d-flex flex-column justify-content-evenly align-items-center text-center shadow">
                    <img src="{{ asset('images/users-testimony/pp-kucing.jpg') }}" class="image-card" alt="">
                    <h4>Mochiaw</h4>
                    <p>
                        <i>" Miaw miau miaaaw miauu miaauu miaw myeeoww nyaaa ~ "</i>
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                    </div>
                </div>
                <div
                    class="card-testimony d-flex flex-column justify-content-evenly align-items-center text-center shadow">
                    <img src="{{ asset('images/users-testimony/pp-wanita-2.jpg') }}" class="image-card" alt="">
                    <h4>Fulani</h4>
                    <p>
                        <i>" Berkat web Gamedrive akhir nya rank ml saya bisa sampe immortal, makasi banyak Gamedrive "</i>
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                    </div>
                </div>
                <div
                    class="card-testimony d-flex flex-column justify-content-evenly align-items-center text-center shadow">
                    <img src="{{ asset('images/users-testimony/pp-wanita.jpg') }}" class="image-card" alt="">
                    <h4>Michielle Alexandra</h4>
                    <p>
                        <i>" Topup game disini ternyata murah bangett yaa gaess, banyak game game populer dan yang lebih
                            penting amanah "</i>
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                        <i class="bi bi-star-fill rating"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- contact --}}
    <footer class="footer">
        <div class="container d-flex justify-content-between gap-5 flex-wrap">
            <div class="content">
                <img src="{{ asset('images/web-icon.jpg') }}" class="img-footer" alt="">
                <p class="mt-3 text-light">Gamedrive: Top-up game dan joki peringkat. Nikmati bermain lebih seru.
                    Bergabunglah sekarang!</p>
                <div class="socials d-flex gap-3">
                    <div class="icon-footer d-flex justify-content-center align-items-center">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <div class="icon-footer d-flex justify-content-center align-items-center">
                        <i class="bi bi-instagram"></i>
                    </div>
                    <div class="icon-footer d-flex justify-content-center align-items-center">
                        <i class="bi bi-twitter-x"></i>
                    </div>
                </div>
            </div>
            <div class="content">
                <h3 class="text-uppercase text-light">links</h3>
                <ul class="d-flex flex-column gap-3">
                    <li>
                        <a href="#" class="text-uppercase text-light">home</a>
                    </li>
                    <li>
                        <a href="#about" class="text-uppercase text-light">about us</a>
                    </li>
                    <li>
                        <a href="#servies" class="text-uppercase text-light">servies</a>
                    </li>
                    <li>
                        <a href="#testimony" class="text-uppercase text-light">testimony</a>
                    </li>
                </ul>
            </div>
            <div class="content text-light">
                <h3 class="text-uppercase">contact us</h3>
                <div class="contact mt-4 d-flex flex-column gap-3">
                    <h6>
                        <i class="bi bi-telephone-fill"></i> +62 8778 8612 930
                    </h6>
                    <h6>
                        <i class="bi bi-envelope-at"></i> support@gamedrive.id
                    </h6>
                </div>
            </div>
        </div>
    </footer>
@endsection