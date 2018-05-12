<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Members extends CI_Controller {
	function tabungan(){
		cek_session_members();
		$data['title'] = 'Tabungan Anda Saat ini';
		$data['record'] = $this->model_members->tabungankonsumen($this->session->username);
		$data['dp'] = $this->model_members->profile($this->session->id_konsumen)->row_array();
		$data['rekening'] = $this->model_members->rekening();
		$data['total'] = $this->model_members->total_tabungan($this->session->username)->row_array();
		$this->template->load('phpmu-one/template','phpmu-one/members/view_tabungan',$data);
	}

	function sponsorisasi(){
		cek_session_members();
		$data['title'] = 'Data Sponsorisasi Anda Saat ini';
		$data['record'] = $this->model_members->sponsorisasi($this->session->username);
		$this->template->load('phpmu-one/template','phpmu-one/members/view_sponsorisasi',$data);
	}

		function orderkode(){
		cek_session_members();
		$jumlah= $this->model_members->hitung_orderkodekonsumen($this->session->id_konsumen)->num_rows();
		$config['base_url'] = base_url().'members/orderkode';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 6; 	
		if ($this->uri->segment('3')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('3');
		}
		if (is_numeric($dari)) {
			$data['record'] = $this->model_members->orderkodekonsumen($this->session->id_konsumen, $config['per_page'], $dari);
		}else{
			redirect('orderkode');
		}
		$this->pagination->initialize($config);
		$data['rekening'] = $this->model_members->rekening();
		$data['title'] = 'List Order Kode Aktivasi Anda';
		$this->template->load('phpmu-one/template','phpmu-one/members/view_order_kode',$data);
	}

	function tambah_orderkode(){
		cek_session_members();
		if (isset($_POST['submit'])){
			$this->model_members->insert_orderkodekonsumen($this->session->id_konsumen);
			redirect('members/orderkode');
		}else{
			$data['title'] = 'Tambah Order Kode Aktivasi Anda';
			$this->template->load('phpmu-one/template','phpmu-one/members/view_order_kode_tambah',$data);
		}
	}

	function detail_orderkode(){
		cek_session_members();
		$data['record'] = $this->model_members->konsumen_orderkode_terkirim($this->uri->segment(3));
		$data['title'] = 'Berikut Pesanan Kode Aktivasi Anda';
		$this->template->load('phpmu-one/template','phpmu-one/members/view_order_kode_detail',$data);
	}

	function belanja(){
		cek_session_members();
		$data['title'] = 'Data Belanja Anda ';
		$data['record'] = $this->model_members->belanja($this->session->id_konsumen);
		$this->template->load('phpmu-one/template','phpmu-one/members/view_belanja',$data);
	}

	function downloadpencairan(){
		$name = $this->uri->segment(3);
		$data = file_get_contents("asset/bukti_transfer/".$name);
		force_download($name, $data);
	}

	function order(){
		cek_session_members();
			$data['title'] = 'Semua Produk Kami';
			$data['record'] = $this->model_members->produk();
			$this->template->load('phpmu-one/template','phpmu-one/members/view_produk',$data);
	}

	function upgrade(){
		cek_session_members();
		if (isset($_POST['submit'])){
			$idk = $this->session->id_konsumen;
			$cek = $this->db->query("SELECT * FROM rb_upgrade where id_konsumen='$idk'")->num_rows();
			if ($cek >= 1){
				echo "<script>window.alert('Maaf, Anda Sudah pernah Melakukan Permohonan Sebelumnya!');
                                  window.location=('".base_url()."members/upgrade')</script>";
			}else{
				$this->model_members->kirimkan_upgrade($idk);
				echo "<script>window.alert('Success, Permohonan sudah Terkirim!');
                                  window.location=('".base_url()."members/upgrade')</script>";
			}
		}else{
			$data['title'] = 'Upgrade Paket';
			$data['row'] = $this->model_members->paket();
			$data['record'] = $this->model_members->konsumen_paket($this->session->id_konsumen)->row_array();
			$this->template->load('phpmu-one/template','phpmu-one/members/view_upgrade',$data);
		}
	}

	function delete_pembayaran(){
		cek_session_members();
		$id = $this->uri->segment(3);
		$row = $this->db->query("SELECT * FROM rb_tabungan_bayar where id_tabungan_bayar='$id'")->row();
		if ($row->id_konsumen == $this->session->id_konsumen){
			$this->model_members->delete_tabungan($id);
			redirect('members/tabungan');
		}else{
			echo "<script>window.alert('Maaf, Anda Tidak Memiliki akses');
                                  window.location=('".base_url()."members/tabungan')</script>";
		}
	}

	function jaringan(){
		cek_session_members();
		$data['title'] = 'Jaringan Anda Saat ini';
		$this->template->load('phpmu-one/template','phpmu-one/members/view_jaringan',$data);
	}

	function downline(){
		cek_session_members();
		if ($this->uri->segment(3) != ''){
			$username = $this->uri->segment(3);
		}else{
			$username = $this->session->username;
		}
		$jumlah= $this->model_members->totaldownline($username)->num_rows();
		$config['base_url'] = base_url().'members/downline/'.$username;
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 25; 	
		if ($this->uri->segment('4')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('4');
		}

		if (is_numeric($dari)) {
			$data['record'] = $this->model_members->downline($username, $config['per_page'], $dari);
		}else{
			redirect('members/downline');
		}
		$this->pagination->initialize($config);
		$data['title'] = 'Downline Anda Saat ini';
		$this->template->load('phpmu-one/template','phpmu-one/members/view_downline',$data);
	}

	function tambah_jaringan(){
		cek_session_members();
		if (isset($_POST['submit'])){
			$kode = strip_tags($this->input->post('kode'));
			$cek = $this->db->query("SELECT * FROM rb_konsumen where kode_konsumen='$kode' AND username=''")->num_rows();
			if ($cek >= 1){
					$this->model_members->jaringan_tambah();
					redirect('members/jaringan');
			}else{
				$data['title'] = 'Tambahkan Jaringan Baru';
				$data['error'] = 'Maaf, Kode Konsumen yang anda masukkan salah!';
				$data['row'] = $this->model_members->paket();
				$this->template->load('phpmu-one/template','phpmu-one/members/view_jaringan_tambah',$data);
			}
		}else{
			$kiri = $this->db->query("SELECT * FROM `rb_foot_detail` where username='".$this->session->username."' AND posisi='0'")->num_rows();
			$kanan = $this->db->query("SELECT * FROM `rb_foot_detail` where username='".$this->session->username."' AND posisi='1'")->num_rows();
			$p = $this->db->query("SELECT posisi FROM `rb_foot_detail` where username='".$this->session->username."' AND downline='".$this->uri->segment(3)."'")->row_array();
				$total = explode('.',$kiri/2);
				if (($total[0] > $kanan) AND $p['posisi'] == 1){
					if ($this->uri->segment(3) == '' OR $this->uri->segment(4) == ''){
						redirect('members/jaringan');
					}
					$data['title'] = 'Tambahkan Jaringan Baru';
					$data['row'] = $this->model_members->paket();
					$this->template->load('phpmu-one/template','phpmu-one/members/view_jaringan_tambah',$data);
				}elseif ($p['posisi'] == 0){
					if ($this->uri->segment(3) == '' OR $this->uri->segment(4) == ''){
						redirect('members/jaringan');
					}
					$data['title'] = 'Tambahkan Jaringan Baru';
					$data['row'] = $this->model_members->paket();
					$this->template->load('phpmu-one/template','phpmu-one/members/view_jaringan_tambah',$data);
				}else{
					echo "<script>window.alert('Maaf, Anda Harus Mengisi Bagian Kiri Terlebih dahulu,..');
                                  window.location=('".base_url()."members/jaringan')</script>";
				}
		}
	}

	function keuangan(){
		cek_session_members();
		$data['title'] = 'Data Keuangan Anda';
		$set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
		$data['ket'] = $this->model_members->keterangan(1)->row_array();
		$data['pen'] = $this->model_members->totpencairan($this->session->id_konsumen,$set['bonus_pasangan'])->row_array();
		$data['sponsor'] = $this->model_members->keuangan($this->session->username)->row_array();
		$data['bonus'] = $this->model_members->bonussponsor($this->session->username)->row_array();
		$data['bonustabungan'] = $this->model_members->bonustabungan($this->session->username)->row_array();
        $data['ro'] = $this->model_members->bonusro($this->session->username)->row_array();
        $data['as'] = $this->model_members->autosavesum($this->session->username,$set['persen_auto_save'],$set['ppn'])->row_array();
		$data['cairan'] = $this->model_members->totpencairan($this->session->username,$set['bonus_pasangan'])->row_array();
		$data['idk'] = $this->session->username;
		$this->template->load('phpmu-one/template','phpmu-one/members/view_keuangan',$data);
	}

	function pencairan(){
		cek_session_members();
		$data['title'] = 'Data History Pencairan Dana';
		$data['record'] = $this->model_members->pencairan_detail($this->session->username);
		$this->template->load('phpmu-one/template','phpmu-one/members/view_pencairan',$data);
	}

	function autosave(){
		cek_session_members();
		$data['title'] = 'Data History Auto Save Reword';
		$data['record'] = $this->model_members->pencairan_detail($this->session->username);
		$this->template->load('phpmu-one/template','phpmu-one/members/view_autosave',$data);
	}

	function profile(){
		cek_session_members();
		$data['title'] = 'Profile Anda';
		$data['row'] = $this->model_members->profile_view($this->session->id_konsumen)->row_array();
		$this->template->load('phpmu-one/template','phpmu-one/members/view_profile',$data);
	}

	function reword(){
		cek_session_members();
		$data['title'] = 'Bonus Reword';
		$data['record'] = $this->model_members->reword();
		$data['row'] = $this->model_members->profile($this->session->id_konsumen)->row_array();
		$data['sponsor'] = $this->model_members->keuangan($this->session->username)->row_array();
		$this->template->load('phpmu-one/template','phpmu-one/members/view_reword',$data);
	}

	function edit_profile(){
		cek_session_members();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_members->profile_update($this->session->id_konsumen);
			redirect('members/profile');
		}else{
			$data['title'] = 'Edit Profile Anda';
			$data['row'] = $this->model_members->profile_view($this->session->id_konsumen)->row_array();
			$this->template->load('phpmu-one/template','phpmu-one/members/view_profile_edit',$data);
		}
	}

	public function username_check(){
        // allow only Ajax request    
        if($this->input->is_ajax_request()) {
	        // grab the email value from the post variable.
	        $username = $this->input->post('a');

            if(!$this->form_validation->is_unique($username, 'rb_konsumen.username')) {          
	         	$this->output->set_content_type('application/json')->set_output(json_encode(array('messageusername' => 'Maaf, Username ini sudah terdaftar,..')));
            }

        }
    }

    public function email_check(){
        // allow only Ajax request    
        if($this->input->is_ajax_request()) {
	        // grab the email value from the post variable.
	        $email = $this->input->post('d');

	        if(!$this->form_validation->is_unique($email, 'rb_konsumen.email')) {          
	         	$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'Maaf, Email ini sudah terdaftar,..')));
            }
        }
    }

    public function ktp_check(){
        // allow only Ajax request    
        if($this->input->is_ajax_request()) {
	        // grab the email value from the post variable.
	        $ktp = $this->input->post('g');

            if(!$this->form_validation->is_unique($ktp, 'rb_konsumen.no_ktp')) {          
	         	$this->output->set_content_type('application/json')->set_output(json_encode(array('messagektp' => 'Maaf, No KTP ini sudah terdaftar,..')));
            }
        }
    }

    public function sponsor_check(){
        // allow only Ajax request    
        if($this->input->is_ajax_request()) {
	        // grab the email value from the post variable.
	        $sps = $this->input->post('sps');

            if(!$this->form_validation->is_unique($sps, 'rb_konsumen.username')) {          
	         	$this->output->set_content_type('application/json')->set_output(json_encode(array('messagesponsor' => '<i style="color:green; font-weight:bold"><span class="glyphicon glyphicon-ok"></span> Oke, Username Sponsor Ditemukan,..</i>')));
            }else{
            	$this->output->set_content_type('application/json')->set_output(json_encode(array('messagesponsor' => '<i style="color:red; font-weight:bold"><span class="glyphicon glyphicon-remove"></span> Username Sponsor Tidak Ditemukan,..</i>')));
            }

        }
    }

    public function paket_check(){
        // allow only Ajax request    
        if($this->input->is_ajax_request()) {
	        $kode = $this->input->post('kode');
	        $k = $this->db->query("SELECT * FROM rb_konsumen a JOIN rb_paket b ON a.id_paket=b.id_paket where a.kode_konsumen='$kode'")->row_array();
     		$this->output->set_content_type('application/json')->set_output(json_encode(array('messagekode' => $k['nama_paket'])));
        }
    }

	function logout(){
		cek_session_members();
		$this->session->sess_destroy();
		redirect('main');
	}
}
