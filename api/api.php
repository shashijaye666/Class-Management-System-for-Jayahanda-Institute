<?php
include('../library/config.php');
header('Content-Type: application/json; charset=utf-8');

use \Firebase\JWT\JWT;
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

function decode_token($token){
    $decoded = JWT::decode($token, key, array('HS256'));
    $tokendata = $decoded->data;
    return $tokendata;
}


function user_login($request)
{
    try
    {
        $response = new stdClass();
        if ((!empty($request->username) || !empty($request->password)))
        {

            $user = new user();
            $Pwdhash = hash('md5',$request->password);

            $res = $user->getPosUser($request->username,$Pwdhash); 

            if($res)
            {

                $timersatus = new Default1();
                $response->timerstatus = $timersatus->GetTimerStatus();

                $Session = new Session();
                $Session->userid=$res->id;
                $Session->datetime=date('Y-m-d H:i:s');
                $Session->chrginglocation=0;
                $Session->transfer=0;

                $sessionid = $Session->SaveSession();                                
                $userid = $res->id;

                $token = array(
                    'iss' => iss,
                    'aud' => aud,
                    'iat' => iat,
                    'nbf' => nbf,
                    'data' => array(
                        'sessionid' => $sessionid,
                        'userid' => $userid,
                    )
                );
                $jwt = JWT::encode($token, key);

                $response->token = $jwt;

                http_response_code(200);
                echo json_encode(array("code" => "1", "message" =>"success",  "data" => $response));
                return;
                
            }
        }

        http_response_code(200);
        echo json_encode(array("code" => "0", "message" =>"failed"));
        return;

    }    
    catch (Exception $ex) 
    {
        LoggerServices::errorMessage($ex);
        http_response_code(200);
        echo json_encode(array('code' => '0',"message" => $ex->getMessage()));
        return;
    }
}

