// var fromdate=flatpickr('#txtdate')
$( document ).ready(function() {


    var jQueryScript = document.createElement('script');  
    jQueryScript.setAttribute('src','https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js');
    document.head.appendChild(jQueryScript);
     page();
    // var fromdate=flatpickr('#txtdate')
    // }
    // var todate=flatpickr('#txtdate2')
   
   // var   selectYear1=$("#dyear").val()


//     var i, currentYear, startYear, endYear, newOption, dropdownYear;
// dropdownYear = document.getElementById("txtyear");
// // dropdownYearload = document.getElementById("dyear");
// currentYear = (new Date()).getFullYear();
// startYear = currentYear - 4;
// endYear = currentYear + 3;

// for (i=startYear;i<=endYear;i++) {
//   newOption = document.createElement("option");
//   newOption.value = i;
//   newOption.label = i;
// 	if (i == currentYear) {
// 		newOption.selected = true;
// 	}
//   dropdownYear.appendChild(newOption);
// //   dropdownYearload.appendChild(newOption);
// }

var i, currentYear, startYear, endYear, newOption, dropdownYear;
dropdownYear1 = document.getElementById("dyear");
// dropdownYearload = document.getElementById("dyear");
currentYear = (new Date()).getFullYear();
startYear = currentYear - 4;
endYear = currentYear + 3;

for (i=startYear;i<=endYear;i++) {
  newOption = document.createElement("option");
  newOption.value = i;
  newOption.label = i;
	if (i == currentYear) {
		newOption.selected = true;
	}
  dropdownYear1.appendChild(newOption);
//   dropdownYearload.appendChild(newOption);
}

// //var   selectYear1=document.getElementById("dyear").value;
// $("#txtyear").val(new Date().getYear());

var select = document.getElementById('dyear');
var value = select.value;
loadgrid(value);


    
});

function page(){
    var fromdate=flatpickr('#txtdate')
    }

