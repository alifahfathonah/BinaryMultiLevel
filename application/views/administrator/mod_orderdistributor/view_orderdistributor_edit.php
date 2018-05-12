<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Transaksi Penjualan Produk (Distributor)</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_orderdistributor',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_distributor_order]'>
                    <tr><th width='120px' scope='row'>Nama distributor</th><td><select name='a' class='form-control' required>";
                                                                            foreach ($distributor->result_array() as $row){
                                                                              if ($rows['id_distributor']==$row['id_distributor']){
                                                                                echo "<option value='$row[id_distributor]' selected>$row[nama_distributor] - $row[alamat_lengkap]</option>";
                                                                              }else{
                                                                                echo "<option value='$row[id_distributor]'>$row[nama_distributor] - $row[alamat_lengkap]</option>";
                                                                              }
                                                                            }
                    echo "</td></tr>
                    <tr><th scope='row'>Nama Produk</th>            <td><select name='b' class='form-control' required>
                                                                            <option value='' selected>- Pilih Produk -</option>";
                                                                            foreach ($produk->result_array() as $row){
                                                                              if ($rows['id_produk']==$row['id_produk']){
                                                                                echo "<option value='$row[id_produk]' selected>$row[nama_produk]</option>";
                                                                              }else{
                                                                                echo "<option value='$row[id_produk]'>$row[nama_produk]</option>";
                                                                              }
                                                                            }
                    echo "</td></tr>
                    <tr><th scope='row'>Jumlah Beli</th>                 <td><input type='number' class='form-control' name='c' value='$rows[jumlah]' required></td></tr>
                    <tr><th scope='row'>Keterangan</th>             <td><input type='text' class='form-control' name='d' value='$rows[keterangan]' required></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
