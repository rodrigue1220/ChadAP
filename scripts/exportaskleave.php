<?php
// On se connecte à MySQL
//try {$bdd = new PDO('mysql:host=db462747321.db.1and1.com;dbname=db462747321', 'dbo462747321', 'GRuf9ezG', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));}
 
// Vérifie les erreurs
//catch(Exception $e) { exit('<b>Catched exception at line '. $e->getLine() .' :</b> '. $e->getMessage());}
 include ('connexion.php');
// Si ok requete
$sql = "SELECT lv_id, lv_nopers, lv_type1, lv_deb1, lv_fin1, lv_nbr1, lv_type2, lv_deb2, lv_fin2, lv_nbr2, lv_type3, lv_deb3, lv_fin3, lv_nbr3, lv_type4, 
		lv_deb4, lv_fin4, lv_nbr4, lv_rep, lv_addr, lv_sup, lv_oic, lv_date, lv_datesup, lv_dateoic, lv_state, lv_statetrt, lv_selfs, lv_dselfs, lv_lib,
		p.rh_contrat, p.rh_lname, p.rh_fname, p.rh_duty 
	FROM wfp_chd_personnel p
	INNER JOIN wfp_chd_rqdjoummah j
	ON j.lv_nopers = p.rh_nopers
	ORDER BY j.lv_id DESC" ;
$requete = $mysqli->query( $sql ) ;
 
while ($ligneencours = $requete->fetch_assoc()) //Tant qu'il y a un enregistrement dans la table on l'associe à une ligne du tableau
{
    // Les lignes de variables du tableau
    $export[] = array($ligneencours["lv_id"], $ligneencours["lv_nopers"], $ligneencours["rh_lname"], $ligneencours["rh_fname"], $ligneencours["rh_duty"], $ligneencours["rh_contrat"], 
		$ligneencours["lv_type1"], $ligneencours["lv_deb1"], $ligneencours["lv_fin1"], $ligneencours["lv_nbr1"],
		$ligneencours["lv_type2"], $ligneencours["lv_deb2"], $ligneencours["lv_fin2"], $ligneencours["lv_nbr2"],
		$ligneencours["lv_type3"], $ligneencours["lv_deb3"], $ligneencours["lv_fin3"], $ligneencours["lv_nbr3"],
		$ligneencours["lv_type4"], $ligneencours["lv_deb4"], $ligneencours["lv_fin4"], $ligneencours["lv_nbr4"], 
		$ligneencours["lv_selfs"], $ligneencours["lv_dselfs"], $ligneencours["lv_rep"], $ligneencours["lv_addr"], $ligneencours["lv_sup"], $ligneencours["lv_oic"],
		$ligneencours["lv_date"], $ligneencours["lv_datesup"], $ligneencours["lv_dateoic"], $ligneencours["lv_state"], $ligneencours["lv_statetrt"], $ligneencours["lv_lib"]);
}
 
    // Nom du fichier et delimiteur entre chaque entrées
    $chemin = 'Demandes_Conges.csv';
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
    $entetes = array('ID', 'Index', 'Prenom', 'Nom', 'Duty', 'Contrat', 'Congés 1', 'Du', 'Au', 'Nombre', 'Congés 2', 'Du', 'Au', 'Nombre',
					'Congés 3', 'Du', 'Au', 'Nombre', 'Congés 4', 'Du', 'Au', 'Nombre', 'WSS', 'Date WSS', 'Reprise', 'Adresse','Superviseur',
					'OIC', 'Date Soumis', 'Date Approbation 1', 'Date Approbation 2', 'Statut', 'Statut Traitement RH', 'Commentaires');
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
