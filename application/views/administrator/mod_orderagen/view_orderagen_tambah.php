<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Transaksi Penjualan Produk</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_orderagen',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Nama Agen</th><td><select name='a' class='form-control' required>
                                                                            <option value='' selected>- Pilih Agen -</option>";
                                                                            foreach ($agen->result_array() as $row){
                                                                                echo "<option value='$row[id_agen]'>$row[nama_agen] - $row[alamat_lengkap]</option>";
                                                                            }
                    echo "</td></tr>
                    <tr><th scope='row'>Nama Produk</th>            <td><select name='b' class='form-control' required>
                                                                            <option value='' selected>- Pilih Produk -</option>";
                                                                            foreach ($produk->result_array() as $row){
                                                                                echo "<option value='$row[id_produk]'>$row[nama_produk]</option>";
                                                                            }
                    echo "</td></tr>
                    <tr><th scope='row'>Jumlah Beli</th>                 <td><input type='number' class='form-control' name='c' required></td></tr>
                    <tr><th scope='row'>Keterangan</th>             <td><input type='text' class='form-control' name='d' required></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
