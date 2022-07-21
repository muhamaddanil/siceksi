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
  <h1 class="h3 mb-2 text-gray-800">Data skripsi</h1>
  <!-- <p class="mb-4">Data berikut merupakan kumpulan skripsi yang berlaku di <b>Dinas Lingkungan Hidup dan Kehutanan</b> - Kota Kendari</p> -->
  <hr>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <?php if ($this->session->userdata('group_id') == 1) { ?>
        <a href="<?php echo site_url('skripsi/add') ?>" class="btn btn-primary btn-icon-split btn-sm">
          <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
          </span>
          <span class="text">Tambah Data</span>
        </a>
      <?php } ?>


      <!-- skripsi Modal-->



      <a href="<?php echo site_url('skripsi') ?>" class="btn btn-success btn-icon-split btn-sm">
        <span class="icon text-white-50">
          <i class="fa fa-refresh"></i>
        </span>
        <span class="text">Refresh Halaman</span>
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th style="width: 5%;">No</th>
              <?php if ($this->session->userdata('group_id') == 1) { ?>
                <th style="width: 12%;">#</th>
              <?php } ?>
              <th>Nim Mahasiswa</th>
              <th>Nama Mahasiswa</th>
              <th>Judul Skripsi</th>
              <th>Peminatan</th>
            </tr>
          </thead>

          <tbody>
            <?php $no = 1;
            foreach ($skripsi as $key) { ?>
              <tr>
                <td><?php echo $no; ?></td>
                <?php if ($this->session->userdata('group_id') == 1) { ?>
                  <td>
                    <a href="<?php echo base_url() . 'upload/skripsi_full/' . $skripsi[0]->skripsi_file_full ?>" target="_blank" class="btn btn-success btn-icon-split btn-sm">
                      <span class="text">
                        <i class="fa fa-download"></i>
                      </span>
                    </a>
                    <a href="<?php echo site_url('skripsi/update/' . $key->skripsi_id) ?>" class="btn btn-warning btn-icon-split btn-sm">
                      <span class="text">
                        <i class="fa fa-edit"></i>
                      </span>
                    </a>
                    <a href="#" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#skripsiRemoveModal<?php echo $key->skripsi_id ?>">
                      <span class="text">
                        <i class="fa fa-trash"></i>
                      </span>
                    </a>
                  </td>
                <?php } ?>
                <td><?php echo $key->mahasiswa_nim ?></td>
                <td><?php echo $key->mahasiswa_nama ?></td>
                <td><?php echo $key->skripsi_judul ?></td>
                <td><?php echo $key->kategori_skripsi_nama ?></td>

              </tr>

              <!-- Looping Modal Area -->




              <!-- skripsi Modal Remove-->
              <div class="modal fade" id="skripsiRemoveModal<?php echo $key->skripsi_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Hapus skripsi</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <?php echo form_open("skripsi/delete") ?>
                    <div class="modal-body">
                      Apakah anda yakin akan menghapus data skripsi <b><?php echo $key->mahasiswa_nama ?></b> ?
                      <input type="hidden" class="form-control" name="skripsi_id" value="<?php echo $key->skripsi_id ?>">
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-danger" type="submit">Hapus</button>
                      <?php echo form_close(); ?>
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

                    </div>
                  </div>
                </div>
              </div>

              <!-- End Looping -->


            <?php $no++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->