<?php
// On se connecte à MySQL
//try {$bdd = new PDO('mysql:host=db462747321.db.1and1.com;dbname=db462747321', 'dbo462747321', 'GRuf9ezG', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));}
 
// Vérifie les erreurs
//catch(Exception $e) { exit('<b>Catched exception at line '. $e->getLine() .' :</b> '. $e->getMessage());}
 include ('connexion.php');
// Si ok requete

$wakit	= date("dmY");
$sql = "SELECT j.logs_id, j.logs_wh, j.logs_matdesc, j.logs_batch, j.logs_wbs, j.logs_grantnum, j.logs_grantdesc, j.logs_sledbbd, j.logs_total, j.logs_tddgrant, p.logc_nom, p.logc_lib 
	FROM wfp_chd_logstock j
	INNER JOIN wfp_chd_logconf p
	ON j.logs_wh = p.logc_nom
	ORDER BY j.logs_wh" ;
$requete = $mysqli->query( $sql ) ;
 
while ($ligneencours = $requete->fetch_assoc()) //Tant qu'il y a un enregistrement dans la table on l'associe à une ligne du tableau
{
    // Les lignes de variables du tableau
    $export[] = array($ligneencours["logc_lib"], $ligneencours["logs_wh"], $ligneencours["logs_matdesc"], $ligneencours["logs_batch"], $ligneencours["logs_wbs"], $ligneencours["logs_grantnum"],
	$ligneencours["logs_grantdesc"], $ligneencours["logs_sledbbd"], $ligneencours["logs_total"], $ligneencours["logs_tddgrant"]);
}
 
    // Nom du fichier et delimiteur entre chaque entrées
    $chemin = "WFP_Chad-ReportSTOCK-".$wakit.".csv";
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
 
    // On affiche une fois l'entête sans boucle
    $entetes = array('Sub-Office', 'Warehouse', 'Mat. Desc.', 'Batch', 'WBS', 'Grant Code', 'Grant Desc.', 'BBD', 'Tot. Stock', 'TDD Grant');
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
