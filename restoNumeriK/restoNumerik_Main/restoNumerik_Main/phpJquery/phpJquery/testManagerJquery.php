<?
include ('class/clsMngr.php');


$mngForm=new manager;

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
<? echo time();?>
<div id="ghostHolder">
<div id="ghost">Bouhhhhhhh</div>

<div id="action">CLIQUEZ ICI</div>
</div>
<input id="btnGhost"  name="" type="button" value="Bouuhhhh" />
<div id='result'>...</div>


<?

//$mngForm->writeFormLogin();

?>

</body>
<script>
$(document).ready(function() {
	
	
	$("#btnLogin").click(showLogin);
	function showLogin(){
		
	var varLogin = $("#txtLogin").val();
		
		alert(varLogin);
		alert( $("#txtPassword").val());
	}
	
	
	$("#btnGhost").click(hideGhost);
	
	function hideGhost(){
	$("#ghostHolder").toggle();	
	}
	
	
	$("#action").click(function() {
	
		$.ajax({
		  url: "testManager.php",
		  type: "post",
		  data: "login=jabid&password=test" ,
		  success: function(response){
			  
			   $("#result").html('Ok bravo '+ response);
		  },
		  error:function(){
			  
			  $("#result").html('there is error while submit');
		  }   
		}); 
	
	});
	
	
});
</script>
</html>
