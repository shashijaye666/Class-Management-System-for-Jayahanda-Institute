<?php
$title = "Havelock City";
include INC_PATH . "_admin/_header.php";
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>Class Schedule</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Class Schedule</li>
                    </ol>
                </div>
            </div>
        </div>
        <!--<row mb-2> -->
    </section>
    <section class="content">
        <!-- <div class="clearfix"></div> -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Class Schedule</h3>
                        </div>
                        <div class="card-body" id="classfrom">
                            <form id="frmEvent" class="form-horizontal form-label-left">

                                <input type="hidden" id="txtId" value="0" />
                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="Name">
                                            <option selected="selected" value="0"></option>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Subject</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="Subject">
                                            <option selected="selected" value="0"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="FreeOutCategory" class="col-sm-2 col-form-label" for="txtDate">Class Date</label>
                                    <div class="col-md-4 col-sm-4">
                                        <input id="txtDate" value="<?php echo date("Y/m/d"); ?>" class="form-control">
                                    </div>
                                    <?php
                                    $currentTime = date("H:i");
                                    ?>
                                    <label for="txtToTime" class="col-sm-2 col-form-label">Class Time </label>
                                    <div class="col-md-4 col-sm-4">
                                        <input id="txtToTime" type="time" value="<?php echo $currentTime; ?>" class="form-control">
                                    </div>



                                    <!-- <label for="FreeOutCategory1" class="col-sm-2 col-form-label" for="txtDate1">
                                        Date To
                                    </label>
                                    <div class="col-md-4 col-sm-4">
                                        <input id="txtToDate" value="<?php echo date("Y/m/d"); ?>" class="form-control">
                                    </div> -->
                                </div>
                                <!-- <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Event Name </label>
                                    <div class="col-sm-4">
                                        <input type="text" id="txtEvent" class="form-control" />
                                    </div>
                                    <label class="col-sm-2 col-form-label">Description </label>
                                    <div class="col-sm-4">
                                        <input type="text" id="txtDesc" class="form-control" disabled="disabled" />
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">No of Hours</label>
                                    <div class="col-sm-4">
                                        <input type="number" id="hours" class="form-control" />
                                        <input type="hidden" id="hours" value="0" />
                                    </div>

                                    <label class="col-sm-2 col-form-label">Zoom Link</label>
                                    <div class="col-sm-4">
                                        <input type="text" required id="link" class="form-control">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div style="float:right">
                                <div class="form-group row">
                                    <div style="padding: 5px;">
                                        <button type="button" id="btnUpdate" class="btn btn-success">Save</button>
                                    </div>
                                    <div style="padding: 5px;">
                                        <button type="button" id="btnCancel" class="btn btn-danger">Cancel</button>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer table-responsive">
                        <table id="tblstudent" class="table table-bordered table-striped tblstudent">
                            <thead>
                                <tr>
                                    <th>Shedule ID</th>
                                    <th>Teacher Name</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>No of Hours</th>
                                    <th>Zoom Link</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                            </thead>
                            <tbody id="tbodyid">
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
    </section>
</div>

<!-- <div id="tokenModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><strong>Complementary Event Tokens</strong></h4>
                <button type="button" class="close" data-dismiss="modal" onclick="Cancel()">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="x_panel">
                    <div class="x_content">
                        <form id="frmtoken" class="form-horizontal form-label-left">

                            <div class="form-group">
                                <div style="float:left">
                                    <button id="btnUpdate" class="btn btn-success" type="button">Save</button>
                                    <button id="btnCancel" class="btn btn-danger" type="button">Cancel</button>
                                </div>
                            </div>
                            <br />
                            <br />
                            <div class="card-footer table-responsive">
                                <table id="tokengrid" class="table table-bordered table-striped tokengrid">
                                    <thead>
                                        <tr>
                                            <th>Event</th>
                                            <th>Token</th>
                                            <th>Valid For</th>
                                            <th>
                                                <input type="checkbox" id="tickalltokens" />
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tokentbodyid">
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- <div id="addvehicleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><strong>Add Vehicle</strong></h4>
                <button type="button" class="close" data-dismiss="modal" onclick="Cancel()">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="x_panel">
                    <div class="x_content">
                        <form id="frmtoken" class="form-horizontal form-label-left">
                            <div class="form-group row ">
                                <label class="control-label col-md-2 col-sm-2 ">Vehicle Number</label>
                                <div class="col-md-4 col-sm-4">
                                    <input type="text" required id="txtAddNewEventVehicle" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label id="lblusedtoken">No Of Token Redempted : 0</label>
                                    <br />
                                    <label id="lblbalncetoken">Balance Token : 0</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div style="float:left">
                                    <button id="btnUpdate" class="btn btn-success" type="button">Save</button>
                                    <button id="btnCancel" class="btn btn-danger" type="button">Cancel</button>
                                </div>
                            </div>
                            <br />
                            <br />
                            <div class="card-footer table-responsive">
                                <table id="addvehiclegrid" class="table table-bordered table-striped addvehiclegrid">
                                    <thead>
                                        <tr>
                                            <th>Vehicle No</th>
                                            <th>Mobile No</th>
                                            <th>Token</th>
                                            <th>Reedem Date Time</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="addvehicletbodyid">
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<?php
include INC_PATH . "_admin/_footer.php";
?>