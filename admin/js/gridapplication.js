

$(document).ready(function(){
    document.getElementById("fromdate").valueAsDate = new Date();
    document.getElementById("todate").valueAsDate = new Date();

    // loadsuppliers();
    cmbprovince();
   loadjobcategory();
   searchdfunc();
    
   $('#filenic').prop('disabled',true);
   $('#filebirthfront').prop('disabled',true);
   $('#filebirthback').prop('disabled',true);
   $('#fileol').prop('disabled',true);
   $('#fileolre').prop('disabled',true);
   $('#fileal').prop('disabled',true);
   $('#filedegree').prop('disabled',true);
   $('#filepolice').prop('disabled',true);
   $('#filearam').prop('disabled',true);

     });
    
        
function loadjobcategory(){
    var job = "jobcategory";
         $.ajax({  
                url:"pages/application.php",  
                method:"POST", 
                data: {job:job},  
                success:function(respond){ 
                $data = $.parseJSON(respond); 
                 
                  if($data=="")
                {
                   $.confirm({
    title: 'Error',
    content: 'Data not available !!',
    type: 'Red',
    buttons: {   
        ok: {
            text: "ok!",
            btnClass: 'btn-primary',
            keys: ['enter'],
            action: function(){

              
            }
        },
        
    }
});
                }
                else
                {
                 
                    
                  $("#cmbjobcategory").empty();
            
                $(' #cmbjobcategory').append('<option value="0">All</option>');
             $.each ($data, function (value,key) {
               
                 $(' #cmbjobcategory').append('<option value='+key.id+'>'+key.post_in_english+'</option>');
             });
                  
              
                }
                
            
                
                    
                }  
           }); 
}


function cmbprovince(){
  var provincename = "provincename";
       $.ajax({  
              url:"pages/application.php",  
              method:"POST", 
              data: {provincename:provincename},  
              success:function(respond){ 
              $data = $.parseJSON(respond); 
               
                if($data=="")
              {
                 $.confirm({
  title: 'Error',
  content: 'Data not available !!',
  type: 'Red',
  buttons: {   
      ok: {
          text: "ok!",
          btnClass: 'btn-primary',
          keys: ['enter'],
          action: function(){

            
          }
      },
      
  }
});
              }
              else
              {
               
                  
                $("#cmbprovince").empty();
          
              $(' #cmbprovince').append('<option value="0">All</option>');
           $.each ($data, function (value,key) {
             
               $(' #cmbprovince').append('<option value='+key.id+'>'+key.province_in_english+'</option>');
           });
                
            
              }
              
          
              
                  
              }  
         }); 
}

// $("#cmbjobcategory").change(function () {
//     loadsuppliers();
// });

// function loadsuppliers(){
//     var loadgasset="load";  
//     var jobcategory=$("#cmbjobcategory").val();
//     // jobcategory:jobcategory
//     $.ajax({
//     type:"POST",
//     url:"pages/application.php",
//     data:{loadgasset:loadgasset,jobcategory:jobcategory},
    
//     success: function(response){
    
       
//         $sdata = $.parseJSON(response);
    
//         $("#suptblbody").empty();
    
//         $.each ($sdata, function (value,key) {
            
//      var name=key.name;
//      var newname=(name.replace(/\"/g, ""));
//      var nic=key.nic;
//      var newnic=(nic.replace(/\"/g, ""));
//      var date=key.createddate;
//      var subdate = date.substring(0, 10);
   
//      var id=key.id;
//      var newid=(id.replace(/\"/g, ""));

//             $('#applicationtable').append('<tr><td style="display: none">'+key.id+'</td><td>'+newname+'</td><td>'+newnic+'</td><td>'+subdate+'</td><td>'+key.post_in_english+'</td><td><button id='+key.id+' class="btnapplicationEdit"><i class="fa fa-eye" aria-hidden="true"></i></button></td></tr>');
//         });                                                                                                                                                                                                                                                                              
//         },
//         failure: function (response) {
//             alert(response);
//         },
    
    
//     });
    
