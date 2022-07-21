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
  <script src="<?php echo base_url()?>assets/plugin-new/ckeditor/ckeditor.js"></script>
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data kp</h1>
  <!-- <p class="mb-4">Data berikut merupakan kumpulan kp yang berlaku di <b>Dinas Lingkungan Hidup dan Kehutanan</b> - Kota Kendari</p> -->
  <hr>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      
      <a href="<?php echo site_url('kp')?>" class="btn btn-warning btn-icon-split btn-sm">
        <span class="icon text-white-50">
          <i class="fa fa-arrow-left"></i>
        </span>
        <span class="text">Kembali</span>
      </a>
      
    </div>
    <div class="card-body">
      
      <?php if ($this->session->userdata('group_id') == 1) { ?>
      <div class="form-group">
        <label for=""><b>Nama Mahasiswa</b></label>
        <select disabled="true" class="form-control" name="kp_ketua" required="required">
          <option value="">-Pilih Mahasiswa-</option>
          <?php foreach($mahasiswa as $j){
              if($kp[0]->kp_ketua==$j->mahasiswa_nim){
          ?>
          <option value="<?php echo $j->mahasiswa_nim?>" selected><?php echo $j->mahasiswa_nama?></option>
          <?php }else{ ?>
            <option value="<?php echo $j->mahasiswa_nim?>" ><?php echo $j->mahasiswa_nama?></option>
          <?php  } }?>
        </select>
      </div>
      <?php } ?>
      
      <label for=""><b>*Isi jika memiliki anggota*</b></label>
      <div class="form-group">
        <label for=""><b>Nama Anggota 1</b></label>
        <select disabled="true" class="form-control" name="kp_anggota1">
          <option value="">-Pilih Mahasiswa-</option>
          <?php foreach($mahasiswa as $j){
             if($kp[0]->kp_anggota1==$j->mahasiswa_nim){
              ?>
              <option value="<?php echo $j->mahasiswa_nim?>" selected><?php echo $j->mahasiswa_nama?></option>
              <?php }else{ ?>
                <option value="<?php echo $j->mahasiswa_nim?>" ><?php echo $j->mahasiswa_nama?></option>
              <?php  } }?>
        </select>
      </div>
      
      <div class="form-group">
        <label for=""><b>Nama Anggota 2</b></label>
        <select disabled="true" class="form-control" name="kp_anggota2">
          <option value="">-Pilih Mahasiswa-</option>
          <?php foreach($mahasiswa as $j){
             if($kp[0]->kp_anggota2==$j->mahasiswa_nim){
              ?>
              <option value="<?php echo $j->mahasiswa_nim?>" selected><?php echo $j->mahasiswa_nama?></option>
              <?php }else{ ?>
                <option value="<?php echo $j->mahasiswa_nim?>" ><?php echo $j->mahasiswa_nama?></option>
              <?php  } }?>
        </select>
      </div>
      

      <div class="form-group">
        <label for=""><b>Juduk KP</b></label>
        <input readonly type="text" class="form-control" name="kp_judul" required="required" value="<?php echo $kp[0]->kp_judul ?>">
      </div>

      <div class="form-group">
        <label for=""><b>KP Tahun</b></label>
        <input readonly type="number" class="form-control" name="kp_tahun" required="required" value="<?php echo $kp[0]->kp_tahun ?>">
      </div>
      
      <div class="form-group">
        <label for=""><b>KP Tempat</b></label>
        <input readonly type="text" class="form-control" name="kp_tempat" required="required" value="<?php echo $kp[0]->kp_tempat ?>">
      </div>

      <div class="form-group">
        <label for=""><b>Dosen Pembimbing</b></label>
        <select disabled="true" class="form-control" name="kp_pembimbing" required="required" >
          <option value="">-Pilih Dosen-</option>
          <?php foreach($dosen as $j){
          if($kp[0]->kp_pembimbing==$j->nomor_induk){
            ?>
            <option value="<?php echo $j->nomor_induk?>" selected><?php echo $j->dosen_nama?></option>
            <?php }else{ ?>
              <option value="<?php echo $j->nomor_induk?>"><?php echo $j->dosen_nama?></option>
            <?php  } }?>
        </select>
      </div>
      
      <div class="form-group">
        <label for=""><b>Download Pengesahan Pembimbing</b></label>
        <a href="<?php echo base_url() .'upload/kp/kp_pengesahan_pembimbing/'. $kp[0]->kp_pengesahan ?>" target="_blank">
          <i class="fa fa-fw fa-file-pdf"></i>
          <span>Download</span>
        </a>
      </div>

      <div class="form-group">
        <label for=""><b>Download Proposal KP</b></label>
        <a href="<?php echo base_url() .'upload/kp/kp_file/'. $kp[0]->kp_file ?>" target="_blank">
          <i class="fa fa-fw fa-file-pdf"></i>
          <span>Download</span>
        </a>
      </div>

      <hr>
    </div>
  </div>

  <script type="text/javascript">
    CKEDITOR.replace( 'editor1' );
  </script>

</div>
<!-- /.container-fluid -->