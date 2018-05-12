<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Paket Terpilih</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_paket',$attributes);
              echo "<div class='col-md-12'>
                      <table class='table table-condensed table-bordered'>
                      <tbody>
                        <input type='hidden' name='id' value='$rows[id_paket]'>
                        <tr><th width='140px' scope='row'>Nama paket</th>    <td><input type='text' class='form-control' name='a' value='$rows[nama_paket]' required></td></tr>
                        <tr><th scope='row'>Harga Paket</th>                 <td><input type='number' class='form-control' name='b' value='$rows[total_rp]'></td></tr>
                        <tr><th scope='row'>Min Paket</th>                   <td><input type='number' class='form-control' name='c' value='$rows[min_paket]'></td></tr>
                        <tr><th scope='row'>Max paket</th>                   <td><input type='number' class='form-control' name='d' value='$rows[max_paket]'></td></tr>
                        <tr><th scope='row'>Nilai Produk</th>                <td><input type='number' class='form-control' name='e' value='$rows[nilai_produk]'></td></tr>
                        <tr><th scope='row'>Nilai Lainnya</th>               <td><input type='text' class='form-control' name='f' value='$rows[lainnya]'></td></tr>
                        <tr><th scope='row'>Potensi Penghasilan</th>         <td><input type='number' class='form-control' name='g' value='$rows[potensi_penghasilan]'></td></tr>
                        <tr><th scope='row'>Bonus Sponsrisasi</th>           <td><input type='number' class='form-control' name='h' value='$rows[bonus_sponsorisasi]'></td></tr>
                        <tr><th scope='row'>Keterangan</th>                  <td><textarea class='form-control' name='i' style='height:160px'>$rows[keterangan]</textarea></td></tr>
                      </tbody>
                      </table>
                    </div>
                  </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
