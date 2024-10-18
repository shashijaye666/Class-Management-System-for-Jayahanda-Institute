<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="?page=index"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="?page=studentsearch"><i class="fa fa-book"></i> <span>Search</span></a></li>
            <li><a href="?page=register"><i class="fa fa-book"></i> <span>Registration</span></a></li>
            <li><a href="?page=studentcourse"><i class="fa fa-book"></i> <span>Student Course</span></a></li>
            <li><a href="?page=course"><i class="fa fa-book"></i> <span>Course</span></a></li>
            <li><a href="?page=batch"><i class="fa fa-book"></i> <span>Batch</span></a></li>
            <li><a href="?page=subject"><i class="fa fa-book"></i> <span>Subject</span></a></li>
            <li><a href="?page=payment"><i class="fa fa-book"></i> <span>Payment</span></a></li>
            <li><a href="?page=attendance"><i class="fa fa-book"></i> <span>Attendance</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="?rptpage=rptRegistration"><i class="fa fa-circle-o"></i> Registration Report</a></li>
                    <li><a href="?rptpage=rptStudent"><i class="fa fa-circle-o"></i> Student Report</a></li>
                    <li><a href="?rptpage=rptPayment"><i class="fa fa-circle-o"></i> Payment Report</a></li>
                    <li><a href="?rptpage=rptAttendance"><i class="fa fa-circle-o"></i> Attendance Report</a></li>
                    <?php
                    if ($_SESSION['USER_ID'] == "2"){ ?>
                    <li><a href="?rptpage=rptPaySummary"><i class="fa fa-circle-o"></i> Payment Summary</a></li>
                    <li><a href="?rptpage=rptAttenSummary"><i class="fa fa-circle-o"></i> Attendance Summary</a></li>
                    <?php }     ?>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>