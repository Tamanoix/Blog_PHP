


<?php

if(isset($_GET["keywords"]))
{ 

    include_once("fonctionsPHP.php") ;

    $connex = connexionDB('bdd_blog') ;

    if ($connex) 
    {

        mysqli_set_charset($connex, 'utf8');    // Ici le code pour mettre ma base de données en UTF8


        // Récupérer les données des Articles du Keywords renvoyé
        $keywords = (int)$_GET['keywords'] ;  // On récupère l'Id_Keywords envoyé par le lien de la Navbar, transmis via l'url (GET)

        $requeteKeywords = "SELECT Nom FROM keywords WHERE Id_Keyword = ".$keywords.";";
        $resultKeywords = mysqli_query($connex,$requeteKeywords);
        $nomKeywords = mysqli_fetch_array($resultKeywords);

        $requeteArticle = "SELECT * FROM article a, article_keywords ak , keywords k WHERE a.Id_Article = ak.Id_Article AND ak.Id_Keyword = k.Id_Keyword AND k.Id_Keyword = ".$keywords.";";
        $resultArticle = mysqli_query($connex,$requeteArticle);
        $articles = mysqli_fetch_all($resultArticle);

        if (!$resultArticle) 
            {
                echo "<script type=text/javascript>";
                echo 'alert("Impossible d\'afficher les articles de ce mot-clé")</script>';
            }

        else if (sizeof($articles) == 0)
            {
                echo    '<div class="card-group">
                            <div class="card">
                                <a href="index.php"><img src="notfound.jpg" class="card-img-top" alt=""></a>
                                <div class="card-body text-center">
                                    <p class="card-text text-center">Il n\'y a aucun article en lien avec le mot-clé : '.$nomKeywords[0].'</p>
                                    <a href="index.php" class="card-text text-center">Retour</a>
                                </div>
                            </div>
                        </div>' ;
            }

        else 
            {
                echo '<div class="text-center mb-3"><h3 class="text-center">Les avions en lien avec le mot-clé : '.$nomKeywords[0].'</3></div>';
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
    echo 'alert("Le mot-clé demandé n\'a pas pu être récupéré...");'; 
    echo "window.history.back();"; 
    echo "</script>"; 

    mysqli_close($connex);
}


?>