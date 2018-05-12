<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Agen extends CI_Controller {
	function index(){
		if (isset($_POST['submit'])){
			$username = $this->input->post('a');
			$password = hash("sha512", md5($this->input->post('b')));
			$cek = $this->db->query("SELECT * FROM rb_agen where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."'");
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				$this->session->set_userdata(array('id'=>$row['id_agen'],
													'username'=>$row['username'],
								   					'level'=>'agen'));
				redirect('agen/home');
			}else{
				$data['title'] = 'Agen &rsaquo; Log In';
				$this->load->view('agen/view_login',$data);
			}
		}else{
			$data['title'] = 'Agen &rsaquo; Log In';
			$this->load->view('agen/view_login',$data);
		}
	}

	function home(){
		cek_session_agen();
		$data['berita'] = $this->model_berita->info_terbaru(4);
		$data['produk'] = $this->model_agen->produk($this->session->id);
		$this->template->load('agen/template','agen/view_home',$data);
	}

	function profile(){
		cek_session_agen();
		$data['rows'] = $this->model_agen->detail_agen($this->session->id)->row_array();
		$data['produk'] = $this->model_agen->produk($this->session->id);
		$data['pembelian'] = $this->model_agen->pembelian($this->session->id);
		$data['penjualan'] = $this->model_agen->penjualan($this->session->id);
		$data['pembeliandist'] = $this->model_agen->pembeliandist($this->session->id);
		$data['pembelianperw'] = $this->model_agen->pembelianperw($this->session->id);
		$this->template->load('agen/template','agen/mod_agen/view_agen',$data);
	}


	function edit_agen(){
		cek_session_agen();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_agen->agen_update_profile();
			redirect('agen/profile');
		}else{
			$data['rows'] = $this->model_agen->agen_edit($this->session->id)->row_array();
			$this->template->load('administrator/template','agen/mod_agen/view_agen_edit',$data);
		}
	}

	function produk(){
		cek_session_agen();
		$data['produk'] = $this->model_agen->produk($this->session->id);
		$this->template->load('agen/template','agen/mod_agen/view_produk',$data);
	}

	function pembelian(){
		cek_session_agen();
		$data['pembelian'] = $this->model_agen->pembelian($this->session->id);
		$data['pembeliandist'] = $this->model_agen->pembeliandist($this->session->id);
		$data['pembelianperw'] = $this->model_agen->pembelianperw($this->session->id);
		$this->template->load('agen/template','agen/mod_agen/view_pembelian',$data);
	}

	function penjualan(){
		cek_session_agen();
		$data['penjualan'] = $this->model_agen->penjualan($this->session->id);
		$this->template->load('agen/template','agen/mod_agen/view_penjualan',$data);
	}

	function tambah_penjualan(){
		cek_session_agen();
		if (isset($_POST['submit'])){
			$produk = $this->input->post('a');
			$stok = $this->db->query("SELECT sum(t1.jumlah) as stok FROM (SELECT a.id_agen as id_pembeli,
								               a.id_produk,
								               a1.nama_produk,
								               a1.agen,
								               a1.konsumen,
								               a.jumlah,
								               NULL AS pembeli
								        FROM   rb_agen_order a, rb_produk a1
								        WHERE  a.id_produk = a1.id_produk
								        UNION
								        SELECT b.id_pembeli,
								               b.id_produk,
								               b1.nama_produk,
								               b1.agen,
								               b1.konsumen,
								               b.jumlah,
								               b.pembeli
								        FROM   rb_konsumen_order b, rb_produk b1
								        WHERE  b.id_produk = b1.id_produk) AS t1 where t1.id_pembeli='".$this->session->id."' AND (t1.pembeli='agen' OR t1.pembeli is NULL) AND t1.id_produk='$produk' GROUP BY t1.id_produk")->row_array();
			
			$jual = $this->db->query("SELECT sum(jumlah) as jual FROM `rb_konsumen_order` where id_penjual='".$this->session->id."' AND id_produk='$produk' AND penjual='agen'")->row_array();
			$sisa = $stok['stok']-$jual['jual'];
			if ($this->input->post('b') > $sisa){
				echo "<script>window.alert('Maaf, Stok Produk Habis atau Tidak Mencukupi!');
                                  window.location=('".base_url()."agen/produk')</script>";
			}else{
				$this->model_agen->agen_tambah_penjualan();
				redirect('agen/penjualan');
			}
			
		}else{
			if (isset($_POST['proses'])){
				$cari = strip_tags($this->input->post('id'));
				$profile = $this->db->query("SELECT * FROM rb_konsumen where username='".$cari."' OR no_ktp='".$cari."'")->row_array();
				$hitung = $this->db->query("SELECT * FROM rb_konsumen where username='".$cari."' OR no_ktp='".$cari."'")->num_rows();
				if ($hitung >= 1){
					$data['id'] = $profile['id_konsumen'];
					$data['no_ktp'] = $profile['no_ktp'];
					$data['nama_konsumen'] = $profile['nama_lengkap'];
					$data['alamat_lengkap'] = $profile['alamat_lengkap'];
					$data['produk'] = $this->model_produk->produk();
					$this->template->load('agen/template','agen/mod_agen/view_penjualan_transaksi',$data);
				}else{
					echo "<script>window.alert('Maaf, Data Konsumen Tidak Ditemukan');
                                  window.location=('".base_url()."agen/penjualan')</script>";
				}
			}else{
				redirect('agen/penjualan');
			}
		}
	}

	function delete_penjualan(){
		cek_session_agen();
		$id = $this->uri->segment(3);
		$this->model_agen->agen_delete_penjualan($id);
		redirect('agen/penjualan');
	}

	function orderkode(){
		cek_session_agen();
		$data['record'] = $this->model_agen->orderkodekonsumen($this->session->id);
		$data['rekening'] = $this->model_members->rekening();
		$data['title'] = 'List Order Kode Aktivasi Anda';
		$this->template->load('agen/template','agen/mod_agen/view_order_kode',$data);
	}

	function detail_orderkode(){
		cek_session_agen();
		$data['record'] = $this->model_agen->konsumen_orderkode_terkirim($this->uri->segment(3));
		$data['title'] = 'Berikut Pesanan Kode Aktivasi Anda';
		$this->template->load('agen/template','agen/mod_agen/view_order_kode_detail',$data);
	}

	function tambah_orderkode(){
		cek_session_agen();
		if (isset($_POST['submit'])){
			$this->model_agen->insert_orderkodekonsumen($this->session->id);
			redirect('agen/orderkode');
		}else{
			$data['title'] = 'Tambah Order Kode Aktivasi Anda';
			$this->template->load('agen/template','agen/mod_agen/view_order_kode_tambah',$data);
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('main');
	}
}
