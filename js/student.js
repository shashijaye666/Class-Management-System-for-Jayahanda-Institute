$(document).ready(function () {
  loadStudent();
});

$("#btnAdd").click(function () {
  $("#formStudent").trigger("reset");
  $("#StudentModal").modal("show");
});

$("#btnCancel").click(function () {
  $("#StudentModal").modal("hide");
});

$("#btnSave").on("click", function (event) {
  var ok = true;
  var msg = "";

  var Id = $("#StudentId").val();
  var StudentName = $("#StudentName").val();
  var Address = $("#Address").val();
  var Email = $("#Email").val();
  var ContactNo = $("#ContactNo").val();
  var ContactName = $("#ContactName").val();
  var ParentName = $("#ParentName").val();
  var ParentContactNo = $("#ParentContactNo").val();
  var ParentIDNo = $("#ParentIDNo").val();
  var Active = $("#Active").prop("checked") ? "true" : "false";

  if (StudentName == "") {
    ok = false;
    msg = "Please enter StudentName";
  } else if (Address == "") {
    ok = false;
    msg = "Please enter Address";
  } else if (Email == "") {
    ok = false;
    msg = "Please enter Email";
  } else if (ContactNo == "") {
    ok = false;
    msg = "Please enter ContactNo";
  } else if (ContactName == "") {
    ok = false;
    msg = "Please enter ContactName";
  } else if (ParentName == "") {
    ok = false;
    msg = "Please enter ParentName";
  } else if (ParentIDNo == "") {
    ok = false;
    msg = "Please enter Parent ID No";
  } else if (ParentContactNo == "") {
    ok = false;
    msg = "Please enter Parent Contact No";
  }

  if (ok) {
    $.ajax({
      method: "POST",
      url: "pages/student.php",
      data: {
        request: "SaveStudent",
        Id: Id,
        StudentName: StudentName,
        Address: Address,
        Active: Active,
        ContactName: ContactName,
        ContactEmail: Email,
        ContactMobile: ContactNo,
        ParentName: ParentName,
        ParentIDNo: ParentIDNo,
        ParentContactNo: ParentContactNo,
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
        $("#StudentModal").modal("hide");
        loadStudent();
      },
      failure: function (response) {
        alert(response);
      },
    });
  } else alert(msg);
  $("#StudentModal").modal("hide");
  loadStudent();
});

function loadStudent() {
  $.ajax({
    method: "POST",
    url: "pages/student.php",
    data: { request: "loadStudent" },
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
    tr.push("<td>" + Res[i].address + "</td>");
    tr.push("<td>" + Res[i].contactemail + "</td>");
    tr.push("<td>" + Res[i].contactmobile + "</td>");
    tr.push(
      "<td><button onclick=\"View('" +
        Res[i].id +
        '\')" class="btn btn-primary"><i class="fa fa-edit"></i> Edit </button></td>'
    );
    tr.push("</tr>");
  }
  $("#tbodyid").empty();
  $("#tblstudent").append($(tr.join("")));
}

function View(Id) {
  $("#StudentModal").modal("show");

  $.ajax({
    method: "POST",
    url: "pages/student.php",
    data: { request: "getStudentById", Id: Id },
    success: function (response) {
      $data = $.parseJSON(response);
      $("#StudentId").val($data[0].id);
      $("#StudentName").val($data[0].name);
      $("#Address").val($data[0].address);
      $("#Email").val($data[0].contactemail);
      $("#ContactNo").val($data[0].contactmobile);
      $("#ContactName").val($data[0].contactname);
      $("#ParentName").val($data[0].parentname);
      $("#ParentContactNo").val($data[0].parentcontactmobile);
      $("#ParentIDNo").val($data[0].parentidno);
      var activ = $data[0].active1 == "0" ? 0 : 1;
      $("#Active").prop("checked", activ);
    },
    failure: function (response) {
      alert(response);
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
      url: "pages/student.php",
      data: { request: "getStudentByStudentName", Name: studentName },
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
    $("#tblstudent").append($(tr.join("")));
  }
});
