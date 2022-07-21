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
  <script src="<?php echo base_url() ?>assets/plugin-new/ckeditor/ckeditor.js"></script>
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data skripsi</h1>
  <!-- <p class="mb-4">Data berikut merupakan kumpulan skripsi yang berlaku di <b>Dinas Lingkungan Hidup dan Kehutanan</b> - Kota Kendari</p> -->
  <hr>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">

      <a href="<?php echo site_url('skripsi') ?>" class="btn btn-warning btn-icon-split btn-sm">
        <span class="icon text-white-50">
          <i class="fa fa-arrow-left"></i>
        </span>
        <span class="text">Kembali</span>
      </a>

      <a href="<?php echo site_url('skripsi/update') ?>" class="btn btn-success btn-icon-split btn-sm">
        <span class="icon text-white-50">
          <i class="fa fa-refresh"></i>
        </span>
        <span class="text">Refresh Halaman</span>
      </a>

    </div>
    <div class="card-body">

      <?php echo form_open_multipart("skripsi/edit") ?>

      <div class="form-group">
        <label for=""><b>Nama Mahasiswa</b></label>
        <select class="form-control" name="mahasiswa_nim" required="required">
          <option value="">-Pilih Mahasiswa-</option>
          <?php foreach ($mahasiswa as $j) {
            if ($skripsi[0]->mahasiswa_nim == $j->mahasiswa_nim) {
          ?>
              <option value="<?php echo $j->mahasiswa_nim ?>" selected><?php echo $j->mahasiswa_nama ?></option>
            <?php } else { ?>
              <option value="<?php echo $j->mahasiswa_nim ?>"><?php echo $j->mahasiswa_nama ?></option>
          <?php  }
          } ?>
        </select>
      </div>

      <div class="form-group">
        <label for=""><b>Peminatan</b></label>
        <select class="form-control" name="kategori_skripsi_id" required="required">
          <option value="">-Pilih Peminatan-</option>
          <?php foreach ($kategori_skripsi as $j) {
            if ($skripsi[0]->kategori_skripsi_id == $j->kategori_skripsi_id) {
          ?>
              <option value="<?php echo $j->kategori_skripsi_id ?>" selected><?php echo $j->kategori_skripsi_nama ?></option>
            <?php } else { ?>
              <option value="<?php echo $j->kategori_skripsi_id ?>"><?php echo $j->kategori_skripsi_nama ?></option>
          <?php  }
          } ?>
        </select>
      </div>

      <div class="form-group">
        <label for=""><b>Juduk Skripsi</b></label>
        <input type="text" class="form-control" name="skripsi_judul" required="required" value="<?php echo $skripsi[0]->skripsi_judul ?>">
      </div>

      <div class="form-group">
        <label for=""><b>Upload Skripsi Full</b></label>
        <input type="hidden" class="form-control" name="skripsi_id" value="<?php echo $skripsi[0]->skripsi_id ?>">
        <input type="file" class="form-control" name="skripsi_full" value="<?php echo $skripsi[0]->skripsi_file_full ?>">
      </div>

      <hr>
      <button style="width: 100%" class="btn btn-warning" type="submit">Edit skripsi</button>
      <?php echo form_close(); ?>
    </div>
  </div>

  <script type="text/javascript">
    CKEDITOR.replace('editor1');
  </script>

</div>
<!-- /.container-fluid -->