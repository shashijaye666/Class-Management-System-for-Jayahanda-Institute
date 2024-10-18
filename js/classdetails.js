$(document).ready(function () {
    loadTeachers();
    loadSubjects();
    loadclassshedule();
    page();
    $("#btnListToken").css("display", "none");
    $("#btnAddVehicle").css("display", "none");
  });
  
  function page() {
    var date = flatpickr("#txtDate");
  }
  
  $("#btnUpdate").click(function () {
    var Id = $("#txtId").val();
    var Name = $("#Name").val();
    var Subject = $("#Subject").val();
    var date = $("#txtDate").val();
    var ClassTime = $("#txtToTime").val();
    var NoofHours = $("#hours").val();
    var ZoomLink = $("#link").val();
  
    // var toDate = $("#txtToDate").val();
    // var fromTime = '00:00:00';//$("#txtFromTime").val();
    // var toTime = '00:00:00';//$("#txtToTime").val();
    // var isValet = $("#chkisValet").is(":checked") == true ? 1 : 0;
    // var tokenType = $('input[name=tokenType]:checked').val();
  
    if (Name === "0") {
      alert("Please select the Name");
    } else if (Subject === "0") {
      alert("Please select the Subject");
    } else if (date === "0") {
      alert("Please enter the date");
    } else if (ClassTime === "") {
      alert("Please enter the ClassTime");
    } else if (NoofHours === "") {
      alert("Please enter the No of Hours");
    } else if (ZoomLink === "") {
      alert("Please enter the Zoom Link");
    } else {
      $.ajax({
        type: "POST",
        url: "pages/classesshedule.php",
        data: {
          request: "SavetClassSchedule",
          Id: Id,
          Name: Name,
          Subject: Subject,
          date: date,
          ClassTime: ClassTime,
          NoofHours: NoofHours,
          ZoomLink: ZoomLink,
        },
  
        success: function (response) {
          $data = $.parseJSON(response);
  
          if ($data == 1) {
            swal("Success", "Your work has been Updated", "success");
          } else if ($data > 1) {
            swal("Success", "Your work has been saved", "success");
            Cancel();
          } else {
            swal("Canceled", "Something went wrong!", "error");
          }
        },
        error: function (error) {
          console.log(error);
        },
      });
    } 
   
  });
  
  
  
  function loadclassshedule() {
      $.ajax({
        method: "POST",
        url: "pages/classesshedule.php",
        data: { request: "loadclassshedule" },
        success: function (response) {
          $data = $.parseJSON(response);
          StudentArray = $data;
          LoadTable($data);
        },
        failure: function (response) {
          alert(response);
        },
      });
    }
    
    function LoadTable(Res) {
      var tr = [];
      for (var i = 0; i < Res.length; i++) {
        tr.push('<tr id="' + Res[i].id + '">');
        tr.push("<td>" + Res[i].id + "</td>");
        tr.push("<td>" + Res[i].name + "</td>");
        tr.push("<td>" + Res[i].subjectname + "</td>");
        tr.push("<td>" + Res[i].date + "</td>");
        tr.push("<td>" + Res[i].time + "</td>");
        tr.push("<td>" + Res[i].noofhours + "</td>");
        tr.push("<td><a href='" + Res[i].zoomlink + "' target='_blank'>" + Res[i].zoomlink + "</a></td>");
   // tr.push("<td><button onclick=\"View('" +Res[i].id +'\')" class="btn btn-primary"><i class="fa fa-edit"></i> Edit </button></td>' );
        tr.push("</tr>");
      }
      $("#tbodyid").empty();
      $("#tblstudent").append($(tr.join("")));
    }
  
  function loadSubjects() {
    $.ajax({
      method: "POST",
      url: "pages/teachers.php",
      data: { request: "getsubject" },
      success: function (response) {
        $data = $.parseJSON(response);
  
        $("#Subject").empty();
        $("#Subject").append('<option value="0">Select Your Subject</option>');
  
        $.each($data, function (value, key) {
          $("#Subject").append(
            "<option value=" + key.id + ">" + key.subjectname + "</option>"
          );
        });
      },
      failure: function (response) {
        alert(response);
      },
    });
  }
  
  function loadTeachers() {
    $.ajax({
      method: "POST",
      url: "pages/classesshedule.php",
      data: { request: "loadTeachers" },
      success: function (response) {
        $data = $.parseJSON(response);
  
        $("#Name").empty();
        $("#Name").append('<option value="0">Select Your Name</option>');
  
        $.each($data, function (value, key) {
          $("#Name").append(
            "<option value=" + key.id + ">" + key.name + "</option>"
          );
        });
      },
      failure: function (response) {
        alert(response);
      },
    });
  }
  
  // $("#cmbProperty").change(function () {
  //     loadRate($(this).val(), 0);
  // });
  
  // function loadRate(propertyId, RateType) {
  
  //     $.ajax({
  //         type: 'POST',
  //         url: 'pages/complementaryevents.php',
  //         data: { 'request': 'getRate', 'propertyid': propertyId },
  
  //         success: function (response) {
  //             $data = JSON.parse(response)
  
  //             $("#cmbRate").empty();
  //             $("#cmbRate").append('<option value="0">Select</option>');
  
  //             $.each($data, function () {
  
  //                 $('#cmbRate').append($("<option/>").val(this.id).text(this.ratetype).attr('Description', this.description).attr('Amount', this.amount).attr('Hour', this.hour).attr('Mode', this.mode));
  //             });
  //             if (RateType != "0")
  //                 $("#cmbRate").val(RateType);
  //             $("#cmbRate").trigger("change");
  //         },
  //         error: function (error) {
  //             console.log(error);
  //         }
  //     });
  // }
  
  $("#cmbRate").change(function () {
    if ($(this).val() != "0") {
      $("#txtDesc").val($("option:selected", this).attr("Description"));
      if ($("option:selected", this).attr("Mode") == "1") {
        $("#txtAmount").val($("option:selected", this).attr("Hour"));
        $("#lblAmount").text("Minutes");
      } else {
        $("#txtAmount").val($("option:selected", this).attr("Amount"));
        $("#lblAmount").text("Amount");
      }
    } else {
      $("#txtDesc").val("");
      $("#txtAmount").val("");
    }
  });
  
  function formatDate(date) {
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? "pm" : "am";
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    day = day < 10 ? "0" + day : day;
    month = month < 10 ? "0" + month : month;
    var strTime = year + "-" + month + "-" + day;
    return strTime;
  }
  
  // $("#btnAdd").click(function () {
  
  //     $('#cmbProperty').removeAttr('disabled');
  //     $('#cmbRate').removeAttr('disabled');
  //     $("#txtEvent").removeAttr('disabled');
  //     $("#txtGuest").removeAttr('disabled');
  //     $("#txtFromDate").removeAttr('disabled');
  //     $("#txtToDate").removeAttr('disabled');
  
  //     $(this).attr("disabled", "disabled");
  //     $("#btnUpdate").removeAttr("disabled");
  //     $("#btnCancel").removeAttr("disabled");
  //     $('input[name=tokenType]').removeAttr("disabled");
  
  //     var todaydate = formatDate(new Date());
  //     $("#txtFromDate").val(todaydate);
  //     $("#txtToDate").val(todaydate);
  // });
  
  $("#btnCancel").click(function () {
    Cancel();
  });
  
  function Cancel() {
    $("#frmEvent").trigger("reset");
    $("#txtId").val("0");
    $("#btnListToken").css("display", "none");
    $("#btnAddVehicle").css("display", "none");
  }
  
  function loadEvent() {
    $.ajax({
      type: "POST",
      url: "pages/complementaryevents.php",
  
      data: { request: "getevent" },
  
      success: function (response) {
        $data = JSON.parse(response);
        $("#sreptblbody").empty();
  
        $.each($data, function (value, key) {
          var isvalet = key.isvalet == "t" ? "Valet" : "Common";
  
          $("#eventgrid").append(
            '<tr><td style="display:none;">' +
              key.id +
              "</td><td>" +
              key.propertyname +
              "</td><td>" +
              key.eventname +
              "</td><td>" +
              key.ratetype +
              "</td><td>" +
              key.noofguests +
              "</td><td>" +
              key.fromdate +
              "</td><td>" +
              key.todate +
              "</td><td>" +
              isvalet +
              "</td><td>" +
              key.tokentype +
              '</td><td><button class="btn btn-primary btnedit" id=' +
              key.id +
              '><i class="fas fa-edit"></i></button> <button class="btn btn-danger btndelete" id=' +
              key.id +
              ' ><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>'
          );
        });
      },
  
      failure: function (response) {
        alert(response);
      },
    });
  }
  
  $(document).on("click", ".btnedit", function () {
    var rowId = $(this).attr("id");
    var FromDate = $(this).closest("tr").find("td:eq(5)").text();
    var ToDate = $(this).closest("tr").find("td:eq(6)").text();
  
    $.ajax({
      type: "POST",
      url: "pages/complementaryevents.php",
      data: { request: "getData", rowId: rowId },
      success: function (response) {
        $data = $.parseJSON(response);
  
        $.each($data, function (value, key) {
          $("#txtId").val(rowId);
          var propertyId = key.propertyid;
          var propertyid = $("#cmbProperty").val(key.propertyid);
          var RateType = key.ratetypeid;
          loadRate(propertyId, RateType);
          $("#txtEvent").val(key.eventname);
          $("#cmbRate").val(RateType);
          $("#txtGuest").val(key.noofguests);
          $("#hidGuest").val(key.noofguests);
          $("#txtFromDate").val(FromDate);
          //$("#txtFromTime").val(FromTime);
          $("#txtToDate").val(ToDate);
          //$("#txtToTime").val(ToTime);
  
          if (key.isvalet == "null") {
            $("#chkisValet").prop("checked", false);
          } else if (key.isvalet == "f") {
            $("#chkisValet").prop("checked", false);
          } else if (key.isvalet == "t") {
            $("#chkisValet").prop("checked", true);
          }
  
          tokenType = key.tokentype;
          $("input[name=tokenType][value=" + tokenType + "]").prop(
            "checked",
            true
          );
          $("input[name=tokenType]").removeAttr("disabled");
          $("#btnListToken").css("display", "inline");
          $("#btnAddVehicle").css("display", "inline");
        });
  
        $("#btnUpdate").removeAttr("disabled");
        $("#btnCancel").removeAttr("disabled");
        $("#cmbProperty").removeAttr("disabled");
        $("#cmbRate").removeAttr("disabled");
        $("#txtEvent").removeAttr("disabled");
        $("#txtGuest").removeAttr("disabled");
        $("#txtFromDate").removeAttr("disabled");
        $("#txtToDate").removeAttr("disabled");
      },
      failure: function (response) {
        alert(response);
      },
    });
  });
  
  $(document).on("click", ".btndelete", function () {
    var Id = $(this).attr("id");
    var FromDate = Date.parse($(this).closest("tr").find("td:eq(5)").text());
    var ToDate = Date.parse($(this).closest("tr").find("td:eq(6)").text());
    var current = new Date();
    var cDate =
      current.getFullYear() +
      "-" +
      (current.getMonth() + 1) +
      "-" +
      current.getDate();
    var dateTime = Date.parse(cDate);
  
    if (dateTime > ToDate) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.value) {
          $.ajax({
            type: "POST",
            url: "pages/complementaryevents.php",
            data: { request: "DeleteData", Id: Id },
            success: function (response) {
              $data = JSON.parse(response);
              if ($data == "1") {
                Swal.fire("Success", "Successfully deleted", "success");
                loadEvent();
                Cancel();
              } else {
                Swal.fire("Canceled", "Request Failed", "error");
              }
            },
            error: function (error) {
              console.log(error);
            },
          });
        }
      });
    }
  });
  
  $("#btnListToken").click(function () {
    $("#tokenModal").modal("show");
    var Id = $("#txtId").val();
    $.ajax({
      type: "POST",
      url: "pages/complementaryevents.php",
      data: { request: "geteventtokens", eventid: Id },
  
      success: function (response) {
        $data = JSON.parse(response);
        myData = $data;
        var tr = [];
        var event = $("#txtEvent").val();
        for (var i = 0; i < myData.length; i++) {
          tr.push('<tr id="' + myData[i].eventid + '">');
          tr.push("<td>" + event + "</td>");
          tr.push("<td>" + myData[i].token + "</td>");
          tr.push("<td>" + myData[i].validtill + "</td>");
  
          if (myData[i].vehicleno != "" && myData[i].vehicleno != null) {
            tr.push("<td>Used</td>");
          } else {
            tr.push("<td><input type='checkbox' class='tickatoken' /></td>");
          }
  
          tr.push("</tr>");
        }
  
        $("#tokentbodyid").empty();
        $("#tokengrid").append($(tr.join("")));
      },
      error: function (error) {
        console.log(error);
      },
    });
  });
  
  $("#btnAddVehicle").click(function () {
    $("#addvehicleModal").modal("show");
    var EventId = $("#txtId").val();
    var EventName = $("#txtEvent").val();
    $.ajax({
      type: "POST",
      url: "pages/complementaryevents.php",
      data: { request: "getcomplementaryvehicles", eventid: EventId },
  
      success: function (response) {
        $data = JSON.parse(response);
        myData = $data;
        var tr = [];
        var tottoken = 0;
        var usedtoken = 0;
  
        for (var i = 0; i < myData.length; i++) {
          if (myData[i].vehicleno != "" && myData[i].vehicleno != null) {
            tr.push(
              '<tr id="' +
                myData[i].id +
                '" data-vehicleno="' +
                myData[i].vehicleno +
                '">'
            );
            tr.push('<td style="display:none">"' + myData[i].eventid + '"</td>');
            //tr.push('<td>' + EventName + '</td>');
            tr.push("<td>" + myData[i].vehicleno + "</td>");
            tr.push("<td>" + myData[i].mobileno + "</td>");
            tr.push("<td>" + myData[i].token + "</td>");
  
            if (myData[i].datetime != "" && myData[i].datetime != null) {
              tr.push("<td>" + myData[i].datetime + "</td>");
              tr.push("<td></td>");
            } else {
              tr.push("<td></td>");
              tr.push(
                '<td><a href="#" class="btnCVEdit"><img src="../App_Themes/images/edit.png" /></a><a href="#" class="btnCVDelete">&nbsp;<img src="../App_Themes/images/delete.png" /></a></td>'
              );
            }
  
            tr.push("</tr>");
  
            if (myData[i].vehicleno != "" && myData[i].vehicleno != null) {
              usedtoken++;
            }
          }
          tottoken++;
        }
  
        $("#addvehicletbodyid").empty();
        $("#addvehiclegrid").append($(tr.join("")));
      },
      error: function (error) {
        console.log(error);
      },
    });
  });
  