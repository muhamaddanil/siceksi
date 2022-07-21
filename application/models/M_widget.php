<?php
defined('BASEPATH') or exit('No direct script access allowed');
class m_widget extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function total_mahasiswa()
  {
    $query  = $this->db->query("SELECT * FROM mahasiswa_tbl");
    return $query->num_rows();
  }
  public function total_skripsi()
  {
    $query  = $this->db->query("SELECT * FROM kategori_skripsi_tbl");
    return $query->num_rows();
  }
  public function total_kategori()
  {
    $query  = $this->db->query("SELECT * FROM skripsi_tbl");
    return $query->num_rows();
  }

  public function total_group()
  {
    $query  = $this->db->query("SELECT * FROM group_tbl");
    return $query->num_rows();
  }
  public function total_user()
  {
    $query  = $this->db->query("SELECT * FROM user_tbl");
    return $query->num_rows();
  }




  function __destruct()
  {
    $this->db->close();
  }
}
