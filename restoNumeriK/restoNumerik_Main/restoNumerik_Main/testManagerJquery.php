<?
session_start();
include ('class/clsForm.php');

$mngForm=new Formulaire;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Document sans nom</title>
</head>
<script src="http://code.jquery.com/jquery-latest.min.js"
        type="text/javascript"></script>
<body>


<?

	$mngForm->writeFormLogin();
	
?>

</body>
<script>

$(document).ready(function() {
	
	$("#btnLogin").click(function() {
	
	var varLogin = $("#txtLogin").val();
	var varPwd = $("#txtPassword").val();
		$.ajax({
		  url: "testManager.php",
		  type: "post",
		  data: "login="+varLogin+"&password="+varPwd+"" ,
		  success: function(data){
			$("#result").html('Ok bravo '+ data);
			$('#resultat').load('showSession.php');

			
			
			  
			 // alert('bonjour');
 		  },
		  error:function(){
			   alert('pasok');
			 // $("#result").html('there is error while submit');
		  }   
		}); 
	
	});
	
	
	

});

</script>
</html>
