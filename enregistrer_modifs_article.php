<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sauvegarde des modifications de l'article</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

    <link href="custom.css" rel="stylesheet">

</head>

<body>

<?php

if(isset($_POST["titre"]) && isset($_POST["auteur"]) && isset($_POST["contenu_texte"]) && isset($_POST["contenu_image"]) && isset($_POST["date_creation"]))
{ 
    
    include_once("fonctionsPHP.php") ;

    $connex = connexionDB('bdd_blog') ;
    if ($connex)
    {                                     

        mysqli_set_charset($connex, 'utf8'); // Ici le code pour mettre ma base de données en UTF8

        // Requête SQL Modifier article
        $IdArticle = $_POST['article'] ;
        $Titre = $_POST['titre'] ;
        $Auteur = $_POST['auteur'] ;
        $ContenuTexte = $_POST['contenu_texte'] ;
        $ContenuImage = $_POST['contenu_image'] ;
        $Date_creation = $_POST['date_creation'] ;
        $Categorie = $_POST["modif_categorie"] ;
        $Keywords = $_POST["modif_keywords"] ;
        $requeteModif = "UPDATE article SET Titre = '$Titre' , Auteur = '$Auteur' , Contenu_texte = '$ContenuTexte' , Contenu_image = '$ContenuImage' , Date_creation = '$Date_creation' , Id_Categorie = '$Categorie' WHERE Id_Article = '$IdArticle' " ;
        $resultModif = mysqli_query($connex, $requeteModif) ;
            if (!$resultModif) 
            {
                echo"<script type=\"text/javascript\">"; 
                echo " alert('Modification impossible.');"; 
                echo "</script>";
            }
            else 
            {
                echo"<script type=\"text/javascript\">"; 
                echo " alert('Modification réussie !');"; 
                echo "</script>";
            }  

        // On supprime d'abord tous les liens vers Keywords avec cet article-là (puisqu'on les modifie)
        $requeteSupprKeywords = "DELETE FROM article_keywords WHERE Id_Article = ".$IdArticle.";" ;
        $resultSupprKeywords = mysqli_query($connex, $requeteSupprKeywords) ;

        // Et ensuite on rajoute les nouveaux via une requête INSERT (pour être sûr d'avoir les bons Keywords)
        foreach($Keywords as $k) {
            $requeteModifKeywords = "INSERT INTO article_keywords (Id_Article , Id_Keyword) VALUES('$IdArticle' , '$k')" ;
            $resultModifKeywords = mysqli_query($connex, $requeteModifKeywords) ;
        }

    echo "<script type=\"text/javascript\">"; 
    echo "window.location.replace('index.php?vue=vue_article&code=".$IdArticle."');"; 
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
    echo " alert('Veuillez correctement saisir les informations demandées !');"; 
    echo "window.history.back();"; 
    echo "</script>"; 

    mysqli_close($connex);
}


            ?>
    

</body>
</html>