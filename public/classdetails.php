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
                    <h3>Classes Schedule</h3>
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
                            <h3 class="card-title">Classes Schedule</h3>
                        </div>
                        <div class="card-body" id="classfrom">

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



<?php
include INC_PATH . "_admin/_footer.php";
?>