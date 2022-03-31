<?php
// On se connecte à MySQL
//try {$bdd = new PDO('mysql:host=db462747321.db.1and1.com;dbname=db462747321', 'dbo462747321', 'GRuf9ezG', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));}
 
// Vérifie les erreurs
//catch(Exception $e) { exit('<b>Catched exception at line '. $e->getLine() .' :</b> '. $e->getMessage());}
 include ('connexion.php');
// Si ok requete

$wakit	= date("dmY");
$sql = "SELECT j.logt_id, j.logt_orig, j.logt_destiwh, j.logt_wbs, j.logt_desc, j.logt_batch, j.logt_grantnum, j.logt_grantdesc, j.logt_bbd, j.logt_netdeliv, j.logt_tddgrant, p.logc_nom, p.logc_lib 
		FROM wfp_chd_logtransit j
		INNER JOIN wfp_chd_logconf p
		ON j.logt_destiwh = p.logc_nom
		WHERE j.logt_orig!='TDCO'
		ORDER BY j.logt_destiwh";
		
$requete = $mysqli->query( $sql ) ;
 
while ($ligneencours = $requete->fetch_assoc()) //Tant qu'il y a un enregistrement dans la table on l'associe à une ligne du tableau
{
    // Les lignes de variables du tableau
    $export[] = array($ligneencours["logc_lib"], $ligneencours["logt_orig"], $ligneencours["logt_destiwh"], $ligneencours["logt_wbs"], $ligneencours["logt_desc"], $ligneencours["logt_batch"], 
	$ligneencours["logt_grantnum"], $ligneencours["logt_grantdesc"], $ligneencours["logt_bbd"], $ligneencours["logt_netdeliv"], $ligneencours["logt_tddgrant"]);
}
 
    // Nom du fichier et delimiteur entre chaque entrées
    $chemin = "WFP_Chad-ReportTRANSIT-OTHER-".$wakit.".csv";
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
    $entetes = array('Sub-Office', 'Origine', 'Destination WH', 'WBS', 'Commodité Desc.', 'Batch', 'Grant Code', 'Grant Desc.', 'BBD', 'Net Delivery', 'TDD Grant');
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