$('#btnAdd').on('click', function(){
 
    var Id = $("#FreeOutId").val();
    var Year = $("#txtyear").val();
    var Descrption = $("#txtdescription").val();
    var Date = $('#txtdate').val();
   
                    $.ajax({
                        
                         url:"pages/frmholiday.php",
                         method:"POST", 
                        data: {'request':'insert',Id:Id,Year:Year,Descrption:Descrption,Date:Date},
                       
                        success: function (response) {
                            // var myData = JSON.parse(response.d)
                            // TenantArray = myData;
                         
    
                            $data=$.parseJSON(response);
                            
                            // var myData = JSON.parse(response.d);
                            if ($data =="1") {
                                // alert('Success')
                                swal("Success!", "Successfully added!", "success");
                                reloadPage();
                                // ClearAll();
                                // filter();
                                
                            } else {
                                //alert('Canceled');
                                swal("Error!", "Date already exit!", "error");
                            }
                            
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                
             });


            //  function loadgrid() {
                // var date1 = document.getElementById("txtdate1").value;
                // var date2 = document.getElementById("txtdate2").value;
                // var time1 = document.getElementById("txttime1").value;
                // var time2 = document.getElementById("txttime2").value;
   
                // var datetime1 = date1 + ' ' + time1;
                // var datetime2 = date2 + ' ' + time2;
   
                // $('#tbfreetbody').empty();
            //     $.ajax({
            //         type: 'POST',
            //         url: 'pages/freeout.php',
            //         data: {'request':'select',datetime1:datetime1,datetime2:datetime2},
                    
            //         success: function (response) {

            //             $data=$.parseJSON(response);
            //             if ($data !="")
            //             {
            //             $.each ($data, function (value,key){
                           
            //                 $('#tbfree').append('<tr><td style="text-align:center;">'+key.vehicleno+'</td></td><td style="text-align:center;">'+key.category+'</td><td style="text-align:center;">'+key.indate+'</td><td style="text-align:center;">'+key.intime+'</td><td style="text-align:center;">'+key.outdate+'</td><td style="text-align:center;">'+key.outtime+'</td><td style="text-align:center;">'+key.date1+'</td><td style="text-align:center;">'+key.time+'</td><td style="text-align:center;">'+key.name+'</td><td style="text-align:center;">'+key.remark+'</td></tr>');
                       
            //                 // $("#tbfreetbody").remove();
            //                 // $('#VehicleBody').empty();
                        
            //             });


            //             }
            //             else{
            //                 // sweetAlert('Canceled', "Data Not Found", 'error');
            //                 alert("data not found");
            //             }
                       
                        
            //         },
            //         error: function (error) {
            //             console.log(error);
            //         }
            //     });
            // }

            function loadgrid(value) {
            var   value=$("#dyear").val();
//                 var select = document.getElementById('dyear');
// var value = select.value;
                // var select = $("#dyear").val();
                // var selectYear = select.value;

            //  alert(selectYear);
             $("#holiday").empty();

                $.ajax({
                    url:"pages/frmholiday.php",
                    method:"POST", 
                   data: {'request':'select',selectYear:value},
                   success: function (response) {
                   
                    $data=$.parseJSON(response);
                    if ($data !="")
                    {
                    $.each ($data, function (value,key){
                       
                        $('#holidaygrid').append('<tr><td style="text-align:center;display:none;">'+key.id+'</td><td style="text-align:center;">'+key.year1+'</td></td><td style="text-align:center;">'+key.holidaytype+'</td><td style="text-align:center;">'+key.date1+'</td><td style="text-align:center;"><button type="button" class="btnsupplierdelete" id='+key.id+'><i class="fa fa-trash" aria-hidden="true"></i></button</td></tr>');
                   //<td style="text-align:center;"><button type="button" id='+key.id+' class="btnsupplierEdit"  style=""><i class="fas fa-edit" aria-hidden="true"></i></button></td>
                        // $("#tbfreetbody").remove();
                        // $('#VehicleBody').empty();
                    
                    });


                    }
                    else{
                        // sweetAlert('Canceled', "Data Not Found", 'error');
                        alert("data not found");
                    }
                   
                    
                },
                    error: function (error) {
                        console.log(error);
                    }
                });

            }
            $("#dyear").change(function(){
                loadgrid();

            });



            $(document).on('click','.btnsupplierEdit', function(){
               
                // $("table > tbody > tr").each(function () {
                // var idholi = ($(this).find('td').eq(0).text());
                var idholi = $(this).attr('id');
                //  });
    
                $.ajax({
                    url:"pages/frmholiday.php",
                    method:"POST", 
                   data: {'request':'edit',idholi:idholi},
                    
                    success: function (response) {
    
                        $data=$.parseJSON(response)
                        $.each ($data, function (value,key){
                            var year1 = key.year1;
                            var holidaytype=key.holidaytype;
                            var date1=key.date1;
                            var id=key.id;
                        //    alert("done");
                        // var date = new Date( $data[0]["Date1"]);
    
                        // var day = ("0" + date.getDate()).slice(-2);
                        // var month = ("0" + (date.getMonth() + 1)).slice(-2);
                        // var datedtl = date.getFullYear() + "-" + (month) + "-" + (day);
                        $('#FreeOutId').val(id);
                        $('#txtyear').val(year1);
                        $('#txtdescription').val(holidaytype);
                        $('#txtdate').val(date1);
                        });
                        
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            // });
    
            });
    

//             $("#btnUpdate").click(function () {
//                 var updateId = $("#FreeOutId").val();
//     var Year = $("#txtyear").val();
//     var Descrption = $("#txtdescription").val();
//     var Date = $('#txtdate').val();

//     $.ajax({
                        
//         url:"pages/frmholiday.php",
//         method:"POST", 
//        data: {'request':'update',updateId:updateId,Year:Year,Descrption:Descrption,Date:Date},
      
//        success: function (response) {
//            // var myData = JSON.parse(response.d)
//            // TenantArray = myData;
        

//            $data=$.parseJSON(response);
           
//            // var myData = JSON.parse(response.d);
//            if ($data =="1"){
//                alert("Successfully Updated!");
//                reloadPage();
//             // var now = new Date();
//             // var day = ("0" + now.getDate()).slice(-2);
//             // var month = ("0" + (now.getMonth() + 1)).slice(-2);
//             // var today = now.getFullYear() + "-" + (month) + "-" + (day);
//             // $('#txtdate').val(today);
//             //    loadgrid();
//         //    $("#FreeOutId").val("");
//         //     $("#txtyear").val("");
//         //      $("#txtdescription").val("");
//         //      $('#txtdate').val("");
//         //      var fromdate=flatpickr('#txtdate')
//                // swal("Success!", "Successfully insert!", "success");
//             //    ClearAll();
//                // filter();
               
//            } else {
//                alert('Canceled');
//            }
           
//        },
//        error: function (error) {
//            console.log(error);
//        }
//    });
//             });



            // $("#btnedit").click(function() {
                // clear();   
            //  $('#btnedit').on('click', function(){
                // loadedit();
            // });
            
            // function loadedit() {
                //  $('#holidaygrid').on('click', '.btn btn-info', function () {

                    // var idholiid = $(this).closest("tr").attr('id');

    
                // $("#btnAdd").attr('disabled', 'disabled');
                // $("#btnSave").removeAttr('disabled');
                // $("#btnCancel").removeAttr('disabled');
                // $("#btnSave").attr('disabled', 'disabled');
                // $("#btnUpdate").removeAttr('disabled');
                // $("#btnExit").attr('disabled', 'disabled');
    
                //get data from server for given ID
                // var idholiid = $(this).closest("tr").attr('id');
                // $.ajax({
                //     url:"pages/frmholiday.php",
                //     method:"POST", 
                //    data: {'request':'edit',idholiid:idholiid},
                //    success: function (response) {
                   
                //     $data=$.parseJSON(response);
    
                        // // var myData = JSON.parse(response.d)
                        // var date = new Date($data[0]["Date1"]);
    
                        // var day = ("0" + date.getDate()).slice(-2);
                        // var month = ("0" + (date.getMonth() + 1)).slice(-2);
                        // var datedtl = date.getFullYear() + "-" + (month) + "-" + (day);
    
                        // $('#txtyear').val($data[0]["Year1"]);
                        // $('#txtdesc').val($data[0]["HolidayType"]);
                        // $('#TxtDate').val(datedtl);
            //         },
            //         error: function (error) {
            //             console.log(error);
            //         }
            //     });
    
            // });

            $(document).on("click", ".btnsupplierdelete", function () { //new
                var idholi = $(this).attr('id');
               // var holiday = $(this).attr('date1');
               var holiday = $(this).closest("tr").find('td:eq(3)').text();
                        var now = new Date();
                           var day = ("0" + now.getDate()).slice(-2);
                           var month = ("0" + (now.getMonth() + 1)).slice(-2);
                           var today = now.getFullYear() + "-" + (month) + "-" + (day);
//var today =new Date().format('YYYY-MM-DD');

                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: true,
                    showCancelButton: true,
                    confirmButtonColor: '#30E482',
                    confirmButtonText: 'Yes',
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                },
                    function () {
                    $.ajax({
                        url:"pages/frmholiday.php",
                        method:"POST", 
                        data: {'request':'delete',idholi:idholi,holiday:holiday,today:today},
                        success: function (response) {
                            $data=$.parseJSON(response);
                            if ($data =="1"){
                                swal('Success', 'Successfully deleted','success');
                                reloadPage();
                                // view();
                                
                            } else {
                                swal('Canceled', "Can't Delete", 'error');
                            }
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });
            });
    
            $("#btnCancel").click(function () 
            {
                reloadPage();
            });
            function reloadPage() {
                window.location.reload()
            }

        
    
        