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
                    <h1 class="page-header">Rejeter Demande de cong&eacute;s</h1>
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
				
				$demandeur	= $result['lv_nopers'];
				$sqlz = "SELECT * FROM user WHERE indexid='$demandeur' " ;
				$requetez	= $mysqli->query( $sqlz );
				$resultz	= $requetez->fetch_assoc();
				$nom		= $resultz["nom"];
				$prenom 	= $resultz["prenom"];
			 ?>
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="rejectaskdjoic.php" method="post">
					<input type="hidden" id="idt" name="idt" value="<?php echo $result['lv_id']; ?>" />
					<div class="form-group">
						<label class="control-label col-sm-3" for="addr">Demandeur:</label>
						<div class="col-sm-5">
							<input type="text" id="dem" name="dem" class="form-control" disabled="disabled" value="<?php echo $nom." ".$prenom; ?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="deb">Du :</label>
						<div class="col-sm-2">
							<input type="date" id="deb" name="deb" class="form-control"	value="<?php echo $result['lv_deb']; ?>" disabled="disabled" />
						</div>
						<label class="control-label col-sm-1" for="ret">Au :</label>
						<div class="col-sm-2">
							<input type="date" id="ret" name="ret" class="form-control" value="<?php echo $result['lv_ret']; ?>" disabled="disabled" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="addr">Adresse:</label>
						<div class="col-sm-5">
							<input type="text" id="addr" name="addr" class="form-control" value="<?php echo $result['lv_addr']; ?>" disabled="disabled"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="addr">Raisons / Commentaires:</label>
						<div class="col-sm-5">
							<textarea id="librej" name="librej" class="form-control" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-5">
							<input type="submit" class="btn btn-danger" value="Rejeter">
							<button type="reset" class="btn btn-warning">Effacer</button>
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