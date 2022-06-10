<?php
session_start();

function check_login() {
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login/index.php");
        exit;
    }
}

function naglowek($title, $what_active = 0) {
    $username = htmlspecialchars($_SESSION["username"]); 
    
    $active = array('', '', '', '');
    $active[$what_active] = 'active';
    
    echo <<<END
        <!DOCTYPE html>
        <html lang="pl">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <script src="https://kit.fontawesome.com/4f0dacf5ab.js" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
            <link rel="stylesheet" href="/marina/css/style.css">
            <link rel="icon" href="/marina/img/icon.png">
            <title>$title</title>
        </head>

        <body>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a href="/marina/index.php" class="navbar-brand">Marina</a>
                    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav">
                            <li class="nav-item px-2">
                                <a href="/marina/index.php" class="nav-link $active[0]">Menu</a>
                            </li>
                            <li class="nav-item px-2">
                                <a href="/marina/boats/list.php" class="nav-link $active[1]">Miejsca Postojowe</a>
                            </li>
                            <li class="nav-item px-2">
                                <a href="/marina/free-places.php" class="nav-link $active[2]">Mapa</a>
                            </li>
                            <li class="nav-item px-2">
                                <a href="/marina/settlements.php" class="disabled nav-link $active[3]">Rozliczenia</a>
                            </li>
                        </ul>

                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown me-3">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-user"></i> Witaj
                                    <b>$username</b>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="/marina/profile.php" class="dropdown-item">
                                        <i class="fas fa-user-circle"></i> Profil
                                    </a>
                                    <a href="/marina/login/change-password.php" class="dropdown-item">
                                        <i class="fas fa-user-lock"></i> Zmień hasło
                                    </a>
                                    <a href="/marina/settings.php" class="dropdown-item">
                                        <i class="fas fa-cog"></i> Ustawienia
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="login/logout.php" class="nav-link">
                                    <i class="fas fa-user-times"></i> Wyloguj
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <header id="weather">
                <div class="container p-1">
                    <a class="weatherwidget-io" href="https://forecast7.com/pl/53d9114d25/swinoujscie/" data-label_1="ŚWINOUJŚCIE" data-label_2="Pogoda" data-theme="original">ŚWINOUJŚCIE Pogoda</a>
                </div>
            </header>
        END;
}

function stopka() {
    echo <<<END
        <div style="height: 150px">
        </div>
    
        <!-- FOOTER -->
        <footer id="main-footer" class="bg-dark text-white py-3 fixed-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-5 m-auto">
                        <a href="https://www.osir.swinoujscie.pl" target="_blank" title="OSiR Wyspiarz">
                            <img src="https://www.osir.swinoujscie.pl/wp-content/themes/osirsw/images/logo.png" alt="OSiR Wyspiarz">
                        </a>
                    </div>
                    <div class="col-4 text-center">
                        <div class="d-inline">
                            KAMERA:
                        </div>
                        <a title="Kamera w porcie jachtowym Świnoujście" href="http://88.218.254.213:8092/player.html" target="_blank"><img src="http://www.osir.swinoujscie.pl/wp-content/uploads/2017/05/port.jpg" alt="kamera" width="80" height="80" class="ms-3 alignnone size-full wp-image-10303"></a>
                    </div>
                    <div class="col-3 m-auto">
                        <p class="lead text-end pt-2">
                            Copyright &copy; <span id="year"></span>
                            Marina
                        </p>
                    </div>
                </div>
            </div>
        </footer>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
        <script>
            ! function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = 'https://weatherwidget.io/js/widget.min.js';
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, 'script', 'weatherwidget-io-js');

        </script>
        <script>
            // Get the current year for the copyright.
            $('#year').text(new Date().getFullYear());
        </script>
    </body>
    </html>
    END;
}
