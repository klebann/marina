<?php
    require_once("common.php");
    check_login();
    naglowek("Witaj", 0);
?>

<section id="hero" class="d-flex flex-column justify-content-center align-items-center text-white ">
    <div class="container text-center text-md-left" data-aos="fade-up">
        <h1 class="display-2">
            Witaj <span style="text-underline: blue;"><?php echo htmlspecialchars($_SESSION["username"]); ?></span>,
        </h1>
        <h2 class="display-3">
            na stronie Mariny.
        </h2>
    </div>
</section>

<section class="pb-5 pt-5">
    <div class="container">
        <h1>Aktualności OSiR</h1>
        <hr>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" alt="Post1" src="img/post1.jpg" data-holder-rendered="true">
                    <div class="card-body">
                        <h5 class="card-title">„TURNIEJ SINGLI SIATKARSKICH”</h5>
                        <p class="card-text">Z okazji Dnia Dziecka sekcja minisiatkówki OSiR Wyspiarz rozegrała swój pierwszy „Turniej singli siatkarskich”. Do ostatniego spotkania trwała zacięta walka o zwycięstwo. W kategorii chłopców (wszyscy z rocznika 2015)...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Czytaj więcej</button>
                            </div>
                            <small class="text-muted">3 czerwca 2022</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" alt="Post2" src="img/post2.jpg" data-holder-rendered="true">
                    <div class="card-body">
                        <h5 class="card-title">ZAWODY INDYWIDUALNE W LEKKIEJ ATLETYCE W RAMACH IGRZYSK MŁODZIEŻY SZKOLNEJ</h5>
                        <p class="card-text">Ośrodek Sportu i Rekreacji „Wyspiarz” w dniu 31 maja 2022 r. zorganizował na stadionie lekkoatletycznym przy ulicy Matejki 22 Mistrzostwa Miasta Świnoujście w indywidualnych zawodach lekkoatletycznych w ramach Igrzysk...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Czytaj więcej</button>
                            </div>
                            <small class="text-muted">1 czerwca 2022</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" alt="Post3" src="img/post3.jpg" data-holder-rendered="true">
                    <div class="card-body">
                        <h5 class="card-title">KONIEC ZMAGAŃ W ŚBL 3×3 EDITION</h5>
                        <p class="card-text">W ostatnią niedzielę maja rozegrany został ostatni z cyklu dziesięciu turniejów koszykówki 3×3 w ramach Świnoujskiej Basket Ligi 3×3 Edition. Przez niespełna sześć miesięcy na obiekcie Uznam Arena rozegrano...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Czytaj więcej</button>
                            </div>
                            <small class="text-muted">30 maja 2022</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" alt="Post4" src="img/post4.jpg" data-holder-rendered="true">
                    <div class="card-body">
                        <h5 class="card-title">V FINAŁ MIEJSKI ŚWINOUJSKICH „CZWARTKÓW LEKKOATLETYCZNYCH”</h5>
                        <p class="card-text">W czwartek 26 maja 2022 r. na stadionie lekkoatletycznym odbył się V Finał Miejski Czwartków Lekkoatletycznych. Pozwoli on wyłonić reprezentację powiatu świnoujskiego na Finał Krajowy, który odbędzie się w...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Czytaj więcej</button>
                            </div>
                            <small class="text-muted">27 maja 2022</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" alt="Post5" src="img/post5.png" data-holder-rendered="true">
                    <div class="card-body">
                        <h5 class="card-title">ZAPROSZENIE NA FINAŁ MIEJSKI CZWARTKÓW LEKKOATLETYCZNYCH</h5>
                        <p class="card-text">Ośrodek Sportu i Rekreacji „ Wyspiarz” serdecznie zaprasza uczniów szkół podstawowych, rocznik 2011/2010/2009 do udziału w Finale Miejskim Czwartków Lekkoatletycznych, który odbędzie się na Stadionie Miejskim w dniu 26...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Czytaj więcej</button>
                            </div>
                            <small class="text-muted">26 maja 2022</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" alt="Post6" src="img/post6.png" data-holder-rendered="true">
                    <div class="card-body">
                        <h5 class="card-title">ZAWODY PŁYWACKIE Z OKAZJI DNIA DZIECKA</h5>
                        <p class="card-text">Z okazji Dnia Dziecka, zapraszamy do udziału w zawodach pływackich, które odbędą się w sobotę 4 czerwca na pływalni Uznam Arena. Wszystkich pływaków, zarówno tych mniejszych, jak i starszych zachęcamy do...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Czytaj więcej</button>
                            </div>
                            <small class="text-muted">25 maja 2022</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <h1>O nas</h1>
        <hr>
        <p>
            Port Jachtowy położony jest w tzw. Basenie Północnym po lewej stronie wejścia do Morza Bałtyckiego. Jest jednym z największych portów jachtowych na polskim Wybrzeżu Morza Bałtyckiego, to również jedyny port morsko – śródlądowy w Polsce. Kanał operatorów stacji radiowych UKF Basenu Północnego – 74.
        </p>
        <p>
            Parametry geograficzne: 53˚54’48” N 14˚16’28” E. Dysponuje 300 miejscami postojowymi dla jachtów o zanurzeniu do 4,5m oraz specjalistycznymi pomostami postojowymi dla skuterów wodnych. Port jachtowy posiada również nabrzeże zewnętrzne przystosowane do obsługi statków pełnomorskich.
            Obiekt gwarantuje dostęp na pomostach do: energii elektrycznej i wody. Ponadto korzystanie z zaplecza socjalnego (toalety, natryski), automat pralniczy z suszarnią, odbiór nieczystości, WiFi. Na terenie Portu znajdują się: wypożyczalnia rowerów, sklep spożywczy, sklep żeglarski, tawerna żeglarska, pole namiotowe i karawaningowe, parking.
            Obiekt jest monitorowany wizyjnie, obsługę personalną zapewniają całodobowo bosmani.
        </p>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <h1>Kontakt</h1>
        <hr>
        <p>
            Obiekt umożliwia slipowanie zimowe jachtów.<br>
            Obiekt dostępny jest cały rok. Informacje pod numerem: <a href="tel: 913219177">91 321 91 77</a>
        </p>
        <p>
            Adres portu jachtowego:<br>
            Ul. Wybrzeże Władysława IV/ul. Jachtowa<br>
            72-600 Świnoujście<br>
            Email: marina@osir.swinoujscie.pl, marina.bosmanat@osir.swinoujscie.pl
        </p>
    </div>
</section>

<?php
    stopka();
?>
