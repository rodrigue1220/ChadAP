<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	
	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
?>

		<br /><br /><br />
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Modification Demande de tansport</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<?php

				include('connexion.php');
				$id = $_GET["id"];

				$sql = "SELECT * FROM wfp_chd_request WHERE reqst_id='$id'" ;
				$requete = $mysqli->query( $sql ) ;
				$result = $requete->fetch_assoc();
			 ?>
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="modif1ask2.php" method="post">
					<input type="hidden" id="id" name="id" value="<?php echo $id;?>" />
					<div class="form-group">
						<label class="control-label col-sm-3" for="motif">Motif :</label>
						<div class="col-sm-5">
							<input type="text" id="motif" name="motif" class="form-control" value="<?php echo $result['reqst_motif']; ?>" required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="dest">Destination :</label>
						<div class="col-sm-5">
							<input type="text" id="dest" name="dest" class="form-control" value="<?php echo $result['reqst_dest']; ?>" required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="det">Passager (s) :</label>
						<div class="col-sm-5">
							<input type="text" id="det" name="det" class="form-control" value="<?php echo $result['reqst_passag']; ?>" required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-3" for="dep">Du :</label>
						<div class="col-sm-2">
							<input type="date" id="dep" name="dep" class="form-control" value="<?php echo $result['reqst_dep']; ?>" required />
						</div>
						<label class="control-label col-sm-1" for="dep">Au :</label>
						<div class="col-sm-2">
							<input type="date" id="ret" name="ret" class="form-control" value="<?php echo $result['reqst_ret']; ?>" required />
						</div>
					</div>	
					<div class="form-group">
						<label class="control-label col-sm-3" for="heurd">De :</label>
						<div class="col-sm-1">
							<input type="text"  id="heurd" name="heurd" class="form-control" value="<?php echo $result['reqst_heurd']; ?>" required />
						</div>
						<div class="col-sm-1">
							<input type="text" id="mind" name="mind" class="form-control" value="<?php echo $result['reqst_mind']; ?>" required />
						</div>
						<label class="control-label col-sm-1" for="heurr">A :</label>
						<div class="col-sm-1">
							<input type="text" id="heurr" name="heurr" class="form-control" value="<?php echo $result['reqst_heurr']; ?>" required />
						</div>
						<div class="col-sm-1">
							<input type="text" id="minr" name="minr" class="form-control" value="<?php echo $result['reqst_minr']; ?>" required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-3" for="oic">OIC (Officer) :</label>
						<div class="col-sm-5">
							<select class="form-control" id="oic" name="oic" required>
								<option><?php echo $result['reqst_oic']; ?></option>
								<?php
									include('connexion.php');
									$unit	= $mysqli->query("SELECT unite AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
									$unite	= $unit['ID'];
									$sqlb 	= "SELECT off_nom, off_pnom FROM wfp_chd_officer WHERE off_unit='$unite' ORDER BY off_nom" ;
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
							<input type="submit" class="btn btn-default" value="Enregistrer">
							<button type="reset" class="btn btn-danger">Effacer</button>
						</div>
					</div>
				</form>
            </div>
            <!-- /.row -->
            

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
<?php
	include("inc/ridjilene2.php");
?>