<?php

    session_start();
    
        ?>

<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Accueil</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stick+No+Bills:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="custom.css" rel="stylesheet">

</head>

<body id="home">

    <div id="nav-to-top"><a href="#home"><i class="fas fa-arrow-up"></i></a></div>

    <?php include_once('navbar.php') ?>

    <div id="home-title" class="text-center">
    
        <h1>Bienvenue sur le Blog de l'armée de l'air</h1>

        <h3>Vous pourrez y trouver toutes les dernières informations sur les avions de combat</h3>

    </div>

    <section id="include-page">

        <?php 

            if (isset($_GET['vue'])) 
            {

                $vue = $_GET['vue'] ;

                switch($vue) {

                    case('admin') :
                        include_once('vues/modif_articles.php');
                        break;
                    
                    case('create') :
                        include_once('vues/creation_article.php');
                        break;

                    case('mod') :
                        include_once('vues/modif_article_particulier.php');
                        break;
                    
                    case('list_categories') :
                        include_once('vues/liste_articles_categories.php');
                        break;

                    case('list_keywords') :
                        include_once('vues/liste_articles_keywords.php');
                        break;

                    case('list_auteurs') :
                        include_once('vues/liste_articles_auteurs.php');
                        break;
                    
                    case('vue_article') :
                        include_once('vues/vue_article_particulier.php');
                        break;

                    case('search') :
                        include_once('vues/liste_articles_search.php');
                        break;

                    case('advanced') :
                        include_once('vues/form_advanced_search.php');
                        break;

                    case('result_advanced_search') :
                        include_once('vues/result_advanced_search.php');
                        break;

                    default :
                        include_once('vues/liste_articles.php');
                }
            
            }

            else
            {

                include_once('vues/liste_articles.php');

            }

            ?>

    </section>

</body>
</html>