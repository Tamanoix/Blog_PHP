<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Insérer un Article dans la BDD</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

    <link href="custom.css" rel="stylesheet">

</head>

<body>

<?php

    if(isset($_POST["titre"]) && isset($_POST["auteur"]) && isset($_POST["contenu_texte"]) && isset($_POST["contenu_image"]) && isset($_POST["create_categorie"]) && isset($_POST["create_keywords"]))
	{ 
        
        include_once("fonctionsPHP.php") ;

        $connex = connexionDB('bdd_blog') ;
        if ($connex)
        {                                     
    
            mysqli_set_charset($connex, 'utf8'); // Ici le code pour mettre ma base de données en UTF8
    
            // Requête SQL INSERT INTO  (article)
            $Id_Article = "" ;
            $Titre = $_POST['titre'] ;
            $Auteur = $_POST['auteur'] ;
            $Texte = $_POST['contenu_texte'] ;
            $Image = $_POST['contenu_image'] ;
            $Date = date("Y-m-d");
            $Categorie = $_POST["create_categorie"] ;
            $Keywords = $_POST["create_keywords"] ;
            $requeteInsert = "INSERT INTO article (Titre , Auteur , Contenu_texte , Contenu_image , Date_creation , Id_Categorie) VALUES('$Titre' , '$Auteur' , '$Texte' , '$Image' , '$Date' , '$Categorie')" ;
            $resultInsert = mysqli_query($connex, $requeteInsert) ;
                if (!$resultInsert) 
                {
                    echo "<script type=\"text/javascript\">"; 
	                echo "alert('Impossible de créer cet article !');"; 
	                echo "</script>";
                }
                else 
                {
                    echo "<script type=\"text/javascript\">"; 
	                echo "alert('Féliciations, votre nouvel article a bien été créé !');"; 
	                echo "</script>";
                }   

            $Id_Article_Insert = mysqli_insert_id($connex) ;
            foreach($Keywords as $k) {
                $requeteInsertKeywords = "INSERT INTO article_keywords (Id_Article , Id_Keyword) VALUES('$Id_Article_Insert' , '$k')" ;
                $resultInsertKeywords = mysqli_query($connex, $requeteInsertKeywords) ;
            }


        echo"<script type=\"text/javascript\">"; 
	    echo "window.location.replace('index.php?vue=vue_article&code=".$Id_Article_Insert."');"; 
        echo "</script>"; 
        
        mysqli_close($connex);

        //header("Location: index.php?vue=admin"); 
        //exit;

        } 

    }
    else 
	{ 
        // Affichage d'un message d'erreur si les champs ne sont pas bien remplis
	    echo"<script type=\"text/javascript\">"; 
	    echo "alert('Veuillez correctement saisir les informations demandées !');"; 
	    echo "window.history.back();"; 
	    echo "</script>"; 

        mysqli_close($connex);
	}


                ?>


</body>

</html>