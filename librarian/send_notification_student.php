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
                                <h2>Send Notification To Student</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                

            <form name="form1" action="" method="post" class="col-lg-6" enctype="multipart/form-data">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <select class="form-control" name="dusername">
                                <?php 
                                $res=mysqli_query($link,"SELECT * FROM user_registration");
                                while($row=mysqli_fetch_array($res)){
                                    ?><option value="<?php echo $row["username"]?>">
                                        <?php echo $row["username"]." (".$row["enrollment"].")";?>
                                    </option><?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="title" class="form-control" placeholder="Enter Title"></td>
                    </tr>
                    <tr>
                        <td>
                            <textarea class="form-control" name="msg" placeholder="Your Message"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="submit1" class="btn btn-primary" value="Send Message"></td>
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

    if (isset($_POST["submit1"])) {
        mysqli_query($link,"INSERT INTO message values ('','$_SESSION[librarian]','$_POST[dusername]','$_POST[title]','$_POST[msg]','n')");
        ?>
        <script type="text/javascript">
            alert("Message Send Successfully");
        </script>
        <?php
    }

?>


<?php 
    include 'footer.php';
?>