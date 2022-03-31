<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

session_start();
if(!@$_SESSION['session'])
{
	require_once('scripts/config.php');	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN">
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Zaki IZZO">
  <link rel="shortcut icon" href="http://10.109.87.10:8080/img/WFPico.ico" />
  
  <title>Chad AP | Log In</title>
  
  <!-- Custom fonts for this template-->
  <link href="http://10.109.87.10:8080/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="http://10.109.87.10:8080/vendor/fontawesome-free/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="http://10.109.87.10:8080/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="http://10.109.87.10:8080/vendor/font-awesome/css/css.css" rel="stylesheet" type="text/css" />
  
  <!-- Custom styles for this template-->
  <link href="http://10.109.87.10:8080/css/iz-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
<?php

if(isset($_GET['erreur']))
	{
	echo'<span class="erreur">';
	$erreur=$_GET['erreur'];
	if($erreur=="pseudo")
		{
		echo"<b><font size=\"+2\" color=\"red\">Erreur : Votre pseudo est invalide</font></b>";
		}
	if($erreur=="passe")
		{
		echo"<b><font size=\"+2\" color=\"red\">Erreur : Votre mot de passe est invalide</font></b>";
		}
	if($erreur=="connexion")
		{
		echo"<b><font size=\"+2\" color=\"red\">Erreur : Votre mot de passe ne correspond pas avec votre pseudo</font></b>";
		}
	echo'</span>';
	}
	
?>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image">
			    
			  </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Veuillez-vous connecter</h1>
                  </div>
				  <hr>
                  <form class="user" method="post" action="scripts/login.php" >
                    <div class="form-group">
                      <input type="pseudo" class="form-control form-control-user" id="pseudo" name="pseudo" placeholder="Entrez Votre Pseudo..." autocomplete="off" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="mdp" name="mdp" placeholder="Mot de Passe" autocomplete="off" required>
                    </div>
                    <!--div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div-->
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      <i class="fas fa-fw fa-sign-in-alt"></i><strong> Login</strong>
                    </button>
                    <!--hr>
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a-->
                  </form>
                  <hr>
                  <div class="text-center">
					<a href="scripts/adduser.php">
                      <i class="fas fa-fw fa-user-plus"></i><strong> Sign Up</strong>
                    </a>
                  </div>
				 
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  <center><strong>ChadAP v1.1.IZ &copy; WFP CO CHAD, 2020</strong></center>

  
<?php 
if($localite != 'local')
echo'<br /><a href="perdu.php">Mot de passe perdu ?</a>';
echo'</div>';
	}
else
	{
		require_once('scripts/conf/config.php');
		require_once('scripts/conf/verifications.php');	
	}

mysql_close();
?>

</body>

</html>
