<?php
$title = "Havelock City";
// include INC_PATH . "_public/_header.php";
include INC_PATH . "_public/_translation.php";
?>

<?php
$lang = $_GET["lang"];
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

</head>
<?php
// get current directory path
$dirpath = "../uploads/*.{pdf}";

$files = array();
$files = glob($dirpath,GLOB_BRACE);

// sort files by last modified date
usort($files, function($x, $y) {
    return filemtime($x) < filemtime($y);
});

echo '<ol style="text-align:justify;">' ;
foreach($files as $item){
  $myfile=pathinfo($item);
 echo '<li>'.$myfile ['basename'].' <a style="color:blue;font-weight:bold" href="'.$item.'" target="_blank">&nbspDownload</a></li>';
}
echo '</ol>';
?>


<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="index3.html" class="navbar-brand">
        <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">Havelock City</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    </div>
  </nav>
  <!-- /.navbar -->

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> <?php echo ($Formtranslation["1"])[$lang]; ?></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Form</h3>
              </div>
              <div class="card-body p-0">
                <form id="appForm" method="post" action="pages/application.php" enctype="multipart/form-data">
                  <input type="hidden" id="request" name="request" value="submitApp">
                  <input type="hidden" id="lang" name="lang" value="<?php echo ($lang == "en" ? "english" : ($lang == "si" ? "Sinhala" : ($lang == "ta" ? "Tamil" : "English"))); ?>" id="lang" />
                  <!-- <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                      <!-- your steps here -->
                      <!-- <div class="step" data-target="#personal-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="personal-part" id="personal-part-trigger">
                          <span class="bs-stepper-circle">1</span>
                          <span class="bs-stepper-label"><?php echo ($Formtranslation["2"])[$lang]; ?></span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#Educational-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="Educational-part" id="Educational-part-trigger">
                          <span class="bs-stepper-circle">2</span>
                          <span class="bs-stepper-label"><?php echo ($Formtranslation["3"])[$lang]; ?></span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#Other-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="Other-part" id="Other-part-trigger">
                          <span class="bs-stepper-circle">3</span>
                          <span class="bs-stepper-label"><?php echo ($Formtranslation["4"])[$lang]; ?></span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#Documents-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="Documents-part" id="Documents-part-trigger">
                          <span class="bs-stepper-circle">4</span>
                          <span class="bs-stepper-label"><?php echo ($Formtranslation["5"])[$lang]; ?></span>
                        </button>
                      </div>
                    </div> --> 
                    <div class="bs-stepper-content">
                    <div class="form-group row">
                          <label for="id" >1.Applicant ID:</label>
                          <div class="col-sm-10">
                          <label name="id" class="font-weight-normal" class="col-sm-10 col-form-label" id="id"></label>
                        </div>
