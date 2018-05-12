<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Administrator extends CI_Controller {
	function index(){
		if (isset($_POST['submit'])){
			$username = $this->input->post('a');
			$password = hash("sha512", md5($this->input->post('b')));
			$cek = $this->db->query("SELECT * FROM users where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."'");
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				$this->session->set_userdata('upload_image_file_manager',true);
				$this->session->set_userdata(array('username'=>$row['username'],
								   'level'=>$row['level'],
								   'upload_image_file_manager' =>'1'));
				redirect('administrator/home');
			}else{
				$data['title'] = 'Administrator &rsaquo; Log In';
				$this->load->view('administrator/view_login',$data);
			}
		}else{
			$data['title'] = 'Administrator &rsaquo; Log In';
			$this->load->view('administrator/view_login',$data);
		}
	}

	function home(){
		cek_session_admin();
		$this->template->load('administrator/template','administrator/view_home');
	}

	function identitaswebsite(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_main->identitas_update();
			redirect('administrator/identitaswebsite');
		}else{
			$data['record'] = $this->model_main->identitas()->row_array();
			$this->template->load('administrator/template','administrator/mod_identitas/view_identitas',$data);
		}
	}

	// Controller Modul Menu Website

	function menuwebsite(){
		cek_session_admin();
		$data['record'] = $this->model_menu->menu_website();
		$this->template->load('administrator/template','administrator/mod_menu/view_menu',$data);
	}

	function tambah_menuwebsite(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_menu->menu_website_tambah();
			redirect('administrator/menuwebsite');
		}else{
			$data['record'] = $this->model_menu->menu_utama();
			$this->template->load('administrator/template','administrator/mod_menu/view_menu_tambah',$data);
		}
	}

	function edit_menuwebsite(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_menu->menu_website_update();
			redirect('administrator/menuwebsite');
		}else{
			$data['record'] = $this->model_menu->menu_utama();
			$data['rows'] = $this->model_menu->menu_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_menu/view_menu_edit',$data);
		}
	}

	function delete_menuwebsite(){
		$id = $this->uri->segment(3);
		$this->model_menu->menu_delete($id);
		redirect('administrator/menuwebsite');
	}


		// Controller Modul Paket
	function paket(){
		cek_session_admin();
		$data['record'] = $this->model_paket->paket();
		$this->template->load('administrator/template','administrator/mod_paket/view_paket',$data);
	}

	function tambah_paket(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_paket->paket_tambah();
			redirect('administrator/paket');
		}else{
			$this->template->load('administrator/template','administrator/mod_paket/view_paket_tambah');
		}
	}

	function edit_paket(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_paket->paket_update();
			redirect('administrator/paket');
		}else{
			$data['rows'] = $this->model_paket->paket_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_paket/view_paket_edit',$data);
		}
	}

	function delete_paket(){
		$id = $this->uri->segment(3);
		$this->model_paket->paket_delete($id);
		redirect('administrator/paket');
	}


	// Controller Modul Halaman Baru

	function halamanbaru(){
		cek_session_admin();
		$data['record'] = $this->model_halaman->halamanstatis();
		$this->template->load('administrator/template','administrator/mod_halaman/view_halaman',$data);
	}

	function tambah_halamanbaru(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_halaman->halamanstatis_tambah();
			redirect('administrator/halamanbaru');
		}else{
			$this->template->load('administrator/template','administrator/mod_halaman/view_halaman_tambah');
		}
	}

	function edit_halamanbaru(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_halaman->halamanstatis_update();
			redirect('administrator/halamanbaru');
		}else{
			$data['rows'] = $this->model_halaman->halamanstatis_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_halaman/view_halaman_edit',$data);
		}
	}

	function delete_halamanbaru(){
		$id = $this->uri->segment(3);
		$this->model_halaman->halamanstatis_delete($id);
		redirect('administrator/halamanbaru');
	}



	// Controller Modul Download

	function download(){
		cek_session_admin();
		$data['record'] = $this->model_download->index();
		$this->template->load('administrator/template','administrator/mod_download/view_download',$data);
	}

	function tambah_download(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_download->download_tambah();
			redirect('administrator/download');
		}else{
			$this->template->load('administrator/template','administrator/mod_download/view_download_tambah');
		}
	}

	function edit_download(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_download->download_update();
			redirect('administrator/download');
		}else{
			$data['rows'] = $this->model_download->download_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_download/view_download_edit',$data);
		}
	}

	function delete_download(){
		$id = $this->uri->segment(3);
		$this->model_download->download_delete($id);
		redirect('administrator/download');
	}




	// Controller Modul Image Slider

	function imagesslider(){
		cek_session_admin();
		$data['record'] = $this->model_main->slide();
		$this->template->load('administrator/template','administrator/mod_slider/view_slider',$data);
	}

	function tambah_imagesslider(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_main->slide_tambah();
			redirect('administrator/imagesslider');
		}else{
			$this->template->load('administrator/template','administrator/mod_slider/view_slider_tambah');
		}
	}

	function edit_imagesslider(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_main->slide_update();
			redirect('administrator/imagesslider');
		}else{
			$data['rows'] = $this->model_main->slide_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_slider/view_slider_edit',$data);
		}
	}

	function delete_imagesslider(){
		$id = $this->uri->segment(3);
		$this->model_main->slide_delete($id);
		redirect('administrator/imagesslider');
	}



	// Controller Modul Album

	function album(){
		cek_session_admin();
		$data['record'] = $this->model_gallery->album();
		$this->template->load('administrator/template','administrator/mod_album/view_album',$data);
	}

	function tambah_album(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_gallery->album_tambah();
			redirect('administrator/album');
		}else{
			$this->template->load('administrator/template','administrator/mod_album/view_album_tambah');
		}
	}

	function edit_album(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_gallery->album_update();
			redirect('administrator/album');
		}else{
			$data['rows'] = $this->model_gallery->album_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_album/view_album_edit',$data);
		}
	}

	function delete_album(){
		$id = $this->uri->segment(3);
		$this->model_gallery->album_delete($id);
		redirect('administrator/album');
	}


	// Controller Modul Gallery

	function gallery(){
		cek_session_admin();
		$data['record'] = $this->model_gallery->gallery();
		$this->template->load('administrator/template','administrator/mod_gallery/view_gallery',$data);
	}

	function tambah_gallery(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_gallery->gallery_tambah();
			redirect('administrator/gallery');
		}else{
			$data['row'] = $this->model_gallery->album();
			$this->template->load('administrator/template','administrator/mod_gallery/view_gallery_tambah',$data);
		}
	}

	function edit_gallery(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_gallery->gallery_update();
			redirect('administrator/gallery');
		}else{
			$data['row'] = $this->model_gallery->album();
			$data['rows'] = $this->model_gallery->gallery_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_gallery/view_gallery_edit',$data);
		}
	}

	function delete_gallery(){
		$id = $this->uri->segment(3);
		$this->model_gallery->gallery_delete($id);
		redirect('administrator/gallery');
	}


	// Controller Modul Playlist

	function playlist(){
		cek_session_admin();
		$data['record'] = $this->model_playlist->playlist();
		$this->template->load('administrator/template','administrator/mod_playlist/view_playlist',$data);
	}

	function tambah_playlist(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_playlist->playlist_tambah();
			redirect('administrator/playlist');
		}else{
			$this->template->load('administrator/template','administrator/mod_playlist/view_playlist_tambah');
		}
	}

	function edit_playlist(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_playlist->playlist_update();
			redirect('administrator/playlist');
		}else{
			$data['rows'] = $this->model_playlist->playlist_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_playlist/view_playlist_edit',$data);
		}
	}

	function delete_playlist(){
		$id = $this->uri->segment(3);
		$this->model_playlist->playlist_delete($id);
		redirect('administrator/playlist');
	}


	// Controller Modul Video

	function video(){
		cek_session_admin();
		$data['record'] = $this->model_playlist->video();
		$this->template->load('administrator/template','administrator/mod_video/view_video',$data);
	}

	function tambah_video(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_playlist->video_tambah();
			redirect('administrator/video');
		}else{
			$data['row'] = $this->model_playlist->playlist();
			$this->template->load('administrator/template','administrator/mod_video/view_video_tambah',$data);
		}
	}

	function edit_video(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_playlist->video_update();
			redirect('administrator/video');
		}else{
			$data['row'] = $this->model_playlist->playlist();
			$data['rows'] = $this->model_playlist->video_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_video/view_video_edit',$data);
		}
	}

	function delete_video(){
		$id = $this->uri->segment(3);
		$this->model_playlist->video_delete($id);
		redirect('administrator/video');
	}


	// Controller Modul Testimoni

	function testimoni(){
		cek_session_admin();
		$data['record'] = $this->model_testimoni->testimoni();
		$this->template->load('administrator/template','administrator/mod_testimoni/view_testimoni',$data);
	}

	function edit_testimoni(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_testimoni->testimoni_update();
			redirect('administrator/testimoni');
		}else{
			$data['rows'] = $this->model_testimoni->testimoni_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_testimoni/view_testimoni_edit',$data);
		}
	}

	function delete_testimoni(){
		$id = $this->uri->segment(3);
		$this->model_testimoni->testimoni_delete($id);
		redirect('administrator/testimoni');
	}


	// Controller Modul List Berita

	function listberita(){
		cek_session_admin();
		$data['record'] = $this->model_berita->list_berita();
		$this->template->load('administrator/template','administrator/mod_berita/view_berita',$data);
	}

	function tambah_listberita(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_berita->list_berita_tambah();
			redirect('administrator/listberita');
		}else{
			$data['tag'] = $this->model_berita->tag_berita();
			$data['record'] = $this->model_berita->kategori_berita();
			$this->template->load('administrator/template','administrator/mod_berita/view_berita_tambah',$data);
		}
	}

	function cepat_listberita(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_berita->list_berita_cepat();
			redirect('administrator/listberita');
		}else{
			redirect('administrator/listberita');
		}
	}

	function edit_listberita(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_berita->list_berita_update();
			redirect('administrator/listberita');
		}else{
			$data['tag'] = $this->model_berita->tag_berita();
			$data['record'] = $this->model_berita->kategori_berita();
			$data['rows'] = $this->model_berita->list_berita_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_berita/view_berita_edit',$data);
		}
	}

	function delete_listberita(){
		$id = $this->uri->segment(3);
		$this->model_berita->list_berita_delete($id);
		redirect('administrator/listberita');
	}


	// Controller Modul Kategori Berita

	function kategoriberita(){
		cek_session_admin();
		$data['record'] = $this->model_berita->kategori_berita();
		$this->template->load('administrator/template','administrator/mod_kategori/view_kategori',$data);
	}

	function tambah_kategoriberita(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_berita->kategori_berita_tambah();
			redirect('administrator/kategoriberita');
		}else{
			$this->template->load('administrator/template','administrator/mod_kategori/view_kategori_tambah');
		}
	}

	function edit_kategoriberita(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_berita->kategori_berita_update();
			redirect('administrator/kategoriberita');
		}else{
			$data['rows'] = $this->model_berita->kategori_berita_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_kategori/view_kategori_edit',$data);
		}
	}

	function delete_kategoriberita(){
		$id = $this->uri->segment(3);
		$this->model_berita->kategori_berita_delete($id);
		redirect('administrator/kategoriberita');
	}



	// Controller Modul Tag Berita

	function tagberita(){
		cek_session_admin();
		$data['record'] = $this->model_berita->tag_berita();
		$this->template->load('administrator/template','administrator/mod_tag/view_tag',$data);
	}

	function tambah_tagberita(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_berita->tag_berita_tambah();
			redirect('administrator/tagberita');
		}else{
			$this->template->load('administrator/template','administrator/mod_tag/view_tag_tambah');
		}
	}

	function edit_tagberita(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_berita->tag_berita_update();
			redirect('administrator/tagberita');
		}else{
			$data['rows'] = $this->model_berita->tag_berita_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_tag/view_tag_edit',$data);
		}
	}

	function delete_tagberita(){
		$id = $this->uri->segment(3);
		$this->model_berita->tag_berita_delete($id);
		redirect('administrator/tagberita');
	}



	// Controller Modul Iklan Home

	function iklanhome(){
		cek_session_admin();
		$data['record'] = $this->model_iklan->iklan_tengah();
		$this->template->load('administrator/template','administrator/mod_iklanhome/view_iklanhome',$data);
	}

	function tambah_iklanhome(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_iklan->iklan_tengah_tambah();
			redirect('administrator/iklanhome');
		}else{
			$this->template->load('administrator/template','administrator/mod_iklanhome/view_iklanhome_tambah');
		}
	}

	function edit_iklanhome(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_iklan->iklan_tengah_update();
			redirect('administrator/iklanhome');
		}else{
			$data['rows'] = $this->model_iklan->iklan_tengah_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_iklanhome/view_iklanhome_edit',$data);
		}
	}

	function delete_iklanhome(){
		$id = $this->uri->segment(3);
		$this->model_iklan->iklan_tengah_delete($id);
		redirect('administrator/iklanhome');
	}



	// Controller Modul Iklan Sidebar

	function iklansidebar(){
		cek_session_admin();
		$data['record'] = $this->model_iklan->iklan_sidebar();
		$this->template->load('administrator/template','administrator/mod_iklansidebar/view_iklansidebar',$data);
	}

	function tambah_iklansidebar(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_iklan->iklan_sidebar_tambah();
			redirect('administrator/iklansidebar');
		}else{
			$this->template->load('administrator/template','administrator/mod_iklansidebar/view_iklansidebar_tambah');
		}
	}

	function edit_iklansidebar(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_iklan->iklan_sidebar_update();
			redirect('administrator/iklansidebar');
		}else{
			$data['rows'] = $this->model_iklan->iklan_sidebar_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_iklansidebar/view_iklansidebar_edit',$data);
		}
	}

	function delete_iklansidebar(){
		$id = $this->uri->segment(3);
		$this->model_iklan->iklan_sidebar_delete($id);
		redirect('administrator/iklansidebar');
	}



	// Controller Modul Logo

	function logowebsite(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_main->logo_update();
			redirect('administrator/logowebsite');
		}else{
			$data['record'] = $this->model_main->logo();
			$this->template->load('administrator/template','administrator/mod_logowebsite/view_logowebsite',$data);
		}
	}



	// Controller Modul Template Website

	function templatewebsite(){
		cek_session_admin();
		$data['record'] = $this->model_main->template();
		$this->template->load('administrator/template','administrator/mod_template/view_template',$data);
	}

	function tambah_templatewebsite(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_main->template_tambah();
			redirect('administrator/templatewebsite');
		}else{
			$this->template->load('administrator/template','administrator/mod_template/view_template_tambah');
		}
	}

	function edit_templatewebsite(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_main->template_update();
			redirect('administrator/templatewebsite');
		}else{
			$data['rows'] = $this->model_main->template_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_template/view_template_edit',$data);
		}
	}

	function delete_templatewebsite(){
		$id = $this->uri->segment(3);
		$this->model_main->template_delete($id);
		redirect('administrator/templatewebsite');
	}




	// Controller Modul Agenda

	function agenda(){
		cek_session_admin();
		$data['record'] = $this->model_agenda->agenda();
		$this->template->load('administrator/template','administrator/mod_agenda/view_agenda',$data);
	}

	function tambah_agenda(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_agenda->agenda_tambah();
			redirect('administrator/agenda');
		}else{
			$this->template->load('administrator/template','administrator/mod_agenda/view_agenda_tambah');
		}
	}

	function edit_agenda(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_agenda->agenda_update();
			redirect('administrator/agenda');
		}else{
			$data['rows'] = $this->model_agenda->agenda_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_agenda/view_agenda_edit',$data);
		}
	}

	function delete_agenda(){
		$id = $this->uri->segment(3);
		$this->model_agenda->agenda_delete($id);
		redirect('administrator/agenda');
	}




	// Controller Modul YM

	function ym(){
		cek_session_admin();
		$data['record'] = $this->model_main->ym();
		$this->template->load('administrator/template','administrator/mod_ym/view_ym',$data);
	}

	function tambah_ym(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_main->ym_tambah();
			redirect('administrator/ym');
		}else{
			$this->template->load('administrator/template','administrator/mod_ym/view_ym_tambah');
		}
	}

	function edit_ym(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_main->ym_update();
			redirect('administrator/ym');
		}else{
			$data['rows'] = $this->model_main->ym_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_ym/view_ym_edit',$data);
		}
	}

	function delete_ym(){
		$id = $this->uri->segment(3);
		$this->model_main->ym_delete($id);
		redirect('administrator/ym');
	}




	// Controller Modul Pesan Masuk

	function pesanmasuk(){
		cek_session_admin();
		$data['record'] = $this->model_main->pesan_masuk();
		$this->template->load('administrator/template','administrator/mod_pesanmasuk/view_pesanmasuk',$data);
	}

	function detail_pesanmasuk(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		$this->db->query("UPDATE hubungi SET dibaca='Y' where id_hubungi='$id'");
		if (isset($_POST['submit'])){
			$this->model_main->pesan_masuk_kirim();
			$data['rows'] = $this->model_main->pesan_masuk_view($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_pesanmasuk/view_pesanmasuk_detail',$data);
		}else{
			$data['rows'] = $this->model_main->pesan_masuk_view($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_pesanmasuk/view_pesanmasuk_detail',$data);
		}
	}




	// Controller Modul User

	function manajemenuser(){
		cek_session_admin();
		$data['record'] = $this->model_users->users();
		$this->template->load('administrator/template','administrator/mod_users/view_users',$data);
	}

	function tambah_manajemenuser(){
		cek_session_admin();
		$id = $this->session->username;
		if (isset($_POST['submit'])){
			$this->model_users->users_tambah();
			redirect('administrator/manajemenuser');
		}else{
			$data['mo'] = $this->model_modul->users_modul();
			$data['rows'] = $this->model_users->users_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_users/view_users_tambah',$data);
		}
	}

	function edit_manajemenuser(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_users->users_update();
			redirect('administrator/manajemenuser');
		}else{
			$data['mo'] = $this->model_modul->users_modul();
			$data['rows'] = $this->model_users->users_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_users/view_users_edit',$data);
		}
	}

	function delete_manajemenuser(){
		$id = $this->uri->segment(3);
		$this->model_users->users_delete($id);
		redirect('administrator/manajemenuser');
	}

	


	// Controller Modul Modul

	function manajemenmodul(){
		cek_session_admin();
		$data['record'] = $this->model_modul->modul();
		$this->template->load('administrator/template','administrator/mod_modul/view_modul',$data);
	}

	function tambah_manajemenmodul(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_modul->modul_tambah();
			redirect('administrator/manajemenmodul');
		}else{
			$this->template->load('administrator/template','administrator/mod_modul/view_modul_tambah');
		}
	}

	function edit_manajemenmodul(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_modul->modul_update();
			redirect('administrator/manajemenmodul');
		}else{
			$data['rows'] = $this->model_modul->modul_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_modul/view_modul_edit',$data);
		}
	}

	function delete_manajemenmodul(){
		$id = $this->uri->segment(3);
		$this->model_modul->modul_delete($id);
		redirect('administrator/manajemenmodul');
	}



	// Controller Modul keuangan


	function rekapkeuangan(){
		cek_session_admin();
		$data['record'] = $this->model_members->konsumen();
		$this->template->load('administrator/template','administrator/mod_keuangan/view_keuangan',$data);
	}

	function exportexcel(){
		cek_session_admin();
		$data['record'] = $this->model_members->konsumen();
		$this->load->view('administrator/mod_keuangan/export_excel',$data);
	}

	function bayarrekapkeuangan(){
		cek_session_admin();
		$row = $this->db->query("SELECT * FROM rb_konsumen where id_konsumen='".$this->uri->segment(3)."'")->row_array();
		$set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
		$sponsor = $this->model_members->keuangan($row['username'])->row_array();
        $bonus = $this->model_members->bonussponsor($row['username'])->row_array();
        $tabungan = $this->model_members->bonustabungan($row['username'])->row_array();
        $ro = $this->model_members->bonusro($row['username'])->row_array();
        $cairan = $this->model_members->totpencairan($row['username'],$set['bonus_pasangan'])->row_array();
        $as = $this->model_members->autosavesum($row['username'],$set['persen_auto_save'],$set['ppn'])->row_array();

        $kecil = min($sponsor['totfoot_left']-$cairan['bonus_pasangan'], $sponsor['totfoot_right']-$cairan['bonus_pasangan']);
        $sisakiri = $sponsor['totfoot_left']-$cairan['bonus_pasangan'];
        $sisakanan = $sponsor['totfoot_right']-$cairan['bonus_pasangan'];
        $bonuspasangan = $kecil*100000;
        $bonussponsor = $bonus['bonussponsor']-$cairan['bonus_sponsor'];
        $bonustabungan = $tabungan['bonustabungan']-$cairan['bonus_tabungan'];		
        $bonusro = $ro['bonusro']-$cairan['bonus_ro'];

        $totalbonus = $bonuspasangan+$bonussponsor+$bonustabungan+$bonusro;
        $ppn = 10/100*($totalbonus);
        $bonus_pajak = $totalbonus-$ppn;
        $autosave = 20/100*($bonus_pajak);

        $cekautosave = $as['auto_save'] + $autosave;
        if ($as['auto_save'] >= 1000000){
            $sisa = 0;
            $totalbonusbersih = $totalbonus - $ppn - $sisa;
        }elseif ($cekautosave >= 1000000){
            $sisa = $autosave-($autosave - (1000000 - $as['auto_save']));
            $totalbonusbersih = $totalbonus - $ppn - $sisa + ($autosave - (1000000 - $as['auto_save']));
        }else{
            $sisa = $autosave;
            $totalbonusbersih = $totalbonus - $ppn - $sisa;
        }

        if ($totalbonusbersih > 1){
	        $datadb = array('username'=>$row['username'],
	                        'bonus_pasangan'=>$bonuspasangan,
	                        'bonus_sponsor'=>$bonussponsor,
	                        'bonus_tabungan'=>$bonustabungan,
	                        'bonus_ro'=>$bonusro,
	                        'waktu_bayar'=>date('Y-m-d'));
	        $this->db->insert('rb_pembayaran_bonus',$datadb);
	    }

        redirect('administrator/rekapkeuangan');
	}

	function bonushistory(){
		cek_session_admin();
		$data['record'] = $this->model_members->bonushistory();
		$this->template->load('administrator/template','administrator/mod_keuangan/view_bonus_history',$data);
	}

	function bonushistory_delete(){
		$id = $this->uri->segment(3);
		$this->model_members->bonushistory_delete($id);
		redirect('administrator/bonushistory');
	}

	function keuanganbayarmanual(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_members->keuanganbayarmanual_tambah();
			redirect('administrator/rekapkeuangan');
		}else{
			$this->template->load('administrator/template','administrator/mod_keuangan/view_keuangan_bayar');
		}
	}


	// Controller Modul Konsumen

	function konsumen(){
		cek_session_admin();
		$data['record'] = $this->model_members->konsumen();
		$this->template->load('administrator/template','administrator/mod_konsumen/view_konsumen',$data);
	}

	function koderahasia(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$kode = $this->input->post('kode');
			$this->model_members->kode_konsumen_tambah();
			redirect('administrator/koderahasia');
		}else{
			$data['record'] = $this->model_members->kode_konsumen();
			$data['paket'] = $this->model_members->paket();
			$this->template->load('administrator/template','administrator/mod_konsumen/view_kode',$data);
		}
	}

	function orderkode(){
		cek_session_admin();
		$data['record'] = $this->model_members->orderkode();
		$this->template->load('administrator/template','administrator/mod_orderkode/view_orderkode',$data);
	}

	function orderkodekonsumen(){
		cek_session_admin();
		$data['record'] = $this->model_members->konsumen_orderkode();
		$data['title']  = 'Pesanan Kode Aktivasi Dari Konsumen.';
		$data['level']  = 'konsumen';
		$this->template->load('administrator/template','administrator/mod_orderkode/view_orderkodekonsumen',$data);
	}

	function orderkodeagen(){
		cek_session_admin();
		$data['record'] = $this->model_members->agen_orderkode();
		$data['title']  = 'Pesanan Kode Aktivasi Dari Agen.';
		$data['level']  = 'agen';
		$this->template->load('administrator/template','administrator/mod_orderkode/view_orderkodekonsumen',$data);
	}

	function orderkodedistributor(){
		cek_session_admin();
		$data['record'] = $this->model_members->distributor_orderkode();
		$data['title']  = 'Pesanan Kode Aktivasi Dari Distributor.';
		$data['level']  = 'distributor';
		$this->template->load('administrator/template','administrator/mod_orderkode/view_orderkodekonsumen',$data);
	}

	function orderkodeperwakilan(){
		cek_session_admin();
		$data['record'] = $this->model_members->perwakilan_orderkode();
		$data['title']  = 'Pesanan Kode Aktivasi Dari Perwakilan.';
		$data['level']  = 'perwakilan';
		$this->template->load('administrator/template','administrator/mod_orderkode/view_orderkodekonsumen',$data);
	}


	function kirim_orderkodekonsumen(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_members->kode_konsumen_insert();
			redirect('administrator/kirim_orderkodekonsumen/'.$this->input->post('id'));
		}else{
			$data['record'] = $this->model_members->konsumen_orderkode_terkirim($this->uri->segment(3));
			$this->template->load('administrator/template','administrator/mod_orderkode/view_orderkodekonsumen_kirim',$data);
		}
	}

	function kirim_orderkodeagen(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_members->kode_konsumen_insert();
			redirect('administrator/kirim_orderkodeagen/'.$this->input->post('id'));
		}else{
			$data['record'] = $this->model_agen->konsumen_orderkode_terkirim($this->uri->segment(3));
			$this->template->load('administrator/template','administrator/mod_orderkode/view_orderkodeagen_kirim',$data);
		}
	}

	function kirim_orderkodedistributor(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_members->kode_konsumen_insert();
			redirect('administrator/kirim_orderkodedistributor/'.$this->input->post('id'));
		}else{
			$data['record'] = $this->model_distributor->konsumen_orderkode_terkirim($this->uri->segment(3));
			$this->template->load('administrator/template','administrator/mod_orderkode/view_orderkodedistributor_kirim',$data);
		}
	}

	function kirim_orderkodeperwakilan(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_members->kode_konsumen_insert();
			redirect('administrator/kirim_orderkodeperwakilan/'.$this->input->post('id'));
		}else{
			$data['record'] = $this->model_perwakilan->konsumen_orderkode_terkirim($this->uri->segment(3));
			$this->template->load('administrator/template','administrator/mod_orderkode/view_orderkodeperwakilan_kirim',$data);
		}
	}


	function delete_orderkode(){
		$id = $this->uri->segment(3);
		$this->model_members->orderkode_delete($id);
		redirect('administrator/orderkode');
	}

	function delete_orderkodekonsumen(){
		$id = $this->uri->segment(3);
		$this->model_members->orderkodekonsumen_delete($id);
		redirect('administrator/kirim_orderkodekonsumen/'.$this->uri->segment(4));
	}

	function delete_orderkodeagen(){
		$id = $this->uri->segment(3);
		$this->model_members->orderkodekonsumen_delete($id);
		redirect('administrator/kirim_orderkodeagen/'.$this->uri->segment(4));
	}

	function delete_orderkodedistributor(){
		$id = $this->uri->segment(3);
		$this->model_members->orderkodekonsumen_delete($id);
		redirect('administrator/kirim_orderkodedistributor/'.$this->uri->segment(4));
	}

	function delete_orderkodeperwakilan(){
		$id = $this->uri->segment(3);
		$this->model_members->orderkodekonsumen_delete($id);
		redirect('administrator/kirim_orderkodeperwakilan/'.$this->uri->segment(4));
	}

	function tambah_konsumen(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_members->konsumen_tambah();
			redirect('administrator/konsumen');
		}else{
			$data['record'] = $this->model_members->paket();
			$this->template->load('administrator/template','administrator/mod_konsumen/view_konsumen_tambah',$data);
		}
	}

	function edit_konsumen(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_members->konsumen_update($id);
			redirect('administrator/konsumen');
		}else{
			$data['rows'] = $this->model_members->profile_view($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_konsumen/view_konsumen_edit',$data);
		}
	}

	
	function detail_konsumen(){
		cek_session_admin();
			$id = $this->uri->segment(3);
			$dat = $this->db->query("SELECT * FROM rb_konsumen where id_konsumen='$id'")->row_array();
			$set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();

			$idk = $dat['username'];
			$data['idk'] = $dat['username'];
			$data['rows'] = $this->model_members->profile_view($id)->row_array();
			$data['tabungan'] = $this->model_members->tabungankonsumen($idk);
			$data['bonustabungan'] = $this->model_members->bonustabungan($idk)->row_array();
            $data['ro'] = $this->model_members->bonusro($idk)->row_array();
            $data['as'] = $this->model_members->autosavesum($idk,$set['persen_auto_save'],$set['ppn'])->row_array();

			$data['sponsor'] = $this->model_members->keuangan($idk)->row_array();
			$data['bonus'] = $this->model_members->bonussponsor($idk)->row_array();
			$data['tax'] = $this->model_members->bonustax($idk);
			$data['rox'] = $this->model_members->bonusrox($idk);
			$data['cairan'] = $this->model_members->totpencairan($idk,$set['bonus_pasangan'])->row_array();

			$data['pencairan'] = $this->model_members->pencairan_detail($idk);
			$data['sponsorisasi'] = $this->model_members->sponsorisasi($idk);
			$data['total_sponsorisasi'] = $this->model_members->sponsorisasi_total($idk)->row_array();
			$data['total_tabungan'] = $this->model_members->tabungan_total($idk)->row_array();
			$data['total_ro'] = $this->model_members->ro_total($idk)->row_array();
			
			$data['dp'] = $this->model_members->profile($id)->row_array();
			$data['total'] = $this->model_members->total_tabungan($idk)->row_array();
			$this->template->load('administrator/template','administrator/mod_konsumen/view_konsumen_detail',$data);
	}

	function delete_konsumen(){
		$id = $this->uri->segment(3);
		$this->model_members->konsumen_delete($id);
		redirect('administrator/koderahasia');
	}


		// Controller Modul Perwakilan

	function perwakilan(){
		cek_session_admin();
		$data['record'] = $this->model_perwakilan->perwakilan();
		$this->template->load('administrator/template','administrator/mod_perwakilan/view_perwakilan',$data);
	}

	function tambah_perwakilan(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_perwakilan->perwakilan_tambah();
			redirect('administrator/perwakilan');
		}else{
			$this->template->load('administrator/template','administrator/mod_perwakilan/view_perwakilan_tambah');
		}
	}

	function edit_perwakilan(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_perwakilan->perwakilan_update();
			redirect('administrator/detail_perwakilan/'.$this->input->post('id'));
		}else{
			$data['rows'] = $this->model_perwakilan->perwakilan_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_perwakilan/view_perwakilan_edit',$data);
		}
	}

	function detail_perwakilan(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		$data['rows'] = $this->model_perwakilan->detail_perwakilan($id)->row_array();
		$data['produk'] = $this->model_perwakilan->produk($id);
		$data['pembelian'] = $this->model_perwakilan->pembelian($id);
		$data['penjualan_konsumen'] = $this->model_perwakilan->penjualan_konsumen($id);
		$data['penjualan_agen'] = $this->model_perwakilan->penjualan_agen($id);
		$data['penjualan_distributor'] = $this->model_perwakilan->penjualan_distributor($id);
		$this->template->load('administrator/template','administrator/mod_perwakilan/view_perwakilan_detail',$data);
	}

	function delete_perwakilan(){
		$id = $this->uri->segment(3);
		$this->model_perwakilan->perwakilan_delete($id);
		redirect('administrator/perwakilan');
	}


		// Controller Modul perwakilan order

	function orderperwakilan(){
		cek_session_admin();
		$data['record'] = $this->model_perwakilan->orderperwakilan();
		$this->template->load('administrator/template','administrator/mod_orderperwakilan/view_orderperwakilan',$data);
	}

	function tambah_orderperwakilan(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_perwakilan->orderperwakilan_tambah();
			redirect('administrator/orderperwakilan');
		}else{
			$data['perwakilan'] = $this->model_perwakilan->perwakilan();
			$data['produk'] = $this->model_produk->produk();
			$this->template->load('administrator/template','administrator/mod_orderperwakilan/view_orderperwakilan_tambah',$data);
		}
	}

	function edit_orderperwakilan(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_perwakilan->orderperwakilan_update();
			redirect('administrator/orderperwakilan');
		}else{
			$data['perwakilan'] = $this->model_perwakilan->perwakilan();
			$data['produk'] = $this->model_produk->produk();
			$data['rows'] = $this->model_perwakilan->orderperwakilan_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_orderperwakilan/view_orderperwakilan_edit',$data);
		}
	}

	function delete_orderperwakilan(){
		$id = $this->uri->segment(3);
		$this->model_perwakilan->orderperwakilan_delete($id);
		redirect('administrator/orderperwakilan');
	}


	// Controller Modul Produk

	function produk(){
		cek_session_admin();
		$data['record'] = $this->model_produk->produk();
		$this->template->load('administrator/template','administrator/mod_produk/view_produk',$data);
	}

	function tambah_produk(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_produk->produk_tambah();
			redirect('administrator/produk');
		}else{
			$this->template->load('administrator/template','administrator/mod_produk/view_produk_tambah');
		}
	}

	function edit_produk(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_produk->produk_update();
			redirect('administrator/produk');
		}else{
			$data['rows'] = $this->model_produk->produk_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_produk/view_produk_edit',$data);
		}
	}

	function delete_produk(){
		$id = $this->uri->segment(3);
		$this->model_produk->produk_delete($id);
		redirect('administrator/produk');
	}


	// Controller Modul Rekening

	function rekening(){
		cek_session_admin();
		$data['record'] = $this->model_rekening->rekening();
		$this->template->load('administrator/template','administrator/mod_rekening/view_rekening',$data);
	}

	function tambah_rekening(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_rekening->rekening_tambah();
			redirect('administrator/rekening');
		}else{
			$this->template->load('administrator/template','administrator/mod_rekening/view_rekening_tambah');
		}
	}

	function edit_rekening(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_rekening->rekening_update();
			redirect('administrator/rekening');
		}else{
			$data['rows'] = $this->model_rekening->rekening_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_rekening/view_rekening_edit',$data);
		}
	}

	function delete_rekening(){
		$id = $this->uri->segment(3);
		$this->model_rekening->rekening_delete($id);
		redirect('administrator/rekening');
	}



	// Controller Modul Reword

	function reword(){
		cek_session_admin();
		$data['record'] = $this->model_reword->reword();
		$this->template->load('administrator/template','administrator/mod_reword/view_reword',$data);
	}

	function tambah_reword(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_reword->reword_tambah();
			redirect('administrator/reword');
		}else{
			$this->template->load('administrator/template','administrator/mod_reword/view_reword_tambah');
		}
	}

	function edit_reword(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_reword->reword_update();
			redirect('administrator/reword');
		}else{
			$data['rows'] = $this->model_reword->reword_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_reword/view_reword_edit',$data);
		}
	}

	function delete_reword(){
		$id = $this->uri->segment(3);
		$this->model_reword->reword_delete($id);
		redirect('administrator/reword');
	}



	// Controller Modul Agen

	function agen(){
		cek_session_admin();
		$data['record'] = $this->model_agen->agen();
		$this->template->load('administrator/template','administrator/mod_agen/view_agen',$data);
	}

	function tambah_agen(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_agen->agen_tambah();
			redirect('administrator/agen');
		}else{
			$this->template->load('administrator/template','administrator/mod_agen/view_agen_tambah');
		}
	}

	function edit_agen(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_agen->agen_update();
			redirect('administrator/agen');
		}else{
			$data['rows'] = $this->model_agen->agen_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_agen/view_agen_edit',$data);
		}
	}

	function detail_agen(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		$data['rows'] = $this->model_agen->detail_agen($id)->row_array();
		$data['produk'] = $this->model_agen->produk($id);
		$data['pembelian'] = $this->model_agen->pembelian($id);
		$data['pembeliandist'] = $this->model_agen->pembeliandist($id);
		$data['pembelianperw'] = $this->model_agen->pembelianperw($id);
		$data['penjualan'] = $this->model_agen->penjualan($id);
		$this->template->load('administrator/template','administrator/mod_agen/view_agen_detail',$data);
	}

	function delete_agen(){
		$id = $this->uri->segment(3);
		$this->model_agen->agen_delete($id);
		redirect('administrator/agen');
	}


	// Controller Modul Agen Order

	function orderagen(){
		cek_session_admin();
		$data['record'] = $this->model_agen->orderagen();
		$this->template->load('administrator/template','administrator/mod_orderagen/view_orderagen',$data);
	}

	function tambah_orderagen(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_agen->orderagen_tambah();
			redirect('administrator/orderagen');
		}else{
			$data['agen'] = $this->model_agen->agen();
			$data['produk'] = $this->model_produk->produk();
			$this->template->load('administrator/template','administrator/mod_orderagen/view_orderagen_tambah',$data);
		}
	}

	function edit_orderagen(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_agen->orderagen_update();
			redirect('administrator/orderagen');
		}else{
			$data['agen'] = $this->model_agen->agen();
			$data['produk'] = $this->model_produk->produk();
			$data['rows'] = $this->model_agen->orderagen_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_orderagen/view_orderagen_edit',$data);
		}
	}

	function delete_orderagen(){
		$id = $this->uri->segment(3);
		$this->model_agen->orderagen_delete($id);
		redirect('administrator/orderagen');
	}



		// Controller Modul Distributor

	function distributor(){
		cek_session_admin();
		$data['record'] = $this->model_distributor->distributor();
		$this->template->load('administrator/template','administrator/mod_distributor/view_distributor',$data);
	}

	function tambah_distributor(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_distributor->distributor_tambah();
			redirect('administrator/distributor');
		}else{
			$this->template->load('administrator/template','administrator/mod_distributor/view_distributor_tambah');
		}
	}

	function edit_distributor(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_distributor->distributor_update();
			redirect('administrator/detail_distributor/'.$this->input->post('id'));
		}else{
			$data['rows'] = $this->model_distributor->distributor_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_distributor/view_distributor_edit',$data);
		}
	}

	function detail_distributor(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		$data['rows'] = $this->model_distributor->detail_distributor($id)->row_array();
		$data['produk'] = $this->model_distributor->produk($id);
		$data['pembelian'] = $this->model_distributor->pembelian($id);
		$data['penjualan_konsumen'] = $this->model_distributor->penjualan_konsumen($id);
		$data['penjualan_agen'] = $this->model_distributor->penjualan_agen($id);
		$this->template->load('administrator/template','administrator/mod_distributor/view_distributor_detail',$data);
	}

	function delete_distributor(){
		$id = $this->uri->segment(3);
		$this->model_distributor->distributor_delete($id);
		redirect('administrator/distributor');
	}



	// Controller Modul distributor order

	function orderdistributor(){
		cek_session_admin();
		$data['record'] = $this->model_distributor->orderdistributor();
		$this->template->load('administrator/template','administrator/mod_orderdistributor/view_orderdistributor',$data);
	}

	function tambah_orderdistributor(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_distributor->orderdistributor_tambah();
			redirect('administrator/orderdistributor');
		}else{
			$data['distributor'] = $this->model_distributor->distributor();
			$data['produk'] = $this->model_produk->produk();
			$this->template->load('administrator/template','administrator/mod_orderdistributor/view_orderdistributor_tambah',$data);
		}
	}

	function edit_orderdistributor(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_distributor->orderdistributor_update();
			redirect('administrator/orderdistributor');
		}else{
			$data['distributor'] = $this->model_distributor->distributor();
			$data['produk'] = $this->model_produk->produk();
			$data['rows'] = $this->model_distributor->orderdistributor_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_orderdistributor/view_orderdistributor_edit',$data);
		}
	}

	function delete_orderdistributor(){
		$id = $this->uri->segment(3);
		$this->model_distributor->orderdistributor_delete($id);
		redirect('administrator/orderdistributor');
	}

	// Controller Modul Upgrade
	function upgrade(){
		cek_session_admin();
			$data['record'] = $this->model_upgrade->upgrade();
			$this->template->load('administrator/template','administrator/mod_upgrade/view_upgrade',$data);
	}

	function proses_upgrade(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		$total = $this->db->query("SELECT * FROM `rb_upgrade` where id_upgrade='$id' AND status='1'")->num_rows();
		if ($total >= 1){
			echo "<script>window.alert('Maaf, Anda permintaan ini sudah di proses,..');
                                  window.location=('".base_url()."administrator/upgrade')</script>";
		}else{
			$this->model_upgrade->upgrade_update($id);
			redirect('administrator/upgrade');
		}
	}

	function delete_upgrade(){
		$id = $this->uri->segment(3);
		$this->model_upgrade->upgrade_delete($id);
		redirect('administrator/upgrade');
	}




	// Controller Modul Tabungan


	function pencairan_file(){
		$name = $this->uri->segment(3);
		$data = file_get_contents("asset/bukti_transfer/".$name);
		force_download($name, $data);
	}

	function downloadkonfirmasitabungan(){
		$name = $this->uri->segment(3);
		$data = file_get_contents("asset/bukti_transfer/".$name);
		force_download($name, $data);
	}

	function tabungan(){
		cek_session_admin();
		$data['record'] = $this->model_members->tabungan();
		$this->template->load('administrator/template','administrator/mod_tabungan/view_tabungan',$data);
	}

	function bayartabungan(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$cek = $this->db->query("SELECT * FROM rb_konsumen where username='".$this->input->post('a')."'")->num_rows();
			if ($cek >= 1){
				$this->model_members->bayar_tabungan();
				redirect('administrator/tabungan');
			}else{
				echo "<script>window.alert('Maaf, Data Konsumen Tidak Ditemukan!');
                                  window.location=('".base_url()."administrator/tabungan')</script>";
			}
			
		}else{
			$this->template->load('administrator/template','administrator/mod_tabungan/view_tabungan_bayar');
		}
	}

	function edittabungan(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_members->tabungan_update();
			redirect('administrator/tabungan');
		}else{
			$data['rows'] = $this->model_members->tabungan_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_tabungan/view_tabungan_edit',$data);
		}
	}

	function deletetabungan(){
		$id = $this->uri->segment(3);
		$this->model_members->tabungan_delete($id);
		redirect('administrator/tabungan');
	}


	// Controller Modul Setting Bonus

	function settingbonus(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_main->settingbonus_update();
			redirect('administrator/settingbonus');
		}else{
			$data['record'] = $this->model_main->settingbonus()->row_array();
			$this->template->load('administrator/template','administrator/mod_settingbonus/view_settingbonus',$data);
		}
	}


	function logout(){
		$this->session->sess_destroy();
		redirect('main');
	}
}
