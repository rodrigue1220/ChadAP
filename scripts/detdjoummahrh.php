<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminRH")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
	include("inc/fonctionscalcul.php");
	//include("inc/fonctionscalc.php");	
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
		<style type="text/css"> .btn{ width:125px; } </style>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
						D&eacute;tails de la demande de Cong&eacute;s en ATTENTE RH
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row --><br />
			<div class="row">
			<?php			
				
				$pivot	= $_GET["id"];

				$sql = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$pivot'" ;
				$requete = $mysqli->query( $sql ) ;
				$result = $requete->fetch_assoc(); 
				$nopers	= $result['lv_nopers'];
				
				$sqlt = "SELECT * FROM user WHERE indexid='$nopers' " ;
				$requetet	= $mysqli->query( $sqlt );
				$resultt	= $requetet->fetch_assoc();
				$nom		= $resultt["nom"];
				$prenom 	= $resultt["prenom"];

					$wakit	= $result['lv_deb1'];
					$ret	= $result['lv_fin1'];
					$typ1	= $result['lv_type1'];
					$typ2	= $result['lv_type2'];
					$typ3	= $result['lv_type3'];
					$typ4	= $result['lv_type4'];
					$soldap	= $result['lv_soldap'];
					$reprise= $result['lv_rep'];
					if ($typ2 =="")
						$typ2 = "N/A";
					if ($typ3 =="")
						$typ3 = "N/A";
					if ($typ4 =="")
						$typ4 = "N/A";
					
					$nombre	= $result["lv_nbr1"];
					if($result["lv_type2"]=="AL")
						$nombre	= $result["lv_nbr2"];
					elseif($result["lv_type3"]=="AL")
						$nombre	= $result["lv_nbr3"];
					elseif($result["lv_type4"]=="AL")
						$nombre	= $result["lv_nbr4"];
										
					$qrest		= $result['lv_soldap']-$nombre;
					
					echo("
						<div class=\"col-lg-6\">
							<div class=\"table-responsive\">");			

					echo("<table class=\"table table-striped table-bordered table-hover\">
						<tbody>
							<tr><th>Demandeur</th><td>".$nom." ".$prenom."</td></tr>
							<tr><th>Cr&eacute;&eacute;e le</th><td>".$result['lv_date']."</td></tr>
							<tr><th>Type de cong&eacute;: <i>".$typ1."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb1']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin1']))."</b>, Nombre : <b>".$result['lv_nbr1']."</b></td></tr>");
							if ($typ2 !="N/A")
								echo("<tr><th>Type de cong&eacute;: <i>".$typ2."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb2']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin2']))."</b>, Nombre : <b>".$result['lv_nbr2']."</b></td></tr>");
							if ($typ3 !="N/A")
								echo("<tr><th>Type de cong&eacute;: <i>".$typ3."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb3']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin3']))."</b>, Nombre : <b>".$result['lv_nbr3']."</b></td></tr>");
							if ($typ4 !="N/A")
								echo("<tr><th>Type de cong&eacute;: <i>".$typ4."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb4']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin4']))."</b>, Nombre : <b>".$result['lv_nbr4']."</b></td></tr>");
							
							echo("<tr><th>Adresse</th><td>".$result['lv_addr']."</td></tr>
							<tr><th>Superviseur</th><td>".$result['lv_sup']."</td></tr>
							<tr><th>OIC</th><td>".$result['lv_oic']."</td></tr>");							
							echo("<tr><th>Date de Reprise</th><td>".date("d.m.Y",strtotime($reprise))."</td></tr>
							<tr><th>Quota Av.</th><td> Au ".date("d.m.Y",strtotime($result['lv_dateav']))." : <b>".$result['lv_soldav']."</b></td></tr>
							<tr><th>Solde Ap.</th><td> Au ".date("d.m.Y",strtotime($result['lv_dateap']))." : <b>".$qrest."</b></td></tr>
						</tbody>");
					echo("</table>");
					echo(" <a onclick=\"autorizdjm('".$result['lv_id']."') \"><button type=\"button\" class=\"btn btn-success\" title=\"Autoriser la Demande\"><i class=\"fa fa-check-circle\" fa-fw></i> AUTORISER</button></a>						
						<a onclick=\"rejetdj('".$result['lv_id']."') \"><button type=\"button\" class=\"btn btn-danger\" title=\"Rejeter la Demande\"><i class=\"fa fa-trash\" fa-fw></i> REJETER</button></a>");		
					echo("</div><!-- /.table-responsive --><br /></div>");

			?>
			
				<div class="col-lg-6">
                    <div class="alert alert-warning">Assurez-vous que les informations affich&eacute;es 
					sont bien correctes avant de <b>PRENDRE ACTION</b>!!!
					</div>
                </div>
                <!-- /.col-lg-6 -->
			</div><!-- /.row -->
		</div>
        <!-- /#page-wrapper -->

<?php
	include("inc/ridjilene2.php");
?>
