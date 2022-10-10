
    
    <form action="traitement_creation_article.php" method="POST" id="form-creer-article">
        <fieldset>
            <legend>Créer un nouvel article</legend>
            <div>
                <div>
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control text-center" name="titre" id="titre" required>
                    </div>
                    <div class="mb-3">
                        <label for="auteur" class="form-label">Auteur</label>
                        <input type="text" class="form-control text-center" name="auteur" id="auteur" required>
                    </div>
                    <div class="mb-3">
                        <label for="contenu_texte" class="form-label">Texte</label>
                        <input type="text" class="form-control text-center" name="contenu_texte" id="contenu_texte" required>
                    </div>
                    <div class="mb-3">
                        <label for="contenu_image" class="form-label">Image (URL)</label>
                        <input type="url" class="form-control text-center" name="contenu_image" id="contenu_image" required>
                    </div>

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
                                echo '<select id="create_categorie" name="create_categorie" class="form-select mb-3 text-center" aria-label="Default select example" required>
                                        <option selected>Sélectionner une catégorie</option>' ;
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
                                echo '<select id="create_keywords" name="create_keywords[]" class="form-select mb-3 text-center" multiple aria-label="multiple select example" required>
                                        <option selected>Sélectionner un ou plusieurs mots-clés</option>' ;
                                while ($keywords = mysqli_fetch_array($resultKeywords))
                                {
                                    echo '<option value="'.$keywords[0].'">'.$keywords[1].'</option>' ;
                                }
                                echo "</select>" ;
                            }
                            mysqli_close($connex) ;
                    }
                    ?>

                </div>
            </div>
        </fieldset>
        <div id="btn-creer-article">
            <input type="submit" value="Créer le nouvel article">
            <input type="reset" value="Réinitialiser le formulaire">
        </div>
        <a href="index.php" id="cancel-creer-article">Annuler</a>
    </form>

