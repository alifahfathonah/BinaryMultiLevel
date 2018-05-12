<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Agen Baru</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_agen',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Username</th>   <td><input type='text' class='form-control' name='a' required></td></tr>
                    <tr><th scope='row'>Password</th>                 <td><input type='password' class='form-control' name='b' required></td></tr>
                    <tr><th scope='row'>Nama Agen</th>                <td><input type='text' class='form-control' name='c' required></td></tr>
                    <tr><th scope='row'>Tempat Lahir</th>             <td><input type='text' class='form-control' name='d' required></td></tr>
                    <tr><th scope='row'>Tanggal Lahir</th>            <td><input type='text' class='datepicker form-control' data-date-format='yyyy-mm-dd' name='e' required></td></tr>
                    <tr><th scope='row'>No KTP / SIM</th>             <td><input type='number' class='form-control' name='f' required></td></tr>
                    <tr><th scope='row'>Alamat Email</th>             <td><input type='email' class='form-control' name='g' required></td></tr>
                    <tr><th scope='row'>Alamat Lengkap</th>           <td><input type='text' class='form-control' name='h' required></td></tr>
                    <tr><th scope='row'>Kota</th>                     <td><input type='text' class='form-control' name='i' required></td></tr>
                    <tr><th scope='row'>Provinsi</th>                 <td><input type='text' class='form-control' name='j' required></td></tr>
                    <tr><th scope='row'>Kode Pos</th>                 <td><input type='number' class='form-control' name='k' required></td></tr>
                    <tr><th scope='row'>Telp / Hp</th>                <td><input type='number' class='form-control' name='l' required></td></tr>
                    <tr><th scope='row'>Aktif</th>                    <td><input type='radio' name='m' value='Y' checked> Ya &nbsp; <input type='radio' name='m' value='N'> Tidak</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
