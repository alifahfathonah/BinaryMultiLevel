<?php 
class Model_auth extends CI_model{
    function register(){
        $bns = $this->db->query("SELECT b.bonus_sponsorisasi, b.total_rp FROM rb_konsumen a JOIN rb_paket b ON a.id_paket=b.id_paket where a.kode_konsumen='".$this->input->post('id')."'")->row();
        $datadbd = array('username'=>$this->db->escape_str(strip_tags($this->input->post('a'))),
                        'password'=>hash("sha512", md5($this->input->post('b'))),
                        'nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                        'email'=>$this->db->escape_str(strip_tags($this->input->post('d'))),
                        'jenis_kelamin'=>$this->db->escape_str($this->input->post('e')),
                        'tanggal_lahir'=>$this->input->post('cf').'-'.$this->input->post('bf').'-'.$this->input->post('af'),
                        'no_ktp'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                        'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('h'))),
                        'ahli_waris'=>$this->db->escape_str(strip_tags($this->input->post('i'))),
                        'kota'=>$this->db->escape_str(strip_tags($this->input->post('j'))),
                        'provinsi'=>$this->db->escape_str(strip_tags($this->input->post('k'))),
                        'no_hp'=>$this->db->escape_str(strip_tags($this->input->post('l'))),
                        'nama_bank'=>$this->db->escape_str(strip_tags($this->input->post('m'))),
                        'no_rekening'=>$this->db->escape_str(strip_tags($this->input->post('n'))),
                        'atas_nama'=>$this->db->escape_str(strip_tags($this->input->post('o'))),
                        'harga_paket'=>$bns->total_rp,
                        'sponsor'=>'',
                        'tanggal_daftar'=>date('Y-m-d'));
        $this->db->where('kode_konsumen',strip_tags($this->input->post('id')));
        $this->db->update('rb_konsumen',$datadbd);
    }

    function order(){
        $datadb = array('jumlah'=>$this->db->escape_str(strip_tags($this->input->post('jml'))),
                        'id_paket'=>$this->db->escape_str(strip_tags($this->input->post('paket'))),
                        'nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('a'))),
                        'alamat_email'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                        'no_hp'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                        'kota'=>$this->db->escape_str(strip_tags($this->input->post('d'))),
                        'nama_bank'=>$this->db->escape_str(strip_tags($this->input->post('e'))),
                        'no_rekening'=>$this->db->escape_str(strip_tags($this->input->post('f'))),
                        'pemilik_rekening'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                        'waktu_order'=>date('Y-m-d H:i:s'));
                $this->db->insert('rb_order_kode',$datadb);
    }
}