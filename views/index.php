<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="views/css/app.css">
    <?php if (isset($links)) echo $links;     ?>
    <title>Jcmo Movies</title>
</head>

<body>
    <header>
        <?php include_once __DIR__ . "/templates/header.php" ?>
    </header>
    <main class="container">
        <aside>
            <?php include_once __DIR__ . "/templates/aside.php" ?>
        </aside>
        <?php if (isset($errors)) : ?>

            <?php
            foreach ($errors as $error) {
                echo  <<<HTML
                    <div class="alert alert-danger mt-3 " role="alert">
                        $error
                    </div>
                HTML;
            }
            ?>
        <?php endif ?>

        <div id="alerts" class="hide" >
            
        </div>
        <section>
            <?php include_once $content ?>
        </section>
    </main>
    <footer>
        <?php include_once __DIR__ . "/templates/footer.php" ?>
    </footer>

    <?php if (isset($script)) echo $script;    ?>
</body>

</html>