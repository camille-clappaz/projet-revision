<?php
require("Card.php");
$_SESSION['messagefin'] = "";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Memory</title>
</head>

<body>
    <div class="niveau">
        <form method="post">
            <label class="choix">Veuillez choisir le nombre de cartes : </label>
            <select class="box" name="paires" id="paires">
                <option value="3">6 Cartes</option>
                <option value="6">12 Cartes</option>
                <option value="12">24 Cartes</option>
            </select>
            <button type="submit" name="choisir">Choisir</button>
        </form>
    </div>
    <?php if (isset($_SESSION['nbCoups'])) {
        if ($_SESSION['nbCoups'] == 1) { ?>
            <div class="coups">Vous avez joué <?= $_SESSION["nbCoups"] ?> coup</div>
        <?php } else { ?>
            <div class="coups">Vous avez joué <?= $_SESSION["nbCoups"] ?> coups</div>
    <?php }
    } ?>

    <?php
    $_SESSION['nb'] = (nbCartes()); //on récupère le nombre de carte séléctionnées
    AfficherCartes($_SESSION['nb']); //puis on affiche le bon nombre de cartes
    endGame(); ?>
    <div class="messagefin"><?= $_SESSION['messagefin']; ?></div>
    <form action="" method="get">
        <button type="submit" name="reset">RESET</button>
    </form>
</body>

</html>
<?php


function creerCartes($nb) // on crée les cartes et on les affiches mélangées.
{
    if (empty($_SESSION['plateau'])) { // on crée une variable de session pour stocker toutes les carte dedans 
        $_SESSION['plateau'] = [];
        for ($i = 0; $i < ($nb * 2); $i += 2) { // $i+=2 => $i=$i+2
            $img_face_up = 'issets/img/' . $i . '.jpg';
            $img_face_down = "issets\img\oeil_sauron.jpg";
            $card[$i] = new Card($i, $img_face_down, $img_face_up, false);
            $card[$i + 1] = new Card($i + 1, $img_face_down, $img_face_up, false);
            array_push($_SESSION['plateau'], $card[$i], $card[$i + 1]); // on push les cartes créees dans notre variable de session
            shuffle($_SESSION['plateau']); // on mélange les cartes
        }
        return $_SESSION['plateau'];
        // NE PAS OUBLIER DE RETOURNER LA VALEUR!!
    }
}

function afficherCartes($nb)
{
?>
    <form action="" method="get">
        <?php
        creerCartes($nb);
        foreach ($_SESSION['plateau'] as $carte) {
            verifCarte($carte);


            if ($carte->getState() == false) {
        ?>
                <button type="submit" value="<?= $carte->getId_card(); ?>" name="retourner">
                    <img src="<?= $carte->getImg_face_down(); ?>" alt="">
                </button>
            <?php

            } else {
            ?>
                <button type="submit" value="<?= $carte->getId_card(); ?>" name="retourner">
                    <img src=" <?= $carte->getImg_face_up(); ?>" alt="">
                </button>
        <?php
            }
        }
        ?>
    </form>
<?php
}
function cliqueCarte($carte) // On vérifie qu'on à cliqué sur la carte grâce à son id, si on clique elle tourne fac up
{
    if (isset($_GET['retourner'])) {
        if ($_GET['retourner'] == $carte->getId_card()) {
            // $carte->setState(true); //si on le met ici, PROBLEME DE RECHARGEMENT donc PB AFFICHAGE MESSAGE
            return true;
        }
    }
}

function verifCarte($carte)
{

    // on verifie qu'on a cliqué sur une carte grâce à son id. 
    if (isset($_SESSION["2cartes"])) {
        if (count($_SESSION["2cartes"]) < 2) { //soit il y a 0,1 carte, si il y en a moins de 2 on peut ajouter une carte dans le tableau.
            // on change son état pour qu'elle se retourne
            if (cliqueCarte($carte)) {
                $carte->setState(true);
                array_push($_SESSION["2cartes"], $carte);
            }
        } else {
            if (isset($_SESSION['nbCoups'])) { 
                $_SESSION['nbCoups']++;
            } else {
                $_SESSION['nbCoups'] = 1;
            }
            if ($_SESSION['2cartes'][0]->img_face_up == $_SESSION['2cartes'][1]->img_face_up) { // on verifie si c'est une paire
                //les cartes sont paires, on met leur etat à true et on les envois dans une variable de session $_SESSION['trueCartes']
                // si elle est définit, sinon on la définit
                if (isset($_SESSION['trueCartes'])) { // si la variable est définit
                    $_SESSION['2cartes'][0]->setState(true); // comme c'est paire, l'état des cartes est true
                    $_SESSION['2cartes'][1]->setState(true);
                    // echo " paire de carte";
                } else {
                    $_SESSION['trueCartes'] = []; // si pas définit, on la définit ici
                }
                array_push($_SESSION['trueCartes'], $_SESSION['2cartes']); // on les envoi dans une variables de session pour qu'elles restent en face up
                $_SESSION["2cartes"] = []; // on vide la session["2carte"] pour continuer le jeu

            } else {
                $_SESSION['2cartes'][0]->setState(false);
                $_SESSION['2cartes'][1]->setState(false);
                $_SESSION["2cartes"] = [];
                // echo "pas les memes";
            }
        }
        // si il y en a deux, le tableau se vide et la carte sur laquelle on a cliquer se met à la place
    } else {
        $_SESSION["2cartes"] = [];
    }
}
function endGame()
{
    // Quand toutes les cartes sont true, c'est la fin du jeu. Message de fin de partie et score.
    if (isset($_SESSION['trueCartes'])) {
        if (count($_SESSION['trueCartes']) == (count($_SESSION['plateau']) / 2)) { // on divise par deux car les cartes sont par paires dans trueCartes
            $_SESSION["score"] = (count($_SESSION['trueCartes']) * 4) / $_SESSION['nbCoups'];
            $_SESSION['messagefin'] = "Partie terminée, bravo! Votre score: " . $_SESSION['score'];
        }
    }
}
function resetGame()
{
    if (isset($_GET['reset'])) {
        session_destroy();
        header('location: memory.php');
    }
}
resetGame();


var_dump($_SESSION);

// var_dump(count($_SESSION['plateau']));
// var_dump(count($_SESSION['trueCartes']));
function nbCartes()
{
    if (isset($_POST['choisir'])) {
        return $_POST['paires'];
    }
}


?>