<?php 
class Model_paket extends CI_model{
    function paket(){
        return $this->db->query("SELECT * FROM rb_paket ORDER BY id_paket DESC");
    }

    function paket_tambah(){
        $datadb = array('nama_paket'=>$this->db->escape_str($this->input->post('a')),
                        'total_rp'=>$this->db->escape_str($this->input->post('b')),
                        'min_paket'=>$this->db->escape_str($this->input->post('c')),
                        'max_paket'=>$this->db->escape_str($this->input->post('d')),
                        'nilai_produk'=>$this->db->escape_str($this->input->post('e')),
                        'lainnya'=>$this->db->escape_str($this->input->post('f')),
                        'potensi_penghasilan'=>$this->db->escape_str($this->input->post('g')),
                        'bonus_sponsorisasi'=>$this->db->escape_str($this->input->post('h')),
                        'keterangan'=>$this->db->escape_str($this->input->post('i')));
        $this->db->insert('rb_paket',$datadb);
    }

    function paket_edit($id){
        return $this->db->query("SELECT * FROM rb_paket where id_paket='$id'");
    }

    function paket_update(){
        $datadb = array('nama_paket'=>$this->db->escape_str($this->input->post('a')),
                        'total_rp'=>$this->db->escape_str($this->input->post('b')),
                        'min_paket'=>$this->db->escape_str($this->input->post('c')),
                        'max_paket'=>$this->db->escape_str($this->input->post('d')),
                        'nilai_produk'=>$this->db->escape_str($this->input->post('e')),
                        'lainnya'=>$this->db->escape_str($this->input->post('f')),
                        'potensi_penghasilan'=>$this->db->escape_str($this->input->post('g')),
                        'bonus_sponsorisasi'=>$this->db->escape_str($this->input->post('h')),
                        'keterangan'=>$this->db->escape_str($this->input->post('i')));
        $this->db->where('id_paket',$this->input->post('id'));
        $this->db->update('rb_paket',$datadb);
    }

    function paket_delete($id){
        return $this->db->query("DELETE FROM rb_paket where id_paket='$id'");
    }
}