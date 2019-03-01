<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
            const closeBtn = document.getElementById('closeNotify');


            if ($navbarBurgers.length > 0) {

                $navbarBurgers.forEach( el => {
                    el.addEventListener('click', () => {

                        const target = el.dataset.target;
                        const $target = document.getElementById(target);

                        el.classList.toggle('is-active');
                        $target.classList.toggle('is-active');

                    });
                });
            }
            try {
                closeBtn.addEventListener('click', function (event) {
                    this.parentNode.remove();
                }, false);
            }
            catch (e) {
                //do nothing if notification isn't in DOM
            }

        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.0/chartist.min.css">
    <title><?php echo SITE_NAME ?></title>
</head>
<body>
<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="<?php echo BASEDIR ?>">
                Home
            </a>
        </div>
    </div>
</nav>
<?php echo Notification::render(); ?>
<section class="hero is-warning is-bold is-fullheight-with-navbar">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                404
            </h1>
            <h2 class="subtitle">
                Strony nie znaleziono.
            </h2>
        </div>
    </div>
</section>
</body>
</html>
