<?php 

    function connexionDB($Base)
    {

        // Connexion au serveur
        $connexion = mysqli_connect('localhost', "root", "root", $Base);

        // Affichage d'un message en cas d'erreur
        if (!$connexion) {
            echo "<script type=text/javascript>";
            echo "alert('Connexion impossible à la base de données')</script>";
            exit();
        }
        return $connexion ;

    }

    ?>