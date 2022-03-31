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
			<style type="text/css"> .btn2{ width:160px; } </style>
                <div class="col-lg-12">
					<h1 class="page-header">
					<div align="right">
						<button type="button" class="btn btn2 btn-primary" onclick="document.location='stockadd.php'" title="ENTREE STOCK"><i class="fa fa-sign-in" fa-fw></i> Entr&eacute;es</button>
						<button type="button" class="btn btn2 btn-info" onclick="document.location='stocksort.php'" title="SORTIE STOCK"><i class="fa fa-sign-out" fa-fw></i> Sorties</button>
						<button type="button" class="btn btn2 btn-success" onclick="document.location='listdeqpmt.php'" title="Liste des demandes équipements"><i class="fa fa-pencil-square" fa-fw></i> Demandes</button>
					</div><br />
                    Sortie du Stock</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="stocksort2.php" method="post" onsubmit="return verif_formulaire()" >
					<div class="form-group">
						<label class="control-label col-sm-3" for="dem">Demandeur :</label>
						<div class="col-sm-5">
							<input type="text" id="dem" name="dem" placeholder="Nom et prenom du demandeur..." class="form-control" required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="item">Item Description :</label>
						<div class="col-sm-5">
							<select class="form-control" id="item" name="item" required>
								<option>Autre</option>
								<?php
									include('connexion.php');

									$sqlb 	= "SELECT catart_nom FROM wfp_chd_catart WHERE catart_type='ART' ORDER BY catart_nom" ;
									$requeteb = $mysqli->query( $sqlb ) ;

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
							<input type="text" id="nbr" name="nbr" class="form-control" required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-3" for="lib">Commentaires :</label>
						<div class="col-sm-5">
							<input type="text" id="lib" name="lib" placeholder="Renseigné raison..." class="form-control" required />
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