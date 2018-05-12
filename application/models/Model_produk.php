<?php 
class Model_produk extends CI_model{
    function produk(){
        return $this->db->query("SELECT * FROM rb_produk ORDER BY id_produk DESC");
    }

    function produk_tambah(){
        $datadb = array('nama_produk'=>$this->db->escape_str($this->input->post('a')),
                        'cabang'=>$this->db->escape_str($this->input->post('dd')),
                        'agen'=>$this->db->escape_str($this->input->post('c')),
                        'distributor'=>$this->db->escape_str($this->input->post('d')),
                        'konsumen'=>$this->db->escape_str($this->input->post('e')),
                        'stok'=>$this->db->escape_str($this->input->post('g')),
                        'status'=>$this->db->escape_str($this->input->post('f')));
        $this->db->insert('rb_produk',$datadb);
    }

    function produk_edit($id){
        return $this->db->query("SELECT * FROM rb_produk where id_produk='$id'");
    }

    function produk_update(){
        $stok = $this->db->query("SELECT * FROM rb_produk where id_produk='".$this->input->post('id')."'")->row_array();
        $datadb = array('nama_produk'=>$this->db->escape_str($this->input->post('a')),
                        'cabang'=>$this->db->escape_str($this->input->post('dd')),
                        'agen'=>$this->db->escape_str($this->input->post('c')),
                        'distributor'=>$this->db->escape_str($this->input->post('d')),
                        'konsumen'=>$this->db->escape_str($this->input->post('e')),
                        'stok'=>($stok['stok'] + $this->input->post('g')),
                        'status'=>$this->db->escape_str($this->input->post('f')));
        $this->db->where('id_produk',$this->input->post('id'));
        $this->db->update('rb_produk',$datadb);
    }

    function produk_delete($id){
        return $this->db->query("DELETE FROM rb_produk where id_produk='$id'");
    }
}