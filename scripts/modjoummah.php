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
                    <h1 class="page-header">Modification Demande de cong&eacute;s</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<?php

				include('connexion.php');
				$id = $_GET["id"];

				$sql = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$id'" ;
				$requete = $mysqli->query( $sql ) ;
				$result = $requete->fetch_assoc();
			 ?>
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="modjoummah2.php" method="post">
					<input type="hidden" id="idt" name="idt" value="<?php echo $result['lv_id']; ?>" />
					<div class="form-group">
						<label class="control-label col-sm-3" for="deb">Du :</label>
						<div class="col-sm-2">
							<input type="date" id="deb" name="deb" class="form-control"	value="<?php echo $result['lv_deb']; ?>" required />
						</div>
						<label class="control-label col-sm-1" for="ret">Au :</label>
						<div class="col-sm-2">
							<input type="date" id="ret" name="ret" class="form-control" value="<?php echo $result['lv_ret']; ?>" required />
						</div>
					</div>
					<?php
						include('connexion.php');
						$exis	= $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
						$nopers	= $exis['ID'];
						$nb		= $mysqli->query("SELECT leave_ldate AS DT FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='R&R' ")->fetch_array();		
						$dates	= $nb['DT'];
						$ldate 	= date("Y-m-d");
						$nombre = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='R&R' ")->fetch_array();		
						$nbjour	= (strtotime($ldate)-strtotime($dates))/86400;
						if(($nbjour>=56) && ($nombre['nb']!=0))
						{
							echo("<div class=\"form-group\">
									<label class=\"control-label col-sm-3\">Inclure R&R :</label>");
								echo("<div class=\"col-sm-5\">
									<label class=\"radio-inline\"><input type=\"radio\" name=\"opt\" id=\"opt\" value=\"NON\">NON</label>
									<label class=\"radio-inline\"><input type=\"radio\" name=\"opt\" id=\"opt\" value=\"OUI\">OUI</label></div></div>");
						}				
					?>
					<div class="form-group">
						<label class="control-label col-sm-3" for="addr">Adresse:</label>
						<div class="col-sm-5">
							<textarea id="addr" name="addr" class="form-control" required><?php echo $result['lv_addr']; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="oic">Superviseur :</label>
						<div class="col-sm-5">
							<select class="form-control" id="oic" name="oic" required>
								<option><?php echo $result['lv_sup']; ?></option>
								<?php
									include('connexion.php');
									$sqle	= "SELECT * FROM user WHERE pseudo='$pseudo' ";
									$requet = $mysqli->query( $sqle );
									$resulte = $requet->fetch_assoc();
									
									$unite	= $resulte['unite'];
									$nom	= $resulte['nom'];
									$prenom	= $resulte['prenom'];
									$sofo	= substr(stristr($unite, '/'), 1);
									
									if ($sofo != "CO NDJAMENA")
									{
										$sqlb 	= "SELECT off_nom, off_pnom FROM wfp_chd_officer WHERE off_unit='$sofo' AND off_nom !='$nom' AND off_pnom !='$prenom' ORDER BY off_nom" ;
										$requeteb = $mysqli->query( $sqlb ) ;

										while( $resultb = $requeteb->fetch_assoc() )
										{
											echo("<option> ".$resultb['off_nom'].",".$resultb['off_pnom']." </option>");
										}										
									}
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
						<label class="control-label col-sm-3" for="oic2">Chef d'unité (OIC) :</label>
						<div class="col-sm-5">
							<select class="form-control" id="oic2" name="oic2" required>
								<option><?php echo $result['lv_oic']; ?></option>
								<?php
									include('connexion.php');
									$sqle	= "SELECT * FROM user WHERE pseudo='$pseudo' ";
									$requet = $mysqli->query( $sqle );
									$resulte = $requet->fetch_assoc();
									
									$unite	= $resulte['unite'];
									$nom	= $resulte['nom'];
									$prenom	= $resulte['prenom'];
									$sofo	= substr(stristr($unite, '/'), 1);
									
									if ($sofo != "CO NDJAMENA")
									{
										$sqlb 	= "SELECT off_nom, off_pnom FROM wfp_chd_officer WHERE off_unit='$sofo' AND off_nom !='$nom' AND off_pnom !='$prenom' ORDER BY off_nom" ;
										$requeteb = $mysqli->query( $sqlb ) ;

										while( $resultb = $requeteb->fetch_assoc() )
										{
											echo("<option> ".$resultb['off_nom'].",".$resultb['off_pnom']." </option>");
										}										
									}
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
            

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
<?php
	include("inc/ridjilene2.php");
?>