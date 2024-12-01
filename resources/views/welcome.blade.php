<!DOCTYPE html>
<html lang="en">

<head>

    <title>
        {{ config('app.name') }} - Home
    </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="frontend/css/font-awesome.min.css">
    <link rel="stylesheet" href="frontend/css/animate.css">
    <link rel="stylesheet" href="frontend/css/owl.carousel.css">
    <link rel="stylesheet" href="frontend/css/owl.theme.default.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="frontend/css/tooplate-style.css">
    <style>

        .team-thumb{
            margin-bottom: 30px;
        }
        .news-thumb{
            margin-bottom: 30px;
        }

        .icon-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .icon-rounded {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }
        
        .team-thumb img {
            border-radius: 10px;
        }
        
        .team-info {
            margin-top: 15px;
            text-align: center;
        }
        
        h3 {
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        p {
            font-size: 1rem;
            color: #666;
        }

        .icon-container {
        display: flex;
        justify-content: center;
        align-items: center;
        }
        
        .news-thumb img {
        border-radius: 10px;
        }
        
        .news-info {
        margin-top: 10px;
        text-align: center;
        }
        
        .news-info h3 a {
        text-decoration: none;
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
        }
        
        .news-info p {
        font-size: 1rem;
        color: #666;
        }
        
        .news-thumb {
        margin-bottom: 20px;
        }
    </style>
</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

    <!-- PRE LOADER -->
    <section class="preloader">
        <div class="spinner">

            <span class="spinner-rotate"></span>

        </div>
    </section>


    <!-- HEADER -->
    <header>
        <div class="container">
            <div class="row">

                <div class="col-md-4 col-sm-5">
                    <p>
                        Welcome to {{ config('app.name') }}
                    </p>
                </div>

                <div class="col-md-8 col-sm-7 text-align-right">
                    <span class="phone-icon"><i class="fa fa-phone"></i> 010-060-0160</span>
                    <span class="date-icon"><i class="fa fa-calendar-plus-o"></i> 6:00 AM - 10:00 PM (Mon-Fri)</span>
                    <span class="email-icon"><i class="fa fa-envelope-o"></i> <a href="#">cs@riskaklinik.com</a></span>
                </div>

            </div>
        </div>
    </header>


    <!-- MENU -->
    <section class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>

                <!-- lOGO TEXT HERE -->
                <a href="/" class="navbar-brand">Klinik Riska Yeni</a>
            </div>

            <!-- MENU LINKS -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#top" class="smoothScroll">Beranda</a></li>
                    <li><a href="#tentang" class="smoothScroll">Tentang</a></li>
                    <li><a href="#layanan" class="smoothScroll">Layanan</a></li>
                    <li><a href="#rumahsakit" class="smoothScroll">Rumah Sakit</a></li>
                    <li class="appointment-btn">
                        <a href="{{ route('register') }}">Daftar Antrian</a>
                    </li>
                    
                    @guest
                        <li class="">
                            <a href="{{ route('login') }}">
                                Login
                            </a>
                        </li>
                    @endguest

                    @auth
                        @if (Auth::user()->peran == 'bidan')
                            <li class="appointment-btn">
                                <a href="{{ route('bidan.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            @else
                            <li class="appointment-btn">
                                <a href="{{ route('petugas.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>

        </div>
    </section>


    <!-- HOME -->
    <section id="home" class="slider">
        <div class="container">
            <div class="row">
                <div class="">
                    <div class="item item-first">
                        <div class="caption">
                            <div class="col-md-offset-1 col-md-10">
                                <h3>
                                    ### Antrian ###
                                </h3>
                                <h1 id="antrianDipanggilHero">
                                    Nomor Antrian
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section id="about">
        <div class="container">
            <div class="row">
    
                <div class="col-md-6 col-sm-6">
                    <div class="about-info">
                        <h2 class="wow fadeInUp" data-wow-delay="0.6s">Welcome to Your <i class="fa fa-h-square"></i>ealth
                            Center</h2>
                        <div class="wow fadeInUp" data-wow-delay="0.8s">
                            <p>Aenean luctus lobortis tellus, vel ornare enim molestie condimentum. Curabitur lacinia nisi
                                vitae velit volutpat venenatis.</p>
                            <p>Sed a dignissim lacus. Quisque fermentum est non orci commodo, a luctus urna mattis. Ut
                                placerat, diam a tempus vehicula.</p>
                        </div>
                        <figure class="profile wow fadeInUp" data-wow-delay="1s">
                            <img src="{{ asset('frontend/images/author-image.jpg') }}" class="img-responsive" alt="">
                            <figcaption>
                                <h3>Dr. Riska Yeni</h3>
                                <p>General Principal</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
    
            </div>
        </div>
    </section>
    
    <!-- TEAM -->
    <section id="team" data-stellar-background-ratio="1">
        <div class="container">
            <div class="row">
    
                <div class="col-md-6 col-sm-6">
                    <div class="about-info">
                        <h2 class="wow fadeInUp" data-wow-delay="0.1s">Our Service</h2>
                    </div>
                </div>
    
                <div class="clearfix"></div>
    
                @forelse ($layanan as $item)
                <div class="col-md-4 col-sm-6">
                    <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-container text-center mb-3">
                            <div class="icon-rounded bg-primary text-white d-inline-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px; border-radius: 50%;">
                                <i class="fa fa-star fa-2x"></i>
                            </div>
                        </div>
                        <img src="images/team-image1.jpg" class="img-responsive img-fluid rounded" alt="">
                
                        <div class="team-info text-center mt-3">
                            <h3>
                                {{ $item->nama_layanan }}
                            </h3>
                            <p>
                                {{ $item->deskripsi_layanan }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center">
                    <div class="alert alert-warning">
                        Data layanan tidak ditemukan
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- NEWS -->
    <section id="news" data-stellar-background-ratio="2.5">
        <div class="container">
            <div class="row">
    
                <div class="col-md-12 col-sm-12">
                    <!-- SECTION TITLE -->
                    <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                        <h2>Rumah Sakit</h2>
                    </div>
                </div>
    
                @forelse ($rumah_sakit as $item)
                <div class="col-md-4 col-sm-6">
                    <div class="news-thumb wow fadeInUp" data-wow-delay="0.4s">
                        <a href="news-detail.html">
                            <img src="images/news-image1.jpg" class="img-responsive img-fluid rounded mb-3" alt="">
                        </a>
                        <div class="news-info text-center">
                            <div class="icon-container text-primary mb-2">
                                <i class="fa fa-hospital-o fa-2x"></i>
                            </div>
                            <h3>
                                <a href="news-detail.html" class="text-dark">
                                    {{ $item->nama_rumah_sakit }}
                                </a>
                            </h3>
                            <p class="text-muted">
                                {{ $item->alamat_rumah_sakit }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>Tidak ada data rumah sakit yang tersedia.</p>
                </div>
                @endforelse
    
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer data-stellar-background-ratio="5">
        <div class="row text-center">
            <div class="col-md-12 col-sm-12 border-top">
                <div class="copyright-text">
                    <p>Copyright &copy; 
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved

                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script src="https://cdn.socket.io/4.6.1/socket.io.min.js"></script>
    <script>
        const socket = io("http://localhost:6001");
    
        // Pastikan koneksi ke server Socket.IO berhasil
        socket.on("connect", () => {
            console.log("Connected to Socket.IO server:", socket.id);
        });
    
        // Mendengarkan event 'refresh:antrian' dari server Socket.IO
        socket.on("refresh:antrian", (data) => {
    
            // Cari elemen hero dengan ID 'antrianDipanggilHero'
            const antrianDipanggilHero = document.getElementById("antrianDipanggilHero");
    

            if (antrianDipanggilHero) {
                // Update teks elemen berdasarkan status
                switch (data.status) {
                    case 'dilewati':
                        antrianDipanggilHero.innerText = `Nomor ${data.no_antrian} - Dilewati`;
                        break;
                    case 'berlangsung':
                        antrianDipanggilHero.innerText = `Nomor ${data.no_antrian} - Sedang Berlangsung`;
                        break;
                    default:
                        antrianDipanggilHero.innerText = `Nomor ${data.no_antrian} - ${data.status}`;
                }
            } else {
                console.warn("Elemen dengan ID 'antrianDipanggilHero' tidak ditemukan di DOM.");
            }
        });
    
        // Tangani koneksi error
        socket.on("connect_error", (error) => {
            console.error("Socket.IO Connection Error:", error);
        });
    
        // Tangani disconnect
        socket.on("disconnect", () => {
            console.warn("Disconnected from Socket.IO server");
        });
    </script>
    <script src="frontend/js/jquery.js"></script>
    <script src="frontend/js/bootstrap.min.js"></script>
    <script src="frontend/js/jquery.sticky.js"></script>
    <script src="frontend/js/jquery.stellar.min.js"></script>
    <script src="frontend/js/wow.min.js"></script>
    <script src="frontend/js/smoothscroll.js"></script>
    <script src="frontend/js/owl.carousel.min.js"></script>
    <script src="frontend/js/custom.js"></script>

    

</body>

</html>