<?php 
class Model_perwakilan extends CI_model{
    function perwakilan(){
        return $this->db->query("SELECT * FROM rb_perwakilan ORDER BY id_perwakilan DESC");
    }

    function produk($id){
        return $this->db->query("SELECT a.*, b.nama_produk, b.cabang, b.distributor, b.konsumen, b.agen, sum(a.jumlah) as stok FROM `rb_perwakilan_order` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_perwakilan='$id' group by id_produk");
    }

    function pembelian($id){
        return $this->db->query("SELECT a.*, b.nama_produk FROM `rb_perwakilan_order` a JOIN rb_produk b ON a.id_produk=b.id_produk where id_perwakilan='$id' order by a.id_perwakilan_order DESC");
    }

    function pembelian_home($id, $limit){
        return $this->db->query("SELECT a.*, b.nama_produk FROM `rb_perwakilan_order` a JOIN rb_produk b ON a.id_produk=b.id_produk where id_perwakilan='$id' order by a.id_perwakilan_order DESC LIMIT $limit");
    }

    function penjualan_konsumen($id){
        return $this->db->query("SELECT a.*, b.id_konsumen, b.nama_lengkap, c.nama_produk, (a.jumlah*d.konsumen) as total, d.konsumen FROM `rb_konsumen_order` a JOIN rb_konsumen b ON a.id_pembeli=b.id_konsumen JOIN rb_produk c ON a.id_produk=c.id_produk JOIN rb_produk d ON a.id_produk=d.id_produk where a.id_penjual='$id' AND a.pembeli='konsumen' AND a.penjual='perwakilan' order by id_konsumen_order DESC");
    }

    function penjualan_agen($id){
        return $this->db->query("SELECT a.*, b.id_agen, b.nama_agen, c.nama_produk, (a.jumlah*d.agen) as total, d.agen FROM `rb_konsumen_order` a JOIN rb_agen b ON a.id_pembeli=b.id_agen JOIN rb_produk c ON a.id_produk=c.id_produk JOIN rb_produk d ON a.id_produk=d.id_produk where a.id_penjual='$id' AND a.pembeli='agen' AND a.penjual='perwakilan' order by id_konsumen_order DESC");
    }

    function penjualan_distributor($id){
        return $this->db->query("SELECT a.*, b.id_distributor, b.nama_distributor, c.nama_produk, (a.jumlah*d.distributor) as total, d.agen FROM `rb_konsumen_order` a JOIN rb_distributor b ON a.id_pembeli=b.id_distributor JOIN rb_produk c ON a.id_produk=c.id_produk JOIN rb_produk d ON a.id_produk=d.id_produk where a.id_penjual='$id' AND a.pembeli='distributor' AND a.penjual='perwakilan' order by id_konsumen_order DESC");
    }

    function perwakilan_tambah(){
        $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                        'password'=>hash("sha512", md5($this->input->post('b'))),
                        'nama_perwakilan'=>$this->db->escape_str($this->input->post('c')),
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
        $this->db->insert('rb_perwakilan',$datadb);
    }

    function perwakilan_tambah_penjualan(){
        $datadb = array('id_pembeli'=>$this->db->escape_str($this->input->post('id')),
                        'id_penjual'=>$this->session->id,
                        'id_produk'=>$this->db->escape_str($this->input->post('a')),
                        'jumlah'=>$this->db->escape_str($this->input->post('b')),
                        'keterangan'=>$this->db->escape_str($this->input->post('c')),
                        'pembeli'=>$this->db->escape_str($this->input->post('d')),
                        'penjual'=>'perwakilan',
                        'waktu_order'=>date('Y-m-d H:i:s'));
        $this->db->insert('rb_konsumen_order',$datadb);
    }

    function perwakilan_edit($id){
        return $this->db->query("SELECT * FROM rb_perwakilan where id_perwakilan='$id'");
    }

    function detail_perwakilan($id){
        return $this->db->query("SELECT * FROM rb_perwakilan where id_perwakilan='$id'");
    }

