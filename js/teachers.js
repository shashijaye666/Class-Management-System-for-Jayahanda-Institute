$(document).ready(function () {
  loadSubjects();
  getteachereducation();
  loadteacher();
});

$("#btnAdd").click(function () {
  loadSubjects();
  $("#formTeacher").trigger("reset");
  $("#teacherModal").modal("show");
});

$("#btnCancel").click(function () {
  $("#teacherModal").modal("hide");
});

$("#btnSave").on("click", function (event) {
  var ok = true;
  var msg = "";

  var Id = $("#teacherId").val();
  var TeacherName = $("#teacherName").val();
  var Subject = $("#Subjectname").val();
  var educationallevel = $("#educationallevel").val();
  var SubjectType = $("#Subjecttype").val();
  var Email = $("#Email").val();
  var ContactNo = $("#ContactNo").val();
  var IDNo = $("#IDNo").val();
  var Active = $("#Active").prop("checked") ? "true" : "false";

  if (TeacherName == "") {
    ok = false;
    msg = "Please enter Your Name";
  } else if (Subject == "") {
    ok = false;
    msg = "Please enter Your Subject";
  } else if (educationallevel == "") {
    ok = false;
    msg = "Please enter Your educational level";
  } else if (SubjectType == "") {
    ok = false;
    msg = "Please enter Your SubjectType";
  } else if (Email == "") {
    ok = false;
    msg = "Please enter Your Email";
  } else if (ContactNo == "") {
    ok = false;
    msg = "Please enter Contact No";
  } else if (IDNo == "") {
    ok = false;
    msg = "Please enter ID No";
  }

  if (ok) {
    $.ajax({
      method: "POST",
      url: "pages/teachers.php",
      data: {
        request: "Saveteacher",
        Id: Id,
        TeacherName: TeacherName,
        Subject: Subject,
        educationallevel: educationallevel,
        SubjectType: SubjectType,
        Email: Email,
        ContactNo: ContactNo,
        IDNo: IDNo,
        Active: Active,
      },
      success: function (response) {
        $data = $.parseJSON(response);

        if ($data == 1) {
          swal("Success", "Your work has been Updated", "success");
        } else if ($data > 1) {
          swal("Success", "Your work has been saved", "success");
        } else {
          swal("Canceled", "Something went wrong!", "error");
        }
        $("#teacherModal").modal("hide");
        loadteacher();
      },
      failure: function (response) {
        alert(response);
      },
    });
  } else alert(msg);
  $("#teacherModal").modal("hide");
  loadteacher();
});

function loadteacher() {
  $.ajax({
    method: "POST",
    url: "pages/teachers.php",
    data: { request: "loadteacher" },
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
    tr.push("<td>" + Res[i].subjecttype + "</td>");
    tr.push("<td>" + Res[i].email + "</td>");
    tr.push("<td>" + Res[i].contactno + "</td>");
    tr.push(
      "<td><button onclick=\"View('" +Res[i].id +'\')" class="btn btn-primary"><i class="fa fa-edit"></i> Edit </button></td>'
    );
    tr.push("</tr>");
    
  }
  $("#tbodyid").empty();
  $("#tblteacher").append($(tr.join("")));
}

function View(Id) {
  $("#teacherModal").modal("show");

  $.ajax({
    method: "POST",
    url: "pages/teachers.php",
    data: { request: "getTeacherById", Id: Id },
    success: function (response) {
      var $data = $.parseJSON(response);
      
      // Populate form fields with data from the response
      $("#teacherId").val($data[0].id);
      $("#teacherName").val($data[0].name);
      $("#Subjectname").val($data[0].subjectid);
      $("#educationallevel").val($data[0].teachereducationid);
      $("#Email").val($data[0].email);
      $("#ContactNo").val($data[0].contactno);
      $("#IDNo").val($data[0].idno);
      $("#Subjecttype").val($data[0].subjecttypeid);  
      var activ = $data[0].active1 == "0" ? false : true;
      $("#Active").prop("checked", activ);
    },
    error: function (response) {
      alert("Error retrieving data. Please try again.");
    },
  });
}


$("#TnameforSearch").bind("keyup", function () {
  var studentName = this.value;
  var myData = $.grep(StudentArray, function (v) {
    return v.name.search(new RegExp(studentName, "i")) != -1;
  });

  LoadTable(myData);
});

$("#btnSearch").click(function () {
  var studentName = $("#TnameforSearch").val();
  if (studentName != "") {
    $.ajax({
      method: "POST",
      url: "pages/teachers.php",
      data: { request: "getTeacherByTeacherName", Name: teacherName },
      success: function (response) {
        $data = $.parseJSON(response);
        LoadTable($data);
      },
      failure: function (response) {
        alert(response);
      },
    });
  } else {
    swal("Canceled", "Data Not Found", "error");

    $("#tbodyid").empty();
    $("#tblteacher").append($(tr.join("")));
  }
});

function loadSubjects() {
  $.ajax({
    method: "POST",
    url: "pages/teachers.php",
    data: { request: "getsubject" },
    success: function (response) {
      $data = $.parseJSON(response);

      $("#Subjectname").empty();
      $("#Subjectname").append(
        '<option value="0">Select Your Subject</option>'
      );

      $.each($data, function (value, key) {
        $("#Subjectname").append(
          "<option value=" + key.id + ">" + key.subjectname + "</option>"
        );
      });
    },
    failure: function (response) {
      alert(response);
    },
  });
}

function getteachereducation() {
  $.ajax({
    method: "POST",
    url: "pages/teachers.php",
    data: { request: "geteducation" },
    success: function (response) {
      $data = $.parseJSON(response);

      $("#educationallevel").empty();
      $("#educationallevel").append(
        '<option value="0">Select Your Education</option>'
      );

      $.each($data, function (value, key) {
        $("#educationallevel").append(
          "<option value=" + key.id + ">" + key.educationtype + "</option>"
        );
      });
    },
    failure: function (response) {
      alert(response);
    },
  });
}
