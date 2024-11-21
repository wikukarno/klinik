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
                        <a href="#" target="_blank">Buat Janji</a>
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
    <section id="home" class="slider" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">

                <div class="owl-carousel owl-theme">
                    <div class="item item-first">
                        <div class="caption">
                            <div class="col-md-offset-1 col-md-10">
                                <h3>Let's make your life happier</h3>
                                <h1>Healthy Living</h1>
                                <a href="#team" class="section-btn btn btn-default smoothScroll">Meet Our Doctors</a>
                            </div>
                        </div>
                    </div>

                    <div class="item item-second">
                        <div class="caption">
                            <div class="col-md-offset-1 col-md-10">
                                <h3>Aenean luctus lobortis tellus</h3>
                                <h1>New Lifestyle</h1>
                                <a href="#about" class="section-btn btn btn-default btn-gray smoothScroll">More About
                                    Us</a>
                            </div>
                        </div>
                    </div>

                    <div class="item item-third">
                        <div class="caption">
                            <div class="col-md-offset-1 col-md-10">
                                <h3>Pellentesque nec libero nisi</h3>
                                <h1>Your Health Benefits</h1>
                                <a href="#news" class="section-btn btn btn-default btn-blue smoothScroll">Read
                                    Stories</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- LAYANAN -->
    <section id="layanan" data-stellar-background-ratio="1">
        <div class="container">
            <div class="row">
    
                <div class="col-12 col-lg-12 text-center">
                    <div class="about-info">
                        <h2 class="wow fadeInUp" data-wow-delay="0.1s">Layanan</h2>
                    </div>
                </div>
    
                <div class="clearfix"></div>
    
                @forelse ($layanan as $item)
                    <div class="col-md-4 col-sm-6">
                        <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                            <div class="team-info text-center">
                                <i class="fa fa-stethoscope fa-3x"></i>
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
                    <div class="col-12 col-lg-12 text-center">
                        <div class="alert alert-warning">
                            Data layanan belum tersedia!.
                        </div>
                    </div>
                @endforelse
    
            </div>
        </div>
    </section>

    <!-- RUMAH SAKIT -->
    <section id="rumahsakit" data-stellar-background-ratio="1">
        <div class="container">
            <div class="row">
    
                <div class="col-12 col-lg-12 text-center">
                    <div class="about-info">
                        <h2 class="wow fadeInUp" data-wow-delay="0.1s">Rumah Sakit</h2>
                    </div>
                </div>
    
                <div class="clearfix"></div>
    
                @forelse ($rumah_sakit as $item)
                <div class="col-md-4 col-sm-6">
                    <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-info text-center">
                            <i class="fa fa-hospital-o fa-3x"></i>
                            <h3>
                                {{ $item->nama_rumah_sakit }}
                            </h3>
                            <p>
                                {{ $item->no_hp_rumah_sakit }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 col-lg-12 text-center">
                    <div class="alert alert-warning">
                        Data layanan belum tersedia!.
                    </div>
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