<?php 
class Model_agen extends CI_model{
    function agen(){
        return $this->db->query("SELECT * FROM rb_agen ORDER BY id_agen DESC");
    }

    function produk($id){
        return $this->db->query("SELECT id_produk, nama_produk, agen, konsumen, sum(t1.jumlah) as stok FROM (SELECT a.id_agen as id_pembeli,
                                               a.id_produk,
                                               a1.nama_produk,
                                               a1.agen,
                                               a1.konsumen,
                                               a.jumlah,
                                               NULL AS pembeli,
                                               NULL AS penjual
                                        FROM   rb_agen_order a, rb_produk a1
                                        WHERE  a.id_produk = a1.id_produk
                                        UNION
                                        SELECT b.id_pembeli,
                                               b.id_produk,
                                               b1.nama_produk,
                                               b1.agen,
                                               b1.konsumen,
                                               b.jumlah,
                                               b.pembeli,
                                               b.penjual
                                        FROM   rb_konsumen_order b, rb_produk b1
                                        WHERE  b.id_produk = b1.id_produk) AS t1 where t1.id_pembeli='$id' AND (t1.pembeli='agen' OR t1.pembeli is NULL) GROUP BY t1.id_produk");
    }

    function pembelian($id){
        return $this->db->query("SELECT a.*, b.nama_produk FROM `rb_agen_order` a JOIN rb_produk b ON a.id_produk=b.id_produk where id_agen='$id' order by a.id_agen_order DESC");
    }

    function pembeliandist($id){
        return $this->db->query("SELECT a.*, b.nama_produk, c.nama_distributor FROM `rb_konsumen_order` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_distributor c ON a.id_penjual=c.id_distributor where a.id_pembeli='$id' AND a.penjual='distributor' AND a.pembeli='agen' order by a.id_konsumen_order DESC");
    }

    function pembelianperw($id){
        return $this->db->query("SELECT a.*, b.nama_produk, c.nama_perwakilan FROM `rb_konsumen_order` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_perwakilan c ON a.id_penjual=c.id_perwakilan where a.id_pembeli='$id' AND a.penjual='perwakilan' AND a.pembeli='agen' order by a.id_konsumen_order DESC");
    }

    function pembelian_home($id, $limit){
        return $this->db->query("SELECT a.*, b.nama_produk FROM `rb_agen_order` a JOIN rb_produk b ON a.id_produk=b.id_produk where id_agen='$id' order by a.id_agen_order DESC LIMIT $limit");
    }

    function penjualan($id){
        return $this->db->query("SELECT a.*, b.nama_lengkap, c.nama_produk, (a.jumlah*d.konsumen) as total, d.konsumen FROM `rb_konsumen_order` a JOIN rb_konsumen b ON a.id_pembeli=b.id_konsumen JOIN rb_produk c ON a.id_produk=c.id_produk JOIN rb_produk d ON a.id_produk=d.id_produk where a.id_penjual='$id' order by id_konsumen_order DESC");
    }

