<?php
// On se connecte à MySQL
//try {$bdd = new PDO('mysql:host=db462747321.db.1and1.com;dbname=db462747321', 'dbo462747321', 'GRuf9ezG', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));}
 
// Vérifie les erreurs
//catch(Exception $e) { exit('<b>Catched exception at line '. $e->getLine() .' :</b> '. $e->getMessage());}
 include ('connexion.php');
// Si ok requete
$sql = "SELECT j.cto_index, p.rh_lname, p.rh_fname, p.rh_duty, j.cto_date, j.cto_deb, j.cto_hdeb, j.cto_hfin,
	j.cto_deb2, j.cto_hdeb2, j.cto_hfin2, j.cto_choix, j.cto_raison, j.cto_approver, j.cto_dapprover, j.cto_dapprover2,
	j.cto_dure, j.cto_statut
	FROM wfp_chd_personnel p
	INNER JOIN wfp_chd_djmcto j
	ON j.cto_index = p.rh_nopers
	ORDER BY p.rh_lname ASC" ;
$requete = $mysqli->query( $sql ) ;
 
while ($ligneencours = $requete->fetch_assoc()) //Tant qu'il y a un enregistrement dans la table on l'associe à une ligne du tableau
{
    // Les lignes de variables du tableau
    $export[] = array($ligneencours["cto_index"], $ligneencours["rh_lname"], $ligneencours["rh_fname"], $ligneencours["rh_duty"],
	$ligneencours["cto_date"], $ligneencours["cto_deb"], $ligneencours["cto_hdeb"], $ligneencours["cto_hfin"],
	$ligneencours["cto_deb2"], $ligneencours["cto_hdeb2"], $ligneencours["cto_hfin2"], $ligneencours["cto_choix"], $ligneencours["cto_raison"],
	$ligneencours["cto_approver"], $ligneencours["cto_dapprover"], $ligneencours["cto_dapprover2"],
	$ligneencours["cto_dure"], $ligneencours["cto_statut"]);
}
 
    // Nom du fichier et delimiteur entre chaque entrées
    $chemin = 'Demandes_Cto.csv';
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
    $entetes = array('Index', 'Nom', 'Prenom', 'Duty', 'Soumis le', 'Date Prevue', 'Debut Prevu', 'Fin Prevu', 
	'Date Effective', 'Debut Eff', 'Fin Eff','Type', 'Raison','Approbateur', 'Date Approbation', 'Date Certification', 'Duree', 'Statut');
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
