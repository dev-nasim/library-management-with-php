<?php 
    session_start();
    if (!isset($_SESSION['librarian'])) {
        ?> 
        <script type="text/javascript">
            window.location="login.php";
        </script>
        <?php
    }
    include 'header.php';
    include '../student/connect.php';
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
                                <h2>Issued Books For Student</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form name="form1" action="" method="post">
                                    <table>
                                        <tr>
                                            <td>
                                                <select name="enr" class="form-control selectpicker">
                                                    <?php 
                                                        $res = mysqli_query($link, "SELECT enrollment from user_registration");
                                                        while ($row = mysqli_fetch_array($res)) {
                                                            echo "<option>";
                                                            echo $row['enrollment'];
                                                            echo "</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="submit" name="submit1" value="Search" class="form-control btn btn-default" style="margin-top: 5px;">
                                            </td>
                                        </tr>
                                    </table>
                                    <?php 

                                    if (isset($_POST['submit1'])) {

                                        $res5 = mysqli_query($link, "SELECT * from user_registration where enrollment='$_POST[enr]' ");
                                        while ($row5 = mysqli_fetch_array($res5)) {
                                            $firstname=$row5['firstname'];
                                            $lastname=$row5['lastname'];
                                            $username=$row5['username'];
                                            $email=$row5['email'];
                                            $contact=$row5['contact'];
                                            $sem=$row5['sem'];
                                            $enrollment=$row5['enrollment'];
                                            $_SESSION['enrollment']=$enrollment;
                                            $_SESSION['susername']=$username;
                                        }

                                        ?>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td><input type="text" class="form-control" name="enrollment" placeholder="enrollmentno" value="<?php echo $enrollment; ?>" disabled></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" name="studentname" placeholder="studentname" value="<?php echo $firstname.' '.$lastname; ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" name="studentsem" placeholder="studentsem" value="<?php echo $sem; ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" name="studentcontact" placeholder="studentContact" value="<?php echo $contact; ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" name="studentemail" placeholder="studentemail" value="<?php echo $email; ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select name="booksname" class="form-control selectpicker">
                                                        <?php 
                                                        $res = mysqli_query($link, "SELECT books_name from add_books");
                                                        while ($row = mysqli_fetch_array($res)) {
                                                            echo "<option>";
                                                            echo $row['books_name'];
                                                            echo "</option>";
                                                        }
                                                    ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" name="booksissuedate" placeholder="booksissuedate" value="<?php echo date('d-m-Y'); ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" name="studentusername" placeholder="studentusername" value="<?php echo $username; ?>" disabled></td>
                                            </tr>
                                            <tr>
                                                <td><input type="submit" class="form-control btn btn-primary" name="submit2" value="Issue Book"></td>
                                            </tr>
                                        </table>
                                        <?php
                                    }
                                    ?>
                                </form>
                                <?php 
                                    if (isset($_POST['submit2'])) {
                                        $qty=0;
                                        $res=mysqli_query($link, "SELECT * from add_books where books_name='$_POST[booksname]' ");
                                        while ($row=mysqli_fetch_array($res)) {
                                            $qty=$row["available_qty"];
                                        }

                                        if ($qty==0) {
                                            ?>
                                            <div class="alert alert-danger col-lg-6 col-lg-push-3">
                                                <strong style="color:white">This Books are not Available in stock</strong>
                                            </div>
                                            <?php
                                        }else{

                                        mysqli_query($link, "INSERT INTO issue_books values ('','$_SESSION[enrollment]','$_POST[studentname]','$_POST[studentsem]','$_POST[studentcontact]','$_POST[studentemail]','$_POST[booksname]','$_POST[booksissuedate]','','$_SESSION[susername]')");
                                        mysqli_query($link, "UPDATE add_books set available_qty=available_qty-1 where books_name='$_POST[booksname]' ");
                                        ?>


                                        <script type="text/javascript">
                                            alert ("Books Issued!");
                                            window.location.href=window.location.href;
                                        </script>
                                        <?php
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
<?php 
    include 'footer.php';
?>