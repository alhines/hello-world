<?php
// Start the session
session_start();
include('../includes/libreria.php');

if(isset($_REQUEST['error']) && !empty($_REQUEST['error'])) {
	$error = false;
}else{
	$error = false;  
	
	if(isset($_REQUEST['email']) && !empty($_REQUEST['email'])) {
      $email = $_REQUEST['email'];     
    }else{
      $error = true;
    }

    if(isset($_REQUEST['pass']) && !empty($_REQUEST['pass'])) {
      $pass = $_REQUEST['pass'];     
    }else{
      $error = true;
    }
}

if (!$error){

	if(isset($_REQUEST['loginAccess']) && ($_REQUEST['loginAccess'] == '1' )) {
								
		$loged = f_login($email, $pass);
												
		if($loged) {			
			header('location: ../dashboard.php?loginAccess=2');
		} else {
			header('location: ../login.php?err=1');
		}		
		
	}elseif ((isset($_REQUEST['loginAccess']) && ($_REQUEST['loginAccess'] == '3' ))) {		
		f_logout();
	}
	
} else{ ?>    
     <?php header('location: ../login.php?err=1'); ?>
<?php } ?>	