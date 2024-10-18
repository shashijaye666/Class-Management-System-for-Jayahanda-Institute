<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    Developed By: <a href="https://www.linkedin.com/in/shashikajaye" target=”_blank” >Shashika Jayathilaka</a> 
  </div>
  <!-- Default to the left -->
  <strong>2024 -<a href="https://maps.app.goo.gl/Axk8KqjBuKzkUaJj8"  target="_blank">Jayahanda Institute </a> </strong>
</footer>
</div>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<!-- <script src="./plugins/jquery/jquery.js"></script>
<script src="./plugins/jquery/jquery.min.js"></script> -->
<script src="./plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dist/js/demo.js"></script>
<!-- date-range-picker -->
<script src="./plugins/moment/moment.min.js"></script>
<script src="./plugins/daterangepicker/daterangepicker.js"></script>
<!-- Bootstrap Switch -->
<script src="./plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="./plugins/bs-stepper/js/bs-stepper.min.js"></script>

<?php
if (isset($_GET["page"])) {
  echo '<script src="js/' . $_GET["page"] . '.js"></script>';
} else {
  echo '<script src="js/login.js"></script>';
}
?>
</body>

</html>