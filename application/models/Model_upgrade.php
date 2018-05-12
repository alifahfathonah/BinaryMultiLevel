<?php 
class Model_upgrade extends CI_model{
    function upgrade(){
        return $this->db->query("SELECT a.id_upgrade, a.id_konsumen, a.id_paket, a.status, a.keterangan, b.id_paket as paket_lama, b.username, b.nama_lengkap, c.min_paket as baru, c.nama_paket as baruc, d.min_paket as lama, d.nama_paket as lamad, (c.min_paket-d.min_paket) as selisih FROM `rb_upgrade` a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen JOIN rb_paket c ON a.id_paket=c.id_paket LEFT JOIN rb_paket d ON a.id_paket_lama=d.id_paket ORDER BY a.id_upgrade DESC");
    }

    function konfirmasitabungan(){
        return $this->db->query("SELECT c.id_konsumen, a.id_tabungan_konfirmasi, c.nama_lengkap, a.bukti_transfer, b.total_bayar, b.tanggal_bayar, b.status, b.keterangan  FROM rb_tabungan_konfirmasi a JOIN rb_tabungan_bayar b ON a.id_tabungan_bayar=b.id_tabungan_bayar JOIN rb_konsumen c ON b.id_konsumen=c.id_konsumen ORDER BY id_tabungan_konfirmasi DESC");
    }

    function upgrade_update($id){
        $datadb = array('status'=>'1');
        $this->db->where('id_upgrade',$id);
        $this->db->update('rb_upgrade',$datadb);

        $r = $this->db->query("SELECT a.id_konsumen, a.id_paket, a.status, b.id_paket as paket_lama, b.username, c.min_paket as baru, d.min_paket as lama, (c.min_paket-d.min_paket) as selisih FROM `rb_upgrade` a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen JOIN rb_paket c ON a.id_paket=c.id_paket JOIN rb_paket d ON b.id_paket=d.id_paket where a.id_upgrade='$id'")->row_array();
        $idk = $r['id_konsumen'];
        $idp = $r['id_paket'];

        include "application/config/koneksi.php";
        function get_update($data, $parent, $paket) {
              static $i = 1;
              $tab = str_repeat(" ", $i);
              if ($data[$parent]) {
                  $i++;
                  foreach ($data[$parent] as $v) {
                       $child = get_update($data, $v->upline, $paket);
                       if ($v->upline != ''){
                           if ($v->posisi == '0'){
                               mysql_query("UPDATE rb_konsumen SET totfoot_left=totfoot_left+$paket where username='$v->upline'");
                           }else{
                               mysql_query("UPDATE rb_konsumen SET totfoot_right=totfoot_right+$paket where username='$v->upline'");
                           }
                       }
                       if ($child) {
                           $i--;
                           $html .= "$child";
                       }
                  }
                  return $html;
              }
        }

        $result = mysql_query("SELECT * FROM rb_konsumen where username!='' ORDER BY id_konsumen DESC");
        while ($row = mysql_fetch_object($result)) {
                $data[$row->username][] = $row;
        }
        $part = $r['username'];
        $paket = ($r['selisih']);
        $menu = get_update($data, $part, $paket);

        $datadbk = array('id_paket'=>$idp);
        $this->db->where('id_konsumen',$idk);
        $this->db->update('rb_konsumen',$datadbk);

        $datadbk = array('bonus_sponsor'=>$r['bnsupgrade']);
        $this->db->where('username',$r['username']);
        $this->db->update('rb_struktur_sponsor',$datadbk);
    }

    function konfirmasitabungan_update($idb){
        $datadb = array('status'=>'Lunas', 'username'=>$this->session->username);
        $this->db->where('id_tabungan_bayar',$idb);
        $this->db->update('rb_tabungan_bayar',$datadb);
    }

    function upgrade_delete($id){
        return $this->db->query("DELETE FROM rb_upgrade where id_upgrade='$id'");
    }
}