function get_parking_charge($request){
    try
    {
        $response = new stdClass();
        //$sessiondata = decode_token($request->token);

        $vmservice = new VehicleMst();
        $veservice = new VehicleEntry();
        $gpservice = new gateproperty();
        $rtservice = new Rates();
        $dfservice = new Default1();
        $cgservice = new PaymentMst();

        $firstHourAmt = 0;
        $PeakAmt = 0;
        $offPeakAmt = 0;
        $hdayAmt = 0;

        $DiffMins = 0;
        $BalMins = 0;
        $ShMins = 0;

        $vehiclemst = null;
        $outlocationid = 0;
        $seasonrateid = 0;
        $vehInTime = null;
        $vehOutTime = new DateTime();
        $totDuration = 0;

        if($request->vehicleno == "")
            $vehiclemst = $vmservice->GetVehicleMstByVehicleEntryId($request->entryid);
        else
            $vehiclemst = $vmservice->GetVehicleMstByVehicleNo($request->vehicleno);

        if($vehiclemst != null){
            $VehicleEntryId = $vehiclemst->lastvehicleentryid;
            $VehCategory = $vehiclemst->vehiclecategory;
            $VehCategory = $VehCategory == 0 ? 1 : $VehCategory;
            $WalletAmount = 0;
            $totDuration = 0;

            if($request->vehicleentry)
                $WalletAmount = 0;
            else
                $WalletAmount = $vehiclemst->wallet != "" ? $vehiclemst->wallet : 0;

            $response->walletamount = $vehiclemst->wallet != "" ? $vehiclemst->wallet : 0;
            $response->vehicleno = $vehiclemst->vehicleno;
            $response->vehtype = $VehCategory;

            $VehicleEntry = $veservice->GetVehicleEntryById($VehicleEntryId);
            if($VehicleEntry){
                $outlocationid = $VehicleEntry->outlocationid;
                if($outlocationid == 0){
                    $response->vehicleentryid = $VehicleEntryId;
                    $vehInTime = new DateTime($VehicleEntry->intime);
                    $response->intime = $vehInTime->format('Y-m-d H:i:s');

                    $img = $veservice->GetImagePath($VehicleEntry->incameraimageid);
                    if($img){
                        $imgpath = $img->imagepath;
                        $File = pathinfo($imgpath);
                        $response->imagepath = $File['basename'];
                    }else{
                        $response->imagepath = "";
                    }

                    if($request->outtime != "")
                        $vehOutTime = new DateTime($request->outtime);

                    $diff = $vehInTime->diff($vehOutTime);
                    $totDuration = ($diff->days * 24 * 60); 
                    $totDuration += ($diff->h * 60); 
                    $totDuration += $diff->i; 
                    if(($diff->s) > 0)
                        $totDuration += 1; 

                    $response->duration = $totDuration;

                    $seasonrateid = $VehicleEntry->seasonrateid;
                    $hrs = $VehicleEntry->h24;

                    if($seasonrateid == 0){
                        $ratemst = $rtservice->GetRate($VehCategory);
                        if($ratemst){
                            $rate1 = $ratemst->rate1;
                            $rate2 = $ratemst->rate2;
                            $rate3 = $ratemst->rate3;
                        }

                        $def = $dfservice->GetAllGraceMinutes();
                        if($def){
                            $DiffMins = $def->graceminuites;
                            $BalMins = $def->h_graceminuites;
                            $ShMins = $def->s_graceminuites;
                        }

                        $response->chargeableamount = 0;

                        if($totDuration > $DiffMins){


                            if($totDuration <= (60 * 5)){ //first 5 Hours
                                $min = $totDuration - floor($totDuration / 60) * 60;
                                $hours = floor($totDuration / 60);
                                if($min > $BalMins)
                                    $hours = $hours + 1;
                    
                                $response->chargeableamount = $response->chargeableamount + ($hours * $rate1);

                            }else{
                                $response->chargeableamount = $response->chargeableamount + (5 * $rate1);
                            } 
                            


                            if(($totDuration >= (60 * 5))){ //After 5 Hours
                                
                                $totDuration = $totDuration - (60 * 5);



                                if($totDuration <= (60 * 3)){
                                    $min = $totDuration - floor($totDuration / 60) * 60;
                                
                                    $hours = floor($totDuration / 60);
                                    if($min > $BalMins)
                                        $hours = $hours + 1;

                                    $response->chargeableamount = $response->chargeableamount + ($hours * $rate2);    
                                    

                            
                                }else{
                                    $response->chargeableamount = $response->chargeableamount + (3 * $rate2);
                                    $totDuration = $totDuration - (60 * 3);

                                    if($totDuration > 0){ //After 8 Hours
                        
                                        $min = $totDuration - floor($totDuration / 60) * 60;
                                        $hours = floor($totDuration / 60);
                                        if($min > $BalMins)
                                            $hours = $hours + 1;
    
                                        $response->chargeableamount = $response->chargeableamount + ($hours * $rate3);
                                    }

                                }

                                

                                
                            }
                            
                            

                            


                        }

                        $response->previouspayment = $cgservice->GetCgpaymentMstAmount($VehicleEntryId);
                        $response->balanceamount = $response->chargeableamount - $response->previouspayment - $WalletAmount;

                        http_response_code(200);
                        echo json_encode(array("code" => "1", "message" =>"success", "data"=> $response));
                        return;

                    }else{
                        http_response_code(200);
                        echo json_encode(array("code" => "0", "message" =>"Season vehicle"));
                        return;
                    }
                }else{
                    http_response_code(200);
                    echo json_encode(array("code" => "0", "message" =>"Vehicle already exited"));
                    return;
                }
            }else{
                http_response_code(200);
                echo json_encode(array("code" => "0", "message" =>"Entry not found"));
                return;
            }
        }else{
            http_response_code(200);
            echo json_encode(array("code" => "0", "message" =>"Vehicle not found"));
            return;
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

function payment_confirmation($request){
    try
    {
        $response = new stdClass();
        $sessiondata = decode_token($request->token);

        $dfservice = new Default1();
        $veservice = new VehicleEntry();
        $vmservice = new VehicleMst();
        $cgservice = new PaymentMst();
        $gpservice = new gateproperty();

        $DiffMins = 0;
        $BalMins = 0;
        $ShMins = 0;

        if($request->paymentamount > 0){
            $refno = $request->terminalid . time();
            $response->refno = $refno;

            $vehiclemst = $vmservice->GetVehicleMstByVehicleEntryId($request->vehicleentryid);
            $VehicleEntry = $veservice->GetVehicleEntryById($request->vehicleentryid);

            $response->vehicleentryid = $VehicleEntry->id;
            $response->vehicleno = $VehicleEntry->vehicleno;
            $response->vehicletype = $VehicleEntry->vehtype;

            $def = $dfservice->GetAllGraceMinutes();
            if($def){
                $DiffMins = $def->graceminuites;
                $BalMins = $def->h_graceminuites;
                $ShMins = $def->s_graceminuites;
            }

            if($VehicleEntry->intime != $VehicleEntry->paidupto){
                $nowTime = new DateTime();
                $vehPaidUpto = new DateTime($VehicleEntry->paidupto);

                $diff = $nowTime->diff($vehPaidUpto);
                $totDuration = ($diff->days * 24 * 60); 
                $totDuration += ($diff->h * 60); 
                $totDuration += $diff->i; 

                if($totDuration <= $DiffMins && $totDuration > 0){
                    http_response_code(200);
                    echo json_encode(array("code" => "1", "message" =>"Already paid"));
                    return;
                }

            }
            
            $flag = false;
            $msg = "";

            $response->fullpayment = 1;

            if($request->paymentmodeid == 3){
                $tokendata = $cgservice->TokenValidation($request->vouchertoken, $request->vehicleentryid, $request->vehicleno);
                if($tokendata){
                    $tokenamount = $tokendata->amount;
                    if($request->paymentamount > $tokenamount){
                        $flag = $cgservice->InsertCgPayment($request,$refno,$tokenamount);
                        $response->fullpayment = 0;
                    }else{
                        $flag = $cgservice->InsertCgPayment($request,$refno,$request->paymentamount, $sessiondata->userid);
                    }
                    $msg = "Payment Successfull";
                }
                else{
                    $flag = false;
                    $msg = "Invalid Token";
                }
            }else{
                $flag = $cgservice->InsertCgPayment($request,$refno,$request->paymentamount, $sessiondata->userid);
                $msg = "Payment Successfull";
            }

            if($flag){
                if($response->fullpayment == 1){

                    $dateTime = new DateTime();
                    $dateTime->modify('+'.$DiffMins.' minutes');
                    $paidupto = $dateTime->format('Y-m-d H:i:s');

                    $veservice->UpdatePaidUpto($request->vehicleentryid, $paidupto, $request->paymentamount);

                    if ($request->walletpayment > 0 || $request->paymentamount > $request->balancepayment){
                        if($vehiclemst){
                            
                        }
                    }


                    if ($request->kiosk == 0){
                        $gpservice->UpdateTransfer8($request->terminalid, 1);

                        if ($request->status == 0){
                            $gpservice->UpdateGateProperty($request->terminalid, 1, $VehicleEntry->vehicleno, $request->paymenttime, $VehicleEntry->id);
                        }

                        http_response_code(200);
                        echo json_encode(array("code" => "1", "message" =>"Payment Successfull", "data" => $response));
                        return;
                    }else{
                        http_response_code(200);
                        echo json_encode(array("code" => "1", "message" =>"Payment Successfull", "data" => $response));
                        return;
                    }
                }else{
                    http_response_code(200);
                    echo json_encode(array("code" => "1", "message" =>"Payment Successfull", "data" => $response));
                    return;
                }
            }else{
                http_response_code(200);
                echo json_encode(array("code" => "0", "message" =>$msg, "data" => $response));
                return;
            }
        }else{
            if ($request->kiosk == 0){
                $gpservice->UpdateTransfer8($request->terminalid, 1);
            }

            http_response_code(200);
            echo json_encode(array("code" => "1", "message" =>"Payment Successfull", "data" => $response));
            return;
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

function get_last_vehicle($request){
    try
    {
        $response = new stdClass();
        $sessiondata = decode_token($request->token);

        $gpservice = new gateproperty();
        $veservice = new VehicleEntry();
        $cgservice = new PaymentMst();

        $res = $gpservice->GetGateProperty($request->propertyid, $request->inout, $request->lastvehicle);
        if($res){
            $response->VehicleEntryId = $res->lastvehicleentryid;
            $response->VehicleNo = $res->vehicleno;
            $response->InTime = $res->intime;
            $response->OutTime = $res->outtime;
            $response->ChargeableAmout = $res->amount;
            $response->VehicleStatus = $res->vehiclestatus;
            $response->ImagePath = $res->imagepath;
            $response->Duration = $res->duration;

            $ve = $veservice->GetVehicleEntryById($response->VehicleEntryId);
            if($ve)
                $response->VehicleType = $ve->vehtype;
            else
                $response->VehicleType = 1;

            $response->PreviousPayment = $cgservice->GetCgpaymentMstAmount($response->VehicleEntryId);
            $gpservice->UpdateTransfer2($res->id);

            http_response_code(200);
            echo json_encode(array("code" => "1", "message" =>"success", "data"=> $response));
            return;
        }else{
            http_response_code(200);
            echo json_encode(array("code" => "0", "message" =>"Data not found"));
            return;
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

function scan_vehicle($request){
    try
    {
        $response = new stdClass();
        $sessiondata = decode_token($request->token);

        $veservice = new VehicleEntry();
        $gpservice = new gateproperty();

        $res = $veservice->GetVehicleDetailsByVehicleNo($request->vehicleno, $request->kiosk);
        if(!empty($res)){
            
            if(count($res) == 1){
                if($request->kiosk == 0){
                    $gpservice->UpdateGateProperty($request->propertyid, $request->inout, $res[0]->vehicleno, $request->outtime, $res[0]->id);

                    if ($request->status == 0 && $res[0]->display == "1"){
                        //ProcessOutCameraImages(Vehicle.PropertyId);
                    }
                }
            }
            http_response_code(200);
            echo json_encode(array("code" => "1", "message" =>"success", "data"=> json_encode($res)));
            return;
        }else{
            http_response_code(200);
            echo json_encode(array("code" => "0", "message" =>"Data not found"));
            return;
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

function select_vehicle($request){
    try
    {
        $response = new stdClass();
        $sessiondata = decode_token($request->token);

        $veservice = new VehicleEntry();
        $gpservice = new gateproperty();

        $ret = $gpservice->UpdateGateProperty($request->propertyid, $request->inout, $request->vehicleno, $request->outtime, $request->lastentryid);

        if($ret){
            
            http_response_code(200);
            echo json_encode(array("code" => "1", "message" =>"success"));
            return;
        }else{
            http_response_code(200);
            echo json_encode(array("code" => "0", "message" =>"failed"));
            return;
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

function refresh($request){
    try
    {
        $response = new stdClass();
        $sessiondata = decode_token($request->token);

        $veservice = new VehicleEntry();
        $gpservice = new gateproperty();

        $ret = $gpservice->RefreshGateProperty($request->propertyid, $request->inout);

        if($ret){
            
            http_response_code(200);
            echo json_encode(array("code" => "1", "message" =>"success"));
            return;
        }else{
            http_response_code(200);
            echo json_encode(array("code" => "0", "message" =>"failed"));
            return;
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

function timer_status($request){
    try
    {
        $response = new stdClass();
        $sessiondata = decode_token($request->token);

        $dservice = new Default1();

        $ret = $dservice->UpdateTimerStatus($request->status);

        if($ret){
            
            http_response_code(200);
            echo json_encode(array("code" => "1", "message" =>"success"));
            return;
        }else{
            http_response_code(200);
            echo json_encode(array("code" => "0", "message" =>"failed"));
            return;
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

function change_vehicle_type($request){
    try
    {
        $response = new stdClass();
        $sessiondata = decode_token($request->token);

        $veservice = new VehicleEntry();
        $gpservice = new gateproperty();

        $ret = $veservice->UpdateVehicleType($request->vehicletype, $request->lastentryid);

        if($ret){
            $res = $veservice->GetVehicleDetailsByVehicleNo($request->vehicleno, $request->kiosk);
            if($res != null){
                
                if(count($res) == 1){
                    if($request->kiosk == 0){
                        $gpservice->UpdateGateProperty($request->propertyid, $request->inout, $res[0]->vehicleno, $request->outtime, $res[0]->id);

                        if ($request->status == 0 && $res[0]->display == "1"){
                            //ProcessOutCameraImages(Vehicle.PropertyId);
                        }
                    }
                }
            }
            
            http_response_code(200);
            echo json_encode(array("code" => "1", "message" =>"success"));
            return;
        }else{
            http_response_code(200);
            echo json_encode(array("code" => "0", "message" =>"failed"));
            return;
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

function gate_property($request){
    try{
        $response = new stdClass();
        $gpservice = new gateproperty();

        $res = $gpservice->GetAllProperty($request->inout);
        http_response_code(200);
        echo json_encode(array("code" => "1", "message" =>"success","data"=> json_encode($res)));
        return;
    }
    catch (Exception $ex) 
    {
        LoggerServices::errorMessage($ex);
        http_response_code(200);
        echo json_encode(array('code' => '0',"message" => $ex->getMessage()));
        return;
    }
}

function manual_entry1($request){
    try
    {
        $response = new stdClass();
        $sessiondata = decode_token($request->token);

        $gpservice = new gateproperty();
        $veservice = new VehicleEntry();
        $vmservice = new VehicleMst();
        $season = new season();
        $remark = new remark();
        $rek  = new stdClass();

        $VehicleEntryId = 0;
        if(strlen($request->vehicleno) >= 5){
            $inTime = new DateTime($request->savedtime);
            $InFrontCameraId = 0;

            $vehicleMst = null;
            $duplicateIn = null;
            $entry1Remarks = null;
            $GateProperty = null;
            $vehicleEntry = null;

            $GateProperty = $gpservice->GetGatePropertyByProperty($request->propertyid, 1);
            if ($request->propertyid == 0)
            {
                $request->propertyid = $GateProperty ? $GateProperty->PropertyId : 0;
            }
            $vehiclemst = $vmservice->GetVehicleMstByVehicleNo(trim($request->vehicleno));

            if(!$vehicleMst){
                $vehicleMst = new stdClass();
                $vehicleMst->VehicleNo = trim($request->vehicleno);
                $vehicleMst->FirstImageBack = null;
                $vehicleMst->FirstImageFront = null;

                $vehicleMst->VehicleCategory = $request->vehicletype;
                $vehicleMst->NewVehicle = 1;

                $vehicleMst->LastInPropertyId = $request->propertyid;
                $vehicleMst->LastInCounter = 0;
                $vehicleMst->LastOutPropertyId = 0;
                $vehicleMst->LastOutCounter = 0;
                $vehicleMst->InOutStatus = 0;
                $vehicleMst->noimage = 0;

                $vehiclemst->id = $vmservice->Insert($vehicleMst);
            }
        }

        if ($vehiclemst->id != 0)
        {
            $vehicleEntry = $veservice->GetVehicleEntryById($vehiclemst->id);
        }

        if ($vehiclemst->inoutstatus == 1)
            {
            $duplicateIn = new duplicatecheck();
            $veh = new stdClass();
            $veh->PreviousVehicleEntryId = $vehiclemst->id;
            $veh->PreviousCounter = $vehiclemst->LastInCounter;
            $veh->NewPropertyId = $request->propertyid;
            $veh->NewCounter = 0;
            $veh->Checked = 0;
            $duplicateIn->insert($veh);

            
            
            $date = new DateTime();
            $date = $date->format('Y-m-d H:i:s');
            $rek->Remark = "No out found. Re entered @ " + $date;
            $rek->Display = 0;
        }

        $vehiclemst->LastInPropertyId = $request->propertyid;
        $vehiclemst->LastInCounter = 0;
        $vehiclemst->LastOutPropertyId = 0;
        $vehiclemst->LastOutCounter = 0;
        $vehiclemst->InOutStatus = 1;

        $vi = new stdClass();
        $vi->VehicleNo = $request->vehicleno;
        $vi->InTime = $inTime->format('Y-m-d H:i:s');
        $vi->OutTime = $inTime->format('Y-m-d H:i:s');
        $vi->LocationId = $request->propertyid;
        $vi->OutLocationId = 0;
        $vi->PaidUpto = $inTime->format('Y-m-d H:i:s');
        $vi->RateId = 0;
        $vi->TotalAmount = 0;
        $vi->VehType = $request->vehicletype;

        $vi->RegularVehicleId = 1;
        $vi->VehicleStatus = 0;
        $vi->InCameraImageId = $InFrontCameraId;
        $vi->InPropertyId = $request->propertyid;
        $vi->InCounter = 0;
        $vi->OutPropertyId = 0;
        $vi->OutCounter = 0;
        $vi->SeasonRateId = 0;
        $vi->TanentId = 0;
        $vi->SeasonId = 0;
        $vi->NormalRateId = 1;
        $vi->H24 = false;
        $vi->VehicleMstId = $vehiclemst->id;
        $vi->Manualverified = true;
        $vi->PropertyId = $request->propertyid;

        $SeasonCheck = $season->CheckSeason($request->vehicleno);
        if ($SeasonCheck != null){
            $vehicleMst->VehicleCategory = $SeasonCheck->category;
            $vi->VehType = $SeasonCheck->category;
            $vi->TanentId = $SeasonCheck->tenantid;
            $vi->SeasonId = $SeasonCheck->SeasonId;

            $validSeason = $season->GetSeasonPayment($SeasonCheck->SeasonId);
            if ($validSeason != null){
                $sdate = $validSeason->validupto;
                $SeasonValidDate = $sdate->format('Y-m-d H:i:s');
                $SeasonRateId = $validSeason->seasonrateid;

                $cdate = new DateTime();
                $cdate = $cdate->format('Y-m-d H:i:s');

                if ($SeasonValidDate >= $cdate){

                    $HolderVehicle = $veservice->GetHolderVehicle($SeasonCheck->SeasonId, $request->VehicleNo);
                    if ($HolderVehicle == null){
                        $priority_vehicle = $validSeason->priorityvehicle;

                        $allowed_count = $season->GetQuota($validSeason->tenantid);

                        $TanentQuata = $allowed_count->carcount;
                        $BikeQuata = $allowed_count->bikecount;

                        $TanentVehicleCount = $veservice->GetTanentVehiclesCount($validSeason->tenantid, 1);
                        $TanentBikeCount = $veservice->GetTanentVehiclesCount($validSeason->tenantid, 2);

                        if ($priority_vehicle == 1)
                        {
                            $vi->SeasonRateId = 1;
                            $vi->NormalRateId = 0;
                            $vi->H24 = true;
                        } else if ($vehiclemst->VehicleCategory == 2 && $priority_vehicle == 0)
                        {
                            if ($BikeQuata > $TanentBikeCount)
                            {
                                $vi->SeasonRateId = 1;
                                $vi->NormalRateId = 0;

                                if ($SeasonRateId == 1 || $SeasonRateId == 2 || $SeasonRateId == 3 || $SeasonRateId == 4 || $SeasonRateId == 5)
                                {
                                    $vi->H24 = true;
                                }
                                else
                                {
                                    $vi->H24 = false;
                                }
                            }
                            else
                            {
                                $rek->Remark = "Tenant Bike Quota Exceeded";
                                $rek->Display = 1;
                            }
                        }else if (($vehiclemst->VehicleCategory == 0 || $vehiclemst->VehicleCategory == 1) && $priority_vehicle == 0)
                        {
                            if ($TanentQuata > $TanentVehicleCount)
                            {
                                $vi->SeasonRateId = 1;
                                $vi->NormalRateId = 0;

                                if ($SeasonRateId == 1 || $SeasonRateId == 2 || $SeasonRateId == 3 || $SeasonRateId == 4 || $SeasonRateId == 5)
                                {
                                    $vi->H24 = true;
                                }
                                else
                                {
                                    $vi->H24 = false;
                                }
                            }
                            else
                            {
                                $rek->Remark = "Tenant Vehicle Quata Exceded";
                                $rek->Display = 1;
                            }
                        }else
                        {
                            $rek->Remark = "Allready Vehicle No - " . $HolderVehicle->VehicleNo . " Entered";
                            $rek->Display = 1;
                        }

                    }else
                    {
                        $rek->Remark = "Season Expired";
                        $rek->Display = 1;
                    }

                }

            }
            

            

        }

        $VehicleEntryId = $veservice->insert($vi);

        $vehicleMst->LastVehicleEntryId = $VehicleEntryId;
        $vmservice->update($vehicleMst);

        if ($entry1Remarks != null)
        {
                $rek->VehicleEntryId = $VehicleEntryId;
                $remark->Insert($rek);
        }

        // tbInMisMatches InMisMatches = inMismatchesServices.GetInMismatchesById(vehicleImage.VehicleEntryId);
        // if (InMisMatches != null)
        // {
        //     InMisMatches.Corrected = 1;
        //     inMismatchesServices.Update(InMisMatches);
        // }

        $ret = $veservice->UpdateVehicleType($request->vehicletype, $VehicleEntryId);

        if($ret){
            
            http_response_code(200);
            echo json_encode(array("code" => "1", "message" =>"success"));
            return;
        }else{
            http_response_code(200);
            echo json_encode(array("code" => "0", "message" =>"failed"));
            return;
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


function manual_entry($request){
    try
    {
        $response = new stdClass();
        $sessiondata = decode_token($request->token);

        $veservice = new VehicleEntry();

        $intime = new DateTime($request->savedtime);
        $intime = $intime->format('Y-m-d H:i:s');


        $ret = $veservice->insert_incam($request->vehicleno, 1, 0,"",$request->propertyid,"SEDAN", $intime);
        if($ret){
            
            http_response_code(200);
            echo json_encode(array("code" => "1", "message" =>"success"));
            return;
        }else{
            http_response_code(200);
            echo json_encode(array("code" => "0", "message" =>"failed"));
            return;
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

function change_password($request){
    try
    {
        $response = new stdClass();
        $sessiondata = decode_token($request->token);

        $user = new user();

        $res = $user->changepassword($sessiondata->userid, $request->currentpassword, $request->newpassword);
        if($res > 0){
            http_response_code(200);
            echo json_encode(array("code" => "1", "message" =>"success"));
            return;
        }else{
            http_response_code(200);
            echo json_encode(array("code" => "0", "message" =>"failed"));
            return;
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

function get_collection($request){
    try
    {
        $response = new stdClass();
        $sessiondata = decode_token($request->token);

        $pm = new PaymentMst();

        $res = $pm->GetUserCollection($sessiondata->userid);
        if($res){
            http_response_code(200);
            echo json_encode(array("code" => "1", "message" =>"success", "data"=>$res));
            return;
        }else{
            http_response_code(200);
            echo json_encode(array("code" => "0", "message" =>"failed"));
            return;
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

function settle_collection($request){
    try
    {
        $response = new stdClass();
        $sessiondata = decode_token($request->token);

        $pm = new PaymentMst();

        $res = $pm->SettleAmount($sessiondata->userid);
        if($res == 1){
            http_response_code(200);
            echo json_encode(array("code" => "1", "message" =>"success"));
            return;
        }else{
            http_response_code(200);
            echo json_encode(array("code" => "0", "message" =>"failed"));
            return;
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