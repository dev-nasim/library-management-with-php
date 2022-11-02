<?php
	include '../student/connect.php';
	include 'connect.php';
	$id = $_GET['id'];
	mysqli_query($link," UPDATE user_registration set status='no' where id=$id");
?>
<script type="text/javascript">
	window.location = "show-student.php";
</script>