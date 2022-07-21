<div class="container-fluid">
  <?php 
    if($this->session->flashdata('add')){ 
      $message = $this->session->flashdata('add');
      $heading = '#Tambah skripsi';
    }else if($this->session->flashdata('update')){ 
      $message = $this->session->flashdata('update');
      $heading = '#Update skripsi';
    }else if($this->session->flashdata('delete')){
      $message = $this->session->flashdata('delete');
      $heading = '#Delete skripsi';  
    } 
  ?>
  <?php if(isset($message)){ ?>
  <script>
    $(document).ready(function(){
      $.toast({
        text : '<?php echo $message;?>',
        heading : '<?php echo $heading;?>',
        position : 'top-right',
        width : 'auto',
        showHideTransition : 'slide',
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
    <?php if($this->session->userdata('group_id') == 1){ ?>
      <a href="<?php echo site_url('verifikasi_skripsi')?>" class="btn btn-warning btn-icon-split btn-sm">
        <span class="icon text-white-50">
          <i class="fa fa-refresh"></i>
        </span>
        <span class="text">Sedang Diproses</span>
      </a>
      
      <a href="<?php echo site_url('verifikasi_skripsi/terima')?>" class="btn btn-success btn-icon-split btn-sm">
        <span class="icon text-white-50">
          <i class="fa fa-refresh"></i>
        </span>
        <span class="text">Upload Diterima</span>
      </a>
      
      <a href="<?php echo site_url('verifikasi_skripsi/tolak')?>" class="btn btn-danger btn-icon-split btn-sm">
        <span class="icon text-white-50">
          <i class="fa fa-refresh"></i>
        </span>
        <span class="text">Upload Ditolak</span>
      </a>
    <?php } ?>
      <a href="<?php echo site_url($this->uri->segment(1))?>" class="btn btn-success btn-icon-split btn-sm">
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
              <th style="width: 7%;">#</th>
              <th>Nim Mahasiswa</th>
              <th>Nama Mahasiswa</th>
              <th>Judul Skripsi</th>
              <th>Status Upload Skripsi</th>
            </tr>
          </thead>
          
          <tbody>
            <?php $no=1; foreach($skripsi as $key){?>
            <tr>
              <td><?php echo $no;?></td>
              <td>
              <?php if($this->session->userdata('group_id') == 2){ ?>
                <a href="<?php echo site_url('verifikasi_skripsi/update/'.$key->skripsi_id.'/'.$this->uri->segment(1))?>" class="btn btn-warning btn-icon-split btn-sm" >
              <?php }  else { ?>
                <a href="<?php echo site_url('verifikasi_skripsi/update/'.$key->skripsi_id)?>" class="btn btn-warning btn-icon-split btn-sm" >
              <?php } ?>
                  <span class="text">
                    <i class="fa fa-eye"></i>
                  </span>
                </a>

              </td>
              <td><?php echo $key->mahasiswa_nim?></td>
                <?php foreach ($mahasiswa as $keys) {
                if($key->mahasiswa_nim == $keys->mahasiswa_nim){
                  ?>
                  <td><?php echo $keys->mahasiswa_nama?></td>
                  <?php 
                  }
                } ?>

              <td><?php echo $key->skripsi_judul?></td>
              <?php 
              if($key->skripsi_status == 0){
                  ?>
                  <td>Proses Pemeriksaan</td>
                  <?php 
                  }else if($key->skripsi_status == 1){ ?>
                  <td>Skripsi Diterima</td>
                  <?php }else{?>
                  <td>Skripsi Ditolak</td>
                  <?php }?>
            </tr>

            <!-- Looping Modal Area -->

            
          

            <!-- skripsi Modal Remove-->
            <div class="modal fade" id="skripsiRemoveModal<?php echo $key->skripsi_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus skripsi</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <?php echo form_open("skripsi/delete")?>
                  <div class="modal-body">
                    Apakah anda yakin akan menghapus data skripsi <b><?php echo $key->skripsi_name ?></b> ?
                    <input type="hidden" class="form-control" name="skripsi_id" value="<?php echo $key->skripsi_id?>">
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


            <?php $no++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->