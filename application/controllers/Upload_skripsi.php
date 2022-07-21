<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';
class Upload_skripsi extends CI_Controller
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
    $this->load->view("admin/master_data/upload_skripsi", $data);
    $this->load->view("attribute/footer", $setting);
  }

  public function cek_kesamaan()
  {
    $start_time = microtime(true);
    $data_fitering = ['yang', 'dan', 'di', 'dari'];
    $setting['settings_app'] = $this->m_setting->fetch_setting();
    $skripsi = $this->m_skripsi->fetch_data();
    $data['file_cek'] = $this->session->userdata('file_cek');

    // ------------------------------------------ Text Preprocessing ----------------------------------------------------- //
    // pdf to text == data input
    $parser = new \Smalot\PdfParser\Parser();
    $pdf    = $parser->parseFile('./upload/file_cek/' . $data['file_cek']);
    $text = $pdf->getText();

    // case folding -> perubahan huruf besar ke kecil
    $text = strtolower($text);

    // Cleasing & Penghapusan spasi
    $text = preg_replace("/[^a-zA-Z]/", "", $text);

    // Fitering
    $text = str_replace($data_fitering, '', $text);
    // echo strlen($text);
    // die;
    // ------------------------------------------ Text Processing ----------------------------------------------------- //
    // echo $this->simil('Berolahragamembuattubuhsehatdanbugar', 'olahragasecarateraturmembuattubuhsehatdanbugar');
    $data['hasil'] = [];
    $array_data = [];
    foreach ($skripsi as $key) {
      $pdf2    = $parser->parseFile('./upload/skripsi_full/' . $key->skripsi_file_full);
      $text_pembanding = $pdf2->getText();

      // case folding -> perubahan huruf besar ke kecil
      $text_pembanding = strtolower($text_pembanding);

      // Cleasing & Penghapusan spasi
      $text_pembanding = preg_replace("/[^a-zA-Z]/", "", $text_pembanding);

      // Fitering
      $text_pembanding = str_replace($data_fitering, '', $text_pembanding);
      $persentasi = $this->simil($text, $text_pembanding);
      $array_data = array(
        'skripsi_id' => $key->skripsi_id,
        'mahasiswa_nim' => $key->mahasiswa_nim,
        'skripsi_judul' => $key->skripsi_judul,
        'skripsi_file_full' => $key->skripsi_file_full,
        'mahasiswa_nama' => $key->mahasiswa_nama,
        'kategori_skripsi_nama' => $key->kategori_skripsi_nama,
        'persentasi' => round($persentasi, 2)
      );
      array_push($data['hasil'], $array_data);
    }
    $end_time = microtime(true);
    $data['waktu_eksekusi'] = round(($end_time - $start_time), 5);

    $log['log_id']      = "";
    $log['log_time']    = date('Y-m-d H:i:s');
    $log['log_message'] = strtolower($this->session->userdata('user_fullname')) . " Melakukan pengecekkan plagiarisme ";
    $log['user_id']     = $this->session->userdata('user_id');
    $this->m_setting->create_log($log);

    $this->load->view("attribute/header", $setting);
    $this->load->view("attribute/menus", $setting);
    $this->load->view("admin/master_data/cek_kesamaan", $data);
    $this->load->view("attribute/footer", $setting);
  }

  public function upload()
  {
    $folder = "./upload/file_cek";
    $move = move_uploaded_file($_FILES["upload_file"]["tmp_name"], $folder . "/" . $_FILES["upload_file"]["name"]);
    if ($move) {
      $this->session->set_userdata(array('file_cek' => $_FILES["upload_file"]["name"]));
      echo "File Proses..";
    } else {
      echo "Uploading failed!";
    }
  }

  // public function rsimil ($a, $alen, $b, $blen, $cs);

  /*
 *	Tests the similarity of two strings a and b using the Ratcliff-Obershelp
 *	method. 	
 *	The return value is a value between 0 and 100 where 0 means that the
 *	two strings have nothing in common, and 100 means that they're exact
 *	matches.
 */
  public function simil($a, $b)
  {
    $alen = strlen($a);
    $blen = strlen($b);

    if ($alen == 0 || $blen == 0)
      return 0;

    return ($this->rsimil($a, $alen, $b, $blen, 1) * 200) / ($alen + $blen);
  }

  /*
 *	Case insensitive version of simil().
 *	It copies the strings internally using strdup(), converts the copies
 *	to uppercase, and compares those.
 *	It returns the same values as simil(), but it may also return zero if 
 *	the calls to strdup() fail. 
 */
  public function isimil($a, $b)
  {
    $alen = strlen($a);
    $blen = strlen($b);

    if ($alen == 0 || $blen == 0)
      return 0;

    return ($this->rsimil($a, $alen, $b, $blen, 0) * 200) / ($alen + $blen);
  }

  /*
 *	This is the core of the algorithm. It finds the longest matching substring
 *	and then recursively matches the left and right remaining strings.
 *	cs - Case sensitive
 */
  public function rsimil($a, $alen, $b, $blen, $cs)
  {
    $p = 0;
    $q = 0;
    $len = 0;
    $left = 0;
    $right = 0;

    /* Find a matching substring */
    for ($i = 0; $i < $alen - $len; $i++)
      for ($j = 0; $j < $blen - $len; $j++) {
        if ($cs) {
          if ($a[$i] == $b[$j] && $a[$i + $len] == $b[$j + $len]) {
            /* Find out whether this is the longest match */
            for ($k = $i + 1, $l = $j + 1; $a[$k] == $b[$l] && $k < $alen && $l < $blen; $k++, $l++);

            if ($k - $i > $len) {
              $p = $i;
              $q = $j;
              $len = $k - $i;
            }
          }
        } else {
          if (strtolower($a[$i]) == strtolower($b[$j]) && strtolower($a[$i + $len]) == strtolower($b[$j + $len])) {
            /* Find out whether this is the longest match */
            for ($k = $i + 1, $l = $j + 1; strtolower($a[$k]) == strtolower($b[$l]) && $k < $alen && $l < $blen; $k++, $l++);

            if ($k - $i > $len) {
              $p = $i;
              $q = $j;
              $len = $k - $i;
            }
          }
        }
      }

    /* No match */
    if ($len == 0)
      return 0;

    /* Match the strings to the left */
    if ($p != 0 && $q != 0)
      $left = $this->rsimil($a, $p, $b, $q, $cs);

    $i = ($p + $len);
    $alen -= $i;
    $j = ($q + $len);
    $blen -= $j;

    /* Match the strings to the right */
    if ($alen != 0 && $blen != 0)
      $right = $this->rsimil($a + $i, $alen, $b + $j, $blen, $cs);

    /* Return the score */
    return $len + $left + $right;
  }
}
