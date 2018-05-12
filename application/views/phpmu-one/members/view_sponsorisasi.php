  <p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Data Sponsorisasi Anda</p>  

                <?php 
                  echo "<table class='table table-hover table-condensed'>
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Waktu</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>";
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $ex = explode(' ',$row['timer']);
                    $tgl_bayar = tgl_indo($ex[0]);
                    echo "<tr><td>$no</td>
                              <td>$row[nama_lengkap]</td>
                              <td>$row[username]</td>
                              <td>$tgl_bayar ".$ex[1]." WIB</td>
                              <td>Rp ".rupiah($row['bonus_sponsor'])."</td>
                              
                          </tr>";
                      $no++;
                    }

                    $total = $record->num_rows();
                  ?>
                    <tr class='danger'>
                      <td colspan='4'></td>
                      <td><b>Rp <?php echo rupiah($total*500000); ?></b></td>
                    </tr>
                  </tbody>
                </table>