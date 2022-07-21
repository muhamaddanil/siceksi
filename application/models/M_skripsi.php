<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_skripsi extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function fetch_data()
  {
    $this->db->select('*');
    $this->db->from('skripsi_tbl a');
    $this->db->join('mahasiswa_tbl b', 'a.mahasiswa_nim=b.mahasiswa_nim', 'LEFT');
    $this->db->join('kategori_skripsi_tbl c', 'a.kategori_skripsi_id=c.kategori_skripsi_id', 'LEFT');
    // $this->db->order_by("skripsi_id", "asc");
    // $this->db->where('skripsi_id', $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }

  public function fetch_data_permahasiswa($id)
  {
    $this->db->select('*');
    $this->db->from('skripsi_tbl a');
    $this->db->join('mahasiswa_tbl b', 'a.mahasiswa_nim=b.mahasiswa_nim', 'LEFT');
    $this->db->join('kategori_skripsi_tbl c', 'a.kategori_skripsi_id=c.kategori_skripsi_id', 'LEFT');
    // $this->db->order_by("skripsi_id", "asc");
    $this->db->where('a.mahasiswa_nim', $id);
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
    $this->db->from('skripsi_tbl a');
    $this->db->join('mahasiswa_tbl b', 'a.mahasiswa_nim=b.mahasiswa_nim', 'LEFT');
    $this->db->join('kategori_skripsi_tbl c', 'a.kategori_skripsi_id=c.kategori_skripsi_id', 'LEFT');
    $this->db->where('a.skripsi_id', $id);
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
    $this->db->insert('skripsi_tbl', $data);
  }

  public function input_batch($data)
  {
    $this->db->insert_batch('skripsi_tbl', $data);
  }

  public function edit($data)
  {
    $this->db->update('skripsi_tbl', $data, array(
      'skripsi_id' => $data['skripsi_id']
    ));
  }

  public function delete($id)
  {
    $this->db->delete('skripsi_tbl', array('skripsi_id' => $id));
  }

  
}
