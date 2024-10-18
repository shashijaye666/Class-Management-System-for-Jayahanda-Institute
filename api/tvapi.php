<?php
include('../library/config.php');
require('../library/fpdf/fpdf.php');
$request = json_decode( file_get_contents('php://input'));

    if(isset($request->request_type))
    {
        $function = $request->request_type;
        if (function_exists($function))
        {
            $function($request);            
        }
        else
        {
            http_response_code(404);
            echo json_encode(array('code' => '0', 'message' => 'Method not found'));
        }
    } 
    else
    {
            http_response_code(200);
            echo json_encode(array('code' => '0', 'message' => 'request_type required'));
    }


    function VehicleIn($request){
        try
        {
            if (!empty($request->gateId))
            {  
                $VehicleIn = new stdClass;
                $gate = new gate();
                $gateId = $request->gateId;

                $res = $gate->getGateProperty($gateId);

                if(!$res)
                {
                    $result=0;
                }else
                {
                    $vId = $res->vehicleentryid;  
                    $transfer = $res->transfer1;   
                    
                    if ($transfer == 0){

                       $veh = new VehicleEntry();
                       $vres = $veh->GetVehicleEntry($vId);
                       
                        if ($vres != null)
                        {
                            $rmk = new entry1remark;
                            $rmkres = $rmk->GetEntryRemark($vId);

                            if ($rmkres != null)
                            {
                                $VehicleIn->Remarks = $rmkres->remark == null ? "" : $rmkres->remark;
                            }
                            else
                            {
                                $VehicleIn->Remarks = "";
                            }
                            $VehicleIn->VehicleInTime = $vres->intime;
                            $seasonrateid = $vres->seasonrateid;
                            
                            if ($seasonrateid > 0 && $seasonrateid != null)
                            {
                                $VehicleIn->VehicleType = "Season";
                            }else {
                                $VehicleIn->VehicleType = "Normal";
                            }

                            $VehicleIn->VehicleNo = $vres->VehicleNo;
                            $VehicleIn->VehicleCategory = $vres->vehtype == 1 ? "Car" : "Bike";

                            $IncameraImageId = $vres->incameraimageid;

                            $InCameraImage = $gate->GetImagePath($IncameraImageId);
                            if ($InCameraImage != null)
                            {
                                $Oldimgpath = "var/www/camera/";
                                $Newimgpath = "http://172.16.13.190:8585/";
                                $newpath = $InCameraImage->imagepath;
                                $newpath = str_replace("\\","/",$newpath);
                                $newpath = str_replace($Oldimgpath,$Newimgpath,$newpath);
                                $VehicleIn->Image = $newpath;
                            }
                            else
                            {
                                $VehicleIn->Image = "";
                            }

                            $flag = $gate->UpdateTransfer1($request->gateId);
                            if ($flag == true)
                            {
                                
                                echo json_encode(array('Code' => 1, 'Message' => "Success", 'Data' => $VehicleIn));

                            } else {

                                echo json_encode(array('Code' => 0, 'Message' => "Something went Wrong while updating"));
                            
                            }

                        } else {
                            $Oldimgpath = "var/www/camera/";
                            $Newimgpath = "http://172.16.13.190:8585/";
                            $newpath = $res->imagepath;
                            $newpath = str_replace("\\","/",$newpath);
                            $newpath = str_replace($Oldimgpath,$Newimgpath,$newpath);
                            $VehicleIn->Image = $newpath;

                            $VehicleIn->VehicleNo = "Not Detected";
                            $VehicleIn->Remarks = "";
                            $VehicleIn->VehicleInTime = new Date().toJSON();;

                            $flag = $gate->UpdateTransfer1($request->gateId);
                            if ($flag == true)
                            {
                                
                                echo json_encode(array('Code' => 1, 'Message' => "Success", 'Data' => $VehicleIn));

                            } else {

                                echo json_encode(array('Code' => 0, 'Message' => "Something went Wrong while updating"));
                            
                            }
                        }
                    }else
                    {
                        echo json_encode(array('Code' => 0, 'Message' => "Data not found"));
                    }

                    
                }

            }else 
            {
                echo json_encode(array('Code' => 0, 'Message' => "Data not found in GateProperty"));
            }
        } 
        catch (Exception $ex) 
        {
            LoggerServices::errorMessage($ex);
            http_response_code(200);
            echo json_encode(array('code' => '0',"message" => $ex->getMessage()));
            return;
        }
    }





    function VehicleOut($request){
        try
        {
            if (!empty($request->gateId))
            {  
                $VehicleOut = new stdClass;
                $gate = new gate();
                $gateId = $request->gateId;

                $res = $gate->getGateProperty($gateId);

                if(!$res)
                {
                    echo json_encode(array('Code' => 0, 'Message' => "Data not found"));
                }else
                {
                    $VehicleOut->VehicleNo = $res->vehicleno == "" ? "Not Detected" : $res->vehicleno;
                    $VehicleOut->VehicleOutTime = $res->outtime;
                    $VehicleOut->Amount = $res->amount;

                    $Oldimgpath = "var/www/camera/";
                    $Newimgpath = "http://172.16.13.190:8585/";
                    $newpath = $res->imagepath;
                    $newpath = str_replace("\\","/",$newpath);
                    $newpath = str_replace($Oldimgpath,$Newimgpath,$newpath);
                    $VehicleOut->Image = $newpath;

                    $vId = $res->vehicleentryid;  
                    $transfer = $res->transfer1;   
                    
                    if ($transfer == 0){ 

                        if($vId != 0){

                            $veh = new VehicleEntry();
                            $vres = $veh->GetVehicleEntry($vId);

                            if ($vres != null)
                            {
                                $rmk = new entry1remark;
                                $rmkres = $rmk->GetEntryRemark($vId);
    
                                if ($rmkres != null)
                                {
                                    $VehicleOut->Remarks = $rmkres->remark == null ? "" : $rmkres->remark;
                                }
                                else
                                {
                                    $VehicleOut->Remarks = "";
                                }
                                $VehicleOut->VehicleInTime = $vres->intime;
                                $seasonrateid = $vres->seasonrateid;
                                
                                if ($seasonrateid > 0 && $seasonrateid != null)
                                {
                                    $VehicleOut->VehicleType = "Season";
                                }else {
                                    $VehicleOut->VehicleType = "Normal";
                                }
    
                                $VehicleOut->VehicleNo = $vres->VehicleNo;
                                $VehicleOut->VehicleCategory = $vres->vehtype == 1 ? "Car" : "Bike";
    
                                $IncameraImageId = $vres->incameraimageid;
    
                                $InCameraImage = $gate->GetImagePath($IncameraImageId);
                                if ($InCameraImage != null)
                                {
                                    $Oldimgpath = "var/www/camera/";
                                    $Newimgpath = "http://172.16.13.190:8585/";
                                    $newpath = $InCameraImage->imagepath;
                                    $newpath = str_replace("\\","/",$newpath);
                                    $newpath = str_replace($Oldimgpath,$Newimgpath,$newpath);
                                    $VehicleOut->Image = $newpath;
                                }
                                else
                                {
                                    $VehicleOut->Image = "";
                                }
                                
    
    
                            } else {

                                echo json_encode(array('Code' => 0, 'Message' => "Data not found"));

                            }


                        }
                        $flag = $gate->UpdateTransfer1($request->gateId);
                        if ($flag == true)
                        {
                            
                            echo json_encode(array('Code' => 1, 'Message' => "Success", 'Data' => $VehicleOut));

                        } else {

                            echo json_encode(array('Code' => 0, 'Message' => "Something went Wrong while updating"));
                        
                        }


                        
                    }else
                    {
                        echo json_encode(array('Code' => 0, 'Message' => "Data not found"));
                    }

                    
                }

            }else 
            {
                echo json_encode(array('Code' => 0, 'Message' => "Data not found in GateProperty"));
            }
        } 
        catch (Exception $ex) 
        {
            LoggerServices::errorMessage($ex);
            http_response_code(200);
            echo json_encode(array('code' => '0',"message" => $ex->getMessage()));
            return;
        }
    }
    

?>