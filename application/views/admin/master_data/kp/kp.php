<div class="container-fluid">
  <?php 
    if($this->session->flashdata('add')){ 
      $message = $this->session->flashdata('add');
      $heading = '#Tambah kp';
    }else if($this->session->flashdata('update')){ 
      $message = $this->session->flashdata('update');
      $heading = '#Update kp';
    }else if($this->session->flashdata('delete')){
      $message = $this->session->flashdata('delete');
      $heading = '#Delete kp';  
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
  <h1 class="h3 mb-2 text-gray-800">Data kp</h1>
  <!-- <p class="mb-4">Data berikut merupakan kumpulan kp yang berlaku di <b>Dinas Lingkungan Hidup dan Kehutanan</b> - Kota Kendari</p> -->
  <hr>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
    <?php if($this->session->userdata('group_id') == 3){ if($kp == false){?>
      <a href="<?php echo site_url('kp/add')?>" class="btn btn-primary btn-icon-split btn-sm">
        <span class="icon text-white-50">
          <i class="fas fa-plus"></i>
        </span>
        <span class="text">Tambah Data</span>
      </a>
      <?php } } ?>

      <a href="<?php echo site_url('kp')?>" class="btn btn-success btn-icon-split btn-sm">
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
              <th style="width: 12%;">#</th>
              <th>Nim Ketua KP</th>
              <th>Nama Ketua KP</th>
              <th>Judul kp</th>
              <th>Tahun KP</th>
              <th>Tempat KP</th>
            </tr>
          </thead>
          
          <tbody>
            <?php $no=1; foreach($kp as $key){?>
            <tr>
              <td><?php echo $no;?></td>
              <td>
              <?php if($this->session->userdata('group_id') == 3){ ?>
                <a href="<?php echo site_url('kp/update/'.$key->kp_id)?>" class="btn btn-warning btn-icon-split btn-sm" >
                  <span class="text">
                    <i class="fa fa-edit"></i>
                  </span>
                </a>
                <a href="#" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#kpRemoveModal<?php echo $key->kp_id?>">
                  <span class="text">
                    <i class="fa fa-trash"></i>
                  </span>
                </a>
              <?php } else { ?>
                <a href="<?php echo site_url('kp/update/'.$key->kp_id)?>" class="btn btn-success btn-icon-split btn-sm" >
                  <span class="text">
                    <i class="fa fa-eye"></i>
                  </span>
                </a>
              <?php } ?>

              </td>
              <td><?php echo $key->kp_ketua?></td>
                <?php foreach ($mahasiswa as $keys) {
                if($key->kp_ketua == $keys->mahasiswa_nim){
                  ?>
                  <td><?php echo $keys->mahasiswa_nama?></td>
                  <?php 
                  }
                } ?>

              <td><?php echo $key->kp_judul?></td>
              <td><?php echo $key->kp_tahun?></td>
              <td><?php echo $key->kp_tempat?></td>
            </tr>

            <!-- Looping Modal Area -->

            
          

            <!-- kp Modal Remove-->
            <div class="modal fade" id="kpRemoveModal<?php echo $key->kp_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus kp</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <?php echo form_open("kp/delete")?>
                  <div class="modal-body">
                    Apakah anda yakin akan menghapus data kp <b><?php echo $key->kp_ketua ?></b> ?
                    <input type="hidden" class="form-control" name="kp_id" value="<?php echo $key->kp_id?>">
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