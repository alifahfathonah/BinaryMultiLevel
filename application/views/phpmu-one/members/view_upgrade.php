<?php 
  echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Paket Aktif Saat ini</p>
        <p>Paket Hanya Bisa di Upgrade paling lama 60 Hari setelah pendaftaran.<br> Dan hanya bisa melakukan upgrade paket 1 kali saja.</p>";                
                  if ($record['id_paket']=='1'){ $color = 'red'; }elseif($record['id_paket']=='2'){ $color = 'orange'; }else{ $color = 'blue'; }
                  $attributes = array('role'=>'form','id' => 'formku');
                  echo form_open_multipart('members/upgrade',$attributes); 
                  echo "<table class='table table-hover'>
                        <thead>
                          <tr><td width='170px'><b>Nama Lengkap</b></td>     <td>$record[nama_lengkap]</td></tr>
                          <tr><td><b>Paket Aktif</b></td>                    <td><b style='color:$color'>$record[nama_paket]</b> : Max $record[min_paket] Pasang dan Max $record[max_paket] Pasang</td></tr>
                          <tr><td><b>Keterangan</b></td>                     <td>Rp ".rupiah($record['harga_paket'])." / $record[min_paket] Paket dan Max $record[max_paket] Pasang Perhari.<br>
                                                                                 Produk Senilai Rp ".rupiah($record['nilai_produk'])." & $record[lainnya] <br>
                                                                                 Potensi Penghasilan Perhari : Rp ".rupiah($record['potensi_penghasilan'])." ,/ Perbulan Rp ".rupiah($record['potensi_penghasilan']*30)."</td></tr>
                          <tr><td><b>Upgrade / Downgrade</b></td>              <td><select class='required form-control' name='a'>
                                                                                      <option value=''>- Pilih -</option>";
                                                                                      foreach ($row->result_array() as $r){
                                                                                          echo "<option value='$r[id_paket]'>$r[nama_paket]</option>";
                                                                                      }
                                                                                   echo "</select></td></tr>
                                                                            <input type='hidden' value='$record[id_paket]' name='paketlama'>
                          <tr><td><b>Jelaskan</b></td>                      <td><textarea class='required form-control' style='height:100px' name='b'></textarea></td></tr>                                                      
                          <tr><td></td>                                       <td><input class='btn btn-primary btn-sm' type='submit' value='Kirimkan Permohonan' name='submit'></td></tr>   
                        </thead>
                    </table>";
                    echo form_close();
?>