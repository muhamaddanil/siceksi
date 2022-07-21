<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pengesahan_pembimbing extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    error_reporting(0);
    $this->load->model("m_skripsi");
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
    $data['skripsi'] = $this->m_skripsi->fetch_data_perpembimbing($this->session->userdata('id'));
    $data['mahasiswa'] = $this->m_mahasiswa->fetch_data();
    $data['dosen'] = $this->m_dosen->fetch_data();
    $this->load->view("attribute/header", $setting);
    $this->load->view("attribute/menus", $setting);
    $this->load->view("admin/master_data/verifikasi_skripsi/skripsi", $data);
    $this->load->view("attribute/footer", $setting);
  }

  public function update() {
    $setting['settings_app'] = $this->m_setting->fetch_setting();
    $data['skripsi'] = $this->m_skripsi->get($this->uri->segment(3));
    $data['mahasiswa'] = $this->m_mahasiswa->fetch_data();
    $data['dosen'] = $this->m_dosen->fetch_data();
    $this->load->view("attribute/header", $setting);
    $this->load->view("attribute/menus", $setting);
    $this->load->view("admin/master_data/verifikasi_skripsi/skripsi_edit", $data);
    $this->load->view("attribute/footer", $setting);
  }
}
