$(document).ready(function () {
  4;
  loaduserlevel();
  loaduser();

  $("#active").prop("checked", true);
});

function Cancel() {
  $("#frmuser").trigger("reset");
  $("#supid").val("0");
}

function ClearAll() {
  $("#txtuser").val("");
  $("#txtusername").val("");
  $("#txtpassword").val("");
  $("#cmbRole").val("");
}

$("#add").on("click", function () {
  $("#userpopup").modal("show");
  $("#btninsert").show();
  $("#btnedit").hide();
  ClearAll();
  // $("#txtusername").val("");
});

function loaduserlevel() {
  $.ajax({
    type: "POST",
    url: "pages/login.php",
    data: { request: "getuserlevels" },

    success: function (response) {
      $data = $.parseJSON(response);
      $.each($data, function (value, key) {
        $("#cmbRole").append(
          "<option value=" + key.id + ">" + key.userlevel + "</option>"
        );
      });
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function loaduser() {
  $.ajax({
    type: "POST",
    url: "pages/login.php",
    data: { loadUser: "loadUser" },
    success: function (response) {
      var $data = $.parseJSON(response);
      if ($data != "") {
        $("#tbUserBody").empty();
        $.each($data, function (value, key) {
          $("#tbUserBody").append(
            "<tr><td>" +
              key.name +
              "</td><td>" +
              key.username +
              "</td><td>" +
              key.userlevel +
              "</td><td>" +
              '</td><td><button class="btn btn-primary Editbutton" id=' +
              key.id +
              '><i class="fas fa-edit"></i></button> <button class="btn btn-danger deletebutton" id=' +
              key.id +
              ' ><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>'
          );
        });
      } else {
        alert("data not found");
      }
    },
    failure: function (response) {
      console.log(response);
    },
  });
}

//Insert the data //

$("#userpopup").on("click", "#btninsert", function () {
  var name = $("#txtuser").val();
  var username = $("#txtusername").val();
  var password = $("#txtpassword").val();
  var userlevel = $("#cmbRole").val();
  if (name == "") {
    swal("Canceled", "Please enter the user", "error");
  } else if (username == "") {
    swal("Canceled", "Please enter the username", "error");
  } else if (password == "") {
    swal("Canceled", "Please enter the password", "error");
  } else if (userlevel == "0") {
    swal("Canceled", "Please select  the userlevel", "error");
  } else {
    $.ajax({
      type: "POST",
      url: "pages/login.php",
      data: {
        request: "insertuser",
        name: name,
        username: username,
        password: password,
        userlevel: userlevel,
      },
      success: function (response) {
        $data = $.parseJSON(response);
        if ($data == 1) {
          // alert('Success')
          swal("Success", "Successfully Saved", "success");
          loaduser();
          //  cleardata();
          $("#userpopup").modal("toggle");
          // filter();
        } else {
          swal("Canceled", "Save Failed!", "error");
          // swal('Canceled');
        }
      },
      failure: function (response) {
        alert(response);
      },
    });
  }
});



//bind the data to pop up modal when press Edit button // 

$(document).on("click", ".Editbutton", function () {
  var rowId = $(this).attr("id");
 
  $.ajax({
    type: "POST",
    url: "pages/login.php",
    data: { id: rowId },
    success: function (response) {
      $data = $.parseJSON(response);
      if ($data != "") {
        $.each($data, function (value, key) {
          $("#supid").val(key.id);
          $("#txtuser").val(key.name);
          $("#txtusername").val(key.username);
          $("#cmbRole").val(key.userlevel);

          $("#userpopup").modal("show");
          $("#btninsert").hide();
          $("#btnedit").show();
        });
      } else {
        alert("data not found");
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});

function validationuseredit() {
  var name = $("#txtuser").val();
  var username = $("#txtusername").val();
  var password = $("#txtpassword").val();
  var userlevel = $("#cmbRole").val();

  if (name == "" || username == "" || password == "" || userlevel == "0") {
    if (username == "") {
      $("#txtusername").css("border-color", "red");
    }
    if (password == "") {
      $("#txtpassword").css("border-color", "red");
    }

    if (name == "") {
      $("#txtuser").css("border-color", "red");
    }
    if (userlevel == "0") {
      $("#cmbRole").css("border-color", "red");
    }
    return false;
  } else {
    return true;
  }
}

// validate the data and run the update function //

$("#userpopup").on("click", "#btnedit", function () {
  if ($("#id").val() == "") {
    if (validationuseredit()) {
      updateusereditsection();
    } else {
      $.confirm({
        title: "Update oparation failure",
        content:
          "please fill out all required fields which has red colour border with suitable data",
        type: "red",
        buttons: {
          ok: {
            text: "ok!",
            btnClass: "btn-primary",
            keys: ["enter"],
            action: function () {},
          },
        },
      });
    }
  } else {
    $.confirm({
      title: "Update oparation failure",
      content:
        "please fill out all required fields which has red colour border with suitable data",
      type: "red",
      buttons: {
        ok: {
          text: "ok!",
          btnClass: "btn-primary",
          keys: ["enter"],
          action: function () {},
        },
      },
    });
  }
});

function updateusereditsection() {
  var id = $("#supid").val();
  var name = $("#txtuser").val();
  var username = $("#txtusername").val();
  var password = $("#txtpassword").val();
  var userlevel = $("#cmbRole").val();

  $.ajax({
    type: "POST",
    url: "pages/login.php",
    data: {
      request: "update",
      id: id,
      name: name,
      username: username,
      password: password,
      userlevel: userlevel,
    },
    success: function (response) {
      if ($data != "") {
        // alert('Success')
        swal("Success!", "Successfully updated!", "success");

        loaduser();
        //  cleardata();
        $("#userpopup").modal("toggle");
      } else {
        swal("Error!", "Canceled!", "error");
      }
    },
    failure: function (response) {
      alert(response);
    },
  });
}

  // function deletedetails(rowid){

  //     var del="delete";

  //     $.ajax({

  //       type:'POST',
  //       url:'pages/login.php',
  //       data:{del:del,id:rowid},
  //       success: function(response){

  //        // alert(response);
  //        swal("Success!", "Successfully deleted!", "success");
  //        loaduser();

  //       }

  //     });

  //   }

  // $(document).on("click", ".deletebutton", function () {
  //   var rowid = $(this).attr("id");
  //   var del = "delete";
  //   swal({
  //     title: "Are you sure?",
  //     text: "You won't be able to revert this!",
  //     icon: "warning",
  //     showCancelButton: true,
  //     confirmButtonColor: "#3085d6",
  //     cancelButtonColor: "#d33",
  //     confirmButtonText: "Yes, delete it!",
  //   }).then((result) => {
  //     if (result.value) {
  //       $.ajax({
  //         type: "POST",
  //         url: "pages/login.php",
  //         data: { del: del, did: rowid },
  //         success: function (response) {
  //           console.log(response);
  //           $data = JSON.parse(response);
  //           if ($data == "1") {
  //             swal("Success", "Successfully deleted", "success");
  //             loaduser();
  //             Cancel();
  //           } else {
  //             swal("Canceled", "Request Failed", "error");
  //           }
  //         },
  //         error: function (error) {
  //           console.log(error);
  //         },
  //       });
  //     }
  //   });
  // });

$(document).ready(function () {
  $(document).on("click", ".deletebutton", function () {
      var rowid = $(this).attr("id");
      var del = "delete";

      if (confirm("Are you sure? You won't be able to revert this!")) {
          $.ajax({
              type: "POST",
              url: "pages/login.php",
              data: { del: del, did: rowid },
              success: function (response) {
                  console.log(response);
                  var data = JSON.parse(response);
                  if (data == "1") {
                      alert("Successfully deleted");
                      loaduser();
                      Cancel();
                  } else {
                      alert("Request Failed");
                  }
              },
              error: function (error) {
                  console.log(error);
              },
          });
      }
  });
});



