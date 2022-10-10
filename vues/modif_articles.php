

    <div>

        <div class="text-center mb-3"><a href="index.php?vue=create">Créer un nouvel article <i class="fas fa-edit"></i></a></div>
        <div class="text-center mb-5"><a href="index.php">Retour</a></div>

        <div>

            <?php

            include_once("fonctionsPHP.php") ;

            $connex = connexionDB('bdd_blog') ;

            if ($connex) 
            {

                mysqli_set_charset($connex, 'utf8');                     // Ici le code pour mettre ma base de données en UTF8

        
                    // Récupérer les données de Articles
                $requeteArticle = "SELECT * FROM article";
                $resultArticle = mysqli_query($connex,$requeteArticle);

                if (!$resultArticle) 
                    {
                        echo "<script type=text/javascript>";
                        echo 'alert("Impossible d\'afficher les articles")</script>';
                    }

                else 
                    {
                        echo "<div class='card-group'>";
                        while ($articles = mysqli_fetch_array($resultArticle))
                        {

                            $code = $articles[0] ;      // Récupérer l'Id_Article pour le supprimer si besoin
                            $mod = "index.php?vue=mod&code=".$code ;      // Transférer cet Id_Article vers le lien de modification (vue=mod) sur la page index.php au click sur l'élément $mod
                            $supp = "supp_article.php?code=".$code ;       // Transférer cet Id_Article vers la page supp_article.php au click sur l'élément $supp

                            $requeteCategorie = "SELECT c.Nom , c.Id_Categorie FROM categorie c , article a WHERE c.Id_Categorie = a.Id_Categorie AND a.Id_Categorie = ".$articles[6].";";
                            $resultCategorie = mysqli_query($connex,$requeteCategorie);
                            $categorie = mysqli_fetch_array($resultCategorie);

                            $vue = "index.php?vue=vue_article&code=".$code ;

                            $requeteKeywords = "SELECT k.Nom , k.Id_Keyword FROM keywords k , article_keywords ak , article a WHERE a.Id_Article =".$code." AND a.Id_Article = ak.Id_Article AND ak.Id_Keyword = k.Id_Keyword" ;
                            $resultKeywords = mysqli_query($connex,$requeteKeywords);
                            $keywords = mysqli_fetch_all($resultKeywords);

                            echo    '<div class="card">
                                        <a href="'.$vue.'"><img src="'.$articles[4].'" class="card-img-top" alt=""></a>
                                        <div class="card-body">
                                            <h3 class="card-title text-center">'.$articles[1].'</h3>
                                            <p class="card-text text-center">'.$articles[3].'</p>
                                            <div class="card-footer">
                                                <p class="card-text text-center">Ecrit par : '.$articles[2].'</p>
                                                <p class="card-text text-center"><small class="text-muted">Date de création :'.$articles[5].'</small></p>
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
                                            <div class="text-center card-footer-admin">
                                                <a href="'.$mod.'"><div>Modifier l\'article <i class="fas fa-edit"></i></div></a>
                                                <a href="'.$supp.'" onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer cet article ?\'));"><div>Supprimer l\'article <i class="fas fa-trash-alt"></i></div></a>
                                            </div>
                                        </div>
                                    </div>';

                        }
                        echo "</div>" ;
                    }

                    mysqli_close($connex) ;
            }


            ?>

        </div>

    </div>