//     }


    $('#btnsearch').on('click', function(){
 
        searchdfunc();
        
        });
        
        
        function searchdfunc(){
           
            var search="search";
        
            var fromdate =$('#fromdate').val();
            var todate =$('#todate').val();
            var jobcategory=$("#cmbjobcategory").val();
            var nic=$("#nic").val();
            var province=$("#cmbprovince").val();
        
        
                $.ajax({
        
                    method:'POST',
                    url:"pages/application.php", 
                    data:{search:search,fromdate:fromdate,todate:todate,jobcategory:jobcategory,nic:nic,province:province},
                    success:function(response){
        
                        $data= $.parseJSON(response);
                        // console.log(response);
                        // var application=$.parseJSON(response);
                        //  var app = $.parseJSON($data[0].application);
        $("#suptblbody").empty();
    
        $.each ($data, function (value,key) {
     var name=key.name;
     var newname=(name.replace(/\"/g, ""));
     var nic=key.nic;
     var newnic=(nic.replace(/\"/g, ""));
     var date=key.createddate;
     var subdate = date.substring(0, 10);
     var id=key.id;
     var newid=(id.replace(/\"/g, ""));

            $('#applicationtable').append('<tr><td>'+key.id+'</td><td>'+newname+'</td><td>'+newnic+'</td><td>'+subdate+'</td><td>'+key.post_in_english+'</td><td>'+key.province_in_english+'</td><td><button id='+key.id+' class="btnapplicationEdit"><i class="fa fa-eye" aria-hidden="true"></i></button></td><td><button id='+key.id+' class="btnapplicationview"><i class="fa fa-file" aria-hidden="true"></i></button></td></tr>');
             
            var totalRowCount = 0;
                     var rowCount = 0;
                     var table = document.getElementById("applicationtable");
                     var rows = table.getElementsByTagName("tr")
                     for (var i = 0; i < rows.length; i++) {
                     totalRowCount++;
                     if (rows[i].getElementsByTagName("td").length > 0) {
                     rowCount++;
                      }
                     }
                    $("#count").text(rowCount);
                    
                         });
                        
                         },
                         failure:function(error){
             
                         }
                        
                     });
                     
    
                    }
        
                    $("#dealermodal").on('click','#closeModel', function () {

                        location.reload();
                    
                    
                        })

    $("#applicationtable").on('click','.btnapplicationEdit', function () {
        var rowId = $(this).attr('id');
        window.open("?page=application&lang=en&id="+rowId);
 
    });

   
$("#applicationtable").on('click','.btnapplicationview', function () {
    var rowId = $(this).attr('id');
    $('#modelWindow').modal('show');
    $("#rowid").val(rowId);

    $.ajax({
          
        type:"POST",
        url:"pages/application.php",
        data:{rowId:rowId},
        success:function(response){
          
          var data= $.parseJSON(response);
          console.log(response);

          var nic= data[0].nic;
        //   var subdate = nic.substring(11, 19);
          $("#filenic").val(nic);
          if(nic!=null){
            $('#filenic').prop('disabled',false);
          }

          var birthfront=data[0].birthfront;
          $("#filebirthfront").val(birthfront);
          if(birthfront!=null){
            $('#filebirthfront').prop('disabled',false);
          }
          
          var birthback=data[0].birthback;
          $("#filebirthback").val(birthback);
          if(filebirthback!=null){
            $('#filebirthback').prop('disabled',false);
          }
          
          var ol=data[0].ol;
          $("#fileol").val(ol);
          if(ol!=null){
            $('#fileol').prop('disabled',false);
          }
          
          var olrec=data[0].olrec;
          $("#fileolre").val(olrec);
          if(olrec!=null){
            $('#fileolre').prop('disabled',false);
          }

          var al=data[0].al;
          $("#fileal").val(al);
          if(al!=null){
            $('#fileal').prop('disabled',false);
          }
          
          var degree=data[0].degree;
          $("#filedegree").val(degree);
          if(degree!=null){
            $('#filedegree').prop('disabled',false);
          }

          var police=data[0].police;

          $("#filepolice").val(police);
          if(police!=null){
            $('#filepolice').prop('disabled',false);
          }
          

          var asd=data[0].asd;
          $("#filearam").val(asd);
          if(asd!=null){
            $('#filearam').prop('disabled',false);
          }
       
      
    
          },failure:function(response){
    
              alert(response);
          }
        });
    
    
    
 });


 
 $('#filenic').on('click', function(){
   var rowId=$("#rowid").val();
   var nicval=$("#filenic").val();


      var link = document.createElement('a');
      var string_url = "../uploads/"+rowId+"/" +nicval+"";
      window.open(string_url);
      link.dispatchEvent(new MouseEvent('click'));

  });


  $('#filebirthfront').on('click', function(){
    var rowId=$("#rowid").val();
    var birthfrontval=$("#filebirthfront").val();

       
       var link = document.createElement('a');
       var string_url = "../uploads/"+rowId+"/" +birthfrontval+"";
       window.open(string_url);
       link.dispatchEvent(new MouseEvent('click'));
   
   });

   $('#filebirthback').on('click', function(){
    var rowId=$("#rowid").val();
    var filebirthbackval=$("#filebirthback").val();

       
       var link = document.createElement('a');
       var string_url = "../uploads/"+rowId+"/" +filebirthbackval+"";
       window.open(string_url);
       link.dispatchEvent(new MouseEvent('click'));
   
   });

   $('#fileol').on('click', function(){
    var rowId=$("#rowid").val();
    var fileolval=$("#fileol").val();

       
       var link = document.createElement('a');
       var string_url = "../uploads/"+rowId+"/" +fileolval+"";
       window.open(string_url);
       link.dispatchEvent(new MouseEvent('click'));
   
   });

   $('#fileolre').on('click', function(){
    var rowId=$("#rowid").val();
    var fileolreval=$("#fileolre").val();

       
       var link = document.createElement('a');
       var string_url = "../uploads/"+rowId+"/" +fileolreval+"";
       window.open(string_url);
       link.dispatchEvent(new MouseEvent('click'));
   
   });

   $('#fileal').on('click', function(){
    var rowId=$("#rowid").val();
    var filealval=$("#fileal").val();

       
       var link = document.createElement('a');
       var string_url = "../uploads/"+rowId+"/" +filealval+"";
       window.open(string_url);
       link.dispatchEvent(new MouseEvent('click'));
   
   });

   $('#filedegree').on('click', function(){
    var rowId=$("#rowid").val();
    var filedegreeval=$("#filedegree").val();

       
       var link = document.createElement('a');
       var string_url = "../uploads/"+rowId+"/" +filedegreeval+"";
       window.open(string_url);
       link.dispatchEvent(new MouseEvent('click'));
   
   });

  
   $('#filepolice').on('click', function(){
    var rowId=$("#rowid").val();
    var filepoliceval=$("#filepolice").val();

       
       var link = document.createElement('a');
       var string_url = "../uploads/"+rowId+"/" +filepoliceval+"";
       window.open(string_url);
       link.dispatchEvent(new MouseEvent('click'));
   
   });


   $('#filearam').on('click', function(){
    var rowId=$("#rowid").val();
    var filearamval=$("#filearam").val();

       
       var link = document.createElement('a');
       var string_url = "../uploads/"+rowId+"/" +filearamval+"";
       window.open(string_url);
       link.dispatchEvent(new MouseEvent('click'));
   
   });


   


    