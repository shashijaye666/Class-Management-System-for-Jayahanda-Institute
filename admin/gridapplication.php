<?php
$title = "Havelock City";
include INC_PATH . "_admin/_header.php";
include INC_PATH . "_public/_translation.php";
?>



 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Applications</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-12">
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
              <div class="form-group row">
              <div class="col-md-5">
                          <label for="FromDate">From Date</label>
                           <input type="date"  name="fromdate" id="fromdate" class="form-control" />   
                     </div>
                     <div class="col-md-5">
                          <label for="ToDate">To Date</label>
                          <input type="date"  name="todate" id="todate"  class="form-control"  />
                     </div>

                    

                     <div class="col-3">
                                <div class="form-group">
                                  <label for="jobcategory">Job Category</label>
                                  <select class="custom-select" id="cmbjobcategory">
                                  <option value="0">All</option>  
                                  </select>
                                </div>
                              </div>

                             

                     <div class="col-3">
                                <div class="form-group">
                                  <label for="jobcategory">Province</label>
                                  <select class="custom-select" id="cmbprovince">
                                  <option value="0">All</option>
                                  </select>
                                </div>
                              </div>

                              
                              <div class="col-md-2">
                          <label for="Height">NIC</label>
                          <input type="text"  name="nic" id="nic"  class="form-control"  />
                     </div>
                              
                     <div class="col-md-3" style="padding-top: 27px;">
                         <button type="button" id="btnsearch" class="btn btn-primary" >Search</button>
                      </div>


                             
                             
           
            
</div>
<div class="form-group row" style="padding-left:920px;">

                          <label for="Height">Count:</label>
                          <div class="col-sm-7">
                          <label  class="font-weight-normal" class="col-sm-2 col-form-label"name="count" id="count"></label>
</div>
</div>

                <table id="applicationtable" class="table table-striped table-bordered">
                  <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>NIC</th>
              <th>Submission Date</th>
              <th>Job Category</th>
              <th>Province</th>
              <th>View</th>
              <th>View Files</th>
              
            </tr>
            </thead>
            <tbody id="suptblbody">
             
          </tbody>
      </table>
      
      
      <div class="modal fade" id="modelWindow" role="dialog">
      <div class="modal-dialog modal-lg"  style=" max-height: 100%; max-width:80%;">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <!-- <h4 class="modal-title">Uploaded Files</h4> -->
                </div>
                <div class="modal-body">
                <div class="form-group row">
                  <input type="hidden" name="id" id="rowid">
                          <label for="exampleInputFile" class="col-sm-2 col-form-label">NIC Copy</label>
                          <div class="col-sm-5">
                         
                          <button type = "button" class="btn btn-info" id="filenic">Download</button>
                            <!-- <input type="file" class="custom-file-input" style="opacity:100" id="filenic" name="filenic"> -->
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputFile" class="col-sm-2 col-form-label">Birth Certificate Copy - 1st Page</label>
                          <div class="col-sm-5">
                          <button type = "button" class="btn btn-info" id="filebirthfront">Download</button>
                            <!-- <input type="file" class="custom-file-input" style="opacity:100" id="filenic" name="filenic"> -->
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputFile" class="col-sm-2 col-form-label">Birth Certificate Copy - 2nd Page</label>
                          <div class="col-sm-5">
                            <button type="button" class="btn btn-info"  id="filebirthback" name="filebirthback" >Download</button>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputFile" class="col-sm-2 col-form-label">O/L Certificate</label>
                          <div class="col-sm-5">
                            <button type="button" class="btn btn-info"  id="fileol" name="fileol"  >Download</button> 
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputFile" class="col-sm-2 col-form-label">O/L Resit Certificate</label>
                          <div class="col-sm-5">
                            <button type="button" class="btn btn-info"  id="fileolre" name="fileolre"  >Download</button> 
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputFile" class="col-sm-2 col-form-label">A/L Certificate</label>
                          <div class="col-sm-5">
                            <button type="button" class="btn btn-info"  id="fileal" name="fileal"  >Download</button> 
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputFile" class="col-sm-2 col-form-label">Degree certificate copy</label>
                          <div class="col-sm-5">
                            <button type="button" class="btn btn-info"  id="filedegree" name="filedegree"  >Download</button>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputFile" class="col-sm-2 col-form-label">Resignation copy of Srilanka Police</label>
                          <div class="col-sm-5">
                            <button type="button" class="btn btn-info"  id="filepolice" name="filepolice"  >Download</button>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputFile" class="col-sm-2 col-form-label">Discharge certificate of armed service</label>
                          <div class="col-sm-5">
                            <button type="button" class="btn btn-info"  id="filearam" name="filearam"  >Download</button>
                          </div>
                </div>
</div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                </div>
              </div>
            </div>
        </div>
                    </div>
                  </div>
                  </div>
            <!-- </div>
          </div> -->
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

<?php
include INC_PATH . "_admin/_footer.php";
?> 
