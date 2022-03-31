<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
require_once('config.php');
require_once('verifications.php');
include("connexion.php");
?>
	<link href="http://10.109.87.10:8080/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand >
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
          
        </div>		
      </a>
	
	  <!-- Divider -->
	  <hr class="sidebar-divider my-0">
	
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="log_admin.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>TABLEAU DE BORD</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>
	  
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEqptF" aria-expanded="true" aria-controls="collapseEqptF">
          <i class="fas fa-fw fa-edit"></i>
          <span>NOUVELLE DEMANDE</span>
        </a>
        <div id="collapseEqptF" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Demande Personnalis&eacute;e :</h6>
			<a class="collapse-item" href="add1asksdr.php"><i class="fas fa-fw fa-home"></i> SALLE REUNION</a>
            <a class="collapse-item" href="askfour.php"><i class="fas fa-fw fa-book-open"></i> FOURNITURE</a>
			<a class="collapse-item" href="askeqpmt.php"><i class="fas fa-fw fa-laptop"></i> EQUIPEMENT</a>
			<a class="collapse-item" href="askcargo.php"><i class="fas fa-fw fa-truck"></i> CAMIONS LOG.</a>
          </div>
        </div>
      </li>
	  
	  <!-- Nav Item - Charts -->
      <li class="nav-item active">
        <a class="nav-link" href="booksgym.php">
          <i class="fas fa-fw fa-calendar-check"></i>
          <span>BOOK S.GYM</span></a>
      </li>
	  
	  <?php
	    /*$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
		$profil	= $pro["PROF"];
	    if($profil == "AdminLOGSTK")
		{*/
			echo("<li class=\"nav-item active\">
					<a class=\"nav-link\" href=\"#\">
						<i class=\"fas fa-fw fa-line-chart\"></i>
						<span>STOCK REPORT</span>
					</a>
				</li>"); 
		//}
	  ?>
	  
	  <!-- Nav Item - Charts >
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-truck"></i>
          <span>TRANSPORT LOG.</span></a>
      </li-->
	  
	  <?php 
		$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
		$requete = $mysqli->query( $sql );
		$result = $requete->fetch_assoc();
		$nom = $result["nom"];
		$prenom = $result["prenom"];
		$prof2 = $result["profil2"];
		$unite = $result["unite"];
				
		$oic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nom' AND off_pnom='$prenom' AND off_unit='ICT/CO NDJAMENA' ")->fetch_array();
		if($oic['ID'] != 0)
		{	
			echo("<li class=\"nav-item active\">
				<a class=\"nav-link collapsed\" href=\"#\" data-toggle=\"collapse\" data-target=\"#collapseOIC\" aria-expanded=\"true\" aria-controls=\"collapseOIC\">
					<i class=\"fas fa-fw fa-check\"></i>
					<span>APPR. OIC / ICT</span>
				</a>
				<div id=\"collapseOIC\" class=\"collapse\" aria-labelledby=\"headingTwo\" data-parent=\"#accordionSidebar\">
					<div class=\"bg-white py-2 collapse-inner rounded\">
						<a class=\"collapse-item\" href=\"listdeqpmtatit.php\"><i class=\"fas fa-fw fa-list\"></i> DEMANDES</a>
						<a class=\"collapse-item\" href=\"stockvarfit.php\"><i class=\"fa fa-bar-chart fa-fw\"></i> VARIATIONS STOCK</a>
					</div>
				</div>
			</li>");
		}
				
		$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
		$profil	= $pro["PROF"];
	
		if ($profil == "AdminSTDESK")
		{	
			echo("<li class=\"nav-item active\">
				<a class=\"nav-link\" href=\"listaskeqpmt.php\">
					<i class=\"fa fa-fw fa-pencil-square\"></i>
					<span>DEM. SDESK</span>
				</a>
			</li>");
		}
				
		if($prof2=="AdminSU" AND $unite=="ADMIN-FINANCE/CO NDJAMENA" )
		{	
			echo("<li class=\"nav-item active\">
				<a class=\"nav-link collapsed\" href=\"#\" data-toggle=\"collapse\" data-target=\"#collapseOICADM\" aria-expanded=\"true\" aria-controls=\"collapseOICADM\">
					<i class=\"fas fa-fw fa-check\"></i>
					<span>APPR. OIC / ADMIN</span>
				</a>
				<div id=\"collapseOICADM\" class=\"collapse\" aria-labelledby=\"headingTwo\" data-parent=\"#accordionSidebar\">
					<div class=\"bg-white py-2 collapse-inner rounded\">
						<a class=\"collapse-item\" href=\"listdefourn.php\"><i class=\"fas fa-fw fa-list\"></i> DEMANDES</a>
						<a class=\"collapse-item\" href=\"stockvarfourn.php\"><i class=\"fa fa-bar-chart fa-fw\"></i> VARIATIONS STOCK</a>
					</div>
				</div>
			</li>");
		}
	  ?>
	  
	  <!-- Nav Item - Charts -->
      <li class="nav-item active">
        <a class="nav-link" href="gouroussphone.php">
          <i class="fas fa-fw fa-tty"></i>
          <span>BILLING SYSTEM</span></a>
      </li>
	  
	  <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLvSys" aria-expanded="true" aria-controls="collapseLvSys">
          <i class="fas fa-fw fa-calendar"></i>
          <span>LEAVE SYSTEM</span>
        </a>
        <div id="collapseLvSys" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="djoummah.php"><i class="fas fa-fw fa-calendar-o"></i> CONGES</a>
			<a class="collapse-item" href="compenscto.php"><i class="fas fa-fw fa-hourglass-half"></i> HEURES SUPP.</a>
			<?php 
				$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
				$requete = $mysqli->query( $sql );
				$result = $requete->fetch_assoc();
				$nomoic = $result["nom"];
				$pnomoic = $result["prenom"];
		
				$oic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nomoic' AND off_pnom='$pnomoic'")->fetch_array();
				if($oic['ID'] != 0)
				{
					echo("<a class=\"collapse-item\" href=\"djoummahapprv.php\"><i class=\"fas fa-fw fa-check\"></i> APPROUVER</a>");
				}
			?>
          </div>
        </div>
      </li>
	  
	  <!-- Nav Item - Charts -->
      <li class="nav-item active">
        <a class="nav-link" href="sugcomment.php">
          <i class="fa fa-fw fa-comments-o"></i>
          <span>SUGGESTIONS </span></a>
      </li>
	  
	  <!-- Nav Item - Charts -->
      <li class="nav-item active">
        <a class="nav-link" href="directory.php">
          <i class="fas fa-fw fa-address-card"></i>
          <span>DIRECTORY</span></a>
      </li>

      <!-- Divider >
      <hr class="sidebar-divider"-->
              
      
	<?php
		
		$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
		$profil	= $pro["PROF"];
						
		$pro2	= $mysqli->query("SELECT profil2 AS PRO FROM user WHERE pseudo='$pseudo'")->fetch_array();
		$profil2= $pro2["PRO"];
		
		if($pseudo=="zimbos" || $profil=="ADMINSYS" || $profil=="AdminFIN")
		{
			echo("<hr class=\"sidebar-divider my-0\">
				<li class=\"nav-item active\">
					<a class=\"nav-link\" href=\"assindex.php\">
						<i class=\"fa fa-fw fa-asterisk\"></i>
						<span>GEST. INDEX</span>
					</a>
				</li>");
		}
		
		if($pseudo=="administrateur" || $profil=="ADMINSYS")
		{
			echo("<!-- Heading -->
				<div class=\"sidebar-heading\">
					GESTIONNAIRE ICT
			</div>");
			echo("<li class=\"nav-item active\">
					<a class=\"nav-link collapsed\" href=\"#\" data-toggle=\"collapse\" data-target=\"#collapseAdm\" aria-expanded=\"true\" aria-controls=\"collapseAdm\">
						<i class=\"fas fa-fw fa-wrench\"></i>
						<span>ADMIN SYSTEM</span>
					</a>
					<div id=\"collapseAdm\" class=\"collapse\" aria-labelledby=\"headingTwo\" data-parent=\"#accordionSidebar\">
						<div class=\"bg-white py-2 collapse-inner rounded\">
							<a class=\"collapse-item\" href=\"addoffice.php\"><i class=\"fas fa-fw fa-institution\"></i> OFFICES</a>
							<a class=\"collapse-item\" href=\"addunite.php\"><i class=\"fas fa-fw fa-building\"></i>  UNITES</a>
							<a class=\"collapse-item\" href=\"add1user.php\"><i class=\"fas fa-fw fa-users\"></i> USERS</a>");
							if($pseudo=="administrateur")
							{
								echo("<a class=\"collapse-item\" href=\"mouchard.php\"><i class=\"fas fa-fw fa-history\"></i>  MOUCHARD</a>");
							}
						echo("</div>
					</div>
				</li>");
		}

		if($profil=="AdminSDR")
		{
			echo("<hr class=\"sidebar-divider\">
				<div class=\"sidebar-heading\">
					GESTIONNAIRE SDR
			</div>");
			echo("<li class=\"nav-item active\">
					<a class=\"nav-link collapsed\" href=\"#\" data-toggle=\"collapse\" data-target=\"#collapseSDR\" aria-expanded=\"true\" aria-controls=\"collapseSDR\">
						<i class=\"fa fa-fw fa-cog\"></i>
						<span>GESTION SDR</span>
					</a>
					<div id=\"collapseSDR\" class=\"collapse\" aria-labelledby=\"headingTwo\" data-parent=\"#accordionSidebar\">
						<div class=\"bg-white py-2 collapse-inner rounded\">
							<a class=\"collapse-item\" href=\"addsdr.php\"><i class=\"fa fa-building\"></i> SALLE</a>
							<a class=\"collapse-item\" href=\"addpc.php\"><i class=\"fa fa-cutlery\"></i> PAUSE-CAFE</a>
							<a class=\"collapse-item\" href=\"addeqpm.php\"><i class=\"fa fa-camera-retro\"></i> MULTIMEDIA</a>
							<a class=\"collapse-item\" href=\"addactivite.php\"><i class=\"fa fa-line-chart\"></i> ACTIVITE</a>
						</div>
					</div>
				</li>");
		}
		
		if($profil=="AdminSTOCK")
		{
			echo("<hr class=\"sidebar-divider\">
				<div class=\"sidebar-heading\">
					GESTIONNAIRE STOCK ICT
			</div>");
			echo("<li class=\"nav-item active\">
					<a class=\"nav-link collapsed\" href=\"#\" data-toggle=\"collapse\" data-target=\"#collapseGestStk\" aria-expanded=\"true\" aria-controls=\"collapseGestStk\">
						<i class=\"fas fa-fw fa-shopping-cart\"></i>
						<span>OVERVIEW STOCK</span>
					</a>
					<div id=\"collapseGestStk\" class=\"collapse\" aria-labelledby=\"headingTwo\" data-parent=\"#accordionSidebar\">
						<div class=\"bg-white py-2 collapse-inner rounded\">
							<a class=\"collapse-item\" href=\"geststockit.php\"><i class=\"fas fa-fw fa-cart-arrow-down\"></i> STOCK DISPONIBLE</a>
							<a class=\"collapse-item\" href=\"stockvarfit.php\"><i class=\"fa fa-bar-chart fa-fw\"></i>  VARIATIONS STOCK</a>
							<a class=\"collapse-item\" href=\"stockaddsortit.php\"><i class=\"fa fa-exchange fa-fw\"></i>  E/S DU STOCK</a>
						</div>
					</div>
				</li>");
			echo("<li class=\"nav-item active\">
					<a class=\"nav-link\" href=\"gestartit.php\">
						<i class=\"fa fa-fw fa-laptop\"></i>
						<span>GESTION ARTICLES</span>
					</a>
				</li>");
			echo("<li class=\"nav-item active\">
					<a class=\"nav-link\" href=\"listdeqpmt.php\">
						<i class=\"fa fa-fw fa-list\"></i>
						<span>LISTE DEMANDES</span>
					</a>
				</li>");
		}
		
		if($profil=="AdminFOURN")
		{
			echo("<hr class=\"sidebar-divider\">
				<div class=\"sidebar-heading\">
					GESTIONNAIRE STOCK ADMIN
			</div>");
			echo("<li class=\"nav-item active\">
					<a class=\"nav-link collapsed\" href=\"#\" data-toggle=\"collapse\" data-target=\"#collapseGestStkF\" aria-expanded=\"true\" aria-controls=\"collapseGestStkF\">
						<i class=\"fas fa-fw fa-shopping-cart\"></i>
						<span>OVERVIEW STOCK</span>
					</a>
					<div id=\"collapseGestStkF\" class=\"collapse\" aria-labelledby=\"headingTwo\" data-parent=\"#accordionSidebar\">
						<div class=\"bg-white py-2 collapse-inner rounded\">
							<a class=\"collapse-item\" href=\"geststockfourn.php\"><i class=\"fas fa-fw fa-cart-arrow-down\"></i> STOCK DISPONIBLE</a>
							<a class=\"collapse-item\" href=\"stockvarfourn.php\"><i class=\"fa fa-bar-chart fa-fw\"></i>  VARIATIONS STOCK</a>
							<a class=\"collapse-item\" href=\"stockaddsortfourn.php\"><i class=\"fa fa-exchange fa-fw\"></i>  E/S DU STOCK</a>
						</div>
					</div>
				</li>");
			echo("<li class=\"nav-item active\">
					<a class=\"nav-link\" href=\"gestartfourn.php\">
						<i class=\"fas fa-fw fa-folder-open\"></i>
						<span>GESTION ARTICLES</span>
					</a>
				</li>");
			echo("<li class=\"nav-item active\">
					<a class=\"nav-link\" href=\"listdemfourn.php\">
						<i class=\"fa fa-fw fa-list\"></i>
						<span>LISTE DEMANDES</span>
					</a>
				</li>");
		}
		
		if($profil=="AdminRH")
		{
			echo("<hr class=\"sidebar-divider\">
				<div class=\"sidebar-heading\">
					GESTIONNAIRE RH
			</div>");
			echo("<li class=\"nav-item active\">
					<a class=\"nav-link collapsed\" href=\"#\" data-toggle=\"collapse\" data-target=\"#collapseRH\" aria-expanded=\"true\" aria-controls=\"collapseRH\">
						<i class=\"fa fa-users fa-fw\"></i> <i class=\"fa fa-fw fa-calendar\"></i>
						<span>GESTION RH</span>
					</a>
					<div id=\"collapseRH\" class=\"collapse\" aria-labelledby=\"headingTwo\" data-parent=\"#accordionSidebar\">
						<div class=\"bg-white py-2 collapse-inner rounded\">
							<a class=\"collapse-item\" href=\"soldeleave.php\"><i class=\"fa fa-check\"></i> VERIFIER SOLDES</a>
							<a class=\"collapse-item\" href=\"askleave.php\"><i class=\"fa fa-calendar\"></i> DEMANDES CONGES</a>
							<a class=\"collapse-item\" href=\"askcto.php\"><i class=\"fa fa-money\"></i> DEMANDES CTO</a>
							<a class=\"collapse-item\" href=\"gestcontcong.php\"><i class=\"fa fa-wrench\"></i> ADMINISTRATION</a>
						</div>
					</div>
				</li>");
		}
		
		if($profil=="AdminLOGFLEET")
		{
			echo("<hr class=\"sidebar-divider\">
				<div class=\"sidebar-heading\">
					GESTIONNAIRE FLOTTE
			</div>");
			echo("<li class=\"nav-item active\">
					<a class=\"nav-link collapsed\" href=\"#\" data-toggle=\"collapse\" data-target=\"#collapseWORKSHOP\" aria-expanded=\"true\" aria-controls=\"collapseWORKSHOP\">
						<i class=\"fa fa-truck fa-fw\"></i>
						<span>GESTION FLOTTE</span>
					</a>
					<div id=\"collapseWORKSHOP\" class=\"collapse\" aria-labelledby=\"headingTwo\" data-parent=\"#accordionSidebar\">
						<div class=\"bg-white py-2 collapse-inner rounded\">
							<a class=\"collapse-item\" href=\"askflotteat.php\"><i class=\"fa fa-edit\"></i> GEST. DEMANDES</a>
							<a class=\"collapse-item\" href=\"suivflotte.php\"><i class=\"fa fa-exchange\"></i> SUIVIS</a>
							<a class=\"collapse-item\" href=\"gestflotte.php\"><i class=\"fa fa-wrench\"></i> ADMINISTRATION</a>
						</div>
					</div>
				</li>");
		}
		
		if($profil=="AdminBILLING")
		{
			echo("<li class=\"nav-item active\">
					<a class=\"nav-link\" href=\"gestgourouss.php\">
						<i class=\"fa fa-fw fa-money\"></i>
						<span>GEST. BILLING</span>
					</a>
				</li>");
		}
		
		if($profil2=="AdminSU")
		{
			echo("<hr class=\"sidebar-divider my-0\">
			<li class=\"nav-item active\">
					<a class=\"nav-link\" href=\"bascprof.php\">
						<i class=\"fa fa-fw fa-exchange\"></i>
						<span>BASC. PROFIL</span>
					</a>
				</li>");
		}
	?>	  
	  
	 <!-- Divider -->
	  <hr class="sidebar-divider my-0">
	  
	  <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <span>ChadAP v1.1.IZ &copy;WFP</span>
		</a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>