    function perwakilan_update(){
        if (trim($this->input->post('b')) != ''){
            $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                            'password'=>hash("sha512", md5($this->input->post('b'))),
                            'nama_perwakilan'=>$this->db->escape_str($this->input->post('c')),
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
                            'nama_perwakilan'=>$this->db->escape_str($this->input->post('c')),
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
        $this->db->where('id_perwakilan',$this->input->post('id'));
        $this->db->update('rb_perwakilan',$datadb);
    }


    function perwakilan_update_profile(){
        if (trim($this->input->post('b')) != ''){
            $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                            'password'=>hash("sha512", md5($this->input->post('b'))),
                            'nama_perwakilan'=>$this->db->escape_str($this->input->post('c')),
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
                            'nama_perwakilan'=>$this->db->escape_str($this->input->post('c')),
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
        $this->db->where('id_perwakilan',$this->input->post('id'));
        $this->db->update('rb_perwakilan',$datadb);
    }


    function perwakilan_delete($id){
        return $this->db->query("DELETE FROM rb_perwakilan where id_perwakilan='$id'");
    }

    function perwakilan_delete_penjualan_konsumen($id){
        return $this->db->query("DELETE FROM rb_konsumen_order where id_konsumen_order='$id'");
    }

    function perwakilan_delete_penjualan_agen($id){
        return $this->db->query("DELETE FROM rb_konsumen_order where id_konsumen_order='$id'");
    }

    function perwakilan_delete_penjualan_distributor($id){
        return $this->db->query("DELETE FROM rb_konsumen_order where id_konsumen_order='$id'");
    }

    function orderperwakilan(){
        return $this->db->query("SELECT a.*, b.nama_produk, c.nama_perwakilan FROM `rb_perwakilan_order` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_perwakilan c ON a.id_perwakilan=c.id_perwakilan order by a.id_perwakilan_order DESC");
    }

    function orderperwakilan_tambah(){
        $datadb = array('id_perwakilan'=>$this->db->escape_str($this->input->post('a')),
                        'id_produk'=>$this->db->escape_str($this->input->post('b')),
                        'jumlah'=>$this->db->escape_str($this->input->post('c')),
                        'keterangan'=>$this->db->escape_str($this->input->post('d')),
                        'waktu_order'=>date('Y-m-d H:i:s'));
        $this->db->insert('rb_perwakilan_order',$datadb);
    }

    function orderperwakilan_edit($id){
        return $this->db->query("SELECT * FROM rb_perwakilan_order where id_perwakilan_order='$id'");
    }

    function orderperwakilan_update(){
        $datadb = array('id_perwakilan'=>$this->db->escape_str($this->input->post('a')),
                        'id_produk'=>$this->db->escape_str($this->input->post('b')),
                        'jumlah'=>$this->db->escape_str($this->input->post('c')),
                        'keterangan'=>$this->db->escape_str($this->input->post('d')));
        $this->db->where('id_perwakilan_order',$this->input->post('id'));
        $this->db->update('rb_perwakilan_order',$datadb);
    }

    function orderperwakilan_delete($id){
        return $this->db->query("DELETE FROM rb_perwakilan_order where id_perwakilan_order='$id'");
    }



    function orderkodekonsumen($idk){
        return $this->db->query("SELECT a.*, b.nama_paket, b.total_rp FROM rb_order_kode_konsumen a JOIN rb_paket b ON a.id_paket=b.id_paket where a.id_konsumen='$idk' AND a.status='perwakilan' ORDER BY a.id_order_kode_konsumen DESC");
    }

    function insert_orderkodekonsumen($idk){
        $datadb = array('id_konsumen'=>$idk,
                        'id_paket'=>$this->input->post('a'),
                        'jumlah'=>$this->input->post('b'),
                        'keterangan'=>$this->input->post('c'),
                        'status'=>'perwakilan',
                        'waktu_order'=>date('Y-m-d H:i:s'));
        $this->db->insert('rb_order_kode_konsumen',$datadb);
    }

    function konsumen_orderkode_terkirim($ido){
        return $this->db->query("SELECT z.id_order_kode_kirim, z.kode_aktivasi, z.waktu_kirim, b.nama_paket FROM rb_order_kode_kirim z JOIN rb_order_kode_konsumen a ON z.id_order_kode_konsumen=a.id_order_kode_konsumen
                                    JOIN rb_paket b ON a.id_paket=b.id_paket where z.id_order_kode_konsumen='$ido' AND a.status='perwakilan'");
    }

    function orderkodekonsumen_delete($id){
        return $this->db->query("DELETE FROM rb_order_kode_kirim where id_order_kode_kirim='$id'");
    }
}