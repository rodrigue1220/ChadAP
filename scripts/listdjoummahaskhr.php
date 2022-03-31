<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');

	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminRH")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
?>
<script language="javascript">
	  function rejetdj( identifiant )
      {
        var confirmation = confirm( "Voulez-vous vraiment Rejeter cette DEMANDE de Congés?" ) ;
		if( confirmation )
		{
			document.location.href = "djoummahrjrh.php?id="+identifiant ;
		}
      }
	  
	  function autorizdjm( identifiant )
      {
        var confirmation = confirm( "Voulez-vous vraiment Autoriser cette DEMANDE de Congés?" ) ;
		if( confirmation )
		{
			document.location.href = "djoummahokrh.php?id="+identifiant ;
		}
      }
</script>

		<br /><br /><br />
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
						Demandes de Cong&eacute;s avec Solde N&eacute;gatif
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Liste des demandes AL
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                
							<?php
										
								$existe = $mysqli->query("SELECT lv_id AS ID FROM wfp_chd_rqdjoummah WHERE lv_state='ATTENTERH' ")->fetch_array();
								if($existe['ID'] != 0)
								{	
									echo("<table class=\"table\">
									<thead>
										<tr>
											<th>#</th>
											<th>Demandeur</th>
											<th>D&eacute;but</th>
											<th>Fin</th>
											<th>Nombre</th>
											<th>Quota Av.</th>
											<th>Solde Ap.</th>
										</tr>
									</thead>");
									
									$i=1;
									$sql = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_state='ATTENTERH' " ;
									$requete = $mysqli->query( $sql ) ;								
								
									while( $result = $requete->fetch_assoc()  )
									{
										$ident 	= $result["lv_id"];
										
										$nombre	= $result["lv_nbr1"];
										if($result["lv_type2"]=="AL")
											$nombre	= $result["lv_nbr2"];
										elseif($result["lv_type3"]=="AL")
											$nombre	= $result["lv_nbr3"];
										elseif($result["lv_type4"]=="AL")
											$nombre	= $result["lv_nbr4"];
										
										$varf 	= $mysqli->query("SELECT GREATEST(lv_fin1, lv_fin2, lv_fin3, lv_fin4) AS DMAX FROM wfp_chd_rqdjoummah WHERE lv_id='$ident' ")->fetch_array();		
										$fin	= $varf['DMAX'];
										
										$nopers = $result['lv_nopers'];
										$sqlt = "SELECT * FROM user WHERE indexid='$nopers' " ;
										$requetet	= $mysqli->query( $sqlt );
										$resultt	= $requetet->fetch_assoc();
										$nom		= $resultt["nom"];
										$prenom 	= $resultt["prenom"];

										$qrest		= $result['lv_soldap']-$nombre;
										
										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$nom." ".$prenom."</td>");
										echo("<td>".date("d.m.Y",strtotime($result['lv_deb1']))."</td>");	
										echo("<td>".date("d.m.Y",strtotime($fin))."</td>");	
										echo("<td>".$nombre."</td>");
										echo("<td>".$result['lv_soldav']."</td>");
										echo("<td>".$qrest."</td>");
										echo("<td><button type=\"button\" class=\"btn btn-primary btn-circle\" onclick=\"document.location='detdjoummahrh.php?id=".$result['lv_id']."'\" title=\"Détails\"><i class=\"fa fa-list\"></i></button></td>");
										echo("<td><a onclick=\"autorizdjm('".$result['lv_id']."') \"><button type=\"button\" class=\"btn btn-success btn-circle\" title=\"Autoriser\"><i class=\"fa fa-check\"></i></button></td>");
										echo("<td><a onclick=\"rejetdj('".$result['lv_id']."') \"><button type=\"button\" class=\"btn btn-warning btn-circle\" title=\"Rejeter\"><i class=\"fa fa-reply\"></i></button></td>");
										$i++;
									}
								}
								else
								{
									echo("<div class=\"alert alert-info\">Aucune demande avec Solde N&eacute;gatif &agrave; autoriser...</div>") ;		
								}
							?>
								
								</tr></tbody></table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
			
        </div>
        <!-- /#page-wrapper -->
<?php
	include("inc/ridjilene2.php");
?>