</div>
                      <!-- your steps content here -->
                      <div id="personal-part" class="content" role="tabpanel" aria-labelledby="personal-part-trigger">
                        <div class="form-group row">
                          <label for="Fullname" >2. <?php echo ($translation["1"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label name="fullname" class="font-weight-normal" class="col-sm-10 col-form-label" id="fullname" placeholder="<?php echo ($translation["1"])[$lang]; ?>"></label>
                        </div>
</div>
<div class="form-group row">
                          <label for="exampleInputEmail1" >2.1. <?php echo ($translation["78"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="font-weight-normal" class="col-sm-5 col-form-label" name="fullnameinenglish" id="fullnameinenglish" placeholder="<?php echo ($translation["78"])[$lang]; ?>"></label>
                        </div>
</div>
                        <div class="form-group row">
                          <label for="exampleInputPassword1" >3. <?php echo ($translation["2"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="font-weight-normal" class="col-sm-5 col-form-label"  name="namewithinitials" id="namewithinitials" placeholder="<?php echo ($translation["2"])[$lang]; ?>"></label>
                        </div>
</div>
                        <div class="form-group row">
                          <label for="exampleInputPassword1" >3.1. <?php echo ($translation["79"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                         <label class="font-weight-normal" class="col-sm-5 col-form-label"  name="namewithinitialsinenglish" id="namewithinitialsinenglish" placeholder="<?php echo ($translation["79"])[$lang]; ?>"></label>
                        </div>
</div>
                        <div class="form-group row">
                        <!-- <label for="exampleInputPassword1">4. <?php echo ($translation["3"])[$lang]; ?></label> -->
                          <label for="exampleInputPassword1" >4. <?php echo ($translation["3"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label" name="nic" id="nic" placeholder="<?php echo ($translation["3"])[$lang]; ?>"></label>
                        </div>
</div>
<div class="form-group row">
                          <label for="exampleInputPassword1" >5. <?php echo ($translation["4"])[$lang]; ?>:</label>
                          <!-- <div class="input-group date" id="reservationdate" data-target-input="nearest"> -->
                          <div class="col-sm-10">
                            <label id="dob" class="font-weight-normal" class="font-weight-normal" class="col-sm-2 col-form-label" data-target="#reservationdate"></label>
                            <!-- <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div> -->
</div>
                          
                        </div>
                        
                        <div class="form-group row">
                          <label for="exampleInputPassword1" >6. <?php echo ($translation["5"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label" id="age" placeholder="<?php echo ($translation["5"])[$lang]; ?>"></label>
                        </div>
</div>
<div class="form-group row">
                          <label for="exampleInputEmail1" >7. <?php echo ($translation["95"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label" id="gender" placeholder="<?php echo ($translation["95"])[$lang]; ?>"></label>
                        </div>
</div>
                        <div class="form-group row">
                          <label for="exampleInputPassword1">8. <?php echo ($translation["98"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label" id="cmbblood" name="cmbblood"></label>
</div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputPassword1" >9. <?php echo ($translation["99"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label" id="cmbreligion" name="cmbreligion">
</div>
                           
                        </div>
                        
                        <div class="form-group row">
                          <label for="exampleInputPassword1" >10. <?php echo ($translation["6"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label" id="placeofbirth" name="placeofbirth" placeholder="<?php echo ($translation["6"])[$lang]; ?>"></label>
                        </div>
</div>

<div class="form-group row">

                          <label for="exampleInputPassword1">10.1 <?php echo ($translation["100"])[$lang]; ?>:</label>
                          <div class="col-sm-5">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label" id="provinceplaceofbirth" name="provinceplaceofbirth"></label>
                        </div>
</div>
                        <div class="form-group row">
                          <label for="exampleInputPassword1" >10.2 <?php echo ($translation["101"])[$lang]; ?>:</label>
                          <div class="col-sm-5">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label" id="districtplaceofbirth" name="districtplaceofbirth"></label>
                        </div>
</div>


                        <div class="form-group row">
                          <label for="exampleInputPassword1" >10.3 <?php echo ($translation["7"])[$lang]; ?>:</label>
                          <div class="col-sm-5">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label" id="divsecplaceofbirth" name="divsecplaceofbirth" placeholder="<?php echo ($translation["7"])[$lang]; ?>"></label>
                        </div>
</div>
                        <!-- <div class="form-group row">
                          <label for="exampleInputPassword1" class="col-sm-2 col-form-label">9. <?php echo ($translation["8"])[$lang]; ?></label>
                          <div class="col-sm-10">
                          <label class="col-sm-2 col-form-label" id="cmbProvince" name="cmbProvince"></label>
                            
                        </div> -->
<!-- </div> -->
                        <!-- <label for="exampleInputPassword1" >10. <?php echo ($translation["9"])[$lang]; ?></label> -->
                        <!-- <div class="card">
                           /.card-header -->
                          <!-- <div class="card-body"> --> 
                          <div class="form-group row">
                            <label for="exampleInputPassword1"  >11. <?php echo ($translation["9"])[$lang]; ?>:</label>
                            <div class="col-sm-5">
                            <label class="font-weight-normal"  class="col-sm-2 col-form-label" id="nationality" name="nationality" placeholder="<?php echo ($translation["9"])[$lang]; ?>"></label>
                          </div>
</div>
                          <div class="form-group row">
                            <label for="exampleInputPassword1" >11.1. <?php echo ($translation["10"])[$lang]; ?>:</label>
                            <div class="col-sm-5">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label" id="descentorregister" placeholder="<?php echo ($translation["10"])[$lang]; ?>"></label>
                        </div>
                          </div>
                          <div class="form-group row">
                            <label for="exampleInputPassword1" >11.2. <?php echo ($translation["13"])[$lang]; ?>:</label>
                            <div class="col-sm-5">
                            <label class="font-weight-normal" class="col-sm-2 col-form-label" id="regcertificateno" name="regcertificateno" placeholder="<?php echo ($translation["13"])[$lang]; ?>"></label>
                          </div>
</div>
                          <!-- <div class="form-group row">
                            <label for="exampleInputPassword1" class="col-sm-2 col-form-label">11.3<?php echo ($translation["14"])[$lang]; ?>:</label>
                            <div class="col-sm-10">
                            <label class="col-sm-2 col-form-label" id="desplaceofbirth" name="desplaceofbirth" placeholder="<?php echo ($translation["14"])[$lang]; ?>"></label>
                          </div> -->
<!-- </div>
 -->

 <div class="form-group row">
                          <label for="exampleInputPassword1" >12.<?php echo ($translation["19"])[$lang]; ?>:</label>
                          <div class="col-sm-5">
                          <label class="font-weight-normal" class="col-sm-5 col-form-label" id="fathersname" name="fathersname" placeholder="<?php echo ($translation["19"])[$lang]; ?>"></label>
                        </div>
</div>
                          <!-- <div class="form-group row">
                            <label for="exampleInputPassword1" class="col-sm-2 col-form-label">12<?php echo ($translation["16"])[$lang]; ?>:</label>
                            <div class="col-sm-10">
                            <label class="col-sm-2 col-form-label" id="appfather" name="appfather" placeholder="<?php echo ($translation["16"])[$lang]; ?>"></label>
                          </div>
</div>
                          <div class="form-group row">
                            <label for="exampleInputPassword1" class="col-sm-2 col-form-label"><?php echo ($translation["17"])[$lang]; ?>:</label>
                            <div class="col-sm-10">
                            <label class="col-sm-2 col-form-label" id="appgrandfather" name="appgrandfather" placeholder="<?php echo ($translation["17"])[$lang]; ?>"></label>
                          </div>
</div>
                          <div class="form-group row">
                            <label for="exampleInputPassword1" class="col-sm-2 col-form-label"><?php echo ($translation["18"])[$lang]; ?>:</label>
                            <div class="col-sm-10">
                            <label class="col-sm-2 col-form-label" id="appgreatgrandfather" name="appgreatgrandfather" placeholder="<?php echo ($translation["18"])[$lang]; ?>"></label>
                          </div> -->
<!-- </div> -->
                            <!-- </div>
                          </div> -->


                        
                          <!-- <div class="form-group row">
                          <label for="exampleInputPassword1" class="col-sm-2 col-form-label">11.<?php echo ($translation["19"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                         <label class="col-sm-2 col-form-label" id="fathersname" name="fathersname" placeholder="<?php echo ($translation["19"])[$lang]; ?>"></label>
                        </div> -->
<!-- </div> -->
                        <!-- <div class="form-group row">
                          <label for="exampleInputPassword1" class="col-sm-2 col-form-label">12. <?php echo ($translation["20"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="col-sm-2 col-form-label" id="permanentadder" name="permanentadder" placeholder="<?php echo ($translation["20"])[$lang]; ?>"></label>
                        </div> -->
<!-- </div> -->
                        <div class="form-group row">
                          <label for="exampleInputPassword1" >13.1. <?php echo ($translation["80"])[$lang]; ?>:</label>
                          <div class="col-sm-5">
                          <label class="font-weight-normal" class="col-sm-5 col-form-label" id="permanentadderineng" name="permanentadderineng" placeholder="<?php echo ($translation["80"])[$lang]; ?>"></label>
                        </div>
</div>
<div class="form-group row">
                          <label for="exampleInputPassword1" >13.2. <?php echo ($translation["102"])[$lang]; ?>:</label>
                          <div class="col-sm-5">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label" id="permanentadderpostalno" name="permanentadderineng" placeholder="<?php echo ($translation["102"])[$lang]; ?>">
                        </div>
</div>

                          <div class="form-group row">
                          <label for="exampleInputPassword1">13.3. <?php echo ($translation["103"])[$lang]; ?></label>
                         
</div>
<div class="row">
                            <div class="col-md-4">
                              <div class="form-group row">
                                <label for="exampleInputPassword1" ><?php echo ($translation["8"])[$lang]; ?>:</label>
                                <div class="col-sm-6">
                          <label class="font-weight-normal" class="col-sm-8 col-form-label" id="cmbpermanentadderprovince" name="cmbpermanentadderprovince">
                        </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group row">
                                <label for="exampleInputPassword1" ><?php echo ($translation["110"])[$lang]; ?>:</label>
                                <div class="col-sm-6">
                          <label class="font-weight-normal" class="col-sm-8 col-form-label" id="cmbpermanentadderdistrict" name="cmbpermanentadderdistrict">
                        </div>
</div>
</div>
                               
                              
                            <div class="col-md-4">
                              <div class="form-group row">
                                <label for="exampleInputPassword1" ><?php echo ($translation["111"])[$lang]; ?>:</label>
                                <div class="col-md-5">
                          <label class="font-weight-normal" class="col-sm-8 col-form-label" id="cmbpermanentadderdivsec" name="cmbpermanentadderdivsec">
                        </div>
                                
                              </div>
                           
                              </div>
                        </div>
                     
                        <div class="form-group row ">
                          <label for="exampleInputPassword1"  >13.4. <?php echo ($translation["109"])[$lang]; ?>:</label>
                          <div class="col-sm-6">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label" id="cmbpermanentaddergnd" name="cmbpermanentaddergnd">
                        </div>
</div>
                         

                        <div class="form-group row">
                          <label for="exampleInputPassword1">13.5 <?php echo ($translation["103"])[$lang]; ?></label>
</div>
                         <div class="row">
                          <div class="col-md-4">
                              <div class="form-group row">
                                <label for="exampleInputPassword1"><?php echo ($translation["113"])[$lang]; ?>:</label>
                                <div class="col-sm-5">
                          <label class="font-weight-normal" class="col-sm-8 col-form-label" id="cmbpermanentadderdivision" name="cmbpermanentadderdivision">
                        </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group row">
                                <label for="exampleInputPassword1" ><?php echo ($translation["112"])[$lang]; ?>:</label>
                                <div class="col-sm-5">
                          <label class="font-weight-normal" class="col-sm-15 col-form-label" id="permanentadderpolice" name="permanentadderpolice">
                        </div>
                                
                              </div>
                            </div>
                          </div>
                       <div>
                        
                        </div>
                                                <div class="form-group row">
                          <label for="exampleInputPassword1" >14. <?php echo ($translation["24"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="font-weight-normal" class="col-sm-5 col-form-label" id="presentadder" name="presentadder" placeholder="<?php echo ($translation["24"])[$lang]; ?>"></label>
                        </div>
</div>
                         <!-- <div class="form-group row">
                           
                          <label for="exampleInputPassword1" class="col-sm-2 col-form-label">14.1. <?php echo ($translation["81"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="col-sm-5 col-form-label" id="presentadderineng" name="presentadderineng" placeholder="<?php echo ($translation["81"])[$lang]; ?>"></label>
                        </div>
</div> -->
<div class="form-group row">
                          <label for="exampleInputPassword1">14.2. <?php echo ($translation["25"])[$lang]; ?></label>
</div>
                          <div class="row">
                          <div class="col-md-3">
                              <div class="form-group row">
                                <label for="exampleInputPassword1"><?php echo ($translation["8"])[$lang]; ?>:</label>
                                <div class="col-sm-6">
                          <label class="font-weight-normal" class="col-sm-10 col-form-label" id="presentadderprovince" name="presentadderprovince">
                        </div>
                                
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group row">
                                <label for="exampleInputPassword1" ><?php echo ($translation["110"])[$lang]; ?>:</label>
                                <div class="col-sm-6">
                          <label class="font-weight-normal" class="col-sm-10 col-form-label" id="presentadderdistrict" name="presentadderdistrict">
                        </div>

                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group row">
                                <label for="exampleInputPassword1"><?php echo ($translation["113"])[$lang]; ?>:</label>
                                <div class="col-sm-5">
                          <label class="font-weight-normal" class="col-sm-8 col-form-label" id="presentadderdivision" name="presentadderdivision">
                        </div>
                                
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group row">
                                <label for="exampleInputPassword1" ><?php echo ($translation["112"])[$lang]; ?>:</label>
                                <div class="col-sm-6">
                          <label class="font-weight-normal" class="col-sm-10 col-form-label" id="presentadderpolice" name="presentadderpolice">
                        </div>

                              </div>
                            </div>
                          </div>
                        
                        
<div class="form-group row">
                          <label for="exampleInputPassword1" >15.1. <?php echo ($translation["26"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="font-weight-normal" class="col-sm-5 col-form-label" id="mailingadder" name="mailingadder" placeholder="<?php echo ($translation["26"])[$lang]; ?>"></label>
                        </div>
</div>
                        <!-- <div class="form-group row">
                          <label for="exampleInputPassword1" class="col-sm-2 col-form-label">18.1. <?php echo ($translation["82"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="col-sm-2 col-form-label" id="mailingadderineng" name="mailingadderineng" placeholder="<?php echo ($translation["82"])[$lang]; ?>"></label>
                        </div>
</div> -->
<div class="form-group row">
                          <label for="exampleInputPassword1">16. <?php echo ($translation["27"])[$lang]; ?></label>
</div>
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group row">
                                <label for="exampleInputPassword1"  ><?php echo ($translation["28"])[$lang]; ?>:</label>
                                <div class="col-sm-7">
                                <label class="font-weight-normal" class="col-sm-10 col-form-label" id="contactresi" name="contactresi" placeholder="<?php echo ($translation["28"])[$lang]; ?>"><label>
                              </div>
</div>
                            </div>
                            <div class="col-md-3">
                            <div class="form-group row">
                                <label for="exampleInputPassword1" ><?php echo ($translation["29"])[$lang]; ?>:</label>
                                <div class="col-sm-7">
                                <label class="font-weight-normal" class="col-sm-10 col-form-label" id="contactprivate" name="contactprivate" placeholder="<?php echo ($translation["29"])[$lang]; ?>"></label>
                              </div>
                            </div>
</div>
                            <div class="col-md-3">
                            <div class="form-group row">
                                <label for="exampleInputPassword1">Whatsapp:</label>
                                <div class="col-sm-7">
                                <label class="font-weight-normal" class="col-sm-10 col-form-label" id="contactwhatsapp" name="contactwhatsapp" placeholder="Whatsapp"></label>
                              </div>
                            </div>
                          </div>
</div>
                        
                        <div class="form-group row">
                          <label for="exampleInputPassword1" >17. <?php echo ($translation["30"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="font-weight-normal" class="col-sm-5 col-form-label" id="emailadder" name="emailadder" placeholder="<?php echo ($translation["30"])[$lang]; ?>"></label>
                        </div>
</div>
                        <div class="form-group row">
                          <label for="exampleInputPassword1">18. <?php echo ($translation["31"])[$lang]; ?></label>
</div>
                          <div class="row">
                            <div class="col-md-3">
                            <div class="form-group row">
                                <label for="exampleInputPassword1" ><?php echo ($translation["32"])[$lang]; ?>:</label>
                                <div class="col-sm-6">
                                <label class="font-weight-normal" class="col-sm-2 col-form-label" id="heightinfeet" name="heightinfeet" placeholder="<?php echo ($translation["32"])[$lang]; ?>"></label>
                              </div>
                            </div>
</div>
                            <div class="col-md-3">
                            <div class="form-group row">
                                <label for="exampleInputPassword1" ><?php echo ($translation["33"])[$lang]; ?>:</label>
                                <div class="col-sm-6">
                                <label class="font-weight-normal" class="col-sm-2 col-form-label" id="heightininches" name="heightininches" placeholder="<?php echo ($translation["33"])[$lang]; ?>"></label>
                              </div>
                            </div>
</div>
                            <div class="col-md-3">
                            <div class="form-group row">
                                <label for="exampleInputPassword1" ><?php echo ($translation["83"])[$lang]; ?>:</label>
                                <div class="col-sm-5">
                                <label class="font-weight-normal" class="col-sm-6 col-form-label" id="heightincm" name="heightincm" placeholder="<?php echo ($translation["83"])[$lang]; ?>"></label>
                              </div>
                            </div>
</div>
                            <div class="col-md-3">
                            <div class="form-group row">
                                <label for="exampleInputPassword1"><?php echo ($translation["34"])[$lang]; ?>:</label>
                                <div class="col-sm-5">
                                <label class="font-weight-normal" class="col-sm-6 col-form-label" id="chestininches" name="chestininches" placeholder="<?php echo ($translation["34"])[$lang]; ?>"></label>
                              </div>
                            </div>
</div>
                          </div>
                       
                        
                        <!-- <button class="btn btn-primary" type="button" onclick="stepper.next()"><?php echo ($Formtranslation["6"])[$lang]; ?></button> -->
                      </div>
                      <div id="Educational-part" class="content" role="tabpanel" aria-labelledby="Educational-part-trigger">
                        <div class="card card-secondary">
                          <div class="card-header">
                            <h3 class="card-title">22. <?php echo ($translation["37"])[$lang]; ?></h3>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-3">
                                <div class="form-group row">
                                  <label for="Year" ><?php echo ($translation["77"])[$lang]; ?>:</label>
                                  <div class="col-sm-5">
                                  <label  class="font-weight-normal" class="col-sm-2 col-form-label" id="yearol" placeholder="<?php echo ($translation["77"])[$lang]; ?>"></label>
                                </div>
</div>
                              </div>
                              <div class="col-3">
                                <div class="form-group row">
                                  <label for="IndexNo" ><?php echo ($translation["38"])[$lang]; ?>:</label>
                                  <div class="col-sm-5">
                                  <label class="font-weight-normal" class="col-sm-2 col-form-label" id="indexnool" placeholder="<?php echo ($translation["38"])[$lang]; ?>"></label>
                                </div>
                              </div>
</div>
                              <div class="col-3">
                                <div class="form-group row">
                                  <label for="School" ><?php echo ($translation["39"])[$lang]; ?>:</label>
                                  <div class="col-sm-7">
                                  <label class="font-weight-normal" class="col-sm-2 col-form-label" id="schoolol" placeholder="<?php echo ($translation["39"])[$lang]; ?>"></label>
                                </div>
                              </div>
</div>
                              <div class="col-3">
                                <div class="form-group row">
                                  <label for="exampleInputPassword1" ><?php echo ($translation["40"])[$lang]; ?>:</label>
                                  <div class="col-sm-5">
                                  <label class="font-weight-normal" class="col-sm-2 col-form-label" id="mediumol" placeholder="<?php echo ($translation["40"])[$lang]; ?>"></label>
                                </div>
                                </div>
                              </div>
                            </div>
</div>
                            
                            <table class="table table-striped" id="tbol">
                              <thead>
                                <tr>
                                  <th style="width: 100px">Con No</th>
                                  <th><?php echo ($translation["47"])[$lang]; ?></th>
                                  <th style="width: 100px"><?php echo ($translation["48"])[$lang]; ?></th>
                                </tr>
                              </thead>
                              <tbody id="tblol">
                              </tbody>
                            </table>
                            <input type="hidden" id="ollist" name="ollist" value="" />
                            </div>
                          </div>
                        

                        <!-- <div id="Educational-part" class="content" role="tabpanel" aria-labelledby="Educational-part-trigger"> -->
                        <div class="card card-secondary">
                          <div class="card-header">
                            <h3 class="card-title"><?php echo ($translation["43"])[$lang]; ?></h3>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-3">
                                <div class="form-group row">
                                  <label for="Year"><?php echo ($translation["77"])[$lang]; ?>:</label>
                                  <div class="col-sm-5">
                                  <label class="font-weight-normal" class="col-sm-2 col-form-label" id="yearolr" placeholder="<?php echo ($translation["77"])[$lang]; ?>"></label>
                                </div>
</div>
                              </div>
                              <div class="col-3">
                                <div class="form-group row">
                                  <label for="IndexNo"><?php echo ($translation["44"])[$lang]; ?>:</label>
                                  <div class="col-sm-5">
                                  <label class="font-weight-normal" class="col-sm-2 col-form-label" id="indexnoolr" placeholder="<?php echo ($translation["44"])[$lang]; ?>"></label>
                                </div>
</div>
                              </div>
                              <div class="col-3">
                                <div class="form-group row">
                                  <label for="School"><?php echo ($translation["45"])[$lang]; ?>:</label>
                                  <div class="col-sm-7">
                                  <label class="font-weight-normal" class="col-sm-2 col-form-label" id="schoololr" placeholder="<?php echo ($translation["45"])[$lang]; ?>"></label>
                                </div>

</div>
                              </div>
                              <div class="col-3">
                                <div class="form-group row">
                                  <label for="Medium"><?php echo ($translation["46"])[$lang]; ?>:</label>
                                  <div class="col-sm-5">
                                  <label class="font-weight-normal" class="col-sm-2 col-form-label" id="mediumolr" placeholder="<?php echo ($translation["46"])[$lang]; ?>"></label>
                                </div>
                                </div>
                              </div>
</div>
</div> 
                             

                   

                            
                           
                            <table class="table table-striped" id=tolr>
                              <thead>
                                <tr>
                                  <th style="width: 100px">Con No</th>
                                  <th><?php echo ($translation["47"])[$lang]; ?></th>
                                  <th style="width: 100px"><?php echo ($translation["48"])[$lang]; ?></th>
                                </tr>
                              </thead>
                              <tbody id="tblolr">
                              </tbody>
                            </table>
                            <input type="hidden" id="olrlist" name="olrlist" value="" />
                            </div>
                            
                         

                        <div class="card card-secondary">
                          <div class="card-header">
                            <h3 class="card-title"> <?php echo ($translation["49"])[$lang]; ?> </h3>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-3">
                                <div class="form-group row">
                                  <label for="Year"><?php echo ($translation["77"])[$lang]; ?>:</label>
                                  <div class="col-sm-5">
                                  <label class="font-weight-normal" class="col-sm-2 col-form-label" id="yearal" placeholder="<?php echo ($translation["77"])[$lang]; ?>">
                                </div>

</div>
                              </div>
                              <div class="col-3">
                                <div class="form-group row">
                                  <label for="IndexNo"><?php echo ($translation["51"])[$lang]; ?>:</label>
                                  <div class="col-sm-5">
                                  <label class="font-weight-normal" class="col-sm-2 col-form-label" id="indexnoal" placeholder="<?php echo ($translation["51"])[$lang]; ?>">
                                </div>
</div>
                              </div>
                              <div class="col-3">
                                <div class="form-group row">
                                  <label for="School"><?php echo ($translation["52"])[$lang]; ?>:</label>
                                  <div class="col-sm-7">
                                  <label class="font-weight-normal" class="col-sm-2 col-form-label" id="schoolal" placeholder="<?php echo ($translation["52"])[$lang]; ?>">
                                </div>
</div>
                              </div>
                              <div class="col-3">
                              <div class="form-group row">
                                  <label for="exampleInputPassword1"><?php echo ($translation["53"])[$lang]; ?>:</label>
                                  <div class="col-sm-5">
                                  <label class="font-weight-normal" class="col-sm-2 col-form-label" id="mediumal" placeholder="<?php echo ($translation["52"])[$lang]; ?>">
                                </div>
                                </div>
                              </div>
                              <div class="col-3">
                                <div class="form-group row">
                                  <label for="ZScore"><?php echo ($translation["56"])[$lang]; ?>:</label>
                                  <div class="col-sm-5">
                                  <label class="font-weight-normal" class="col-sm-2 col-form-label" id="zscoreal" placeholder="<?php echo ($translation["56"])[$lang]; ?>"></label>
                                </div>
</div>
                              </div>
                            </div>
                            </div>
                            <div>
                            <table class="table table-striped" id="tbal">
                              <thead>
                                <tr>
                                  <th style="width: 100px" >Con No</th>
                                  <th><?php echo ($translation["47"])[$lang]; ?></th>
                                  <th style="width: 100px"><?php echo ($translation["48"])[$lang]; ?></th>
                                </tr>
                              </thead>
                              <tbody id="tblal">
                              </tbody>
                            </table>
                            <input type="hidden" id="allist" name="allist" value="" />
                           
                          </div>
                          </div>
                        

                        
                        <div class="form-group row">
                          <label class="col-sm-8 col-form-label"><?php echo ($translation["106"])[$lang]; ?>:</label>
                          <div class="col-sm-1">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label" id="completeddegree" name="completeddegree" data-on-text="YES" data-off-text="NO" data-bootstrap-switch></label>
                        </div>
</div>
                        <div class="form-group row">
                          <label class="col-sm-8 col-form-label"><?php echo ($translation["107"])[$lang]; ?>:</label>
                          <div class="col-sm-1">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label" id="followingdegree" name="followingdegree" data-on-text="YES" data-off-text="NO" data-bootstrap-switch></label>
                        </div>
</div>
                       
                      <div class="form-group row">
                          <label for="exampleInputEmail1">23. <?php echo ($translation["57"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                            <label class="font-weight-normal" class="col-sm-5 col-form-label" id="marialstatus" name="marialstatus"></label>
                        </div>
                        </div>

                        
                        <div class="form-group row">
                          <label for="exampleInputPassword1">24. <?php echo ($translation["58"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="font-weight-normal" class="col-sm-5 col-form-label" id="currentoccupation" name="currentoccupation" placeholder="<?php echo ($translation["58"])[$lang]; ?>"></label>
                        </div>
</div>
                        <div class="form-group row">
                            <label><?php echo ($translation["59"])[$lang]; ?>:</label>
                            <div class="col-sm-10">
                            <label class="font-weight-normal" class="col-sm-2 col-form-label" id="armedservicemember" name="armedservicemember" data-bootstrap-switch></label>
                        </div>
</div>
                        <div class="form-group row">
                            <label>25. <?php echo ($translation["60"])[$lang]; ?>:</label>
                            <div class="col-sm-10">
                            <label class="font-weight-normal" class="col-sm-2 col-form-label" id="servedinslpolice" name="servedinslpolice"  data-bootstrap-switch></label>
                        </div>
</div>
                        <div class="form-group row">
                          <label for="exampleInputPassword1" ><?php echo ($translation["62"])[$lang]; ?>:</label>
                          <div class="col-sm-10">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label" id="cmbrank" name="cmbrank">
                            
                        </div>
</div>
                        <div class="form-group row">
                          <label for="exampleInputPassword1" ><?php echo ($translation["63"])[$lang]; ?>:</label>
                          <div class="col-sm-8">
                          <label class="font-weight-normal" class="col-sm-2 col-form-label"  id="regimentalno" name="regimentalno" placeholder="<?php echo ($translation["63"])[$lang]; ?>"></label>
                        </div>
</div>
                        <div class="form-group row">
                          <label for="exampleInputPassword1" ><?php echo ($translation["64"])[$lang]; ?>:</label>
                          <div class="col-sm-8">
                          <label class="font-weight-normal" class="col-sm-10 col-form-label" id="reasonforleaving" name="reasonforleaving" placeholder="<?php echo ($translation["64"])[$lang]; ?>"></label>
                        </div>
</div>
                        <div class="form-group row">
                            <label>26. <?php echo ($translation["65"])[$lang]; ?>:</label>
                            <div class="col-sm-10">
                            <label class="font-weight-normal" class="col-sm-2 col-form-label" id="servedinarmedservice" name="servedinarmedservice"></label>
                        </div>
</div>
                        <input type = "button" class="btn btn-info" value = "Print" id="ApplicationReport" />
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <!-- Control Sidebar -->
 <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->



  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Developed By: <a href="https://www.linkedin.com/in/shashikajaye" target=”_blank”>Shashika Jayathilaka </a> (Pvt) Ltd.
    </div>
    <!-- Default to the left -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- date-range-picker -->
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Bootstrap Switch -->
<script src="../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<script>
  $(function () {

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
  });
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })
  </script>
<?php
  if(isset($_GET["page"]))
  {
    echo '<script src="js/'.$_GET["page"].'.js"></script>';
  }
  else{
    echo '<script src="js/index.js"></script>';
  }
?>
</body>
</html>