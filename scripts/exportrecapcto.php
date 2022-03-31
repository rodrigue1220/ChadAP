<?php
// On se connecte à MySQL
//try {$bdd = new PDO('mysql:host=db462747321.db.1and1.com;dbname=db462747321', 'dbo462747321', 'GRuf9ezG', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));}
 
// Vérifie les erreurs
//catch(Exception $e) { exit('<b>Catched exception at line '. $e->getLine() .' :</b> '. $e->getMessage());}
 include ('connexion.php');
// Si ok requete
	$jour	= date("Y-m-d");
	$cald	= date_parse($jour);
	$dcald	= $cald["day"];
		
	if ($dcald > 2)
	{
		$chahar	= date('Y-m', strtotime('-1 month'));
	}
	else
	{
		$chahar	= date('Y-m', strtotime('-2 month'));
	}
		
$sql = "SELECT j.rcto_id, j.rcto_dem, j.rcto_mois, j.rcto_durcto, j.rcto_durcash, j.rcto_durover, p.rh_lname, p.rh_fname, p.rh_duty, p.rh_contrat 
	FROM wfp_chd_personnel p
	INNER JOIN wfp_chd_recapcto j
	ON j.rcto_dem = p.rh_nopers
	WHERE j.rcto_mois = '$chahar'
	ORDER BY p.rh_lname ASC" ;
$requete = $mysqli->query( $sql ) ;
 
while ($ligneencours = $requete->fetch_assoc()) //Tant qu'il y a un enregistrement dans la table on l'associe à une ligne du tableau
{
    // Les lignes de variables du tableau
    $export[] = array($ligneencours["rcto_dem"], $ligneencours["rh_lname"], $ligneencours["rh_fname"], $ligneencours["rh_duty"],
	$ligneencours["rh_contrat"], $ligneencours["rcto_durcto"], $ligneencours["rcto_durcash"], $ligneencours["rcto_durover"]);
}
 
    // Nom du fichier et delimiteur entre chaque entrées
    $chemin = "Recap_Demandes_CTO-".$chahar.".csv";
    $delimiteur = ','; // Pour une tabulation, $delimiteur = "t";
 
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
 
    // On affiche une fois l'entête sans boucle
    $entetes = array('Index', 'Nom', 'Prenom', 'Duty', 'Contrat', 'Total CTO','Total CASH', 'Overtime');
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
