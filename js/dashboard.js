$(document).ready(function () {
  $("#cmbproperty").trigger("change");
});

$("#cmbproperty").change(function () {
  var level = this.value;
  $("#img").attr("src", "pages/dashboard.php?level="+level);
});
