

<?php

if(isset($_GET["search_input"]))
{ 
    
    include_once("fonctionsPHP.php") ;

    $connex = connexionDB('bdd_blog') ;
    if ($connex)
    {                                     

        mysqli_set_charset($connex, 'utf8'); // Ici le code pour mettre ma base de données en UTF8

        $searchValue = $_GET['search_input'] ;

        // Requête de recherche
        $requeteSearch = "SELECT * FROM article WHERE Titre LIKE '%$searchValue%' OR Contenu_texte LIKE '%$searchValue%'";
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
                                <a href="index.php"><img src="notfound.jpg" class="card-img-top" alt=""></a>
                                <div class="card-body text-center">
                                    <p class="card-text text-center">Il n\'y a aucun article correspondant à la recherche : '.$searchValue.'</p>
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
    