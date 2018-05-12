<?php 
class Model_members extends CI_model{
    function totalkonsumen($username){
        return $this->db->query("SELECT * FROM rb_konsumen where username='$username'");
    }

    function paketkonsumen($username){
        return $this->db->query("SELECT * FROM rb_konsumen a JOIN rb_paket b ON a.id_paket=b.id_paket WHERE a.username='$username'");
    }

    function tabungan(){
        return $this->db->query("SELECT * FROM rb_tabungan_bayar ORDER BY id_tabungan_bayar DESC");
    }

    function bonushistory(){
        return $this->db->query("SELECT * FROM rb_pembayaran_bonus ORDER BY id_pembayaran_bonus DESC");
    }

    function konsumen_orderkode(){
        return $this->db->query("SELECT a.*, b.nama_paket, b.total_rp, c.nama_lengkap as nama_lengkap FROM rb_order_kode_konsumen a 
                                    JOIN rb_paket b ON a.id_paket=b.id_paket 
                                      JOIN rb_konsumen c ON a.id_konsumen=c.id_konsumen where a.status='konsumen'
                                        ORDER BY a.id_order_kode_konsumen DESC");
    }

    function agen_orderkode(){
        return $this->db->query("SELECT a.*, b.nama_paket, b.total_rp, c.nama_agen as nama_lengkap FROM rb_order_kode_konsumen a 
                                    JOIN rb_paket b ON a.id_paket=b.id_paket 
                                      JOIN rb_agen c ON a.id_konsumen=c.id_agen where a.status='agen'
                                        ORDER BY a.id_order_kode_konsumen DESC");
    }

    function distributor_orderkode(){
        return $this->db->query("SELECT a.*, b.nama_paket, b.total_rp, c.nama_distributor as nama_lengkap FROM rb_order_kode_konsumen a 
                                    JOIN rb_paket b ON a.id_paket=b.id_paket 
                                      JOIN rb_distributor c ON a.id_konsumen=c.id_distributor where a.status='distributor'
                                        ORDER BY a.id_order_kode_konsumen DESC");
    }

    function perwakilan_orderkode(){
        return $this->db->query("SELECT a.*, b.nama_paket, b.total_rp, c.nama_perwakilan as nama_lengkap FROM rb_order_kode_konsumen a 
                                    JOIN rb_paket b ON a.id_paket=b.id_paket 
                                      JOIN rb_perwakilan c ON a.id_konsumen=c.id_perwakilan where a.status='perwakilan'
                                        ORDER BY a.id_order_kode_konsumen DESC");
    }

    function konsumen_orderkode_terkirim($ido){
        return $this->db->query("SELECT z.id_order_kode_kirim, z.kode_aktivasi, z.waktu_kirim, b.nama_paket FROM rb_order_kode_kirim z JOIN rb_order_kode_konsumen a ON z.id_order_kode_konsumen=a.id_order_kode_konsumen
                                    JOIN rb_paket b ON a.id_paket=b.id_paket where z.id_order_kode_konsumen='$ido' AND a.status='konsumen'");
    }

    function orderkodekonsumen($idk, $sampai, $dari){
        return $this->db->query("SELECT a.*, b.nama_paket, b.total_rp FROM rb_order_kode_konsumen a JOIN rb_paket b ON a.id_paket=b.id_paket where a.id_konsumen='$idk' AND a.status='konsumen' ORDER BY a.id_order_kode_konsumen DESC LIMIT $dari, $sampai");
    }

    function hitung_orderkodekonsumen($idk){
        return $this->db->query("SELECT * FROM rb_order_kode_konsumen where id_konsumen='$idk' AND status='konsumen'");
    }

    function insert_orderkodekonsumen($idk){
        $datadb = array('id_konsumen'=>$idk,
                        'id_paket'=>$this->input->post('a'),
                        'jumlah'=>$this->input->post('b'),
                        'keterangan'=>$this->input->post('c'),
                        'status'=>'konsumen',
                        'waktu_order'=>date('Y-m-d H:i:s'));
        $this->db->insert('rb_order_kode_konsumen',$datadb);
    }

    function kode_konsumen_insert(){
        for ($i = 1; $i <= $this->input->post('a'); $i++){
            $kode=acakangkahuruf(12);
            $datadb = array('id_paket' => $this->input->post('b'),
                            'kode_konsumen'=>$kode);
            $this->db->insert('rb_konsumen',$datadb);

            $datadbb = array('id_order_kode_konsumen' => $this->input->post('id'),
                            'kode_aktivasi'=>$kode,
                            'waktu_kirim'=>date('Y-m-d H:i:s'));
            $this->db->insert('rb_order_kode_kirim',$datadbb);
        }
    }

    function orderkodekonsumen_delete($id){
        return $this->db->query("DELETE FROM rb_order_kode_kirim where id_order_kode_kirim='$id'");
    }

    function autosavesum($username,$pasave,$ppn){
        return $this->db->query("SELECT username, sum($pasave/100*((bonus_pasangan+bonus_sponsor+bonus_tabungan+bonus_ro)-($ppn/100*(bonus_pasangan+bonus_sponsor+bonus_tabungan+bonus_ro)))) as auto_save FROM `rb_pembayaran_bonus` where username='$username'");
    }

    function lastautosavesum($username, $id){
        return $this->db->query("SELECT username, sum(20/100*((bonus_pasangan+bonus_sponsor+bonus_tabungan+bonus_ro)-(10/100*(bonus_pasangan+bonus_sponsor+bonus_tabungan+bonus_ro)))) as auto_save FROM `rb_pembayaran_bonus` where username='$username' AND id_pembayaran_bonus < '$id'");
    }

    function bonushistory_delete($id){
        return $this->db->query("DELETE FROM rb_pembayaran_bonus where id_pembayaran_bonus='$id'");
    }

    function tabungankonsumen($idk){
        return $this->db->query("SELECT * FROM rb_tabungan_bayar where username='$idk' ORDER BY id_tabungan_bayar DESC");
    }

    function total_tabungan($id){
        return $this->db->query("SELECT sum(total_bayar) as total FROM `rb_tabungan_bayar` where username='$id' AND status='Lunas'");
    }

    function produk(){
        return $this->db->query("SELECT * FROM rb_produk ORDER BY id_produk DESC");
    }

    function rekening(){
        return $this->db->query("SELECT * FROM rb_rekening ORDER BY id_rekening ASC");
    }



    function posisiawal($id, $kiri, $kanan){
        return $this->db->query("SELECT * FROM rb_konsumen where totfoot_right >= $kanan AND totfoot_left >= $kiri AND sponsor='$id'");
    }

    function posisi($id, $kiri, $kanan, $max_kiri, $max_kanan, $posisi){
        return $this->db->query("SELECT * FROM rb_konsumen where totfoot_right >= $kanan AND totfoot_left >= $kiri AND totfoot_right < $max_kanan AND totfoot_left < $max_kiri AND sponsor='$id'");
    }

    function posisimax($id, $kiri, $kanan, $posisi){
        return $this->db->query("SELECT * FROM rb_konsumen where totfoot_right >= $kanan AND totfoot_left >= $kiri AND sponsor='$id'");
    }

    function reword(){
        return $this->db->query("SELECT * FROM rb_reword ORDER BY id_reword ASC");
    }

    function downline($username, $sampai, $dari){
        return $this->db->query("SELECT a.*, b.sponsor as sponsor_asli, b.tanggal_daftar, b.id_konsumen FROM `rb_struktur_sponsor_level` a JOIN rb_konsumen b ON a.username=b.username where a.sponsor='$username' ORDER BY a.level ASC LIMIT $dari, $sampai");
    }

    function totaldownline($username){
        return $this->db->query("SELECT * FROM `rb_struktur_sponsor_level` a JOIN rb_konsumen b ON a.username=b.username where a.sponsor='$username'");
    }

    function jaringan_tambah(){
        $bns = $this->db->query("SELECT b.bonus_sponsorisasi, b.total_rp FROM rb_konsumen a JOIN rb_paket b ON a.id_paket=b.id_paket where a.kode_konsumen='".$this->input->post('kode')."'")->row();
        $datadbd = array('sponsor'=>$this->db->escape_str(strip_tags($this->input->post('sps'))),
                        'upline'=>$this->db->escape_str(strip_tags($this->input->post('upl'))),
                        'posisi'=>$this->db->escape_str(strip_tags($this->input->post('q'))),
                        'username'=>$this->db->escape_str(strip_tags($this->input->post('a'))),
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
                        'tanggal_daftar'=>date('Y-m-d'));
        $this->db->where('kode_konsumen',strip_tags($this->input->post('kode')));
        $this->db->update('rb_konsumen',$datadbd); 

        // Update Referral Sponsor
        $row = $this->db->query("SELECT * FROM rb_konsumen where username='".$this->input->post('sps')."'")->row();
        $new_totref = $row->tot_ref + 1;
        $datareferral = array('tot_ref'=>$new_totref);
        $this->db->where('username',strip_tags($this->input->post('sps')));
        $this->db->update('rb_konsumen',$datareferral); 

        // Pengisian Kaki Pada Upline
        if ($this->input->post('q') == '0'){
            $dataupline = array('foot1'=>$this->db->escape_str(strip_tags($this->input->post('a'))));
        }elseif ($this->input->post('q') == '1'){
            $dataupline = array('foot2'=>$this->db->escape_str(strip_tags($this->input->post('a'))));
        }

        $this->db->where('username',strip_tags($this->input->post('upl')));
        $this->db->update('rb_konsumen',$dataupline); 

        //Update dengan perulangan jml total kaki dari upline dan kaki member harian dan menyimpan bonus pasangan
        $uplid = $this->input->post('upl'); 
        $sponsor = $this->input->post('sps'); 
        $membr = $this->input->post('a');
        $cekek = $this->db->query("SELECT * FROM rb_struktur_sponsor where username='".$this->input->post('a')."' AND sponsor='".$this->input->post('sps')."'")->num_rows();
        if ($cekek <= 0){
            $datasponsor = array('username'=>$this->db->escape_str(strip_tags($this->input->post('a'))),
                                    'sponsor'=>$this->db->escape_str(strip_tags($this->input->post('sps'))),
                                    'bonus_sponsor'=>$bns->bonus_sponsorisasi,
                                    'timer'=>date('Y-m-d H:i:s'));
            $this->db->insert('rb_struktur_sponsor',$datasponsor);
        }

            //Penyimpanan Struktur Sponsor
            $level=0; 
            $sponsore = $sponsor;
            do{
                $level++;
                $cekssl = $this->db->query("SELECT * FROM rb_struktur_sponsor_level where username='".$this->input->post('a')."' AND sponsor='$sponsore' AND level='$level'")->num_rows();
                if ($cekssl <= 0){
                  $datasponsorlevel = array('username'=>$this->db->escape_str(strip_tags($this->input->post('a'))),
                                    'sponsor'=>$sponsore,
                                    'level'=>$level,
                                    'timer'=>date('Y-m-d H:i:s'));
                  $this->db->insert('rb_struktur_sponsor_level',$datasponsorlevel);
                }
                $row = $this->db->query("SELECT * FROM rb_konsumen WHERE username='$sponsore'")->row_array();
                $sponsore=$row['sponsor'];
             }
             while(!empty($sponsore));

        $set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
        include "application/config/koneksi.php";
        function get_update($data, $parent, $paket, $pasangan, $downline, $sps) {
              static $i = 1;
              $tab = str_repeat(" ", $i);
              if ($data[$parent]) {
                  $i++;
                  foreach ($data[$parent] as $v) {
                       $child = get_update($data, $v->upline, $paket, $pasangan, $downline, $sps);
                       if ($v->upline != ''){
                           if ($v->posisi == '0'){
                               mysql_query("UPDATE rb_konsumen SET totfoot_left=totfoot_left+$paket where username='$v->upline'");
                           }else{
                               mysql_query("UPDATE rb_konsumen SET totfoot_right=totfoot_right+$paket where username='$v->upline'");
                           }
                       }

                       if ($v->totfoot_update_day == date('Y-m-d')){
                            if ($v->upline != ''){
                               if ($v->posisi == '0'){
                                   mysql_query("UPDATE rb_konsumen SET totfoot_left_day=totfoot_left_day+$paket where username='$v->upline'");
                                   $cek = mysql_num_rows(mysql_query("SELECT * FROM rb_foot where username='$v->upline' AND totfoot_day='".date('Y-m-d')."'"));
                                   if ($cek >= 1){
                                      mysql_query("UPDATE rb_foot SET totfoot_left=totfoot_left+$paket where username='$v->upline'");
                                   }else{
                                      mysql_query("INSERT INTO rb_foot VALUES('','$v->upline','$paket','0','".date('Y-m-d')."','$pasangan')");
                                   }
                                   mysql_query("INSERT INTO rb_foot_detail VALUES('','$v->upline','$downline','$sps','0')");
                               }else{
                                   mysql_query("UPDATE rb_konsumen SET totfoot_right_day=totfoot_right_day+$paket where username='$v->upline'");
                                   $cek = mysql_num_rows(mysql_query("SELECT * FROM rb_foot where username='$v->upline' AND totfoot_day='".date('Y-m-d')."'"));
                                   if ($cek >= 1){
                                      mysql_query("UPDATE rb_foot SET totfoot_right=totfoot_right+$paket where username='$v->upline'");
                                   }else{
                                      mysql_query("INSERT INTO rb_foot VALUES('','$v->upline','0','$paket','".date('Y-m-d')."','$pasangan')");
                                   }
                                   mysql_query("INSERT INTO rb_foot_detail VALUES('','$v->upline','$downline','$sps','1')");
                               }
                           }
                       }else{
                            mysql_query("UPDATE rb_konsumen SET totfoot_left_day='0', totfoot_right_day='0', totfoot_update_day='".date('Y-m-d')."' where totfoot_update_day!='".date('Y-m-d')."'");
                            if ($v->upline != ''){
                               if ($v->posisi == '0'){
                                   mysql_query("UPDATE rb_konsumen SET totfoot_left_day=totfoot_left_day+$paket where username='$v->upline'");
                                   $cek = mysql_num_rows(mysql_query("SELECT * FROM rb_foot where username='$v->upline' AND totfoot_day='".date('Y-m-d')."'"));
                                   if ($cek >= 1){
                                      mysql_query("UPDATE rb_foot SET totfoot_left=totfoot_left+$paket where username='$v->upline'");
                                   }else{
                                      mysql_query("INSERT INTO rb_foot VALUES('','$v->upline','$paket','0','".date('Y-m-d')."','$pasangan')");
                                   }
                                   mysql_query("INSERT INTO rb_foot_detail VALUES('','$v->upline','$downline','$sps','0')");
                               }else{
                                   mysql_query("UPDATE rb_konsumen SET totfoot_right_day=totfoot_right_day+$paket where username='$v->upline'");
                                   $cek = mysql_num_rows(mysql_query("SELECT * FROM rb_foot where username='$v->upline' AND totfoot_day='".date('Y-m-d')."'"));
                                   if ($cek >= 1){
                                      mysql_query("UPDATE rb_foot SET totfoot_right=totfoot_right+$paket where username='$v->upline'");
                                   }else{
                                      mysql_query("INSERT INTO rb_foot VALUES('','$v->upline','0','$paket','".date('Y-m-d')."','$pasangan')");
                                   }
                                   mysql_query("INSERT INTO rb_foot_detail VALUES('','$v->upline','$downline','$sps','1')");
                               }
                           }
                       }
                  }
              }
        }

        $p = mysql_fetch_array(mysql_query("SELECT b.min_paket FROM rb_konsumen a JOIN rb_paket b ON a.id_paket=b.id_paket where a.kode_konsumen='".$this->input->post('kode')."'"));
        $result = mysql_query("SELECT * FROM rb_konsumen where username!='' ORDER BY id_konsumen DESC");
        while ($row = mysql_fetch_object($result)) {
                $data[$row->username][] = $row;
        }
        $part = $this->input->post('a');
        $downline = $this->input->post('a');
        $sps = $this->input->post('sps');
        $paket = $p['min_paket'];
        $pasangan = $set['bonus_pasangan'];
        $menu = get_update($data, $part, $paket, $pasangan, $downline, $sps);

    }

    function cairkan_bonus($id){
            $config['upload_path'] = 'asset/bukti_transfer/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|pdf';
            $config['max_size'] = '6000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('b');
            $hasil=$this->upload->data();
            if ($hasil['file_name']!=''){
                $datadb = array('id_konsumen'=>$id,
                                'total'=>$this->input->post('a'),
                                'file_bukti'=>$hasil['file_name'],
                                'tanggal_pencairan'=>$this->input->post('c'));
                $this->db->insert('rb_pencairan',$datadb);
            }
    }

    function bayar_tabungan($bonus,$gen){
        $tanggal_bayar = tgl_simpan($this->input->post('c'))." ".date("H:i:s");
        $datadb = array('username'=>$this->input->post('a'),
                        'total_bayar'=>$this->input->post('b'),
                        'tanggal_bayar'=>$tanggal_bayar,
                        'keterangan'=>$this->input->post('d'),
                        'status'=>'Lunas');
        $this->db->insert('rb_tabungan_bayar',$datadb);
        $idt = $this->db->insert_id();

        $cek = $this->db->query("SELECT * FROM (SELECT * FROM rb_struktur_sponsor_level 
                where sponsor IN (SELECT sponsor FROM (SELECT sponsor, max(level) as level_max 
                    FROM rb_struktur_sponsor_level 
                        where level GROUP BY sponsor) as a where a.level_max <= $gen)) as a where a.username='".$this->input->post('a')."'")->num_rows();
        if ($cek >= 1){
          include "application/config/koneksi.php";
            function get_update($data, $parent, $paket, $bonus) {
                  static $i = 1;
                  $tab = str_repeat(" ", $i);
                  if ($data[$parent]) {
                      $i++;
                      foreach ($data[$parent] as $v) {
                           $child = get_update($data, $v->upline, $paket, $bonus);
                           if ($v->upline != ''){
                              mysql_query("INSERT INTO rb_bonus_tabungan VALUES('','$paket','$v->upline','$bonus','".date('Y-m-d H:i:s')."')");
                           }
                      }
                  }
            }
            $result = mysql_query("SELECT * FROM rb_konsumen where username!='' ORDER BY id_konsumen DESC");
            while ($row = mysql_fetch_object($result)) {
                    $data[$row->username][] = $row;
            }
            $part = $this->input->post('a');
            $paket = $idt;
            $menu = get_update($data, $part, $paket, $bonus);
        }
    }

    function tabungan_edit($id){
        return $this->db->query("SELECT * FROM rb_tabungan_bayar where id_tabungan_bayar='$id'");
    }

    function tabungan_update(){
        $tanggal_bayar = tgl_simpan($this->input->post('c'))." ".date("H:i:s");
        $datadb = array('username'=>$this->input->post('a'),
                        'total_bayar'=>$this->input->post('b'),
                        'tanggal_bayar'=>$tanggal_bayar,
                        'keterangan'=>$this->input->post('d'),
                        'status'=>'Lunas');

        $this->db->where('id_tabungan_bayar',$this->input->post('id'));
        $this->db->update('rb_tabungan_bayar',$datadb);
    }

    function delete_tabungan($id){
        return $this->db->query("DELETE FROM rb_tabungan_bayar where id_tabungan_bayar='$id'");
    }

    function konsumen(){
        return $this->db->query("SELECT * FROM rb_konsumen where username != '' AND password != '' ORDER BY id_konsumen DESC");
    }

    function kode_konsumen(){
        return $this->db->query("SELECT * FROM rb_konsumen a JOIN rb_paket b ON a.id_paket=b.id_paket where a.username = '' AND a.password = '' ORDER BY a.id_konsumen DESC");
    }

    function orderkode(){
        return $this->db->query("SELECT * FROM rb_order_kode a JOIN rb_paket b ON a.id_paket=b.id_paket ORDER BY a.id_order_kode DESC");
    }

    function orderkode_delete($id){
        return $this->db->query("DELETE FROM rb_order_kode where id_order_kode='$id'");
    }

    function konsumen_delete($id){
        return $this->db->query("DELETE FROM rb_konsumen where id_konsumen='$id'");
    }

    function tabungan_delete($id){
        return $this->db->query("DELETE FROM rb_tabungan_bayar where id_tabungan_bayar='$id'");
    }

    function kode_konsumen_tambah(){
        for ($i = 1; $i <= $this->input->post('kode'); $i++){
            $kode=acakangkahuruf(12);
            $datadb = array('id_paket' => $this->input->post('paket'),
                            'kode_konsumen'=>$kode);
            $this->db->insert('rb_konsumen',$datadb);
        }
    }

    function kirimkan_upgrade($idk){
                $datadb = array('id_konsumen'=>$idk,
                                'id_paket_lama'=>$this->input->post('paketlama'),
                                'id_paket'=>$this->input->post('a'),
                                'keterangan'=>$this->input->post('b'),
                                'waktu_request'=>date('Y-m-d H:i:s'),
                                'status'=>'0');
                $this->db->insert('rb_upgrade',$datadb);
    }

    function konsumen_paket($id){
        return $this->db->query("SELECT * FROM rb_konsumen a JOIN rb_paket b ON a.id_paket=b.id_paket where id_konsumen='$id'");
    }

    function paket(){
        return $this->db->query("SELECT * FROM rb_paket");
    }

    function sponsorisasi($username){
        return $this->db->query("SELECT * FROM rb_struktur_sponsor a JOIN rb_konsumen b ON a.username=b.username where a.sponsor='$username'");
    }

    function sponsorisasi_total($username){
        return $this->db->query("SELECT sum(bonus_sponsor) as total FROM rb_struktur_sponsor where sponsor='$username'");
    }

    function tabungan_total($username){
        return $this->db->query("SELECT sum(jumlah_bonus) as total FROM rb_bonus_tabungan where username='$username'");
    }

    function ro_total($username){
        return $this->db->query("SELECT sum(jumlah_bonus) as total FROM rb_bonus_ro where username='$username'");
    }

    

    function keterangan($id){
        return $this->db->query("SELECT * FROM `rb_keterangan` where id_keterangan='$id'");
    }

    function bonussponsor($username){
        return $this->db->query("SELECT sum(bonus_sponsor) as bonussponsor FROM rb_struktur_sponsor where sponsor='$username'");
    }

    function bonustax($username){
        return $this->db->query("SELECT a.*, b.username as upline FROM rb_bonus_tabungan a JOIN rb_tabungan_bayar b ON a.id_tabungan_bayar=b.id_tabungan_bayar where a.username='$username'");
    }

    function bonusrox($username){
        return $this->db->query("SELECT * FROM rb_bonus_ro where username='$username'");
    }

    function bonustabungan($username){
        return $this->db->query("SELECT sum(jumlah_bonus) as bonustabungan FROM rb_bonus_tabungan where username='$username'");
    }

    function bonusro($username){
        return $this->db->query("SELECT sum(jumlah_bonus) as bonusro FROM rb_bonus_ro where username='$username'");
    }

    function keuangan($id){
        return $this->db->query("SELECT * FROM rb_konsumen where username='$id'");
    }

    function keuanganbayarmanual_tambah($idk){
        $datadb = array('username'=>$this->input->post('a'),
                        'bonus_pasangan'=>$this->input->post('b'),
                        'bonus_sponsor'=>$this->input->post('c'),
                        'bonus_tabungan'=>$this->input->post('d'),
                        'bonus_ro'=>$this->input->post('e'),
                        'waktu_bayar'=>date('Y-m-d'));
        $this->db->insert('rb_pembayaran_bonus',$datadb);
    }

    function totpencairan($id,$bonus){
        return $this->db->query("SELECT sum(bonus_pasangan)/$bonus as bonus_pasangan, sum(bonus_sponsor) as bonus_sponsor, sum(bonus_tabungan) as bonus_tabungan, sum(bonus_ro) as bonus_ro FROM rb_pembayaran_bonus where username='$id'");
    }

    function pencairan_detail($id){
        return $this->db->query("SELECT * FROM `rb_pembayaran_bonus` where username='$id' ORDER BY id_pembayaran_bonus DESC");
    }

    function profile($id){
        return $this->db->query("SELECT harga_paket as total_rp, tanggal_daftar, rekning_virtual FROM `rb_konsumen` where id_konsumen='$id'");
    }

    function profile_view($id){
        return $this->db->query("SELECT * FROM `rb_konsumen` a JOIN rb_paket b ON a.id_paket=b.id_paket where a.id_konsumen='$id'");
    }

    function profile_update($id){
        if (trim($this->input->post('a')) != ''){
            $datadbd = array('password'=>hash("sha512", md5($this->input->post('a'))),
                            'nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                            'email'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                            'jenis_kelamin'=>$this->db->escape_str($this->input->post('d')),
                            'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                            'no_ktp'=>$this->db->escape_str(strip_tags($this->input->post('f'))),
                            'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                            'ahli_waris'=>$this->db->escape_str(strip_tags($this->input->post('h'))),
                            'kota'=>$this->db->escape_str(strip_tags($this->input->post('i'))),
                            'provinsi'=>$this->db->escape_str(strip_tags($this->input->post('j'))),
                            'no_hp'=>$this->db->escape_str(strip_tags($this->input->post('k'))));
        }else{
           $datadbd = array('nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                            'email'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                            'jenis_kelamin'=>$this->db->escape_str($this->input->post('d')),
                            'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                            'no_ktp'=>$this->db->escape_str(strip_tags($this->input->post('f'))),
                            'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                            'ahli_waris'=>$this->db->escape_str(strip_tags($this->input->post('h'))),
                            'kota'=>$this->db->escape_str(strip_tags($this->input->post('i'))),
                            'provinsi'=>$this->db->escape_str(strip_tags($this->input->post('j'))),
                            'no_hp'=>$this->db->escape_str(strip_tags($this->input->post('k'))));
        }
        $this->db->where('id_konsumen',$id);
        $this->db->update('rb_konsumen',$datadbd);
    }

    function konsumen_update($id){
        if (trim($this->input->post('a')) != ''){
            $datadbd = array('password'=>hash("sha512", md5($this->input->post('a'))),
                            'nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                            'email'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                            'jenis_kelamin'=>$this->db->escape_str($this->input->post('d')),
                            'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                            'no_ktp'=>$this->db->escape_str(strip_tags($this->input->post('f'))),
                            'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                            'ahli_waris'=>$this->db->escape_str(strip_tags($this->input->post('h'))),
                            'kota'=>$this->db->escape_str(strip_tags($this->input->post('i'))),
                            'provinsi'=>$this->db->escape_str(strip_tags($this->input->post('j'))),
                            'no_hp'=>$this->db->escape_str(strip_tags($this->input->post('k'))),
                            'nama_bank'=>$this->db->escape_str(strip_tags($this->input->post('l'))),
                            'no_rekening'=>$this->db->escape_str(strip_tags($this->input->post('m'))),
                            'rekning_virtual'=>$this->db->escape_str(strip_tags($this->input->post('mm'))),
                            'atas_nama'=>$this->db->escape_str(strip_tags($this->input->post('n'))));
        }else{
           $datadbd = array('nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                            'email'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                            'jenis_kelamin'=>$this->db->escape_str($this->input->post('d')),
                            'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                            'no_ktp'=>$this->db->escape_str(strip_tags($this->input->post('f'))),
                            'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                            'ahli_waris'=>$this->db->escape_str(strip_tags($this->input->post('h'))),
                            'kota'=>$this->db->escape_str(strip_tags($this->input->post('i'))),
                            'provinsi'=>$this->db->escape_str(strip_tags($this->input->post('j'))),
                            'no_hp'=>$this->db->escape_str(strip_tags($this->input->post('k'))),
                            'nama_bank'=>$this->db->escape_str(strip_tags($this->input->post('l'))),
                            'no_rekening'=>$this->db->escape_str(strip_tags($this->input->post('m'))),
                            'rekning_virtual'=>$this->db->escape_str(strip_tags($this->input->post('mm'))),
                            'atas_nama'=>$this->db->escape_str(strip_tags($this->input->post('n'))));
        }
        $this->db->where('id_konsumen',$this->input->post('id'));
        $this->db->update('rb_konsumen',$datadbd);
    }

    function belanja($id){
        return $this->db->query("SELECT * FROM (
                                    SELECT a.id_pembeli,
                                           a.id_penjual,
                                           a.id_produk,
                                           a1.nama_produk,
                                           a1.konsumen,
                                           a.jumlah,
                                           a.pembeli,
                                           a.penjual,
                                           a.waktu_order
                                    FROM   rb_konsumen_order a, rb_produk a1
                                    WHERE  a.id_produk = a1.id_produk) AS t1 
                                 where t1.id_pembeli='$id' AND (t1.pembeli='konsumen' OR t1.pembeli is NULL) ORDER BY waktu_order DESC");
    }

    function belanjatotal($id){
        return $this->db->query("SELECT sum(t1.konsumen*t1.jumlah) as total FROM (
                                    SELECT a.id_pembeli,
                                           a.id_penjual,
                                           a.id_produk,
                                           a1.nama_produk,
                                           a1.konsumen,
                                           a.jumlah,
                                           a.pembeli,
                                           a.waktu_order
                                    FROM   rb_konsumen_order a, rb_produk a1
                                    WHERE  a.id_produk = a1.id_produk) AS t1 
                                 where t1.id_pembeli='$id' AND (t1.pembeli='konsumen' OR t1.pembeli is NULL) ORDER BY waktu_order DESC");
    }
}