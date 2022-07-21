<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_kategori_skripsi extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function fetch_data()
  {
    $this->db->select('*');
    $this->db->from('kategori_skripsi_tbl');
    $this->db->order_by("kategori_skripsi_id", "asc");
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }

  public function get($id)
  {
    $this->db->select('*');
    $this->db->from('kategori_skripsi_tbl');
    $this->db->where('kategori_skripsi_id', $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }

  public function input($data)
  {
    $this->db->insert('kategori_skripsi_tbl', $data);
  }

  public function edit($data)
  {
    $this->db->update('kategori_skripsi_tbl', $data, array(
      'kategori_skripsi_id' => $data['kategori_skripsi_id']
    ));
  }

  public function delete($id)
  {
    $this->db->delete('kategori_skripsi_tbl', array('kategori_skripsi_id' => $id));
  }

  public function total_skripsi($id)
  {
    $query  = $this->db->query("SELECT * FROM skripsi_tbl where kategori_skripsi_id = '$id' ");
    return $query->num_rows();
  }
}
