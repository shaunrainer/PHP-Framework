<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= $data['pageTitle'] ?></title>

        <!-- Bootstrap CSS -->
        <link href="<?= APP_URL ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <link href="<?= APP_URL ?>/inc/css/style.css" rel="stylesheet">

    </head>

    <body>

        <nav class="navbar navbar-inverse">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= APP_URL ?>"><?= $data['pageTitle'] ?></a>
                </div>

                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?= APP_URL ?>">Home</a></li>
                        <li><a href="facebook">Facebook</a></li>
                    </ul>
                </div><!--/.nav-collapse -->

            </div>
        </nav>

        <div class="container">

            <div class="jumbotron">
                <h1>Welcome to Shaun's Framework</h1>
                <p>Please login to facebook via the link in the navigation.</p>
            </div>

        </div>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Bootstra JS -->
        <script src="<?= APP_URL ?>/assets/bootstrap/js/bootstrap.min.js"></script>

    </body>
</html>