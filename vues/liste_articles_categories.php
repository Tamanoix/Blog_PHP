


<?php

if(isset($_GET["categorie"]))
{ 

    include_once("fonctionsPHP.php") ;

    $connex = connexionDB('bdd_blog') ;

    if ($connex) 
    {

        mysqli_set_charset($connex, 'utf8');    // Ici le code pour mettre ma base de données en UTF8


        // Récupérer les données des Articles de la Catégorie renvoyée
        $categorie = (int)$_GET['categorie'] ;  // On récupère l'Id_Categorie envoyé par le lien de la Navbar, transmis via l'url (GET)

        $requeteCategorie = "SELECT Nom , Id_Categorie FROM categorie WHERE Id_Categorie = ".$categorie.";";
        $resultCategorie = mysqli_query($connex,$requeteCategorie);
        $nomCategorie = mysqli_fetch_array($resultCategorie);

        $requeteArticle = "SELECT * FROM article a, categorie c WHERE a.Id_Categorie = c.Id_Categorie AND c.Id_Categorie = ".$categorie.";";
        $resultArticle = mysqli_query($connex,$requeteArticle);
        $articles = mysqli_fetch_all($resultArticle);

        if (!$resultArticle) 
            {
                echo "<script type=text/javascript>";
                echo 'alert("Impossible d\'afficher les articles de cette catégorie")</script>';
            }

        else if (sizeof($articles) == 0)
            {
                echo    '<div class="card-group">
                            <div class="card">
                                <a href="index.php"><img src="notfound.jpg" class="card-img-top" alt=""></a>
                                <div class="card-body text-center">
                                    <p class="card-text text-center">Il n\'y a aucun article dans la catégorie : '.$nomCategorie[0].'</p>
                                    <a href="index.php" class="card-text text-center">Retour</a>
                                </div>
                            </div>
                        </div>' ;
            }

        else 
            {
                echo '<div class="text-center mb-3"><h3 class="text-center">Les avions de la catégorie : '.$nomCategorie[0].'</3></div>';
                echo "<div class='card-group'>";
                foreach ($articles as $a)
                {
                    $requeteKeywords = "SELECT k.Nom , k.Id_Keyword FROM keywords k , article_keywords ak , article a WHERE a.Id_Article =".$a[0]." AND a.Id_Article = ak.Id_Article AND ak.Id_Keyword = k.Id_Keyword" ;
                    $resultKeywords = mysqli_query($connex,$requeteKeywords);
                    $keywords = mysqli_fetch_all($resultKeywords);
                    
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
                                        <p class="card-text text-center">Catégorie : <a href="index.php?vue=list_categories&categorie='.$nomCategorie[1].'">'.$nomCategorie[0].'</a></p>' ;
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