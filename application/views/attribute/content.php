<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Beranda </h1>
  <hr>
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-8 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mahasiswa</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $mahasiswa ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-8 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Skripsi</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $skripsi; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-file fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="col-xl-8 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kategori</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $kategori ?></div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-file fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if ($this->session->userdata('group_id') == 1) { ?>
  <div class="col-xl-12 col-md-6 mb-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Log Sistem Terbaru</h6>
      </div>
      <div class="card-body">
        <?php foreach ($log as $key) { ?>
          <small class="text-danger"><b><?php echo $key->user_name ?></b><br><?php echo $key->log_time ?></small><br>
          <?php echo $key->log_message ?>
          <hr>
        <?php  } ?>
      </div>
    </div>
  </div>
<?php } ?>