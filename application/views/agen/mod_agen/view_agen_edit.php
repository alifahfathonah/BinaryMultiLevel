<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Profile anda (Agen)</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('agen/edit_agen',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='".$this->session->id."'>
                    <tr><th width='120px' scope='row'>Username</th>   <td><input type='text' class='form-control' name='a' value='$rows[username]' required></td></tr>
                    <tr><th scope='row'>Password</th>                 <td><input type='password' class='form-control' name='b'></td></tr>
                    <tr><th scope='row'>Nama Agen</th>                <td><input type='text' class='form-control' name='c' value='$rows[nama_agen]' required></td></tr>
                    <tr><th scope='row'>Tempat Lahir</th>             <td><input type='text' class='form-control' name='d' value='$rows[tempat_lahir]' required></td></tr>
                    <tr><th scope='row'>Tanggal Lahir</th>            <td><input type='text' class='datepicker form-control' data-date-format='yyyy-mm-dd' name='e' value='$rows[tanggal_lahir]' required></td></tr>
                    <tr><th scope='row'>No KTP / SIM</th>             <td><input type='number' class='form-control' name='f' value='$rows[no_ktp_sim]' required></td></tr>
                    <tr><th scope='row'>Alamat Email</th>             <td><input type='email' class='form-control' name='g' value='$rows[email]' required></td></tr>
                    <tr><th scope='row'>Alamat Lengkap</th>           <td><input type='text' class='form-control' name='h' value='$rows[alamat_lengkap]' required></td></tr>
                    <tr><th scope='row'>Kota</th>                     <td><input type='text' class='form-control' name='i' value='$rows[kota]' required></td></tr>
                    <tr><th scope='row'>Provinsi</th>                 <td><input type='text' class='form-control' name='j' value='$rows[provinsi]' required></td></tr>
                    <tr><th scope='row'>Kode Pos</th>                 <td><input type='number' class='form-control' name='k' value='$rows[kode_pos]' required></td></tr>
                    <tr><th scope='row'>Telp / Hp</th>                <td><input type='number' class='form-control' name='l' value='$rows[telp_hp]' required></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
