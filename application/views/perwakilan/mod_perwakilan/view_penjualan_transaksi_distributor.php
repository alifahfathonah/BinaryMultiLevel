<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Transaksi Penjualan Produk ke Distributor</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('perwakilan/tambah_penjualan_distributor',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='d' value='distributor'>
                    <input type='hidden' name='id' value='$id'>
                    <tr><th width='120px' scope='row'>No KTP / SIM</th><td><input type='text' class='form-control' value='$no_ktp' required disabled></td></tr>
                    <tr><th width='120px' scope='row'>Nama Distributor</th><td><input type='text' class='form-control' value='$nama_konsumen' required disabled></td></tr>
                    <tr><th width='120px' scope='row'>Alamat Lengkap</th><td><textarea class='form-control' required disabled>$alamat_lengkap</textarea></td></tr>

                    <tr><th scope='row'>Nama Produk</th>            <td><select name='a' class='form-control' required>
                                                                            <option value='' selected>- Pilih Produk -</option>";
                                                                            foreach ($produk->result_array() as $row){
                                                                                echo "<option value='$row[id_produk]'>$row[nama_produk]</option>";
                                                                            }
                    echo "</td></tr>
                    <tr><th scope='row'>Jumlah Beli</th>            <td><input type='number' class='form-control' name='b' required></td></tr>
                    <tr><th scope='row'>Keterangan</th>             <td><input type='text' class='form-control' name='c' required></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Proses</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
