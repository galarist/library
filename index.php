<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon">
    <title>ICTDBS504 - AT2</title>
</head>

<body>
    <?php include ('view/header.php'); ?>
    <header>
        <?php echo "Welcome <span>", $_SESSION["username"], "</span>!" ?>
    </header>
    <section>
        <article>
            <div>
                <fieldset>
                    <img src="/library/public/img/covers/t9i-edit-book-covers-online.jpg" alt="">
                    <p>Book Title</p>
                </fieldset>
            </div>
        </article>
        <article>
            <div>
                <fieldset>
                    <img src="/library/public/img/covers/t9i-edit-book-covers-online.jpg" alt="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit possimus natus totam at nostrum autem eos doloremque voluptas amet hic, dolorem quas voluptatibus id nihil assumenda. Eveniet, voluptatum maxime! Molestiae.</p>
                </fieldset>
            </div>
        </article>
    </section>
    <?php include ('view/footer.php'); ?>
</body>

</html>