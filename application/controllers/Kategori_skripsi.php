<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kategori_skripsi extends CI_Controller {
  function __construct() {
    parent::__construct();
    error_reporting(0);
    $this->load->model("m_kategori_skripsi");
    $this->load->model("m_setting");
    if (!($this->session->userdata('user_id'))) {
      redirect('home');
    }
  }
  
  public function index() {
    $setting['settings_app'] = $this->m_setting->fetch_setting();
    $data['kategori_skripsi'] = $this->m_kategori_skripsi->fetch_data();
    $this->load->view("attribute/header",$setting);
    $this->load->view("attribute/menus",$setting);
    $this->load->view("admin/master_data/kategori_skripsi", $data);
    $this->load->view("attribute/footer",$setting);
  }

  
  
  public function input() {
    $data['kategori_skripsi_id']    = "";
    $data['kategori_skripsi_nama']  = $this->input->post('kategori_skripsi_nama');
    $this->session->set_flashdata('add', 'Berhasil Tambah kategori_skripsi ' . $data['kategori_skripsi_nama']);

    $this->m_kategori_skripsi->input($data);
    redirect('kategori_skripsi');
  }
  
  public function edit() {
    $data['kategori_skripsi_id']    = $this->input->post('kategori_skripsi_id');
    $data['kategori_skripsi_nama']  = $this->input->post('kategori_skripsi_nama');
    $this->session->set_flashdata('update', 'Berhasil Update kategori_skripsi ' . $data['kategori_skripsi_nama']);
    
    $this->m_kategori_skripsi->edit($data);
    redirect('kategori_skripsi');
      
  }
  
  public function delete() {
    $this->m_kategori_skripsi->delete($this->input->post('kategori_skripsi_id'));
    $this->session->set_flashdata('delete', 'kategori_skripsi ' . $this->input->post('kategori_skripsi_nama')." telah dihapus !");
    redirect('kategori_skripsi');
  }
  
}