    function agen_tambah(){
        $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                        'password'=>hash("sha512", md5($this->input->post('b'))),
                        'nama_agen'=>$this->db->escape_str($this->input->post('c')),
                        'tempat_lahir'=>$this->db->escape_str($this->input->post('d')),
                        'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                        'no_ktp_sim'=>$this->db->escape_str($this->input->post('f')),
                        'email'=>$this->db->escape_str($this->input->post('g')),
                        'alamat_lengkap'=>$this->db->escape_str($this->input->post('h')),
                        'kota'=>$this->db->escape_str($this->input->post('i')),
                        'provinsi'=>$this->db->escape_str($this->input->post('j')),
                        'kode_pos'=>$this->db->escape_str($this->input->post('k')),
                        'telp_hp'=>$this->db->escape_str($this->input->post('l')),
                        'waktu_daftar'=>date('Y-m-d H:i:s'),
                        'aktif'=>$this->db->escape_str($this->input->post('m')));
        $this->db->insert('rb_agen',$datadb);
    }

    function agen_tambah_penjualan(){
        $datadb = array('id_pembeli'=>$this->db->escape_str($this->input->post('id')),
                        'id_penjual'=>$this->session->id,
                        'id_produk'=>$this->db->escape_str($this->input->post('a')),
                        'jumlah'=>$this->db->escape_str($this->input->post('b')),
                        'keterangan'=>$this->db->escape_str($this->input->post('c')),
                        'pembeli'=>'konsumen',
                        'penjual'=>'agen',
                        'waktu_order'=>date('Y-m-d H:i:s'));
        $this->db->insert('rb_konsumen_order',$datadb);
    }

    function agen_edit($id){
        return $this->db->query("SELECT * FROM rb_agen where id_agen='$id'");
    }

    function detail_agen($id){
        return $this->db->query("SELECT * FROM rb_agen where id_agen='$id'");
    }

    function agen_update(){
        if (trim($this->input->post('b')) != ''){
            $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                            'password'=>hash("sha512", md5($this->input->post('b'))),
                            'nama_agen'=>$this->db->escape_str($this->input->post('c')),
                            'tempat_lahir'=>$this->db->escape_str($this->input->post('d')),
                            'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                            'no_ktp_sim'=>$this->db->escape_str($this->input->post('f')),
                            'email'=>$this->db->escape_str($this->input->post('g')),
                            'alamat_lengkap'=>$this->db->escape_str($this->input->post('h')),
                            'kota'=>$this->db->escape_str($this->input->post('i')),
                            'provinsi'=>$this->db->escape_str($this->input->post('j')),
                            'kode_pos'=>$this->db->escape_str($this->input->post('k')),
                            'telp_hp'=>$this->db->escape_str($this->input->post('l')),
                            'aktif'=>$this->db->escape_str($this->input->post('m')));
        }else{
            $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                            'nama_agen'=>$this->db->escape_str($this->input->post('c')),
                            'tempat_lahir'=>$this->db->escape_str($this->input->post('d')),
                            'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                            'no_ktp_sim'=>$this->db->escape_str($this->input->post('f')),
                            'email'=>$this->db->escape_str($this->input->post('g')),
                            'alamat_lengkap'=>$this->db->escape_str($this->input->post('h')),
                            'kota'=>$this->db->escape_str($this->input->post('i')),
                            'provinsi'=>$this->db->escape_str($this->input->post('j')),
                            'kode_pos'=>$this->db->escape_str($this->input->post('k')),
                            'telp_hp'=>$this->db->escape_str($this->input->post('l')),
                            'aktif'=>$this->db->escape_str($this->input->post('m')));
        }
        $this->db->where('id_agen',$this->input->post('id'));
        $this->db->update('rb_agen',$datadb);
    }


    function agen_update_profile(){
        if (trim($this->input->post('b')) != ''){
            $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                            'password'=>hash("sha512", md5($this->input->post('b'))),
                            'nama_agen'=>$this->db->escape_str($this->input->post('c')),
                            'tempat_lahir'=>$this->db->escape_str($this->input->post('d')),
                            'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                            'no_ktp_sim'=>$this->db->escape_str($this->input->post('f')),
                            'email'=>$this->db->escape_str($this->input->post('g')),
                            'alamat_lengkap'=>$this->db->escape_str($this->input->post('h')),
                            'kota'=>$this->db->escape_str($this->input->post('i')),
                            'provinsi'=>$this->db->escape_str($this->input->post('j')),
                            'kode_pos'=>$this->db->escape_str($this->input->post('k')),
                            'telp_hp'=>$this->db->escape_str($this->input->post('l')));
        }else{
            $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                            'nama_agen'=>$this->db->escape_str($this->input->post('c')),
                            'tempat_lahir'=>$this->db->escape_str($this->input->post('d')),
                            'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                            'no_ktp_sim'=>$this->db->escape_str($this->input->post('f')),
                            'email'=>$this->db->escape_str($this->input->post('g')),
                            'alamat_lengkap'=>$this->db->escape_str($this->input->post('h')),
                            'kota'=>$this->db->escape_str($this->input->post('i')),
                            'provinsi'=>$this->db->escape_str($this->input->post('j')),
                            'kode_pos'=>$this->db->escape_str($this->input->post('k')),
                            'telp_hp'=>$this->db->escape_str($this->input->post('l')));
        }
        $this->db->where('id_agen',$this->input->post('id'));
        $this->db->update('rb_agen',$datadb);
    }


    function agen_delete($id){
        return $this->db->query("DELETE FROM rb_agen where id_agen='$id'");
    }

    function agen_delete_penjualan($id){
        return $this->db->query("DELETE FROM rb_konsumen_order where id_konsumen_order='$id'");
    }


    function orderagen(){
        return $this->db->query("SELECT a.*, b.nama_produk, c.nama_agen FROM `rb_agen_order` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_agen c ON a.id_agen=c.id_agen order by a.id_agen_order DESC");
    }

    function orderagen_tambah(){
        $datadb = array('id_agen'=>$this->db->escape_str($this->input->post('a')),
                        'id_produk'=>$this->db->escape_str($this->input->post('b')),
                        'jumlah'=>$this->db->escape_str($this->input->post('c')),
                        'keterangan'=>$this->db->escape_str($this->input->post('d')),
                        'waktu_order'=>date('Y-m-d H:i:s'));
        $this->db->insert('rb_agen_order',$datadb);
    }

    function orderagen_edit($id){
        return $this->db->query("SELECT * FROM rb_agen_order where id_agen_order='$id'");
    }

    function orderagen_update(){
        $datadb = array('id_agen'=>$this->db->escape_str($this->input->post('a')),
                        'id_produk'=>$this->db->escape_str($this->input->post('b')),
                        'jumlah'=>$this->db->escape_str($this->input->post('c')),
                        'keterangan'=>$this->db->escape_str($this->input->post('d')));
        $this->db->where('id_agen_order',$this->input->post('id'));
        $this->db->update('rb_agen_order',$datadb);
    }

    function orderagen_delete($id){
        return $this->db->query("DELETE FROM rb_agen_order where id_agen_order='$id'");
    }

    

    function orderkodekonsumen($idk){
        return $this->db->query("SELECT a.*, b.nama_paket, b.total_rp FROM rb_order_kode_konsumen a JOIN rb_paket b ON a.id_paket=b.id_paket where a.id_konsumen='$idk' AND a.status='agen' ORDER BY a.id_order_kode_konsumen DESC");
    }

    function insert_orderkodekonsumen($idk){
        $datadb = array('id_konsumen'=>$idk,
                        'id_paket'=>$this->input->post('a'),
                        'jumlah'=>$this->input->post('b'),
                        'keterangan'=>$this->input->post('c'),
                        'status'=>'agen',
                        'waktu_order'=>date('Y-m-d H:i:s'));
        $this->db->insert('rb_order_kode_konsumen',$datadb);
    }

    function konsumen_orderkode_terkirim($ido){
        return $this->db->query("SELECT z.id_order_kode_kirim, z.kode_aktivasi, z.waktu_kirim, b.nama_paket FROM rb_order_kode_kirim z JOIN rb_order_kode_konsumen a ON z.id_order_kode_konsumen=a.id_order_kode_konsumen
                                    JOIN rb_paket b ON a.id_paket=b.id_paket where z.id_order_kode_konsumen='$ido' AND a.status='agen'");
    }

    function orderkodekonsumen_delete($id){
        return $this->db->query("DELETE FROM rb_order_kode_kirim where id_order_kode_kirim='$id'");
    }
}