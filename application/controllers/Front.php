<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Front extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    error_reporting(0);
    $this->load->model("m_setting");
  }

  public function index()
  {
    $this->load->view("attribute/front/index");
  }
}
