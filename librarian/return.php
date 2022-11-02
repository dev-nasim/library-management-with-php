<?php 
	include '../student/connect.php';
	$id=$_GET['id'];
	$a=date('d-m-Y');
	$res=mysqli_query($link,"UPDATE issue_books set books_return_date='$a' where id='$id' ");

	$books_name="";
	$res=mysqli_query($link, "SELECT * from issue_books where id=$id");
	while ($row=mysqli_fetch_array($res)) {
		$books_name = $row['books_name'];
	}
	mysqli_query($link, "UPDATE add_books set available_qty=available_qty+1 where books_name='$books_name' ");
?>
<script type="text/javascript">
	window.location="return_book.php";
</script>