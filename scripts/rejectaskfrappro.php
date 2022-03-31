<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	if ($profil != "AdminFOURN")
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
						<div align="right">
							<button type="button" class="btn btn-success" onclick="document.location='listdeqpmt.php'" title="Liste des demandes équipements"><i class="fa fa-pencil-square" fa-fw></i> Liste des Demandes </button>
						</div><br />		
						Rejet Admin Appro / STOCK
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
                <form class="form-horizontal" name="formulaire" action="rejectaskfrappro2.php" method="post">
					<input type="hidden" id="id" name="id" value="<?php echo $id;?>" />					
					<div class="form-group">
						<label class="control-label col-sm-3" for="demand">Demandeur :</label>
						<div class="col-sm-5">
							<input type="text" id="demand" name="demand" disabled="disabled" class="form-control" value="<?php echo $result['rqeqpmt_demand']; ?>" required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="item">Item Description :</label>
						<div class="col-sm-5">
							<input type="text" id="item" name="item" disabled="disabled" class="form-control" value="<?php echo $result['rqeqpmt_item']; ?>" required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="nbr">Nombre :</label>
						<div class="col-sm-5">
							<input type="text" id="nbr" name="nbr" disabled="disabled" class="form-control" value="<?php echo $result['rqeqpmt_nbr']; ?>" required />
						</div>
					</div>	
					<div class="form-group">
						<label class="control-label col-sm-3" for="comm">Commentaires Admin Appro / STOCK:</label>
						<div class="col-sm-5">
							<textarea id="comm" name="comm" placeholder="Saisir vos remarques"></textarea>
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