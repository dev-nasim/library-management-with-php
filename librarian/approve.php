
<?php 
	include '../student/connect.php';
	$id = $_GET['id'];
	mysqli_query($link," UPDATE user_registration set status='yes' where id=$id");
?>
<script type="text/javascript">
	window.location = "show-student.php";
</script>