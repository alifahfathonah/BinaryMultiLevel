<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data User</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_manajemenuser',$attributes); 
              if ($rows['foto']==''){ $foto = 'users.gif'; }else{ $foto = $rows['foto']; }
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[username]'>
                    <input type='hidden' name='ids' value='$rows[id_session]'>
                    <tr><th width='120px' scope='row'>Username</th>   <td><input type='text' class='form-control' name='a' value='$rows[username]' readonly='on'></td></tr>
                    <tr><th scope='row'>Password</th>                 <td><input type='password' class='form-control' name='b'></td></tr>
                    <tr><th scope='row'>Nama Lengkap</th>             <td><input type='text' class='form-control' name='c' value='$rows[nama_lengkap]'></td></tr>
                    <tr><th scope='row'>Email</th>                    <td><input type='email' class='form-control' name='d' value='$rows[email]'></td></tr>
                    <tr><th scope='row'>No Telp</th>                  <td><input type='number' class='form-control' name='e' value='$rows[no_telp]'></td></tr>
                    <tr><th scope='row'>Level</th>                    <td>"; if($rows['level']=='user'){ echo "<input type='radio' name='g' value='kontributor'> Kontributor &nbsp; <input type='radio' name='g' value='user' checked> Users Biasa &nbsp; <input type='radio' name='g' value='admin'> Administrator"; }else{ echo "<input type='radio' name='g' value='user'> Users Biasa &nbsp; <input type='radio' name='g' value='admin' checked> Administrator"; } echo "</td></tr>
                    <tr><th scope='row'>Blokir</th>                   <td>"; if ($rows['blokir']=='Y'){ echo "<input type='radio' name='h' value='Y' checked> Ya &nbsp; <input type='radio' name='h' value='N'> Tidak"; }else{ echo "<input type='radio' name='h' value='Y'> Ya &nbsp; <input type='radio' name='h' value='N' checked> Tidak"; } echo "</td></tr>
                    <tr><th scope='row'>Ganti Foto</th>                     <td><input type='file' class='form-control' name='f'><hr style='margin:5px'>
                                                                                 <img class='img-thumbnail' style='height:60px' src='".base_url()."asset/foto_user/$foto'></td></tr>
                  </tbody>
                  </table>
                  <b>Hak Akses :</b><br>";
                      $no = 1;
                      foreach ($mo->result_array() as $mode){
                        $total = $this->db->query("SELECT * FROM users_modul where id_modul='$mode[id_modul]' AND id_session='$rows[id_session]'")->num_rows();
                        if ($total >= 1){ $status='checked'; }else{ $status=''; }
                        echo "<span style='display:inline-block;'><input type=checkbox value='$mode[id_modul]' name='i".$no."' $status>$mode[nama_modul] &nbsp; &nbsp; </span>";
                      $no++;
                      }
                echo "</div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";