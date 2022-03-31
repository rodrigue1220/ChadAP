<?php
// On se connecte à MySQL
//try {$bdd = new PDO('mysql:host=db462747321.db.1and1.com;dbname=db462747321', 'dbo462747321', 'GRuf9ezG', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));}
 
// Vérifie les erreurs
//catch(Exception $e) { exit('<b>Catched exception at line '. $e->getLine() .' :</b> '. $e->getMessage());} CONCAT(j.reqsdr_deb, " ",j.reqsdr_horaire1) AS DEBUT, CONCAT(j.reqsdr_fin, " ",j.reqsdr_horaire2) AS FIN,
 include ('connexion.php');
// Si ok requete  
	
$sql ="SELECT j.reqsdr_id, j.reqsdr_deman, j.reqsdr_date, j.reqsdr_raison, j.reqsdr_actvt, j.reqsdr_salle, j.reqsdr_nbr, j.reqsdr_mmedia, j.reqsdr_pc,
	j.reqsdr_horaire1, j.reqsdr_horaire2, j.reqsdr_deb, j.reqsdr_fin, j.reqsdr_state, j.reqsdr_dateact, j.reqsdr_lib, p.nom, p.prenom, p.pseudo
	FROM user p
	INNER JOIN wfp_chd_requestsdr j
	ON j.reqsdr_deman = p.pseudo
	ORDER BY j.reqsdr_id DESC" ;
$requete = $mysqli->query( $sql ) ;
 
while ($ligneencours = $requete->fetch_assoc()) //Tant qu'il y a un enregistrement dans la table on l'associe à une ligne du tableau
{
    // Les lignes de variables du tableau, $ligneencours["DEBUT"], $ligneencours["FIN"]
    $export[] = array($ligneencours["reqsdr_id"], $ligneencours["nom"],$ligneencours["prenom"], $ligneencours["reqsdr_date"], $ligneencours["reqsdr_raison"], 
	$ligneencours["reqsdr_actvt"], $ligneencours["reqsdr_nbr"], $ligneencours["reqsdr_deb"], $ligneencours["reqsdr_fin"], $ligneencours["reqsdr_horaire1"],
	$ligneencours["reqsdr_horaire2"], $ligneencours["reqsdr_pc"], $ligneencours["reqsdr_mmedia"], $ligneencours["reqsdr_state"], $ligneencours["reqsdr_dateact"],
	$ligneencours["reqsdr_lib"]);
}
 
    // Nom du fichier et delimiteur entre chaque entrées
    $chemin = 'Rapport_Demandes_SDR.csv';
    $delimiteur = ';'; // Pour une tabulation, $delimiteur = "t";
 
    // Création du fichier csv
    // fopen : Ouvre un fichier
    /*
        w+ : Ouvre en lecture et écriture ;
        Place le pointeur de fichier au début du fichier et réduit la taille du fichier à 0.
        Si le fichier n'existe pas, on tente de le créer.
    */
    $fichier_csv = fopen($chemin, 'w+');
 
    /*
        Si votre fichier a vocation a être importé dans Excel,
        vous devez impérativement utiliser la ligne ci-dessous pour corriger
        les problèmes d'affichage des caractères internationaux (les accents par exemple)
    */
    fprintf($fichier_csv, chr(0xEF).chr(0xBB).chr(0xBF));
 
    // On affiche une fois l'entête sans boucle  'Du', 'Au',  
    $entetes = array('Numero', 'Nom', 'Prenom', 'Soumis le', 'Raison', 'Activite', 'Nombre', 'Date Debut', 'Date Fin', 'Heure Debut', 'Heure Fin', 'Pause-Cafe', 'Multimedia', 'Statut', 'Date Action', 'Commentaire');
	fputcsv($fichier_csv, $entetes, $delimiteur);
   // print_r($entetes);
 
    // Boucle foreach sur chaque ligne du tableau
    // Boucle pour se déplacer dans les tableaux
    foreach($export as $ligneaexporter){
        // chaque ligne en cours de lecture est insérée dans le fichier
        // les valeurs présentes dans chaque ligne seront séparées par $delimiteur
        fputcsv($fichier_csv, $ligneaexporter, $delimiteur);
        //print_r($ligneaexporter);
    }
 
    // fermeture du fichier csv
    fclose($fichier_csv);
 ?>
 <!--doctype HTML>
<html>
    <head>
        <meta charset="utf8" />
        <title>Download CSV</title>
    </head>
    <body>
        <p><a href='Demandes_Conges.csv' target='_blank'>Télécharger le fichier csv des inscrits</a></p>
    </body>
</html-->
