<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Distributor extends CI_Controller {
	function index(){
		if (isset($_POST['submit'])){
			$username = $this->input->post('a');
			$password = hash("sha512", md5($this->input->post('b')));
			$cek = $this->db->query("SELECT * FROM rb_distributor where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."'");
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				$this->session->set_userdata(array('id'=>$row['id_distributor'],
													'username'=>$row['username'],
								   					'level'=>'distributor'));
				redirect('distributor/home');
			}else{
				$data['title'] = 'Distributor &rsaquo; Log In';
				$this->load->view('distributor/view_login',$data);
			}
		}else{
			$data['title'] = 'Distributor &rsaquo; Log In';
			$this->load->view('distributor/view_login',$data);
		}
	}

	function home(){
		cek_session_distributor();
		$data['berita'] = $this->model_berita->info_terbaru(4);
		$data['produk'] = $this->model_distributor->produk($this->session->id);
		$this->template->load('distributor/template','distributor/view_home',$data);
	}

	function profile(){
		cek_session_distributor();
		$data['rows'] = $this->model_distributor->detail_distributor($this->session->id)->row_array();
		$data['produk'] = $this->model_distributor->produk($this->session->id);
		$data['pembelian'] = $this->model_distributor->pembelian($this->session->id);
		$data['pembelianperw'] = $this->model_distributor->pembelianperw($this->session->id);
		$data['penjualan_konsumen'] = $this->model_distributor->penjualan_konsumen($this->session->id);
		$data['penjualan_agen'] = $this->model_distributor->penjualan_agen($this->session->id);
		$this->template->load('distributor/template','distributor/mod_distributor/view_distributor',$data);
	}


	function edit_distributor(){
		cek_session_distributor();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_distributor->distributor_update_profile();
			redirect('distributor/profile');
		}else{
			$data['rows'] = $this->model_distributor->distributor_edit($this->session->id)->row_array();
			$this->template->load('administrator/template','distributor/mod_distributor/view_distributor_edit',$data);
		}
	}

	function produk(){
		cek_session_distributor();
		$data['produk'] = $this->model_distributor->produk($this->session->id);
		$this->template->load('distributor/template','distributor/mod_distributor/view_produk',$data);
	}

	function pembelian(){
		cek_session_distributor();
		$data['pembelian'] = $this->model_distributor->pembelian($this->session->id);
		$data['pembelianperw'] = $this->model_distributor->pembelianperw($this->session->id);
		$this->template->load('distributor/template','distributor/mod_distributor/view_pembelian',$data);
	}

	function penjualankonsumen(){
		cek_session_distributor();
		$data['penjualan'] = $this->model_distributor->penjualan_konsumen($this->session->id);
		$this->template->load('distributor/template','distributor/mod_distributor/view_penjualan_konsumen',$data);
	}

	function penjualanagen(){
		cek_session_distributor();
		$data['penjualan'] = $this->model_distributor->penjualan_agen($this->session->id);
		$this->template->load('distributor/template','distributor/mod_distributor/view_penjualan_agen',$data);
	}

	function tambah_penjualan_konsumen(){
		cek_session_distributor();
		if (isset($_POST['submit'])){
			$produk = $this->input->post('a');
			$stok = $this->db->query("SELECT sum(t1.jumlah) as stok FROM (SELECT a.id_distributor as id_pembeli,
                                               a.id_produk,
                                               a1.nama_produk,
                                               a1.distributor,
                                               a1.agen,
                                               a1.konsumen,
                                               a.jumlah,
                                               NULL AS pembeli,
                                               NULL AS penjual
                                        FROM   rb_distributor_order a, rb_produk a1
                                        WHERE  a.id_produk = a1.id_produk
                                        UNION
                                        SELECT b.id_pembeli,
                                               b.id_produk,
                                               b1.nama_produk,
                                               b1.distributor,
                                               b1.agen,
                                               b1.konsumen,
                                               b.jumlah,
                                               b.pembeli,
                                               b.penjual
                                        FROM   rb_konsumen_order b, rb_produk b1
                                        WHERE  b.id_produk = b1.id_produk) AS t1 where t1.id_pembeli='".$this->session->id."' AND (t1.pembeli='distributor' OR t1.pembeli is NULL)  AND t1.id_produk='$produk'  GROUP BY t1.id_produk")->row_array();
			$jual = $this->db->query("SELECT sum(jumlah) as jual FROM `rb_konsumen_order` where id_penjual='".$this->session->id."' AND id_produk='$produk' AND penjual='distributor'")->row_array();
			$sisa = $stok['stok']-$jual['jual'];
			if ($this->input->post('b') > $sisa){
				echo "<script>window.alert('Maaf, Stok Produk Habis atau Tidak Mencukupi!');
                                  window.location=('".base_url()."distributor/produk')</script>";
			}else{
				$this->model_distributor->distributor_tambah_penjualan();
				redirect('distributor/penjualankonsumen');
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
					$this->template->load('distributor/template','distributor/mod_distributor/view_penjualan_transaksi_konsumen',$data);
				}else{
					echo "<script>window.alert('Maaf, Data Konsumen Tidak Ditemukan');
                                  window.location=('".base_url()."distributor/penjualankonsumen')</script>";
				}
			}else{
				redirect('distributor/penjualankonsumen');
			}
		}
	}

	function tambah_penjualan_agen(){
		cek_session_distributor();
		if (isset($_POST['submit'])){
			$produk = $this->input->post('a');
			$stok = $this->db->query("SELECT sum(t1.jumlah) as stok FROM (SELECT a.id_distributor as id_pembeli,
                                               a.id_produk,
                                               a1.nama_produk,
                                               a1.distributor,
                                               a1.agen,
                                               a1.konsumen,
                                               a.jumlah,
                                               NULL AS pembeli,
                                               NULL AS penjual
                                        FROM   rb_distributor_order a, rb_produk a1
                                        WHERE  a.id_produk = a1.id_produk
                                        UNION
                                        SELECT b.id_pembeli,
                                               b.id_produk,
                                               b1.nama_produk,
                                               b1.distributor,
                                               b1.agen,
                                               b1.konsumen,
                                               b.jumlah,
                                               b.pembeli,
                                               b.penjual
                                        FROM   rb_konsumen_order b, rb_produk b1
                                        WHERE  b.id_produk = b1.id_produk) AS t1 where t1.id_pembeli='".$this->session->id."' AND (t1.pembeli='distributor' OR t1.pembeli is NULL)  AND t1.id_produk='$produk'  GROUP BY t1.id_produk")->row_array();
			$jual = $this->db->query("SELECT sum(jumlah) as jual FROM `rb_konsumen_order` where id_penjual='".$this->session->id."' AND id_produk='$produk' AND penjual='distributor'")->row_array();
			$sisa = $stok['stok']-$jual['jual'];
			if ($this->input->post('b') > $sisa){
				echo "<script>window.alert('Maaf, Stok Produk Habis atau Tidak Mencukupi!');
                                  window.location=('".base_url()."distributor/produk')</script>";
			}else{
				$this->model_distributor->distributor_tambah_penjualan();
				redirect('distributor/penjualanagen');
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
					$this->template->load('distributor/template','distributor/mod_distributor/view_penjualan_transaksi_agen',$data);
				}else{
					echo "<script>window.alert('Maaf, Data Konsumen Tidak Ditemukan');
                                  window.location=('".base_url()."distributor/penjualanagen')</script>";
				}
			}else{
				redirect('distributor/penjualanagen');
			}
		}
	}

	function delete_penjualan_konsumen(){
		cek_session_distributor();
		$id = $this->uri->segment(3);
		$this->model_distributor->distributor_delete_penjualan_konsumen($id);
		redirect('distributor/penjualankonsumen');
	}

	function delete_penjualan_agen(){
		cek_session_distributor();
		$id = $this->uri->segment(3);
		$this->model_distributor->distributor_delete_penjualan_agen($id);
		redirect('distributor/penjualanagen');
	}

	function orderkode(){
		cek_session_distributor();
		$data['record'] = $this->model_distributor->orderkodekonsumen($this->session->id);
		$data['rekening'] = $this->model_members->rekening();
		$data['title'] = 'List Order Kode Aktivasi Anda';
		$this->template->load('distributor/template','distributor/mod_distributor/view_order_kode',$data);
	}

	function detail_orderkode(){
		cek_session_distributor();
		$data['record'] = $this->model_distributor->konsumen_orderkode_terkirim($this->uri->segment(3));
		$data['title'] = 'Berikut Pesanan Kode Aktivasi Anda';
		$this->template->load('distributor/template','distributor/mod_distributor/view_order_kode_detail',$data);
	}

	function tambah_orderkode(){
		cek_session_distributor();
		if (isset($_POST['submit'])){
			$this->model_distributor->insert_orderkodekonsumen($this->session->id);
			redirect('distributor/orderkode');
		}else{
			$data['title'] = 'Tambah Order Kode Aktivasi Anda';
			$this->template->load('distributor/template','distributor/mod_distributor/view_order_kode_tambah',$data);
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('main');
	}
}
