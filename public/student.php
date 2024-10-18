<?php
$title = "Havelock City";
include INC_PATH . "_admin/_header.php";
?>
<div class="content-wrapper">
    <main role="main" class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="form-group">
                                <h3 class="card-title">List of Students</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Student Name</label>
                                        <div class="col-md-12 col-sm-12 ">
                                            <input type="text" id="TnameforSearch" class="form-control" placeholder="Enter Student Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 " style="padding-top: 30px;">
                                            <button type="button" id="btnAdd" class="btn btn-success form-control"><i class="fa fa-plus"></i>
                                                Add New Student</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 " style="padding-top: 30px;">
                                            <button type="button" id="btnSearch" class="btn btn-secondary form-control"><i class="fa fa-search"></i>
                                                Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer table-responsive">
                            <table id="tblstudent" class="table table-bordered table-striped tblstudent">
                                <thead>
                                    <tr>
                                        <th>Student Id</th>
                                        <th>Student Name</th>
                                        <th>Address</th>
                                        <th>ContactEmail</th>
                                        <th>ContactMobile</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyid">
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>


<div id="StudentModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><strong>Student Detail</strong></h4>
                <button type="button" class="close" data-dismiss="modal" onclick="Cancel()">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="x_panel">
                    <div class="x_content">
                        <form id="formStudent" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            <input type="hidden" id="StudentId" />

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 "> Student Name</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" required id="StudentName" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Address</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" required id="Address" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Email</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" required id="Email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 "> Contact No</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" required id="ContactNo" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Contact Name</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" required id="ContactName" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Parent Name</label>
                                <div class="col-md-9 col-sm-9">
                                    <textarea class="form-control" id="ParentName"></textarea>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Parent ID No</label>
                                <div class="col-md-9 col-sm-9">
                                    <textarea class="form-control" id="ParentIDNo"></textarea>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 "> Parent Contact No</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" required id="ParentContactNo" class="form-control">
                                </div>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="Active" value="true">
                                <label for="Active" class="custom-control-label">Active</label>
                            </div>
                            <div class="form-group">
                                <div style="float:right">
                                    <button type="button" id="btnSave" class="btn btn-success">Save</button>
                                    <button type="button" id="btnCancel" onclick="Cancel()" class="btn btn-warning">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include INC_PATH . "_admin/_footer.php";
?>

<script type="text/javascript">

</script>