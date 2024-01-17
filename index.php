<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Activitar Template">
    <meta name="keywords" content="Activitar, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FitSearch</title>

    
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>


.user-section a {
    margin-right: 100px; /* Регулируйте отступ между кнопками по вашему усмотрению */
    color: white; /* Сделаем текст кнопки "Привет" белым */
}

.user-section a:hover {
    text-decoration: underline; /* Добавим подчеркивание при наведении на кнопку "Привет" */
}

.user-section span {
    margin-right: 500px; /* Регулируйте отступ справа от кнопки "Привет" по вашему усмотрению */
    margin-top: -5px;
    color: white; /* Поднимем кнопку "Выйти" немного вверх */
}


    </style>

</head>

<body>
    
    <div id="preloder">
        <div class="loader"></div>
    </div>

    
    <body>
        <header class="header-section">
            <div class="container-fluid">
                <div class="logo">
                    <a href="./index.php">
                        <img src="img/logo.png" alt="" width="400" height="100">
                    </a>
                </div>
                <div class="container">
                    <div class="nav-menu">
                        <nav class="mainmenu mobile-menu">
                            <ul>
                                <li class="active"><a href="./index.php">Главная</a></li>
                                <li><a href="./opportunities.php">Наши возможности</a></li>
                                <li><a href="registration.html">Регистрация</a></li>
                                <div class="user-section">
                                    <?php
                                    session_start();
                                    if (isset($_SESSION['username'])) {
                                        $username = $_SESSION['username'];
                                        echo "<span>Привет, $username! </span> <a href='logout.php'>Выйти</a>";
                                    } else {
                                        echo "<a href='registration.html'>Регистрация</a>";
                                    }
                                    ?>
                                </div>
                            </ul>
                        </nav>
                    </div>
                    <div id="mobile-menu-wrap"></div>
                </div>
            </div>
        </header>
   

    
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-item set-bg" data-setbg="img/hero-slider/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hero-text">
                                <h2>Твой сервис поиска для</h2>
                                <h1>ФИТНЕССА и СПОРТА</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    
    <section class="home-about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <h2>Раздел поиска</h2>
                        <p class="short-details">Здесь вы можете начать поиск спортивных залов по вашим требованиям, после прохождения регистрации или входа вас перенаправит на страницу поиска.</p>
                        <a href="registration.html" class="primary-btn about-btn">Начать поиск!</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-img">
                        <img src="img/index_logo.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    
    <div class="map">
        <div id="yandexMap" style="width: 100%; height: 590px;"></div>
    </div>
    

    
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-logo-item">
                        <div class="f-logo">
                            <a href="#"><img src="img/logo.png" alt=""></a>
                        </div>
                        <p>....</p>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h5>Специализация сервиса</h5>
                        <ul class="workout-program">
                            <li><a href="#">Бодибилдинг</a></li>
                            <li><a href="#">Пауэрлифтинг</a></li>
                            <li><a href="#">Фитнесс</a></li>
                            <li><a href="#">Воркаут</a></li>
                            <li><a href="#">и другое</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-widget">
                        <h5>Поддержка:</h5>
                        <ul class="footer-info">
                            <li>
                                <i class="fa fa-phone"></i>
                                <span>Телефон:</span>
                                +7 (964) 052-02-19
                            </li>
                            <li>
                                <i class="fa fa-envelope-o"></i>
                                <span>Почта:</span>
                                aliomarovt@yandex.ru
                            </li>
                            <li>
                                <i class="fa fa-globe"></i>
                                <span>Источник данных:</span>
                                <a href="https://data.mos.ru/opendata" target="_blank">data.mos.ru</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="ct-inside">
                            Moscow &copy;<script>document.write(new Date().getFullYear());</script> FitSearch
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
   

    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

    <script src="https://api-maps.yandex.ru/2.1/?apikey=748f4927-077a-4a37-85e3-12a909fb54f6&lang=ru_RU" type="text/javascript"></script>
    
    <script>
        ymaps.ready(init);
    
            // Функция инициализации карты
            function init() {
            // Создание объекта карты
            var myMap = new ymaps.Map('yandexMap', {
                center: [55.7558, 37.6176], // Координаты центра карты (центр Москвы)
                zoom: 10 // Уровень масштабирования
            });

            // Добавление метки на карту
            var myPlacemark = new ymaps.Placemark([55.7558, 37.6176], {
                hintContent: 'Москва!', // Всплывающая подсказка при наведении на метку
                balloonContent: 'Столица России' // Содержание информационного окна при клике на метку
            });

            // Добавление метки на карту через геообъекты
            myMap.geoObjects.add(myPlacemark);

            // Добавление поискового контрола
            var searchControlRight = new ymaps.control.SearchControl({
                options: {
                    noPlacemark: true, // Отключение отображения метки результата поиска на карте
                    float: 'right', // Размещение контрола справа
                    provider: 'yandex#search' // Поставщик данных для поиска 
                }
            });

            // Добавление поискового контрола на карту
            myMap.controls.add(searchControlRight);

            // Обработка события изменения границ карты 
            myMap.events.add('boundschange', function (event) {
                // Установка границ для поискового контрола, основанного на событии изменения границ
                searchControlRight.options.set('boundedBy', event.get('newBounds'));
            });
        }

    </script>
    
</body>

</html>
