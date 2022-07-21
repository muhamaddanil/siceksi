<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kp extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    error_reporting(0);
    $this->load->model("m_kp");
    $this->load->model("m_mahasiswa");
    $this->load->model("m_dosen");
    $this->load->model("m_setting");
    $this->load->library('upload');
    if (!($this->session->userdata('user_id'))) {
      redirect('home');
    }
  }

  public function index()
  {
    $setting['settings_app'] = $this->m_setting->fetch_setting();
    if ($this->session->userdata('group_id') == 3) { 
      $data['kp'] = $this->m_kp->fetch_data_permahasiswa($this->session->userdata('id'));
    }else{
      $data['kp'] = $this->m_kp->fetch_data();
    }
    // print_r($data['kp']);
    // die;
    
    $data['mahasiswa'] = $this->m_mahasiswa->fetch_data();
    $data['dosen'] = $this->m_dosen->fetch_data();
    $this->load->view("attribute/header", $setting);
    $this->load->view("attribute/menus", $setting);
    $this->load->view("admin/master_data/kp/kp", $data);
    $this->load->view("attribute/footer", $setting);
  }

  public function add() {
    $setting['settings_app'] = $this->m_setting->fetch_setting();
    $data['kp'] = $this->m_kp->fetch_data();
    $data['mahasiswa'] = $this->m_mahasiswa->fetch_data();
    $data['dosen'] = $this->m_dosen->fetch_data();
    $this->load->view("attribute/header", $setting);
    $this->load->view("attribute/menus", $setting);
    $this->load->view("admin/master_data/kp/kp_add", $data);
    $this->load->view("attribute/footer", $setting);
  }

  public function update() {
    $setting['settings_app'] = $this->m_setting->fetch_setting();
    $data['kp'] = $this->m_kp->get($this->uri->segment(3));
    $data['mahasiswa'] = $this->m_mahasiswa->fetch_data();
    $data['dosen'] = $this->m_dosen->fetch_data();
    $this->load->view("attribute/header", $setting);
    $this->load->view("attribute/menus", $setting);
    if ($this->session->userdata('group_id') == 3) { 
      $this->load->view("admin/master_data/kp/kp_edit", $data);
    }else{
      $this->load->view("admin/master_data/kp/kp_lihat", $data);
    }
    
    $this->load->view("attribute/footer", $setting);
  }

  public function input()
  {
    $config['upload_path']   = './upload/kp/kp_pengesahan_pembimbing/';
    $config['allowed_types'] = "pdf|doc|docx";
    $config['overwrite']     = "true";
    $config['max_size']      = "20000000000";
    $config['max_width']     = "10000";
    $config['max_height']    = "10000";
    $config['file_name']     = 'kp-pengesahan-pembimbing-' . $this->input->post('kp_ketua');
    $this->upload->initialize($config);
    $this->upload->do_upload('pengesahan_pembimbing');
    $dat1                                           = $this->upload->data();
    $data['kp_pengesahan']          = $dat1['file_name'];

    $config3['upload_path']   = './upload/kp/kp_file/';
    $config3['allowed_types'] = "pdf|doc|docx";
    $config3['overwrite']     = "true";
    $config3['max_size']      = "20000000000";
    $config3['max_width']     = "10000";
    $config3['max_height']    = "10000";
    $config3['file_name']     = 'kp-file-' . $this->input->post('kp_ketua');
    $this->upload->initialize($config3);
    $this->upload->do_upload('kp_full');
    $dat3                                           = $this->upload->data();
    $data['kp_file']          = $dat3['file_name'];
    
    if ($this->session->userdata('group_id') == 3) { 
      $data['kp_ketua']            = $this->session->userdata('id');
    }else{
      $data['kp_ketua']            = $this->input->post('kp_ketua');
    }
    
    $data['kp_judul']            = $this->input->post('kp_judul');
    $data['kp_tahun']            = $this->input->post('kp_tahun');
    $data['kp_upload_datetime']            = date('Y-m-d H:i:s');
    $data['kp_pembimbing']            = $this->input->post('kp_pembimbing');
    $data['kp_tempat']            = $this->input->post('kp_tempat');
    $data['kp_anggota1']            = $this->input->post('kp_anggota1');
    $data['kp_anggota2']            = $this->input->post('kp_anggota2');
    $this->session->set_flashdata('add', 'Berhasil Tambah kp <b>' . $data['kp_ketua'] . '</b>');
    $this->m_kp->input($data);


    redirect('kp');
  }

  public function edit()
  {
    $config['upload_path']   = './upload/kp/kp_pengesahan_pembimbing/';
    $config['allowed_types'] = "pdf|doc|docx";
    $config['overwrite']     = "true";
    $config['max_size']      = "20000000000";
    $config['max_width']     = "10000";
    $config['max_height']    = "10000";
    $config['file_name']     = 'kp-pengesahan-pembimbing-' . $this->input->post('kp_ketua');
    $this->upload->initialize($config);
    $this->upload->do_upload('pengesahan_pembimbing');
    $dat1                                           = $this->upload->data();
    $data['kp_pengesahan']          = $dat1['file_name'];

    $config3['upload_path']   = './upload/kp/kp_file/';
    $config3['allowed_types'] = "pdf|doc|docx";
    $config3['overwrite']     = "true";
    $config3['max_size']      = "20000000000";
    $config3['max_width']     = "10000";
    $config3['max_height']    = "10000";
    $config3['file_name']     = 'kp-file-' . $this->input->post('kp_ketua');
    $this->upload->initialize($config3);
    $this->upload->do_upload('kp_full');
    $dat3                                           = $this->upload->data();
    $data['kp_file']          = $dat3['file_name'];
    
    if ($this->session->userdata('group_id') == 3) { 
      $data['kp_ketua']            = $this->session->userdata('id');
    }else{
      $data['kp_ketua']            = $this->input->post('kp_ketua');
    }
    
    $data['kp_judul']            = $this->input->post('kp_judul');
    $data['kp_tahun']            = $this->input->post('kp_tahun');
    $data['kp_upload_datetime']            = date('Y-m-d H:i:s');
    $data['kp_pembimbing']            = $this->input->post('kp_pembimbing');
    $data['kp_tempat']            = $this->input->post('kp_tempat');
    $data['kp_anggota1']            = $this->input->post('kp_anggota1');
    $data['kp_anggota2']            = $this->input->post('kp_anggota2');
    $this->session->set_flashdata('update', 'Berhasil Edit kp <b>' . $data['kp_ketua'] . '</b>');
    $this->m_kp->edit($data);

    redirect('kp');
  }

  public function delete()
  {
    $this->session->set_flashdata('delete', 'kp <b>' . $this->input->post('kp_id') . '</b> telah dihapus !');
    $this->m_kp->delete($this->input->post('kp_id'));
    redirect('kp');
  }
}
