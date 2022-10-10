


<?php

if(isset($_GET["auteur"]))
{ 

    include_once("fonctionsPHP.php") ;

    $connex = connexionDB('bdd_blog') ;

    if ($connex) 
    {

        mysqli_set_charset($connex, 'utf8');    // Ici le code pour mettre ma base de données en UTF8


        // Récupérer les données des Articles de l'auteur renvoyé
        $auteur = (int)$_GET['auteur'] ;  // On récupère l'Id_Article (en fonction de l'auteur choisi) envoyé par le lien de la Navbar, transmis via l'url (GET)

        $requeteNomAuteur = "SELECT Auteur FROM article WHERE Id_Article = ".$auteur.";";
        $resultNomAuteur = mysqli_query($connex,$requeteNomAuteur);
        $nomAuteur = mysqli_fetch_array($resultNomAuteur);

        $requeteCategorie = "SELECT c.Nom , c.Id_Categorie FROM categorie c , article a WHERE c.Id_Categorie = a.Id_Categorie AND a.Id_Article = ".$auteur.";";
        $resultCategorie = mysqli_query($connex,$requeteCategorie);
        $categorie = mysqli_fetch_array($resultCategorie);

        $vue = "index.php?vue=vue_article&code=".$auteur ;

        $requeteKeywords = "SELECT k.Nom , k.Id_Keyword FROM keywords k , article_keywords ak , article a WHERE a.Id_Article =".$auteur." AND a.Id_Article = ak.Id_Article AND ak.Id_Keyword = k.Id_Keyword" ;
        $resultKeywords = mysqli_query($connex,$requeteKeywords);
        $keywords = mysqli_fetch_all($resultKeywords);

        $requeteArticleAuteur = "SELECT * FROM article WHERE Id_Article = ".$auteur.";";
        $resultArticleAuteur = mysqli_query($connex,$requeteArticleAuteur);
        $articles = mysqli_fetch_all($resultArticleAuteur);

        if (!$resultArticleAuteur) 
            {
                echo "<script type=text/javascript>";
                echo 'alert("Impossible d\'afficher les articles de cet auteur")</script>';
            }

        else if (sizeof($articles) == 0)
            {
                echo    '<div class="card-group">
                            <div class="card">
                                <a href="index.php"><img src="notfound.jpg" class="card-img-top" alt=""></a>
                                <div class="card-body text-center">
                                    <p class="card-text text-center">Il n\'y a aucun article pour l\'auteur : '.$nomAuteur[0].'</p>
                                    <a href="index.php" class="card-text text-center">Retour</a>
                                </div>
                            </div>
                        </div>' ;
            }

        else 
            {
                echo '<div class="text-center mb-3"><h3 class="text-center">Les articles de l\'auteur : '.$nomAuteur[0].'</3></div>';
                echo "<div class='card-group'>";
                foreach ($articles as $a)
                {
                    $code = $a[0] ;
                    $vue = "index.php?vue=vue_article&code=".$code ;
                    echo    '<div class="card">
                                <a href="'.$vue.'"><img src="'.$a[4].'" class="card-img-top" alt=""></a>
                                <div class="card-body">
                                    <h3 class="card-title text-center">'.$a[1].'</h3>
                                    <p class="card-text text-center">'.$a[3].'</p>
                                    <div class="card-footer">
                                        <p class="card-text text-center">Ecrit par : '.$a[2].'</p>
                                        <p class="card-text text-center"><small class="text-muted">Date de création :'.$a[5].'</small></p>
                                    </div>
                                    <div class="card-footer">
                                        <p class="card-text text-center">Catégorie : <a href="index.php?vue=list_categories&categorie='.$categorie[1].'">'.$categorie[0].'</a></p>' ;
                    if ($keywords != null) 
                    { 
                        echo            '<p class="card-text text-center">Keywords : ' ;
                        foreach ($keywords as $k)
                        {
                            echo            '<a href="index.php?vue=list_keywords&keywords='.$k[1].'">'.$k[0].' </a>' ;
                        }            
                        echo            '</p>' ;
                    }
                    echo            '</div>
                                </div>
                            </div>';
                }
                echo "</div>" ;
            }

            mysqli_close($connex) ;
    }

}

else 
{
    // Affichage d'un message d'erreur si l' Id_Categorie n'a pas été récupéré via GET
    echo"<script type=\"text/javascript\">"; 
    echo 'alert("La catégorie demandée n\'a pas pu être récupérée...");'; 
    echo "window.history.back();"; 
    echo "</script>"; 

    mysqli_close($connex);
}


?>