$(document).ready(function (){
  
  let params = (new URL(document.location)).searchParams;
  let rowId = params.get("id");

  $.ajax({
          
    type:"POST",
    url:"pages/application.php",
    data:{id:rowId},
    success:function(response){
      
      $data= $.parseJSON(response);
      console.log(response);
      var application=$.parseJSON(response);
      var app = $.parseJSON($data[0].application);

      var id=application[0].id;
          var name=app["fullnameinenglish"];
          var fullname=app["fullname"];
          var nic=app["nic"];
          var dob=app["dob"];
          var nameintial=app["namewithinitials"];
          // var age=app["age"];
          var namewithintial=app["namewithinitialsinenglish"];
          var age=app["ageyear"];
          var gender=app["gender"] ;
          if (gender==1){
            gender='male';
          }
          else{
            gender='female';
          }

          var blood=application[0].bloodgroup_in_english ;
          var region= application[0].religion_in_english;
          var placeofbirth=app["placeofbirth"] ;
          var provinceplaceofbirth=application[0].birthprovince;
          var districtplaceofbirth=application[0].birthdistrict;

          var divsecplaceofbirth=application[0].birthdivision;
          var nationality=application[0].nationality_in_english;
          var descentorregister=app["deorreg"];
          if (descentorregister==1){
            descentorregister='Descend';
          }
          else{
            descentorregister='Registration';
          }

           var regcertificateno=app["regcertificateno"];
           var fathersname=app["fathersname"];
           var permanentadderineng=app["permanentadderineng"];
          var permanentadderpostalno=app["permanentadderpostalno"];
          var permanentaddergnd=application[0].gnd_in_english;
          var cmbpermanentadderprovince=application[0].addressprovince;
          var cmbpermanentadderdistrict=application[0].addressdistrict;
          var addressdivisionsec=application[0].addressdivision;
          var division=application[0].permanent;
          var police=application[0].permanentpolice;
          
           //var permanentadderpolice=;
           var presentadder=app["presentadderineng"];
           var presentprovince=application[0].presentpro;
           var presentdistrict=application[0].presentdistrict;
           var presentdivision=application[0].present;
          var presentadderpolice=application[0].presentpolice;
           var mailingadder=app["mailingadderineng"];
          var contactres=app["contactresi"];
          var contactprivate=app["contactprivate"];
          var contactwhatsapp=app["contactwhatsapp"];
           var emailadder=app["emailadder"];
          var heightinfeet=app["heightinfeet"];
           var heightininches=app["heightininches"];
          var heightincm=app["heightincm"];

           var chestininches=app["chestininches"];
           
           var yearol=app["yearol"];
           var indexnool=app["indexnool"];
           var schoolol=app["schoolol"];
           var mediumol=app["cmbMediumol"];
           if (mediumol==1) {
            mediumol='English';
          } else if (mediumol==2) {
          mediumol='Sinhala';
          }
          else if(mediumolr==0){
            mediumolr='';
          }
         else {
          mediumol='Tamil';
         }
          //  if(mediumol='1'){
          //    mediumol='English';
          //  }
          //  else if(mediumol='2'){
          //    mediumol='Sinhala';
          //  }
          //  else{
          //    mediumol='Tamil';
          //  }
          //  var cmbSubjectol=app["ollist"];
          // var gradeol=;
            const ollist=app["ollist"];
            $sdata = $.parseJSON(ollist);
            $("#tblol").empty();
    
        $.each ($sdata, function (value,key) {


            var id=key[0];
            var subject=key[1]; 
            var grade=key[2];

            $('#tbol').append('<tr><td>'+id+'</td><td>'+subject+'</td><td>'+grade+'</td></td></tr>');

});                                                                                                                                                                                                                                                                              
        



           var yearolr=app["yearolr"];
           var indexnoolr=app["indexnoolr"];
          var schoololr=app["schoololr"];
           var mediumolr=app["cmbMediumolr"];
           if (mediumolr==1) {
            mediumolr='English';
          } else if (mediumolr==2) {
          mediumolr='Sinhala';
         }
         else if(mediumolr==0){
          mediumolr='';
         } else {
          mediumolr='Tamil';
         }


         const olr=app["olrlist"]
         $sdata = $.parseJSON(olr);
            $("#tblolr").empty();
    
        $.each ($sdata, function (value,key) {


            var id=key[0];
            var subject=key[1]; 
            var grade=key[2];

            $('#tolr').append('<tr><td>'+id+'</td><td>'+subject+'</td><td>'+grade+'</td></td></tr>');

}); 
          // var cmbSubjectolr=;
          // var gradeolr=;
          // var olrlist=;
           var yearal=app["yearal"];
          var indexnoal=app["indexnoal"];
           var schoolal=app["schoolal"];
           var mediumal=app["cmbMediumal"];
           if (mediumal==1) {
            mediumal='English';
          } else if (mediumal==2) {
            mediumal='Sinhala';
         }
         else if(mediumal==0){
          mediumal='';
         } else {
          mediumal='Tamil';
         }
         var zscoreal=app["zscoreal"];
           const al=app["allist"];
           $sdata = $.parseJSON(al);
           $("#tblal").empty();
   
       $.each ($sdata, function (value,key) {


           var id=key[0];
           var subject=key[1]; 
           var grade=key[2];

           $('#tbal').append('<tr><td>'+id+'</td><td>'+subject+'</td><td>'+grade+'</td></td></tr>');

}); 
          // var cmbSubjectal=;
          // var cmbGradeal=;
          // var allist=;
          var completedegree=app["completeddegree"];
          if(completedegree=='on'){
            completedegree='Yes';
          }
          else{
            completedegree='No'
          }

          var followingdegree=app['followingdegree']
          if(followingdegree=='on'){
            followingdegree='Yes';
          }
          else{
            followingdegree='No'
          }
           var marialstatus=application[0].status_in_english;
          //  if(marialstatus==null){
          //    marialstatus='Not mentioned';
          //  }
           var currentoccupation=app["currentoccupation"];
          // var armedservicemember=;
          // var servedinslpolice=;
          // var cmbrank=;
           var regimentalno=app["regimentalno"];
          var reasonforleaving=app["reasonforleaving"];
          // var nicform=app.push("nic_path");
          // that.value = nicform;
          // var servedinarmedservice=app[""];
          // var volunteerarmedservicemember=;
          // var servedvolunteerarmedservice=;
          // var offencearrested=;
          // var offencecharged=;
          // var offencedetail=;
          // var offencearrestedrelative=;
          // var offencechargedrelative=;
          // var offencedetailrelative=;


          
          
          // var newname=(name.replace(/\"/g, ""));
          // var newage=(age.replace(/\"/g, ""));
          // var newnic=(nic.replace(/\"/g, ""));
          id
          $('#id').text(id);
          $('#fullname').text(fullname);
          $('#fullnameinenglish').text(name);
          
          $('#nic').text(nic);
          $('#age').text(age);
          $('#namewithinitials').text(nameintial);
          $('#namewithinitialsinenglish').text(namewithintial);
          $('#dob').text(dob);

          $('#gender').text(gender);
          $('#cmbblood').text(blood);
          $('#cmbreligion').text(region);
          $('#placeofbirth').text(placeofbirth);
          $('#provinceplaceofbirth').text(provinceplaceofbirth);
          $('#districtplaceofbirth').text(districtplaceofbirth);
          $('#divsecplaceofbirth').text(divsecplaceofbirth);
          $('#nationality').text(nationality);
          $('#descentorregister').text(descentorregister);
          $('#regcertificateno').text(regcertificateno);
          $('#fathersname').text(fathersname);
          $('#permanentadderineng').text(permanentadderineng);
          $('#permanentadderpostalno').text(permanentadderpostalno);
          $('#cmbpermanentadderprovince').text(cmbpermanentadderprovince);
          $('#cmbpermanentadderdistrict').text(cmbpermanentadderdistrict);
          $('#cmbpermanentadderdivsec').text(addressdivisionsec);
          
          $('#cmbpermanentaddergnd').text(permanentaddergnd);
          $('#cmbpermanentadderdivision').text(division);
        
          $('#permanentadderpolice').text(police);
          $('#presentadder').text(presentadder);
          $('#presentadderprovince').text(presentprovince);
          $('#presentadderdistrict').text(presentdistrict);
          $('#presentadderdivision').text(presentdivision);
          
          
          $('#presentadderpolice').text(presentadderpolice);
          $('#mailingadder').text(mailingadder);
          $('#contactresi').text(contactres);
          $('#contactprivate').text(contactprivate);
          $('#contactwhatsapp').text(contactwhatsapp);
          $('#emailadder').text(emailadder);
          $('#heightinfeet').text(heightinfeet);
          $('#heightininches').text(heightininches);
          $('#heightincm').text(heightincm);
          $('#chestininches').text(chestininches);
          $('#yearol').text(yearol);
          $('#indexnool').text(indexnool);
          $('#schoolol').text(schoolol);
          $('#mediumol').text(mediumol);
          $('#cmbSubjectol').text();
          $('#gradeol').text();
          $('#ollist').text(ollist);
          // $('#tblol').text(cmbSubjectol);
          // $('#tblol').append('<tr><td style="display: none">'+key.id+'</td><td>'+cmbSubjectol+'</td></tr>');

          $('#yearolr').text(yearolr);
          $('#indexnoolr').text(indexnoolr);
          $('#schoololr').text(schoololr);
          $('#mediumolr').text(mediumolr);
          $('#cmbSubjectolr').text();
          $('#gradeolr').text();
          $('#olrlist').text();
          $('#yearal').text(yearal);
          $('#indexnoal').text(indexnoal);
          $('#schoolal').text(schoolal);
          $('#mediumal').text(mediumal);
          $('#zscoreal').text(zscoreal);
          $('#cmbSubjectal').text();
          $('#cmbGradeal').text();
          $('#allist').text();
          $('#completeddegree').text(completedegree);
          $('#followingdegree').text(followingdegree);
          
          
          $('#marialstatus').text(marialstatus);
          $('#currentoccupation').text(currentoccupation);
          $('#armedservicemember').text();
          $('#servedinslpolice').text();
          $('#cmbrank').text();
          $('#regimentalno').text(regimentalno);
          $('#reasonforleaving').text(reasonforleaving);
          $('#servedinarmedservice').text();
          $('#volunteerarmedservicemember').text();
          $('#servedvolunteerarmedservice').text();
          $('#offencearrested').text();
          $('#offencecharged').text();
          $('#offencedetail').text();
          $('#offencearrestedrelative').text();
          $('#offencechargedrelative').text();
          $('#offencedetailrelative').text();

  

      },failure:function(response){

          alert(response);
      }


  });

});



function btnclick(value){
  let params = (new URL(document.location)).searchParams;
  let rowId = params.get("id");
  let newvalue=value;

  var link = document.createElement('a');
  var string_url = "../uploads/"+rowId+"/" +newvalue+".*";
  window.open(string_url);
  link.dispatchEvent(new MouseEvent('click'));
}




$("#ApplicationReport").on('click', function() {
     document.getElementById('ApplicationReport').style.visibility='hidden';
     window.print();
    document.getElementById('ApplicationReport').style.visibility='visible';



    });





