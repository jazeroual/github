<?
session_start();
if($_SESSION['statusLogin']!="OK"){
	header('location:index.php');
}


include ('../class/clsForm.php');
$form=new form;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Document sans nom</title>
<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<? 
echo $form->frmMenuAdmin();
?>

</body>
</html>

<script>
$(document).ready(function(){




});

</script>