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
  <script src="<?php echo base_url()?>assets/plugin-new/ckeditor/ckeditor.js"></script>
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data skripsi</h1>
  <!-- <p class="mb-4">Data berikut merupakan kumpulan skripsi yang berlaku di <b>Dinas Lingkungan Hidup dan Kehutanan</b> - Kota Kendari</p> -->
  <hr>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
    <?php if($this->session->userdata('group_id') == 2){ 
            if($this->uri->segment(4)=='pengesahan_penguji'){ ?>
              <a href="<?php echo site_url('pengesahan_penguji')?>" class="btn btn-warning btn-icon-split btn-sm">
            <?php } else { ?>
              <a href="<?php echo site_url('pengesahan_pembimbing')?>" class="btn btn-warning btn-icon-split btn-sm">
    <?php } } else { ?>
      <a href="<?php echo site_url('verifikasi_skripsi')?>" class="btn btn-warning btn-icon-split btn-sm">
    <?php } ?>
        <span class="icon text-white-50">
          <i class="fa fa-arrow-left"></i>
        </span>
        <span class="text">Kembali</span>
      </a>
    </div>
    <div class="card-body">
      
      <?php echo form_open_multipart("verifikasi_skripsi/edit")?>

      <div class="form-group">
        <label for=""><b>Nama Mahasiswa</b></label>
        <select disabled="true" class="form-control" name="mahasiswa_nim" required="required">
          <option value="">-Pilih Mahasiswa-</option>
          <?php foreach($mahasiswa as $j){
              if($skripsi[0]->mahasiswa_nim==$j->mahasiswa_nim){
          ?>
          <option value="<?php echo $j->mahasiswa_nim?>" selected><?php echo $j->mahasiswa_nama?></option>
          <?php }else{ ?>
            <option value="<?php echo $j->mahasiswa_nim?>" ><?php echo $j->mahasiswa_nama?></option>
          <?php  } }?>
        </select>
      </div>

      <div class="form-group">
        <label for=""><b>Juduk Skripsi</b></label>
        <input readonly type="text" class="form-control" name="skripsi_judul" required="required" value="<?php echo $skripsi[0]->skripsi_judul ?>">
      </div>

      <div class="form-group">
        <label for=""><b>Waktu Selesai</b></label>
        <input readonly type="date" class="form-control" name="skripsi_waktu_selesai" required="required" value="<?php echo $skripsi[0]->skripsi_waktu_selesai ?>">
      </div>

      <div class="form-group">
        <label for=""><b>Dosen Pembimbing 1</b></label>
        <select disabled="true" class="form-control" name="skripsi_pembimbing_1" required="required">
          <option value="">-Pilih Dosen-</option>
          <?php foreach($dosen as $j){
              if($skripsi[0]->skripsi_pembimbing_1==$j->nomor_induk){
          ?>
          <option value="<?php echo $j->nomor_induk?>" selected><?php echo $j->dosen_nama?></option>
          <?php }else{ ?>
            <option value="<?php echo $j->nomor_induk?>"><?php echo $j->dosen_nama?></option>
          <?php  } }?>
        </select>
      </div>

      <div class="form-group">
        <label for=""><b>Dosen Pembimbing 2</b></label>
        <select disabled="true" class="form-control" name="skripsi_pembimbing_2" required="required">
          <option value="">-Pilih Dosen-</option>
          <?php foreach($dosen as $j){
              if($skripsi[0]->skripsi_pembimbing_2==$j->nomor_induk){
          ?>
          <option value="<?php echo $j->nomor_induk?>" selected><?php echo $j->dosen_nama?></option>
          <?php }else{ ?>
            <option value="<?php echo $j->nomor_induk?>"><?php echo $j->dosen_nama?></option>
          <?php  } }?>
        </select>
      </div>

      <div class="form-group">
        <label for=""><b>Dosen Penguji 1</b></label>
        <select disabled="true" class="form-control" name="skripsi_penguji_1" required="required">
          <option value="">-Pilih Dosen-</option>
          <?php foreach($dosen as $j){
              if($skripsi[0]->skripsi_penguji_1==$j->nomor_induk){
          ?>
          <option value="<?php echo $j->nomor_induk?>" selected><?php echo $j->dosen_nama?></option>
          <?php }else{ ?>
            <option value="<?php echo $j->nomor_induk?>"><?php echo $j->dosen_nama?></option>
          <?php  } }?>
        </select>
      </div>

      <div class="form-group">
        <label for=""><b>Dosen Penguji 2</b></label>
        <select disabled="true" class="form-control" name="skripsi_penguji_2" required="required">
          <option value="">-Pilih Dosen-</option>
          <?php foreach($dosen as $j){
              if($skripsi[0]->skripsi_penguji_2==$j->nomor_induk){
          ?>
          <option value="<?php echo $j->nomor_induk?>" selected><?php echo $j->dosen_nama?></option>
          <?php }else{ ?>
            <option value="<?php echo $j->nomor_induk?>"><?php echo $j->dosen_nama?></option>
          <?php  } }?>
        </select>
      </div>

      <div class="form-group">
        <label for=""><b>Dosen Penguji 3</b></label>
        <select disabled="true" class="form-control" name="skripsi_penguji_3" required="required">
          <option value="">-Pilih Dosen-</option>
          <?php foreach($dosen as $j){
              if($skripsi[0]->skripsi_penguji_3==$j->nomor_induk){
          ?>
          <option value="<?php echo $j->nomor_induk?>" selected><?php echo $j->dosen_nama?></option>
          <?php }else{ ?>
            <option value="<?php echo $j->nomor_induk?>"><?php echo $j->dosen_nama?></option>
          <?php  } }?>
        </select>
      </div>

      <?php if($this->session->userdata('group_id') == 2){ 
            if($this->uri->segment(4)=='pengesahan_penguji'){ ?>
              <div class="form-group">
                <label for=""><b>Download Pengesahan Penguji</b></label>
                <a href="<?php echo base_url() .'upload/pengesahan_penguji/'. $skripsi[0]->skripsi_pengesahan_penguji ?>" target="_blank">
                  <i class="fa fa-fw fa-file-pdf"></i>
                  <span>Download</span>
                </a>
              </div>

              <div class="form-group">
                <label for=""><b>Download Skripsi Full</b></label>
                <a href="<?php echo base_url() .'upload/skripsi_full/'. $skripsi[0]->skripsi_file_full ?>" target="_blank">
                  <i class="fa fa-fw fa-file-pdf"></i>
                  <span>Download</span>
                </a>
                <input type="hidden" class="form-control" name="skripsi_id" value="<?php echo $skripsi[0]->skripsi_id ?>">
              </div>
            <?php } else { ?>
              <div class="form-group">
                <label for=""><b>Download Pengesahan Pembimbing</b></label>
                <a href="<?php echo base_url() .'upload/pengesahan_pembimbing/'. $skripsi[0]->skripsi_pengesahan_pembimbing ?>" target="_blank">
                  <i class="fa fa-fw fa-file-pdf"></i>
                  <span>Download</span>
                </a>
              </div>

              <div class="form-group">
                <label for=""><b>Download Skripsi Full</b></label>
                <a href="<?php echo base_url() .'upload/skripsi_full/'. $skripsi[0]->skripsi_file_full ?>" target="_blank">
                  <i class="fa fa-fw fa-file-pdf"></i>
                  <span>Download</span>
                </a>
                <input type="hidden" class="form-control" name="skripsi_id" value="<?php echo $skripsi[0]->skripsi_id ?>">
              </div>
      <?php } } else { ?>
        <div class="form-group">
          <label for=""><b>Download Pengesahan Pembimbing</b></label>
          <a href="<?php echo base_url() .'upload/pengesahan_pembimbing/'. $skripsi[0]->skripsi_pengesahan_pembimbing ?>" target="_blank">
            <i class="fa fa-fw fa-file-pdf"></i>
            <span>Download</span>
          </a>
        </div>

        <div class="form-group">
          <label for=""><b>Download Pengesahan Penguji</b></label>
          <a href="<?php echo base_url() .'upload/pengesahan_penguji/'. $skripsi[0]->skripsi_pengesahan_penguji ?>" target="_blank">
            <i class="fa fa-fw fa-file-pdf"></i>
            <span>Download</span>
          </a>
        </div>

        <div class="form-group">
          <label for=""><b>Download Skripsi Sebagian</b></label>
          <a href="<?php echo base_url() .'upload/skripsi_sebagian/'. $skripsi[0]->skripsi_file_separuh ?>" target="_blank">
            <i class="fa fa-fw fa-file-pdf"></i>
            <span>Download</span>
          </a>
        </div>

        <div class="form-group">
          <label for=""><b>Download Skripsi Full</b></label>
          <a href="<?php echo base_url() .'upload/skripsi_full/'. $skripsi[0]->skripsi_file_full ?>" target="_blank">
            <i class="fa fa-fw fa-file-pdf"></i>
            <span>Download</span>
          </a>
          <input type="hidden" class="form-control" name="skripsi_id" value="<?php echo $skripsi[0]->skripsi_id ?>">
        </div>
      <?php } ?>
      
      
      <?php if ($this->session->userdata('group_id') == 1) { ?>
        <div class="form-group">
        <label for=""><b>Status Verifikasi Skripsi</b></label>
        <select class="form-control" name="skripsi_status" required="required">
          <option value="">-Pilih Status-</option>
          <?php if($skripsi[0]->skripsi_status==0){
          ?>
          <option value="0" selected>Proses Pemeriksaan</option>
          <option value="1" >Skripsi Diterima</option>
          <option value="2" >Skripsi Ditolak</option>
          <?php }else if($skripsi[0]->skripsi_status==1){ ?>
          <option value="0" >Proses Pemeriksaan</option>
          <option value="1" selected>Skripsi Diterima</option>
          <option value="2" >Skripsi Ditolak</option>
          <?php  }else if($skripsi[0]->skripsi_status==2){ ?>
            <option value="0" >Proses Pemeriksaan</option>
            <option value="1" >Skripsi Diterima</option>
            <option value="2" selected>Skripsi Ditolak</option>
            <?php  }else{ ?>
            <option value="0" >Proses Pemeriksaan</option>
            <option value="1" >Skripsi Diterima</option>
            <option value="2" >Skripsi Ditolak</option>
              <?php  } ?>
        </select>
      </div>

      <div class="form-group">
        <label for=""><b>Catatan Koreksi</b></label>
        <input type="text" class="form-control" name="skripsi_komentar">
      </div>

      <hr>
      <button style="width: 100%" class="btn btn-warning" type="submit">Verifikasi skripsi</button>
      <?php } ?>
      
      
      <?php echo form_close(); ?>
    </div>
  </div>

  <script type="text/javascript">
    CKEDITOR.replace( 'editor1' );
  </script>

</div>
<!-- /.container-fluid -->