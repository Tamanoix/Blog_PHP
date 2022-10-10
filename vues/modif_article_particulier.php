

    <?php

        include_once("fonctionsPHP.php") ;

        $connex = connexionDB('bdd_blog') ;

        if ($connex)
        {

            mysqli_set_charset($connex, 'utf8') ;        // Ici le code pour mettre ma base de données en UTF8

            $code = (int)$_GET['code'] ;                // On récupère l'Id_Article envoyé par la page modif_articles.php via le click sur $mod
            $requeteModif = "SELECT * FROM article WHERE Id_Article = ".$code.";" ;         // Requête de récupération de toutes les données de l'article = celui envoyé par le code de la page modif_articles.php
            $resultModif = mysqli_query($connex, $requeteModif) ;

            if (!$resultModif)
            {

                echo "<script type='text/javascript'>"; 
                echo "alert('Impossible de récupérer cet article');";
                echo "</script>"; 

            }

            else
            {
                while ($ModArticle = mysqli_fetch_array($resultModif)) {
                    $IdArticle = $ModArticle[0] ;
                    $Titre = $ModArticle[1] ;
                    $Auteur = $ModArticle[2] ;
                    $ContenuTexte = $ModArticle[3] ;
                    $ContenuImage = $ModArticle[4] ;
                    $Date = $ModArticle[5] ;
                    $Categorie = $ModArticle[6] ;
                }

            }

            ?>
    
    <form action="enregistrer_modifs_article.php" method="POST" id="form-modifier-article">
        <fieldset>
            <legend>Modification de l'article</legend>
            <div>
                <div>
                    <span> <!-- On cache cette partie du formulaire -->
                        <input type="hidden" name="article" id="article" value="<?php echo $IdArticle ; ?>">    <!-- ID de l'Article pour transférer vers Enregistrer_modifs_article.PHP via POST -->
                    </span>
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control text-center" name="titre" id="titre" value="<?php echo $Titre ; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="auteur" class="form-label">Auteur</label>
                        <input type="text" class="form-control text-center" name="auteur" id="auteur" value="<?php echo $Auteur ; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="contenu_texte" class="form-label">Texte</label>
                        <input type="text" class="form-control text-center" name="contenu_texte" id="contenu_texte" value="<?php echo $ContenuTexte ; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="contenu_image" class="form-label">Image</label>
                        <input type="url" class="form-control text-center" name="contenu_image" id="contenu_image" value="<?php echo $ContenuImage ; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_creation" class="form-label">Date de création</label>
                        <input type="date" class="form-control text-center" name="date_creation" id="date_creation" value="<?php echo $Date ; ?>" required>
                    </div>

                    <!-- Le select Catégories -->
                    <?php
                    include_once("fonctionsPHP.php") ;
                    $connex = connexionDB('bdd_blog') ;
                    if ($connex) 
                    {
                        mysqli_set_charset($connex, 'utf8');    // Ici le code pour mettre ma base de données en UTF8

                        $requeteCategorieNom = "SELECT Nom FROM categorie WHERE Id_Categorie = ".$Categorie.";";
                        $resultCategorieNom = mysqli_query($connex,$requeteCategorieNom);
                        $nomCategorie = mysqli_fetch_array($resultCategorieNom);

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
                                echo '<select id="modif_categorie" name="modif_categorie" class="form-select mb-3 text-center" aria-label="Default select example" required>
                                        <option value="'.$Categorie.'" selected>'.$nomCategorie[0].'</option>' ;
                                while ($categories = mysqli_fetch_array($resultCategorie))
                                {
                                    if ($categories[0] == $Categorie) 
                                    {
                                        // condition pour éviter que la catégorie ne s'affiche en doublon dans la liste
                                    }
                                    else 
                                    {
                                        echo '<option value="'.$categories[0].'">'.$categories[1].'</option>' ;
                                    }
                            
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

                        $requeteKeywordsNom = "SELECT k.Id_Keyword , k.Nom FROM keywords k , article_keywords ak , article a WHERE a.Id_Article = ".$IdArticle." AND a.Id_Article = ak.Id_Article AND ak.Id_Keyword = k.Id_Keyword" ;
                        $resultKeywordsNom = mysqli_query($connex,$requeteKeywordsNom);
                        $nomKeywords = mysqli_fetch_all($resultKeywordsNom);

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
                                echo '<select id="modif_keywords" name="modif_keywords[]" class="form-select mb-3 text-center" multiple aria-label="multiple select example" required>' ;
                                $array_IdKeywords = [];
                                foreach($nomKeywords as $nk)
                                {
                                    echo '<option value="'.$nk[0].'" selected>'.$nk[1].'</option>' ;
                                    array_push($array_IdKeywords , $nk[0]) ;
                                }
                                while ($keywords = mysqli_fetch_array($resultKeywords))
                                {
                                    if (in_array($keywords[0] , $array_IdKeywords)) 
                                    {
                                        // condition pour éviter que les mots-clés ne s'affichent en doublon dans la liste
                                    }
                                    else
                                    {
                                        echo '<option value="'.$keywords[0].'">'.$keywords[1].'</option>' ;
                                    }
                                }
                                echo "</select>" ;
                            }
                    }
                    ?>

                </div>
            </div>
        </fieldset>
        <div id="btn-modifier-article">
            <input type="submit" value="Sauvegarder les modifications">
            <input type="reset" value="Réinitialiser les modifications">
        </div>
        <a href="index.php" id="cancel-modifier-article">Annuler</a>
    </form>

    <?php

        }

             mysqli_close($connex);
        

    ?>

