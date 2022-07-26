<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    error_reporting(0);
    $this->load->model("m_login");
    $this->load->model("m_widget");
    $this->load->model("m_setting");
  }

  public function index()
  {
    if (!($this->session->userdata('user_id'))) {
      $data['settings_app']   = $this->m_setting->fetch_setting();
      $this->load->view("admin/login/login_page", $data);
    } else {
      $setting['settings_app'] = $this->m_setting->fetch_setting();
      $data['mahasiswa']         = $this->m_widget->total_mahasiswa();
      $data['skripsi']           = $this->m_widget->total_skripsi();
      $data['kategori']         = $this->m_widget->total_kategori();
      $data['log']            = $this->m_setting->get_log();

      $this->load->view("attribute/header", $setting);
      $this->load->view("attribute/menus", $setting);
      $this->load->view("attribute/content", $data);
      $this->load->view("attribute/footer", $setting);
    }
  }

  public function login()
  {
    if ($_POST) {
      $data['username'] = $this->input->post('username');
      $data['password'] = md5($this->input->post('password'));
      $result           = $this->m_login->login($data);
      if (!!($result)) {
        $data = array(
          'user_id'         => $result->user_id,
          'user_name'       => $result->user_name,
          'user_fullname'   => $result->user_fullname,
          'user_photo'      => $result->user_photo,
          'id'     => $result->id,
          'group_id'        => $result->group_id,
          'IsAuthorized'    => true
        );

        $this->session->set_userdata($data);
        redirect('home');
      } else {
        $this->session->set_flashdata('login', 'Username atau Kata Sandi salah!');
        redirect('home');
      }
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('' . base_url());
  }
}
