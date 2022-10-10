<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Suppression article</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

    <link href="custom.css" rel="stylesheet">

</head>

<body>


    <?php

        include_once("fonctionsPHP.php") ;

        $connex = connexionDB('bdd_blog') ;

        if ($connex)
        {

            mysqli_set_charset($connex, 'utf8') ;        // Ici le code pour mettre ma base de données en UTF8

            $code = (int)$_GET['code'] ;                // On récupère l'Id_Article envoyé par la page modif_articles.php via le click sur $supp
            $requeteSuppr = "DELETE FROM article WHERE Id_Article = ".$code.";" ;         // Requête de suppression de l'Id Article = celui envoyé par le code de la page modif_articles.php
            $resultSuppr = mysqli_query($connex, $requeteSuppr) ;

            if (!$resultSuppr)
            {

                echo "<script type='text/javascript'>"; 
                echo "alert('Impossible de supprimer cet article');";
                echo "</script>"; 

            }

            else
            {

                echo "<script type='text/javascript'>"; 
                echo "alert('Article supprimé avec succès !');";
                echo "window.location.replace('index.php?vue=admin');"; 
                echo "</script>";

                mysqli_close($connex);

            }

        }

            ?>

</body>
</html>