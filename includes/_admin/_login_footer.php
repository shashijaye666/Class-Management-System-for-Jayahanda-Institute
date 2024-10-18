</div>
  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>

  <?php
    if (isset($_GET["page"])) {
        echo '<script src="js/' . $_GET["page"] . '.js"></script>';
    } else {
        echo '<script src="js/index.js"></script>';
    }
    ?>
  </body>

  </html>