<?php
    session_start(); // ici on continue la session
    if ((!isset($_SESSION['session'])) || ($_SESSION['session'] == ""))
    {
    // La variable $_SESSION['login'] n'existe pas, ou bien elle est vide
    // <=> la personne ne s'est PAS connectée
    echo '<p>Vous ne pouvez pas <a href="../index.php">acceder</a>.</p>'."\n";
    exit();
    }
?>
