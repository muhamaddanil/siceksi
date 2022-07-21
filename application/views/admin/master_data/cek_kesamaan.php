<div class="container-fluid">
  <?php
  if ($this->session->flashdata('add')) {
    $message = $this->session->flashdata('add');
    $heading = '#Tambah skripsi';
  } else if ($this->session->flashdata('update')) {
    $message = $this->session->flashdata('update');
    $heading = '#Update skripsi';
  } else if ($this->session->flashdata('delete')) {
    $message = $this->session->flashdata('delete');
    $heading = '#Delete skripsi';
  }
  ?>
  <?php if (isset($message)) { ?>
    <script>
      $(document).ready(function() {
        $.toast({
          text: '<?php echo $message; ?>',
          heading: '<?php echo $heading; ?>',
          position: 'top-right',
          width: 'auto',
          showHideTransition: 'slide',
          icon: 'info',
          hideAfter: 5000
        })
      });
    </script>
  <?php } ?>
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Hasil Kesamaan</h1>
  <hr>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="<?php echo site_url('skripsi/add') ?>" class="btn btn-primary btn-icon-split btn-sm">
        <span class="icon text-white-50">
          <i class="fas fa-print"></i>
        </span>
        <span class="text">Cetak Hasil</span>
      </a>

      <a href="<?php echo site_url('upload_skripsi/cek_kesamaan') ?>" class="btn btn-success btn-icon-split btn-sm">
        <span class="icon text-white-50">
          <i class="fa fa-refresh"></i>
        </span>
        <span class="text">Refresh Halaman</span>
      </a>
      <!-- <br>
      <br> -->
      <a href="<?php echo site_url('upload/file_cek/' . $file_cek) ?>" class="btn btn-success btn-icon-split btn-sm">
        <span class="icon text-white-50">
          <i class="fa fa-download"></i>
        </span>
        <span class="text"><?= $file_cek ?></span>
      </a>
      <span style="color:red">Waktu Eksekusi Algoritma <?php echo $waktu_eksekusi ?> ms</span>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th style="width: 5%;">No</th>
              <th>Nama Mahasiswa</th>
              <th>Dokumen Skripsi</th>
              <th>Kategori Skripsi</th>
              <th>Kemiripan (%)</th>
            </tr>
          </thead>

          <tbody>
            <?php $no = 1;

            foreach ($hasil as $key) { ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $key['mahasiswa_nama'] ?></td>
                <td><?php echo $key['skripsi_file_full'] ?></td>
                <td><?php echo $key['kategori_skripsi_nama'] ?></td>
                <?php if ($key['persentasi'] > 80) { ?>
                  <td style="color:red;"><?php echo $key['persentasi'] . ' %' ?></td>
                <?php } else if ($key['persentasi'] > 50) { ?>
                  <td style="color:yellow;"><?php echo $key['persentasi'] . ' %' ?></td>
                <?php } else if ($key['persentasi'] > 0) { ?>
                  <td style="color:green;"><?php echo $key['persentasi'] . ' %' ?></td>
                <?php } ?>

              </tr>

              <!-- Looping Modal Area -->
            <?php $no++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->