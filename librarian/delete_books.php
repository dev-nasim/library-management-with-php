<?php 
session_start();
    if (!isset($_SESSION['librarian'])) {
        ?> 
        <script type="text/javascript">
            window.location="login.php";
        </script>
        <?php
    }

	include '../student/connect.php';

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		mysqli_query($link, "DELETE FROM add_books where id=$id");?>
		<script type="text/javascript">
			window.location="display_books.php";
		</script><?php
	}else{
		?>
		<script type="text/javascript">
			window.location="display_books.php";
		</script>
		<?php
	}
 ?>