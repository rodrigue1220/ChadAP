<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminFLEET")
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
                    <h1 class="page-header">Modification de la demande n&deg;<?php echo $_GET["id"]; ?> </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="modvalidask2.php" method="post" onsubmit="return verif_formulaire()" >
					<?php echo "<input type=\"hidden\" name=\"id\" id=\"id\" value=".$_GET["id"]." \>"; ?>
					<div class="form-group">
						<label class="control-label col-sm-3" for="chauf">Chauffeur :</label>
						<div class="col-sm-5">						
							<select class="form-control" id="chauf" name="chauf" >
								<option>Choisir...</option>
								<?php
									include('connexion.php');
									$sqlb = "SELECT * FROM wfp_chd_chauffeur ORDER BY chauf_nom" ;
									$requeteb = $mysqli->query( $sqlb ) ;

									while( $resultb = $requeteb->fetch_assoc() )
									{
										echo("<option> ".$resultb['chauf_nom']." ".$resultb['chauf_pnom']." </option>");
									}				
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="vehi">V&eacute;hicule  :</label>
						<div class="col-sm-5">
							<select class="form-control" id="vehi" name="vehi" >
								<option>Choisir...</option>
								<?php
									include('connexion.php');
									$sqlb = "SELECT flot_immat FROM wfp_chd_flotte ORDER BY flot_immat" ;
									$requeteb = $mysqli->query( $sqlb ) ;

									while( $resultb = $requeteb->fetch_assoc() )
									{
										echo("<option> ".$resultb['flot_immat']." </option>");
									}				
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-5">
							<input type="submit" class="btn btn-default" value="Approuver">
							<button type="reset" class="btn btn-danger">Annuler</button>
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
