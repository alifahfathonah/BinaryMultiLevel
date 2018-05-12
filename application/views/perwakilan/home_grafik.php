<div class='box'>
      <div class='box-header'>
        <h3 class='box-title'>Application Buttons</h3>
      </div>
      <div class='box-body'>
        <p>Selamat datang di halaman perwakilan, Terima kasih sudah melakukan login, 
           Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola konten website anda 
            atau pilih ikon-ikon pada Control Panel di bawah ini : </p>
        <a href="<?php echo base_url(); ?>perwakilan/home" class='btn btn-app'><i class='fa fa-dashboard'></i> Dashboard</a>
        <a href="<?php echo base_url(); ?>perwakilan/profile" class='btn btn-app'><i class='fa fa-edit'></i> Profile</a>
        <a href="<?php echo base_url(); ?>perwakilan/produk" class='btn btn-app'><i class='fa fa-th-list'></i> Stok</a>
        <a href="<?php echo base_url(); ?>perwakilan/pembelian" class='btn btn-app'><i class='fa fa-shopping-cart'></i> Pembelian</a>
        <a href="<?php echo base_url(); ?>perwakilan/penjualankonsumen" class='btn btn-app'><i class='fa fa-users'></i> Trx Konsumen</a>
        <a href="<?php echo base_url(); ?>perwakilan/penjualanagen" class='btn btn-app'><i class='fa fa-user'></i> Trx Agen</a>
        <a href="<?php echo base_url(); ?>perwakilan/penjualandistributor" class='btn btn-app'><i class='fa fa-user'></i> Trx Cabang</a>
        <a href="<?php echo base_url(); ?>perwakilan/orderkode" class='btn btn-app'><i class='fa fa-key'></i> Kode Aktivasi</a>
      </div>
    </div>


<div class="box box-success">
    <div class="box-header">
    <i class="fa fa-th-list"></i>
    <h3 class="box-title">History Stok Produk</h3>
        <div class="box-tools pull-right">
           <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
        </div>

    <div class="box-body chat" id="chat-box">
        <table class="table table-bordered table-striped">
                    <thead>
                                <tr bgcolor='#e3e3e3'>
                                  <th width="30px">No</th>
                                  <th>Nama Produk</th>
                                  <th>Harga Modal</th>
                                  <th>Harga Cabang</th>
                                  <th>Harga Agen</th>
                                  <th>Harga Konsumen</th>
                                  <th><center>Sisa Stok</center></th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $no = 1;
                                foreach ($produk->result_array() as $row){
                                $jual = $this->db->query("SELECT sum(jumlah) as jumlah FROM rb_konsumen_order where id_penjual='".$this->session->id."' AND id_produk='$row[id_produk]' AND penjual='perwakilan'")->row_array();
                                echo "<tr><td>$no</td>
                                          <td>$row[nama_produk]</td>
                                          <td>Rp ".rupiah($row['cabang'])."</td>
                                          <td>Rp ".rupiah($row['distributor'])."</td>
                                          <td>Rp ".rupiah($row['agen'])."</td>
                                          <td>Rp ".rupiah($row['konsumen'])."</td>
                                          <td width='120px' align=center>".rupiah($row['stok']-$jual['jumlah'])."</td>
                                      </tr>";
                                  $no++;
                                }
                              ?>
                              </tbody>
                            </table>
    </div><!-- /.chat -->
</div><!-- /.box (chat box) -->

