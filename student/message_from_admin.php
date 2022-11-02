<?php 
    session_start();
if (!isset($_SESSION["username"])) {
    ?>
    <script type="text/javascript">
        window.location="login.php";
    </script>
    <?php
}
    include 'header.php';
    include 'connect.php';
    mysqli_query($link, "UPDATE message set read1='y' where dusername='$_SESSION[username]' ");
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
                                <h2>Message</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Full Name (From)</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                    </tr>
                                    <?php
                                    $res=mysqli_query($link,"SELECT * FROM message where dusername='$_SESSION[username]' order by id DESC");
                                    while($row=mysqli_fetch_array($res)){

                                        $res1=mysqli_query($link,"SELECT * FROM librarian_registration where username='$row[susername]' ");
                                        while($row1=mysqli_fetch_array($res1)){
                                            $fullname=$row1['firstname']." ".$row1['lastname'];
                                        }

                                        echo "<tr>";
                                        echo "<td>"; echo $fullname; echo "</td>";
                                        echo "<td>"; echo $row['title']; echo "</td>";
                                        echo "<td>"; echo $row['msg']; echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
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