



<?php

if(isset($_POST['search_categorie']) && isset($_POST['search_keywords']) && isset($_POST['search_auteur']))
{ 
    
    include_once("fonctionsPHP.php") ;

    $connex = connexionDB('bdd_blog') ;
    if ($connex)
    {                                     

        mysqli_set_charset($connex, 'utf8'); // Ici le code pour mettre ma base de données en UTF8

        $categorie = $_POST['search_categorie'] ;
        $keywords = $_POST['search_keywords'] ;
        $auteur = $_POST['search_auteur'] ;

        // Requête de recherche
        $requeteSearch = "SELECT * FROM article a , categorie c , article_keywords ak , keywords k WHERE c.Id_Categorie = ".$categorie." AND k.Id_Keyword = ".$keywords." AND a.Id_Article = ".$auteur." AND ak.Id_Keyword = k.Id_Keyword AND ak.Id_Article = a.Id_Article ;";
        $resultSearch = mysqli_query($connex,$requeteSearch);
        $articlesSearch = mysqli_fetch_all($resultSearch);

        if (!$resultSearch) 
        {
            echo "<script type=text/javascript>" ;
            echo "alert('La recherche ne fonctionne pas !')</script>" ;
        }

        else if (sizeof($articlesSearch) == 0)
            {
                echo    '<div class="card-group">
                            <div class="card">
                                <a href="index.php"><img src="img/notfound.jpg" class="card-img-top" alt=""></a>
                                <div class="card-body text-center">
                                    <p class="card-text text-center">Il n\'y a aucun article correspondant à la recherche</p>
                                    <a href="index.php" class="card-text text-center">Retour</a>
                                </div>
                            </div>
                        </div>' ;
            }

        else 
        {
            echo "<div class='card-group'>";
                foreach ($articlesSearch as $as)
                {

                    $requeteAllKeywords = "SELECT k.Nom , k.Id_Keyword FROM keywords k , article_keywords ak , article a WHERE a.Id_Article =".$as[0]." AND a.Id_Article = ak.Id_Article AND ak.Id_Keyword = k.Id_Keyword" ;
                    $resultAllKeywords = mysqli_query($connex,$requeteAllKeywords);
                    $Allkeywords = mysqli_fetch_all($resultAllKeywords);

                    $code = $as[0] ;
                    $vue = "index.php?vue=vue_article&code=".$code ;
                    echo    '<div class="card">
                                <a href="'.$vue.'"><img src="'.$as[4].'" class="card-img-top" alt=""></a>
                                <div class="card-body">
                                    <h3 class="card-title text-center">'.$as[1].'</h3>
                                    <p class="card-text text-center">'.$as[3].'</p>
                                    <div class="card-footer">
                                        <p class="card-text text-center">Ecrit par : '.$as[2].'</p>
                                        <p class="card-text text-center"><small class="text-muted">Date de création :'.$as[5].'</small></p>
                                    </div>
                                    <div class="card-footer">
                                                <p class="card-text text-center">Catégorie : <a href="index.php?vue=list_categories&categorie='.$as[7].'">'.$as[8].'</a></p>' ;
                    if ($Allkeywords != null) 
                    { 
                        echo                    '<p class="card-text text-center">Keywords : ' ;
                        foreach ($Allkeywords as $k)
                        {
                            echo                    '<a href="index.php?vue=list_keywords&keywords='.$k[1].'">'.$k[0].' </a>' ;
                        }            
                            echo                '</p>' ;
                    }
                    echo            '</div>
                                </div>
                            </div>';
                }
            echo "</div>" ;
        }  

        mysqli_close($connex);

    } 

}
else 
{ 
    // Affichage d'un message d'erreur si les champs de recherche ne sont pas bien remplis
    echo "<script type=\"text/javascript\">"; 
    echo "alert('Veuillez saisir une recherche valable !');"; 
    echo "</script>"; 

    mysqli_close($connex);
}


    ?>
    