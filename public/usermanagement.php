<?php
$title = "Lanka Hospital";
include INC_PATH . "_admin/_header.php";
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>User Management</h3>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-primary float-right" id="add">New User</button>
                </div>
            </div>
        </div>
        <!--<row mb-2> -->
    </section>
    <!-- page content -->
    <!-- <div class="right_col" role="main">
    <div class=""> -->
    <!-- <div class="page-title">
            <div class="title_left">
                <h3>User Management</h3>
            </div>
            <div class="clearfix"></div>



            <div class="title_left">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    </button>


                </div>
            </div>
        </div> -->


    <section class="content">
        <!-- <div class="clearfix"></div> -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- <div class="card-body"> -->
                        <div class="card-body hiddenTable" id="mylist" style="background-color: #fff;">
                            <table class="table table-bordered table-hover" border="1" cellspacing="0" cellpadding="5"
                                id="tbUser">

                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>User Role</td>
                                    </tr>
                                </thead>
                                <tbody id="tbUserBody">
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>







<!--Popup Modal of supplier-->
<div class="modal fade" id="userpopup" tabindex="-1" role="dialog" aria-labelledby="userpopupLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #2980B9; color:white;">
                <h4 class="modal-title" id="userpopupLabel"> User Details</h4>

            </div>
            <div class="modal-body">
                <form action="" method="post" id="frmuser">
                    <input type="hidden" class="form-control" id="id" name="namebrandid">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" placeholder="Enter name" id="txtuser" name="txtuser"
                            value="">
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" placeholder="Enter username" id="txtusername"
                            name="txtusername" value="">
                    </div>
                    <div class="form-group">
                        <label for="username">Password:</label>
                        <input type="password" class="form-control" placeholder="Enter password" id="txtpassword"
                            name="txtpassword" value="">
                    </div>
                    <div class="form-group">
                        <label for="username">User Role:</label>
                        <select class="form-control" id="cmbRole" name="cmbRole">
                            <!-- <option value="0">-Select Role-</option>
                                                <option value="1">Admin</option>
                                                <option value="2">User</option> -->
                        </select>
                    </div>

                    <!-- <div class="form-group">
                        <label><input type="checkbox" id="active"> Active</label>
                    </div> -->
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="supid" name="userid">
                    </div>

                    <button type="button" id="btninsert" class="btn btn-primary">Save</button>
                    <button type="button" id="btnedit" class="btn btn-primary">Edit</button>



                    <button type="button" id="btncancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                </form>
            </div>
        </div>
    </div>
</div>
<?php
include INC_PATH . "_admin/_footer.php";

?>

