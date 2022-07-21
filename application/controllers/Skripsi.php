<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Skripsi extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    error_reporting(0);
    $this->load->model("m_skripsi");
    $this->load->model("m_kategori_skripsi");
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
    $data['skripsi'] = $this->m_skripsi->fetch_data();
    $this->load->view("attribute/header", $setting);
    $this->load->view("attribute/menus", $setting);
    $this->load->view("admin/master_data/skripsi/skripsi", $data);
    $this->load->view("attribute/footer", $setting);
  }

  public function add()
  {
    $setting['settings_app'] = $this->m_setting->fetch_setting();
    $data['skripsi'] = $this->m_skripsi->fetch_data();
    $data['mahasiswa'] = $this->m_mahasiswa->fetch_data();
    $data['dosen'] = $this->m_dosen->fetch_data();
    $data['kategori_skripsi'] = $this->m_kategori_skripsi->fetch_data();
    $this->load->view("attribute/header", $setting);
    $this->load->view("attribute/menus", $setting);
    $this->load->view("admin/master_data/skripsi/skripsi_add", $data);
    $this->load->view("attribute/footer", $setting);
  }

  public function update()
  {
    $setting['settings_app'] = $this->m_setting->fetch_setting();
    $data['skripsi'] = $this->m_skripsi->get($this->uri->segment(3));
    $data['mahasiswa'] = $this->m_mahasiswa->fetch_data();
    $data['dosen'] = $this->m_dosen->fetch_data();
    $data['kategori_skripsi'] = $this->m_kategori_skripsi->fetch_data();
    $this->load->view("attribute/header", $setting);
    $this->load->view("attribute/menus", $setting);
    $this->load->view("admin/master_data/skripsi/skripsi_edit", $data);
    $this->load->view("attribute/footer", $setting);
  }

  public function input()
  {
    $config3['upload_path']   = './upload/skripsi_full/';
    $config3['allowed_types'] = "pdf|doc|docx";
    $config3['overwrite']     = "true";
    $config3['max_size']      = "20000000000";
    $config3['max_width']     = "10000";
    $config3['max_height']    = "10000";
    $config3['file_name']     = 'skripsi-full-' . $this->input->post('mahasiswa_nim');
    $this->upload->initialize($config3);
    $this->upload->do_upload('skripsi_full');
    $dat3                                           = $this->upload->data();

    $data['skripsi_file_full']          = $dat3['file_name'];
    $data['mahasiswa_nim']            = $this->input->post('mahasiswa_nim');
    $data['skripsi_judul']            = $this->input->post('skripsi_judul');
    $data['kategori_skripsi_id']            = $this->input->post('kategori_skripsi_id');
    $this->session->set_flashdata('add', 'Berhasil Tambah skripsi <b>' . $data['mahasiswa_nim'] . '</b>');
    $this->m_skripsi->input($data);


    redirect('skripsi');
  }

  public function edit()
  {
    $config3['upload_path']   = './upload/skripsi_full/';
    $config3['allowed_types'] = "pdf|doc|docx";
    $config3['overwrite']     = "true";
    $config3['max_size']      = "20000000000";
    $config3['max_width']     = "10000";
    $config3['max_height']    = "10000";
    $config3['file_name']     = 'skripsi-full-' . $this->input->post('mahasiswa_nim');
    $this->upload->initialize($config3);
    $this->upload->do_upload('skripsi_full');
    $dat3                                           = $this->upload->data();

    $data['skripsi_file_full']          = $dat3['file_name'];
    $data['skripsi_id']            = $this->input->post('skripsi_id');
    $data['mahasiswa_nim']            = $this->input->post('mahasiswa_nim');
    $data['skripsi_judul']            = $this->input->post('skripsi_judul');
    $data['kategori_skripsi_id']            = $this->input->post('kategori_skripsi_id');

    $this->session->set_flashdata('update', 'Berhasil Edit skripsi <b>' . $data['mahasiswa_nim'] . '</b>');
    $this->m_skripsi->edit($data);

    redirect('skripsi');
  }

  public function delete()
  {
    $this->session->set_flashdata('delete', 'skripsi <b>' . $this->input->post('skripsi_id') . '</b> telah dihapus !');
    $this->m_skripsi->delete($this->input->post('skripsi_id'));
    redirect('skripsi');
  }
}
