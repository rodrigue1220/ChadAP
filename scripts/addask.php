<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');

	include("inc/rass.php");
	include("inc/botoune.php");
?>
		<br /><br /><br />
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Demande de tansport</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="add2ask.php" method="post" onsubmit="return verif_formulaire()" >
					<div class="form-group">
						<label class="control-label col-sm-3" for="nom">Demandeur  :</label>
						<div class="col-sm-5">
							<input type="text" id="nom" name="nom" placeholder="Entrer nom et prenom" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="motif">Motif :</label>
						<div class="col-sm-5">
							<input type="text" id="motif" name="motif" placeholder="Renseigner le motif" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="dest">Destination  :</label>
						<div class="col-sm-5">
							<input type="text" id="dest" name="dest" placeholder="Entrer la destination" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="det">Noms des Passagers :</label>
						<div class="col-sm-5">
							<input type="text" id="det" name="det" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="dep">Du :</label>
						<div class="col-sm-2">
							<input type="date" id="dep" name="dep" class="form-control">
						</div>
						<label class="control-label col-sm-1" for="ret">Au :</label>
						<div class="col-sm-2">
							<input type="date" id="ret" name="ret" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="heur">De :</label>
						<div class="col-sm-1">
							<select class="form-control" id="heurd" name="heurd" >
								<option>HH</option>
								<option> 07 </option><option> 08 </option><option> 09 </option><option> 10 </option>
								<option> 11 </option><option> 12 </option><option> 13 </option><option> 14 </option>
								<option> 15 </option><option> 16 </option><option> 17 </option><option> 18 </option>
							</select>
						</div>
						<div class="col-sm-1">
							<select class="form-control" id="mind" name="mind" >
								<option>mm</option>
								<option> 00 </option><option> 05 </option><option> 10 </option><option> 15 </option>
								<option> 20 </option><option> 25 </option><option> 30 </option><option> 35 </option>
								<option> 40 </option><option> 45 </option><option> 50 </option><option> 55 </option>
							</select>
						</div>
						<label class="control-label col-sm-1" for="heur">A :</label>
						<div class="col-sm-1">
							<select class="form-control" id="heurr" name="heurr" >
								<option>HH</option>
								<option> 07 </option><option> 08 </option><option> 09 </option><option> 10 </option>
								<option> 11 </option><option> 12 </option><option> 13 </option><option> 14 </option>
								<option> 15 </option><option> 16 </option><option> 17 </option><option> 18 </option>
							</select>
						</div>
						<div class="col-sm-1">
							<select class="form-control" id="minr" name="minr" >
								<option>mm</option>
								<option> 00 </option><option> 05 </option><option> 10 </option><option> 15 </option>
								<option> 20 </option><option> 25 </option><option> 30 </option><option> 35 </option>
								<option> 40 </option><option> 45 </option><option> 50 </option><option> 55 </option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="oic">OIC (Officer) :</label>
						<div class="col-sm-5">
							<select class="form-control" id="oic" name="oic" >
								<option>Autorisé par...</option>
								<?php
									include('connexion.php');
									$unit	= $mysqli->query("SELECT unite AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
									$unite	= $unit['ID'];
									$sqlb 	= "SELECT off_nom, off_pnom FROM wfp_chd_officer WHERE off_unit='$unite' ORDER BY off_nom" ;
									$requeteb = $mysqli->query( $sqlb ) ;

									while( $resultb = $requeteb->fetch_assoc() )
									{
										echo("<option> ".$resultb['off_nom']." ".$resultb['off_pnom']." </option>");
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
