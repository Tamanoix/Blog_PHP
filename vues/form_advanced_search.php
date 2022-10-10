

            <form action="index.php?vue=result_advanced_search" method="POST" id="form-rechercher-article">

                    <!-- Le select Catégories -->
                    <?php
                    include_once("fonctionsPHP.php") ;
                    $connex = connexionDB('bdd_blog') ;
                    if ($connex) 
                    {
                        mysqli_set_charset($connex, 'utf8');    // Ici le code pour mettre ma base de données en UTF8

                            // Récupérer les données de Catégories
                        $requeteCategorie = "SELECT * FROM categorie";
                        $resultCategorie = mysqli_query($connex,$requeteCategorie);
                        if (!$resultCategorie) 
                            {
                                echo "<script type=text/javascript>" ;
                                echo 'alert("Impossible d\'afficher les catégories")</script>' ;
                            }
                        else 
                            {
                                echo '<select id="search_categorie" name="search_categorie" class="form-select mb-3 text-center" aria-label="Default select example" required>';
                                while ($categories = mysqli_fetch_array($resultCategorie))
                                {
                                    echo '<option value="'.$categories[0].'">'.$categories[1].'</option>' ;
                                }
                                echo "</select>" ;
                            }
                            mysqli_close($connex) ;
                    }
                    ?>

                    <!-- Le select Keywords -->
                    <?php
                    include_once("fonctionsPHP.php") ;
                    $connex = connexionDB('bdd_blog') ;
                    if ($connex) 
                    {
                        mysqli_set_charset($connex, 'utf8');    // Ici le code pour mettre ma base de données en UTF8

                            // Récupérer les données de Keywords
                        $requeteKeywords = "SELECT * FROM keywords";
                        $resultKeywords = mysqli_query($connex,$requeteKeywords);
                        if (!$resultKeywords) 
                            {
                                echo "<script type=text/javascript>" ;
                                echo "alert('Impossible d afficher les mots-clés')</script>" ;
                            }
                        else 
                            {
                                echo '<select id="search_keywords" name="search_keywords" class="form-select mb-3 text-center" aria-label="Default select example" required>' ;
                                while ($keywords = mysqli_fetch_array($resultKeywords))
                                {
                                    echo '<option value="'.$keywords[0].'">'.$keywords[1].'</option>' ;
                                }
                                echo "</select>" ;
                            }
                    }
                    ?>

                    <!-- Le select Auteurs -->
                    <?php
                    include_once("fonctionsPHP.php") ;
                    $connex = connexionDB('bdd_blog') ;
                    if ($connex) 
                    {
                        mysqli_set_charset($connex, 'utf8');    // Ici le code pour mettre ma base de données en UTF8
                            // Récupérer les données de Keywords
                        $requeteAuteur = "SELECT Auteur , Id_Article FROM article";
                        $resultAuteur = mysqli_query($connex,$requeteAuteur);
                        if (!$resultAuteur) 
                            {
                                echo "<script type=text/javascript>" ;
                                echo "alert('Impossible d afficher les auteurs')</script>" ;
                            }
                        else 
                            {
                                echo '<select id="search_auteur" name="search_auteur" class="form-select mb-3 text-center" aria-label="Default select example" required>' ;
                                while ($auteur = mysqli_fetch_array($resultAuteur))
                                {
                                    echo '<option value="'.$auteur[1].'">'.$auteur[0].'</option>' ;
                                }
                                echo "</select>" ;
                            }
                            mysqli_close($connex) ;
                    }
                    ?>

                    <div id="btn-rechercher-article">
                        <input type="Submit" value="Rechercher" class="text-center">
                    </div>

            </form>

