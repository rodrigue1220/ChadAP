<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
?>	
	<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
		  
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
			<img src="http://10.109.87.10:8080/img/WFP-0000015014.png" width="225" height="80" alt="Logo WFP">
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
			

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">            
				<span class="mr-2 d-none d-lg-inline text-gray-600 small">
				   <?php echo("<i class=\"fas fa-user-circle fa-fw\"></i> ".$pseudo." ");?>
				</span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <?php echo("<a class=\"dropdown-item\" href=\"modif1user.php?ide=".$pseudo."\">
                  <i class=\"fas fa-user fa-sm fa-fw mr-2 text-gray-400\"></i>
					Profil
                  </a>");
				?>
				<a class="dropdown-item" href="http://10.109.87.10:8080/Doc/Guide-Utilisateur_ChadAP.pdf" target="new">
                  <i class="fas fa-book fa-sm fa-fw mr-2 text-gray-400"></i>
                  Manuel
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Deconnexion
                </a>
              </div>
            </li>
			
			<!-- Nav Item - Messages -->
            
            <div class="topbar-divider d-none d-sm-block"></div>
			
			<li class="nav-item">				
			  <a class="nav-link" title="Deconnexion" href="#" data-toggle="modal" data-target="#logoutModal">
				<span id="type6"> </span>
				&emsp;&emsp;<i class="fas fa-fw fa-sign-out-alt"></i>
			  </a>
			</li>

          </ul>

    </nav>
		
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
	  
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pr&ecirc;t &agrave; Quitter?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Cliquez sur "Deconnexion" pour terminer la Session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
          <a class="btn btn-danger" href="logout.php">Deconnexion</a>
        </div>
      </div>
    </div>
  </div>