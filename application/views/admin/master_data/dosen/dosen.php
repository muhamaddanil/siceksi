<div class="container-fluid">
  <script>
    $(document).ready(function() {
      $('#import_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
          url: "<?php echo base_url() ?>api/dosen_import",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            $('#file').val('');
            // alert(data);
            $("#importdosenModal").modal('hide');
            window.location = "<?php echo site_url('dosen'); ?>";
          }
        })
      });

    });
  </script>
  <?php
  if ($this->session->flashdata('add')) {
    $message = $this->session->flashdata('add');
    $heading = '#Tambah dosen';
  } else if ($this->session->flashdata('update')) {
    $message = $this->session->flashdata('update');
    $heading = '#Update dosen';
  } else if ($this->session->flashdata('delete')) {
    $message = $this->session->flashdata('delete');
    $heading = '#Delete dosen';
  } else if ($this->session->flashdata('import')) {
    $message = $this->session->flashdata('import');
    $heading = '#import Dosen';
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
  <h1 class="h3 mb-2 text-gray-800">Data dosen</h1>
  <p class="mb-4">Data berikut merupakan kumpulan Dosen yang terdaftar di Jurusan <b>Teknik Informatika</b> - Universitas Halu Oleo</p>
  <hr>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#dosenModal">
        <span class="icon text-white-50">
          <i class="fas fa-plus"></i>
        </span>
        <span class="text">Tambah Data</span>
      </a>

      <!-- dosen Modal-->
      <div class="modal fade" id="dosenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah dosen Baru</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <?php echo form_open_multipart("dosen/input") ?>
            <div class="modal-body">
              <div class="form-group">
                <label for=""><b>Id dosen</b></label>
                <input type="text" class="form-control" placeholder="Masukkan Id dosen..." name="dosen_id" required="required">
              </div>
              <div class="form-group">
                <label for=""><b>NIP/NIDN</b></label>
                <input type="text" class="form-control" placeholder="Masukkan Nip/Nidn dosen..." name="nomor_induk" required="required">
              </div>
              <div class="form-group">
                <label for=""><b>Nama dosen</b></label>
                <input type="text" class="form-control" placeholder="Masukkan Nama dosen..." name="dosen_nama" required="required">
              </div>
              <div class="form-group">
                <label for=""><b>Jabatan Fungsional</b></label>
                <select class="form-control" name="jabatan">
                  <option value="">.:: Pilih Jabatan ::.</option>
                  <?php foreach ($subkriteria as $keys) {
                    if ($keys->kriteria_id == 'C2') {
                  ?>
                      <option value="<?php echo $keys->subkriteria_id ?>"><?php echo $keys->subkriteria_nama ?></option>
                  <?php }
                  } ?>
                </select>
              </div>
              <div class="form-group">
                <label for=""><b>Tingkatan Pendidikan</b></label>
                <select class="form-control" name="pendidikan">
                  <option value="">.:: Pilih Tingkatan Pendidikan ::.</option>
                  <?php foreach ($subkriteria as $keys) {
                    if ($keys->kriteria_id == 'C3') {
                  ?>
                      <option value="<?php echo $keys->subkriteria_id ?>"><?php echo $keys->subkriteria_nama ?></option>
                  <?php }
                  } ?>
                </select>
              </div>
              <div class="form-group">
                <label for=""><b>Status</b></label>
                <select class="form-control" name="status">
                  <option value="">.:: Pilih Status ::.</option>
                  <?php foreach ($subkriteria as $keys) {
                    if ($keys->kriteria_id == 'C4') {
                  ?>
                      <option value="<?php echo $keys->subkriteria_id ?>"><?php echo $keys->subkriteria_nama ?></option>
                  <?php }
                  } ?>
                </select>
              </div>
              <hr>
            </div>

            <div class="modal-footer">
              <button class="btn btn-primary" type="submit">Tambah</button>
              <?php echo form_close(); ?>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

            </div>
          </div>
        </div>
      </div>


      <!-- <a href="#" class="btn btn-warning btn-icon-split btn-sm" data-toggle="modal" data-target="#importdosenModal">
        <span class="icon text-white-50">
          <i class="fas fa-file-upload"></i>
        </span>
        <span class="text">Import Data</span>
      </a> -->

      <!-- Import Data Dosen Modal-->
      <div class="modal fade" id="importdosenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Import Data Dosen</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>

            <form method="post" id="import_form" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <a href="<?php echo base_url("upload/excel/format_dosen.xlsx"); ?>">Download Format</a><br>
                  <label for=""><b>Import Data</b></label>
                  <input type="file" class="form-control" name="file" id="file" required accept=".xls, .xlsx">
                </div>

              </div>
              <div class="modal-footer">
                <input type="submit" name="import" value="Import" class="btn btn-primary" />
            </form>

            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

          </div>
        </div>
      </div>
    </div>

    <a href="<?php echo site_url('dosen') ?>" class="btn btn-success btn-icon-split btn-sm">
      <span class="icon text-white-50">
        <i class="fa fa-refresh"></i>
      </span>
      <span class="text">Refresh Halaman</span>
    </a>

    <!-- <a href="<?php echo site_url('api/dosen_export') ?>" class="btn btn-success btn-icon-split btn-sm">
      <span class="icon text-white-50">
        <i class="fa fa-file-excel-o"></i>
      </span>
      <span class="text">Export Data</span>
    </a> -->

  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 12%;">#</th>
            <th>NIP/NIDN</th>
            <th>Nama dosen</th>
            <th>Jabatan</th>
            <th>Tingkatan Pendidikan</th>
            <th>Status</th>
          </tr>
        </thead>

        <tbody>
          <?php $no = 1;
          foreach ($dosen as $key) { ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td>
                <a href="#" class="btn btn-warning btn-icon-split btn-sm" data-toggle="modal" data-target="#dosenEditModal<?php echo $key->dosen_id ?>">
                  <span class="text">
                    <i class="fa fa-edit"></i>
                  </span>
                </a>
                <a href="#" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#dosenRemoveModal<?php echo $key->dosen_id ?>">
                  <span class="text">
                    <i class="fa fa-trash"></i>
                  </span>
                </a>

              </td>
              <td><?php echo $key->nomor_induk ?></td>
              <td><?php echo $key->dosen_nama ?></td>

              <?php
              foreach ($subkriteria as $keys) {
                if ($key->jabatan == $keys->subkriteria_id) { ?>
                  <td><?php echo $keys->subkriteria_nama ?></td>
                <?php }
                if ($key->pendidikan == $keys->subkriteria_id) { ?>
                  <td><?php echo $keys->subkriteria_nama ?></td>
                <?php }
                if ($key->status == $keys->subkriteria_id) { ?>
                  <td><?php echo $keys->subkriteria_nama ?></td>
              <?php }
              } ?>

            </tr>

            <!-- Looping Modal Area -->



            <div class="modal fade" id="dosenEditModal<?php echo $key->dosen_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit dosen</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <?php echo form_open_multipart("dosen/edit") ?>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for=""><b>Id dosen</b></label>
                      <input type="text" class="form-control" placeholder="Masukkan Id dosen..." name="dosen_id" required="required" value="<?php echo $key->dosen_id ?>">
                    </div>
                    <div class="form-group">
                      <label for=""><b>NIP/NIDN</b></label>
                      <input type="text" class="form-control" placeholder="Masukkan Nip/Nidn dosen..." name="nomor_induk" required="required" value="<?php echo $key->nomor_induk ?>">
                    </div>
                    <div class="form-group">
                      <label for=""><b>Nama dosen</b></label>
                      <input type="text" class="form-control" placeholder="Masukkan Nama dosen..." name="dosen_nama" required="required" value="<?php echo $key->dosen_nama ?>">
                    </div>
                    <div class="form-group">
                      <label for=""><b>Jabatan Fungsional</b></label>
                      <select class="form-control" name="jabatan">
                        <option value="">.:: Pilih Jabatan ::.</option>
                        <?php foreach ($subkriteria as $keys) {
                          if ($keys->kriteria_id == 'C2') {
                            if ($key->jabatan == $keys->subkriteria_id) {
                        ?>
                              <option value="<?php echo $keys->subkriteria_id ?>" selected><?php echo $keys->subkriteria_nama ?></option>
                            <?php } else { ?>
                              <option value="<?php echo $keys->subkriteria_id ?>"><?php echo $keys->subkriteria_nama ?></option>
                        <?php }
                          }
                        } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for=""><b>Tingkatan Pendidikan</b></label>
                      <select class="form-control" name="pendidikan">
                        <option value="">.:: Pilih Tingkatan Pendidikan ::.</option>
                        <?php foreach ($subkriteria as $keys) {
                          if ($keys->kriteria_id == 'C3') {
                            if ($key->pendidikan == $keys->subkriteria_id) {
                        ?>
                              <option value="<?php echo $keys->subkriteria_id ?>" selected><?php echo $keys->subkriteria_nama ?></option>
                            <?php } else { ?>
                              <option value="<?php echo $keys->subkriteria_id ?>"><?php echo $keys->subkriteria_nama ?></option>
                        <?php }
                          }
                        } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for=""><b>Status</b></label>
                      <select class="form-control" name="status">
                        <option value="">.:: Pilih Status ::.</option>
                        <?php foreach ($subkriteria as $keys) {
                          if ($keys->kriteria_id == 'C4') {
                            if ($key->status == $keys->subkriteria_id) {
                        ?>
                              <option value="<?php echo $keys->subkriteria_id ?>" selected><?php echo $keys->subkriteria_nama ?></option>
                            <?php } else { ?>
                              <option value="<?php echo $keys->subkriteria_id ?>"><?php echo $keys->subkriteria_nama ?></option>
                        <?php }
                          }
                        } ?>
                      </select>
                    </div>
                    <hr>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-warning" type="submit">Edit</button>
                    <?php echo form_close(); ?>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

                  </div>
                </div>
              </div>
            </div>
            <!-- dosen Modal Remove-->
            <div class="modal fade" id="dosenRemoveModal<?php echo $key->dosen_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus dosen</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <?php echo form_open("dosen/delete") ?>
                  <div class="modal-body">
                    Apakah anda yakin akan menghapus data dosen <b><?php echo $key->dosen_nama ?></b> ?
                    <input type="hidden" class="form-control" name="dosen_id" value="<?php echo $key->dosen_id ?>">
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