<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function register(){
		if (isset($_POST['submit'])){
			$idk = strip_tags($this->input->post('id'));
			$dat = $this->db->query("SELECT * FROM rb_konsumen where kode_konsumen='$idk'");
			$datt = $this->db->query("SELECT * FROM rb_konsumen where kode_konsumen='$idk' AND username=''");
			$total = $datt->num_rows();
			$rows = $dat->row_array();

			if ($total == 0){
			    $data['title'] = 'Formulir Pendaftaran';
				$this->template->load('phpmu-one/template','phpmu-one/view_register',$data);
			}else{
				$cekakun = $this->db->query("SELECT * FROM rb_konsumen where username='".strip_tags($this->input->post('a'))."' OR email='".strip_tags($this->input->post('d'))."' OR no_ktp='".strip_tags($this->input->post('g'))."'")->num_rows();
				if ($cekakun >= 1){
					echo "<script>window.alert('Maaf, Akun dengan Username : ".$this->input->post('a').", No KTP : ".$this->input->post('g').", Email : ".$this->input->post('d')." sudah Terdaftar,..!');
	                              window.location=('".base_url()."')</script>";
				}else{
					$this->model_auth->register();
					$this->session->set_userdata(array('id_konsumen'=>$rows['id_konsumen'], 
				                                        'kode_konsumen'=>$this->input->post('id'), 
				                                        'username'=>$this->input->post('a'),
				                                        'sponsor'=>''));
					redirect('members/profile');
				}
			}
		}else{
			$idk = $this->input->post('kode');
			$dat = $this->db->query("SELECT * FROM rb_konsumen a JOIN rb_paket b ON a.id_paket=b.id_paket where a.kode_konsumen='$idk' AND a.username='' AND a.password=''");
		    $row = $dat->row();
		    $data['paket'] = $row->nama_paket;
		    $total = $dat->num_rows();
		        if ($total == 0){
                    redirect('main');
		        }
			$data['title'] = 'Formulir Pendaftaran';
			$this->template->load('phpmu-one/template','phpmu-one/view_register',$data);
		}
	}

	public function order(){
		if (isset($_POST['submit'])){
			$data['title'] = 'Success Order Kode Aktivasi';
			$cek = $this->db->query("SELECT * FROM rb_order_kode where alamat_email='".$this->input->post('b')."' AND waktu_order LIKE '".date('Y-m-d H:i')."%'")->num_rows();
			if ($cek >= 1){
				redirect('main');
			}
				$this->model_auth->order();
				$row = $this->db->query("SELECT * FROM rb_paket where id_paket='".$this->input->post('paket')."'")->row_array();
				$harga = $this->input->post('jml') * $row['total_rp'];

				$email_tujuan = strip_tags($this->input->post('b'));
				$tglaktif = date("d-m-Y H:i:s");
				$subject      = 'Pemesanan Kode Aktivasi ...';
				$message      = "<html><body>Halooo! <b>".strip_tags($this->input->post('a'))."</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tglaktif</span> Anda Mengirimkan Permohonan Untuk Pembelian Kode Aktivasi di MLM System Binary,..
					<table style='width:100%; margin-left:25px'>
		   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Informasi Anda : </b></td></tr>
						<tr><td><b>Nama Paket</b></td>			<td> : <b>".$row['nama_paket']."</b></td></tr>
						<tr><td><b>Jumlah Pin</b></td>			<td> : ".strip_tags($this->input->post('jml'))." Pin</td></tr>
						<tr><td><b>Nama Lengkap</b></td>		<td> : ".strip_tags($this->input->post('a'))."</td></tr>
						<tr><td><b>Alamat Email</b></td>		<td> : ".strip_tags($this->input->post('b'))."</td></tr>
						<tr><td><b>No Handphone</b></td>		<td> : ".strip_tags($this->input->post('c'))."</td></tr>
						<tr><td><b>Kota</b></td>				<td> : ".strip_tags($this->input->post('d'))." </td></tr>
						<tr><td><b>Nama Bank</b></td>			<td> : ".strip_tags($this->input->post('e'))." </td></tr>
						<tr><td><b>No Rekening</b></td>			<td> : ".strip_tags($this->input->post('f'))." </td></tr>
						<tr><td><b>Pemilik Rekening</b></td>	<td> : ".strip_tags($this->input->post('g'))." </td></tr>
						<tr><td colspan='2'>Silahkan Transfer : <b style='color:red'>Rp ".rupiah($harga)." </b>
											<br>dan selanjutnya orderran anda segera kami proses, salam success..</td></tr>
					</table><br>

					<table style='width:100%; margin-left:25px'>
                  		<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Rekening Perusahaan : </b></td></tr>";
	                    $rekening = $this->model_members->rekening();
	                    foreach ($rekening->result_array() as $row){
		                    echo "<tr bgcolor=#e3e3e3><td width=150px><b>Nama Bank</b></td> <td>$row[nama_bank]</td></tr>
				                  <tr><td><b>No Rekening</b></td>       					<td>$row[no_rekening]</td></tr>
				                  <tr><td><b>Pemilik Rekening</b></td>  					<td>$row[pemilik_rekening]</td></tr>
				                  <tr><td colspan='2'><br></td></tr>";
	                    }
                echo "</table><br>

					Admin, MLM System Binary
					</body></html> \n";
				
				$this->email->from('robby.prihandaya@gmail.com', 'MLM System Binary');
				$this->email->to($email_tujuan);
				$this->email->cc('');
				$this->email->bcc('');

				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->set_mailtype("html");
				$this->email->send();
				
				$config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['charset'] = 'utf-8';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				$this->email->initialize($config);

			$data['email'] = $this->input->post('b');
			$this->template->load('phpmu-one/template','phpmu-one/view_order_success',$data);
		}else{
			$data['jml'] = $this->input->post('jml');
			$data['paket'] = $this->input->post('paket');
			$cek = $this->db->query("SELECT * FROM rb_paket where id_paket='".$this->input->post('paket')."'");
			$row = $cek->row_array();
			$data['harga'] = $this->input->post('jml') * $row['total_rp'];
			$data['nama_paket'] = $row['nama_paket'];
			$data['title'] = 'Formulir Order Kode Aktivasi';
			$this->template->load('phpmu-one/template','phpmu-one/view_order',$data);
		}
	}

	public function login(){
		if (isset($_POST['login'])){
			if ($this->input->post('a') == '' OR $this->input->post('b') == ''){
				echo "<script>window.alert('Maaf, Inputan Tidak Boleh Kosong!!');
                                  window.location=('".base_url()."')</script>";
			}else{
				$username = strip_tags($this->input->post('a'));
				$password = hash("sha512", md5(strip_tags($this->input->post('b'))));
				$cek = $this->db->query("SELECT * FROM rb_konsumen where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."'");
			    $row = $cek->row_array();
			    $total = $cek->num_rows();
				if ($total > 0){
					$this->session->set_userdata(array('id_konsumen'=>$row['id_konsumen'],
									   'kode_konsumen'=>$row['kode_konsumen'], 
									   'username'=>$row['username'],
									   'sponsor'=>$row['sponsor']));
					redirect('members/profile');
				}else{
					$data['title'] = 'Gagal Login';
					$this->template->load('phpmu-one/template','phpmu-one/view_login_error',$data);
				}
			}
		}
	}

	public function lupass(){
		if (isset($_POST['lupa'])){
			$email = strip_tags($this->input->post('a'));
			$cek = $this->db->query("SELECT * FROM rb_konsumen where email='".$this->db->escape_str($email)."'");
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){

				$randompass = generateRandomString(10);
				$passwordbaru = hash("sha512", md5($randompass));
				$this->db->query("UPDATE rb_konsumen SET password='$passwordbaru' where email='".$this->db->escape_str($email)."'");

				if ($row['jenis_kelamin']=='Laki-laki'){ $panggill = 'Bpk.'; }else{ $panggill = 'Ibuk.'; }
				$email_tujuan = $row['email'];
				$tglaktif = date("d-m-Y H:i:s");
				$subject      = 'Permintaan Reset Password ...';
				$message      = "<html><body>Halooo! <b>$panggill ".$row['nama_lengkap']."</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tglaktif</span> Anda Mengirimkan Permintaan untuk Reset Password
					<table style='width:100%; margin-left:25px'>
		   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Informasi akun Anda : </b></td></tr>
						<tr><td><b>Kode Konsumen</b></td>			<td> : ".$row['kode_konsumen']."</td></tr>
						<tr><td><b>Nama Lengkap</b></td>			<td> : ".$row['nama_lengkap']."</td></tr>
						<tr><td><b>Alamat Email</b></td>			<td> : ".$row['email']."</td></tr>
						<tr><td><b>No Telpon</b></td>				<td> : ".$row['no_hp']."</td></tr>
						<tr><td><b>Jenis Kelamin</b></td>			<td> : ".$row['jenis_kelamin']." </td></tr>
						<tr><td><b>Tanggal Lahir</b></td>			<td> : ".$row['tanggal_lahir']." </td></tr>
						<tr><td><b>Nomor KTP</b></td>				<td> : ".$row['no_ktp']." </td></tr>
						<tr><td><b>Alamat Lengkap</b></td>			<td> : ".$row['alamat_lengkap']." </td></tr>
						<tr><td><b>Ahli Waris</b></td>				<td> : ".$row['ahli_waris']." </td></tr>
						<tr><td><b>Kota</b></td>					<td> : ".$row['kota']." </td></tr>
						<tr><td><b>Provinsi</b></td>				<td> : ".$row['provinsi']." </td></tr>
						<tr><td><b>Nama Bank</b></td>				<td> : ".$row['nama_bank']." </td></tr>
						<tr><td><b>No Rekening</b></td>				<td> : ".$row['no_rekening']." </td></tr>
						<tr><td><b>Atas Nama</b></td>				<td> : ".$row['atas_nama']." </td></tr>
						<tr><td><b>Waktu Daftar</b></td>			<td> : ".$row['tanggal_daftar']."</td></tr>
					</table>
					<br> Username Login : <b style='color:red'>$row[username]</b>
					<br> Password Login : <b style='color:red'>$randompass</b>
					<br> Silahkan Login di : <a href='https://phpmu.com/demo/mlm/'>https://phpmu.com/demo/mlm/</a> <br>
					Admin, MLM System Binary </body></html> \n";
				
				$this->email->from('robby.prihandaya@gmail.com', 'MLM System Binary');
				$this->email->to($email_tujuan);
				$this->email->cc('');
				$this->email->bcc('');

				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->set_mailtype("html");
				$this->email->send();
				
				$config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['charset'] = 'utf-8';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				$this->email->initialize($config);

				$data['email'] = $email;
				$data['title'] = 'Permintaan Reset Password Sudah Terkirim...';
				$this->template->load('phpmu-one/template','phpmu-one/view_lupass_success',$data);
			}else{
				$data['email'] = $email;
				$data['title'] = 'Email Tidak Ditemukan...';
				$this->template->load('phpmu-one/template','phpmu-one/view_lupass_error',$data);
			}
		}
	}
}
