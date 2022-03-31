<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$id = $_GET["id"];
				
	$dem = $mysqli->query("SELECT rqeqpmt_demand AS ID FROM wfp_chd_requesteqpmt WHERE rqeqpmt_id='$id' ")->fetch_array();
	if($dem['ID'] != $pseudo)
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
?>

		<br /><br /><br />
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">		
						Modification de ma demande d'&eacute;quipement
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<?php

				include('connexion.php');
				$id = $_GET["id"];

				$sql = "SELECT * FROM wfp_chd_requesteqpmt WHERE rqeqpmt_id='$id'" ;
				$requete = $mysqli->query( $sql ) ;
				$result = $requete->fetch_assoc();
			 ?>
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="modif2askeqpmt.php" method="post">
					<input type="hidden" id="id" name="id" value="<?php echo $id;?>" />					
					<div class="form-group">
						<label class="control-label col-sm-3" for="item">Item Description :</label>
						<div class="col-sm-5">
							<select class="form-control" id="item" name="item" required>
								
								<?php
									include('connexion.php');
									$cle	= $_GET["cle"];

									$sqlb 	= "SELECT catart_nom FROM wfp_chd_catart WHERE catart_type='ART' AND catart_lib='$cle' ORDER BY catart_nom" ;
									$requeteb = $mysqli->query( $sqlb ) ;

									echo("<option> ".$result['rqeqpmt_item']." </option>");
									echo("<option>Autre</option>");
									while( $resultb = $requeteb->fetch_assoc() )
									{
										echo("<option> ".$resultb['catart_nom']." </option>");
									}				
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="otr">Autre  :</label>
						<div class="col-sm-5">
							<input type="text" id="otr" name="otr" placeholder="Spécifier Si Autre..." class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="nbr">Nombre :</label>
						<div class="col-sm-5">
							<input type="text" id="nbr" name="nbr" class="form-control" value="<?php echo $result['rqeqpmt_nbr']; ?>" required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="motif">Raison :</label>
						<div class="col-sm-5">
							<input type="text" id="motif" name="motif" class="form-control" value="<?php echo $result['rqeqpmt_motif']; ?>" required />
						</div>
					</div>				
					<div class="form-group">
						<label class="control-label col-sm-3" for="oic">Chef de Section / OIC :</label>
						<div class="col-sm-5">
							<select class="form-control" id="oic" name="oic" required>

								<?php
									include('connexion.php');
									$sqle	= "SELECT * FROM user WHERE pseudo='$pseudo' ";
									$requet = $mysqli->query( $sqle );
									$resulte = $requet->fetch_assoc();
									
									$unite	= $resulte['unite'];
									$nom	= $resulte['nom'];
									$prenom	= $resulte['prenom'];
									$sqlb 	= "SELECT off_nom, off_pnom FROM wfp_chd_officer WHERE off_unit='$unite' AND off_nom !='$nom' AND off_pnom !='$prenom' ORDER BY off_nom" ;
									$requeteb = $mysqli->query( $sqlb ) ;
									while( $resultb = $requeteb->fetch_assoc() )
									{
										echo("<option> ".$resultb['off_nom'].",".$resultb['off_pnom']." </option>");
									}				
								?>
							</select>
						</div>
					</div>	      
					
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-5">
							<input type="submit" class="btn btn-default" value="Modifier">
							<button type="reset" class="btn btn-danger">Effacer</button>
						</div>
					</div>
				</form>
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->
<?php
	include("inc/ridjilene2.php");
?>