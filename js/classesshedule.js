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
  loadclassshedule();
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
    tr.push("<td>" + Res[i].zoomlink + "</td>");
    tr.push("<td>" + "<button onclick=\"View('" + Res[i].id + '\')" class="btn btn-primary"><i class="fa fa-edit"></i> Edit </button>' +"</td>"
       + "<td>" + " <button onclick=\"Delete('" + Res[i].id + '\')" class="btn btn-danger"><i class="fa fa-trash"></i> delete </button>' +"</td>"
    );
    tr.push("</tr>");
  }
  $("#tbodyid").empty();
  $("#tblstudent").append($(tr.join("")));
}

function View(Id) {
  $.ajax({
    method: "POST",
    url: "pages/classesshedule.php",
    data: { request: "getClassSheduleById", Id: Id },
    success: function (response) {
      $data = $.parseJSON(response);
      $("#txtId").val($data[0].id);
      $("#Name").val($data[0].teacherid);
      $("#Subject").val($data[0].subjectid);
      $("#txtDate").val($data[0].date);
      $("#txtToTime").val($data[0].time);
      $("#hours").val($data[0].noofhours);
      $("#link").val($data[0].zoomlink);
    },
    failure: function (response) {
      alert(response);
    },
  });
}

function Delete(Id) {


  if (confirm("Are you sure? You won't be able to revert this!")) {
    $.ajax({
      type: "POST",
      url: "pages/classesshedule.php",
      data: { request: "deletedata", Id: Id }, 
      success: function (response) {
        console.log(response);
        var data = JSON.parse(response);
        if (data == "1") {
          alert("Successfully deleted");
          loadclassshedule();
        } else {
          alert("Request Failed");
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
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

$("#btnCancel").click(function () {
  Cancel();
});

function Cancel() {
  $("#frmEvent").trigger("reset");
  $("#txtId").val("0");
  $("#btnListToken").css("display", "none");
  $("#btnAddVehicle").css("display", "none");
}

