<?php
    $tahun = date('Y');  //Otomatis tahun sekarang
    $query = "SELECT MONTH(reg_periksa.tgl_registrasi) AS bulan, MONTHNAME(reg_periksa.tgl_registrasi) AS namabulan FROM reg_periksa WHERE YEAR(reg_periksa.tgl_registrasi) = '$tahun' AND reg_periksa.status_lanjut = 'Ralan' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 60 GROUP BY bulan ORDER BY bulan";
    $ambil = mysqli_fetch_array(mysqli_query($mysqli,$query));
    
    //$tahun = date('Y');
?>	
  <!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Dashboard v2</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Dashboard v2</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	 <!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-child"></i></span>
              <?php
                  $tampil=mysqli_query($mysqli, "SELECT * FROM reg_periksa WHERE reg_periksa.status_lanjut = 'Ralan' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 60");
                  $total=mysqli_num_rows($tampil);
              ?>
              <div class="info-box-content">
                <span class="info-box-text">Usia Lebih Dari 60 th</span>
                <span class="info-box-number"><?php echo $total;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-child"></i></span>
              <?php
                  $tampil=mysqli_query($mysqli, "SELECT * FROM reg_periksa WHERE reg_periksa.status_lanjut = 'Ralan' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 60");
                  $total=mysqli_num_rows($tampil);
              ?>
              <div class="info-box-content">
                <span class="info-box-text">Usia Kurang Dari 60 th</span>
                <span class="info-box-number"><?php echo $total;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">760</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <span class="info-box-number">2,000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
	 </div>
</section>

