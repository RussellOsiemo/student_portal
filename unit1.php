<?php
session_start();
// $_SESSION['unit1'];
include "config.php";
$unit_name = "";
$reg_no="";
$unique_no="";
$examCard_no="";
$marks = "";
$grade = "";
//unit 1 name
$sql = "SELECT * FROM lecturer";
$query = mysqli_query($conn, $sql);
//change when many lecturers
    $row = mysqli_fetch_array($query);
    // $name = $row['name'];
    $unit_code_name = $row["unit1"];
    // split code and name 
    $unit_array = explode(":",$unit_code_name);
    $unit_code = $unit_array[0];
    $unit_name = $unit_array[1];


//our unit name is to come from the lecturer database so as to use it
$lecQuery = "SELECT * FROM  exam_card";
$lecresult = mysqli_query($conn,$lecQuery);
if (mysqli_num_rows($lecresult)>0) {
  $row = mysqli_fetch_array($lecresult);
  //we need this to split it and get 
  $units = $row["units_codes_and_names"];
  $reg_no =$row["regno"];
  $stud_name = $row["names"];
  $examCard_no = $row["exam_card_no"];
  //change to sime auto incerement stuff
  $stud_id = $row['id'];

}


//selct all the stuff from exam card table 

//split the units this is now an array
$unit_1_finder = explode(',',$unit_code_name);
// we now have each unit separately but in array 
//lets search the array for the unit name
$unit_1 = array_search($unit_code_name,$unit_1_finder);
//now select regnos with that unit innit 
$search_sql = "SELECT * FROM unit_reg WHERE unit_codes_and_names LIKE $unit_1";
$search_results = mysqli_query($conn, $search_sql);
if(mysqli_num_rows($search_results)>0){
  $search_row = mysqli_fetch_array($search_results);
  //capture the regnos of peiple doing the units 
  
}


//now we have say a single unit with code and name lets split it to code and name (:)
$single_unit

// $sql = 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $unit_code;?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
    <div class="wrapper">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo "Datatable For ".$unit_code.":".$unit_name;?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover ">
                  <thead class="bg-primary">
                  <tr>
                    <th style ="width:5px;">Serial No.</th>
                    <th style ="width:10px;">Registration No.</th>
                    <th style ="width:20px;">Exam Card No.</th>
                    <th style ="width:10px;">Unique No.</th>
                    <th style ="width:5px;"> Marks</th>
                    <th style ="width:5px;">Grade</th>
                    <th style ="width:5px;">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><?php echo $stud_id; ?></td>
                    <td><?php echo $reg_no;?></td>
                    <td><?php echo $examCard_no?></td>
                    <!-- fixed for now  -->
                    <td>RES9675</td>
                    <!-- editable but static needs crud  -->
                    <td>68</td>
                    <!-- use case for grading -->
                    <td>B</td>
                    <td><button type="button" class="btn btn-prmary"><a href="#">Change</a></button></td>
                  </tr>
    
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
             
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
