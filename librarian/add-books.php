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
    include 'header.php';
?>
        <!-- page content area main -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3></h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Add Books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <form name="form1" action="" method="post" class="col-lg-6" enctype="multipart/form-data">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><input type="text" class="form-control" name="booksname" placeholder="Books Name" required></td>
                                        </tr>
                                        <tr>
                                            <td>Books Image:<input type="file" name="f1" required></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="books_author" placeholder="Books Author Name" required></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="pub_name" placeholder="Books Publication Name" required></td>
                                        </tr>
                                        <tr>
                                            <td><input type="date" class="form-control" name="purchase_date" placeholder="Books Purchase Date" required></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="price" placeholder="Books Price" required></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="books_qty" placeholder="Books Quantity" required></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="books_avqty" placeholder="Books Available Quantity" required></td>
                                        </tr>
                                        <tr>
                                            <td><input type="submit" name="submit1" class="btn btn-primary" value="Insert Books"></td>
                                        </tr>
                                    </table>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->


<?php
    if (isset($_POST['submit1'])) {
        $tm = md5(time());
        $fnm = $_FILES['f1']['name'];
        $dst = "./books_image/".$tm.$fnm;
        $dst1 = "books_image/".$tm.$fnm;
        move_uploaded_file($_FILES['f1']['tmp_name'], $dst);

        mysqli_query($link, "INSERT INTO add_books values ('','$_POST[booksname]','$dst1','$_POST[books_author]','$_POST[pub_name]','$_POST[purchase_date]','$_POST[price]','$_POST[books_qty]','$_POST[books_avqty]','$_SESSION[librarian]')");

        ?>
        <script type="text/javascript">
            alert("Books Inserted");
        </script>

        <?php 
    }
?>






        .
<?php 
    include 'footer.php';
?>