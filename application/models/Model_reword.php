<?php 
class Model_reword extends CI_model{
    function reword(){
        return $this->db->query("SELECT * FROM rb_reword ORDER BY id_reword ASC");
    }

    function reword_tambah(){
        $datadb = array('posisi'=>$this->db->escape_str($this->input->post('a')),
                        'ket_kanan'=>$this->db->escape_str($this->input->post('c')),
                        'ket_kiri'=>$this->db->escape_str($this->input->post('e')),
                        'reword'=>$this->db->escape_str($this->input->post('f')));
        $this->db->insert('rb_reword',$datadb);
    }

    function reword_edit($id){
        return $this->db->query("SELECT * FROM rb_reword where id_reword='$id'");
    }

    function reword_update(){
        $datadb = array('posisi'=>$this->db->escape_str($this->input->post('a')),
                        'ket_kanan'=>$this->db->escape_str($this->input->post('c')),
                        'ket_kiri'=>$this->db->escape_str($this->input->post('e')),
                        'reword'=>$this->db->escape_str($this->input->post('f')));
        $this->db->where('id_reword',$this->input->post('id'));
        $this->db->update('rb_reword',$datadb);
    }

    function reword_delete($id){
        return $this->db->query("DELETE FROM rb_reword where id_reword='$id'");
    }
}