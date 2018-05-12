<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Perwakilan extends CI_Controller {
	function index(){
		if (isset($_POST['submit'])){
			$username = $this->input->post('a');
			$password = hash("sha512", md5($this->input->post('b')));
			$cek = $this->db->query("SELECT * FROM rb_perwakilan where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."'");
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				$this->session->set_userdata(array('id'=>$row['id_perwakilan'],
													'username'=>$row['username'],
								   					'level'=>'perwakilan'));
				redirect('perwakilan/home');
			}else{
				$data['title'] = 'Perwakilan &rsaquo; Log In';
				$this->load->view('perwakilan/view_login',$data);
			}
		}else{
			$data['title'] = 'Perwakilan &rsaquo; Log In';
			$this->load->view('perwakilan/view_login',$data);
		}
	}

	function home(){
		cek_session_perwakilan();
		$data['berita'] = $this->model_berita->info_terbaru(4);
		$data['produk'] = $this->model_perwakilan->produk($this->session->id);
		$this->template->load('perwakilan/template','perwakilan/view_home',$data);
	}

	function profile(){
		cek_session_perwakilan();
		$data['rows'] = $this->model_perwakilan->detail_perwakilan($this->session->id)->row_array();
		$data['produk'] = $this->model_perwakilan->produk($this->session->id);
		$data['pembelian'] = $this->model_perwakilan->pembelian($this->session->id);
		$data['penjualan_konsumen'] = $this->model_perwakilan->penjualan_konsumen($this->session->id);
		$data['penjualan_agen'] = $this->model_perwakilan->penjualan_agen($this->session->id);
		$data['penjualan_distributor'] = $this->model_perwakilan->penjualan_distributor($this->session->id);
		$this->template->load('perwakilan/template','perwakilan/mod_perwakilan/view_perwakilan',$data);
	}


	function edit_perwakilan(){
		cek_session_perwakilan();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_perwakilan->perwakilan_update_profile();
			redirect('perwakilan/profile');
		}else{
			$data['rows'] = $this->model_perwakilan->perwakilan_edit($this->session->id)->row_array();
			$this->template->load('administrator/template','perwakilan/mod_perwakilan/view_perwakilan_edit',$data);
		}
	}

	function produk(){
		cek_session_perwakilan();
		$data['produk'] = $this->model_perwakilan->produk($this->session->id);
		$this->template->load('perwakilan/template','perwakilan/mod_perwakilan/view_produk',$data);
	}

	function pembelian(){
		cek_session_perwakilan();
		$data['pembelian'] = $this->model_perwakilan->pembelian($this->session->id);
		$this->template->load('perwakilan/template','perwakilan/mod_perwakilan/view_pembelian',$data);
	}

	function penjualankonsumen(){
		cek_session_perwakilan();
		$data['penjualan'] = $this->model_perwakilan->penjualan_konsumen($this->session->id);
		$this->template->load('perwakilan/template','perwakilan/mod_perwakilan/view_penjualan_konsumen',$data);
	}

	function penjualanagen(){
		cek_session_perwakilan();
		$data['penjualan'] = $this->model_perwakilan->penjualan_agen($this->session->id);
		$this->template->load('perwakilan/template','perwakilan/mod_perwakilan/view_penjualan_agen',$data);
	}

	function penjualandistributor(){
		cek_session_perwakilan();
		$data['penjualan'] = $this->model_perwakilan->penjualan_distributor($this->session->id);
		$this->template->load('perwakilan/template','perwakilan/mod_perwakilan/view_penjualan_distributor',$data);
	}

	function tambah_penjualan_konsumen(){
		cek_session_perwakilan();
		if (isset($_POST['submit'])){
			$produk = $this->input->post('a');
			$stok = $this->db->query("SELECT sum(jumlah) as stok FROM `rb_perwakilan_order` where id_perwakilan='".$this->session->id."' AND id_produk='$produk'")->row_array();
			$jual = $this->db->query("SELECT sum(jumlah) as jual FROM `rb_konsumen_order` where id_penjual='".$this->session->id."' AND id_produk='$produk' AND penjual='perwakilan'")->row_array();
			$sisa = $stok['stok']-$jual['jual'];
			if ($this->input->post('b') > $sisa){
				echo "<script>window.alert('Maaf, Stok Produk Habis atau Tidak Mencukupi!');
                                  window.location=('".base_url()."perwakilan/produk')</script>";
			}else{
				$this->model_perwakilan->perwakilan_tambah_penjualan();
				redirect('perwakilan/penjualankonsumen');
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
					$this->template->load('perwakilan/template','perwakilan/mod_perwakilan/view_penjualan_transaksi_konsumen',$data);
				}else{
					echo "<script>window.alert('Maaf, Data Konsumen Tidak Ditemukan');
                                  window.location=('".base_url()."perwakilan/penjualankonsumen')</script>";
				}
			}else{
				redirect('perwakilan/penjualankonsumen');
			}
		}
	}

	function tambah_penjualan_agen(){
		cek_session_perwakilan();
		if (isset($_POST['submit'])){
			$produk = $this->input->post('a');
			$stok = $this->db->query("SELECT sum(jumlah) as stok FROM `rb_perwakilan_order` where id_perwakilan='".$this->session->id."' AND id_produk='$produk'")->row_array();
			$jual = $this->db->query("SELECT sum(jumlah) as jual FROM `rb_konsumen_order` where id_penjual='".$this->session->id."' AND id_produk='$produk' AND penjual='perwakilan'")->row_array();
			$sisa = $stok['stok']-$jual['jual'];
			if ($this->input->post('b') > $sisa){
				echo "<script>window.alert('Maaf, Stok Produk Habis atau Tidak Mencukupi!');
                                  window.location=('".base_url()."perwakilan/produk')</script>";
			}else{
				$this->model_perwakilan->perwakilan_tambah_penjualan();
				redirect('perwakilan/penjualanagen');
			}
		}else{
			if (isset($_POST['proses'])){
				$cari = strip_tags($this->input->post('id'));
				$profile = $this->db->query("SELECT * FROM rb_agen where username='".$cari."' OR no_ktp_sim='".$cari."'")->row_array();
				$hitung = $this->db->query("SELECT * FROM rb_agen where username='".$cari."' OR no_ktp_sim='".$cari."'")->num_rows();
				if ($hitung >= 1){
					$data['id'] = $profile['id_agen'];
					$data['no_ktp'] = $profile['no_ktp_sim'];
					$data['nama_konsumen'] = $profile['nama_agen'];
					$data['alamat_lengkap'] = $profile['alamat_lengkap'];
					$data['produk'] = $this->model_produk->produk();
					$this->template->load('perwakilan/template','perwakilan/mod_perwakilan/view_penjualan_transaksi_agen',$data);
				}else{
					echo "<script>window.alert('Maaf, Data Konsumen Tidak Ditemukan');
                                  window.location=('".base_url()."perwakilan/penjualanagen')</script>";
				}
			}else{
				redirect('perwakilan/penjualanagen');
			}
		}
	}

	function tambah_penjualan_distributor(){
		cek_session_perwakilan();
		if (isset($_POST['submit'])){
			$produk = $this->input->post('a');
			$stok = $this->db->query("SELECT sum(jumlah) as stok FROM `rb_perwakilan_order` where id_perwakilan='".$this->session->id."' AND id_produk='$produk'")->row_array();
			$jual = $this->db->query("SELECT sum(jumlah) as jual FROM `rb_konsumen_order` where id_penjual='".$this->session->id."' AND id_produk='$produk' AND penjual='perwakilan'")->row_array();
			$sisa = $stok['stok']-$jual['jual'];
			if ($this->input->post('b') > $sisa){
				echo "<script>window.alert('Maaf, Stok Produk Habis atau Tidak Mencukupi!');
                                  window.location=('".base_url()."perwakilan/produk')</script>";
			}else{
				$this->model_perwakilan->perwakilan_tambah_penjualan();
				redirect('perwakilan/penjualandistributor');
			}
		}else{
			if (isset($_POST['proses'])){
				$cari = strip_tags($this->input->post('id'));
				$profile = $this->db->query("SELECT * FROM rb_distributor where username='".$cari."' OR no_ktp_sim='".$cari."'")->row_array();
				$hitung = $this->db->query("SELECT * FROM rb_distributor where username='".$cari."' OR no_ktp_sim='".$cari."'")->num_rows();
				if ($hitung >= 1){
					$data['id'] = $profile['id_distributor'];
					$data['no_ktp'] = $profile['no_ktp_sim'];
					$data['nama_konsumen'] = $profile['nama_distributor'];
					$data['alamat_lengkap'] = $profile['alamat_lengkap'];
					$data['produk'] = $this->model_produk->produk();
					$this->template->load('perwakilan/template','perwakilan/mod_perwakilan/view_penjualan_transaksi_distributor',$data);
				}else{
					echo "<script>window.alert('Maaf, Data Konsumen Tidak Ditemukan');
                                  window.location=('".base_url()."perwakilan/penjualandistributor')</script>";
				}
			}else{
				redirect('perwakilan/penjualandistributor');
			}
		}
	}

	function delete_penjualan_konsumen(){
		cek_session_perwakilan();
		$id = $this->uri->segment(3);
		$this->model_perwakilan->perwakilan_delete_penjualan_konsumen($id);
		redirect('perwakilan/penjualankonsumen');
	}

	function delete_penjualan_agen(){
		cek_session_perwakilan();
		$id = $this->uri->segment(3);
		$this->model_perwakilan->perwakilan_delete_penjualan_agen($id);
		redirect('perwakilan/penjualanagen');
	}

	function delete_penjualan_distributor(){
		cek_session_perwakilan();
		$id = $this->uri->segment(3);
		$this->model_perwakilan->perwakilan_delete_penjualan_distributor($id);
		redirect('perwakilan/penjualandistributor');
	}

	function orderkode(){
		cek_session_perwakilan();
		$data['record'] = $this->model_perwakilan->orderkodekonsumen($this->session->id);
		$data['rekening'] = $this->model_members->rekening();
		$data['title'] = 'List Order Kode Aktivasi Anda';
		$this->template->load('perwakilan/template','perwakilan/mod_perwakilan/view_order_kode',$data);
	}

	function detail_orderkode(){
		cek_session_perwakilan();
		$data['record'] = $this->model_perwakilan->konsumen_orderkode_terkirim($this->uri->segment(3));
		$data['title'] = 'Berikut Pesanan Kode Aktivasi Anda';
		$this->template->load('perwakilan/template','perwakilan/mod_perwakilan/view_order_kode_detail',$data);
	}

	function tambah_orderkode(){
		cek_session_perwakilan();
		if (isset($_POST['submit'])){
			$this->model_perwakilan->insert_orderkodekonsumen($this->session->id);
			redirect('perwakilan/orderkode');
		}else{
			$data['title'] = 'Tambah Order Kode Aktivasi Anda';
			$this->template->load('perwakilan/template','perwakilan/mod_perwakilan/view_order_kode_tambah',$data);
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('main');
	}
}
