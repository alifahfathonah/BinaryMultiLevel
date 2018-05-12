  <p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Tabungan Anda 
  <p>Berikut ini adalah data paket tabungan anda.</p> 
                <?php 
                  echo "<table class='table table-hover table-condensed'>
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Total Bayar</th>
                        <th>Tanggal Bayar</th>
                        <th>Status</th>
                        <th>Rekening Virtual</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                          <td></td>
                          <td>Rp ".rupiah($dp['total_rp'])."</td>
                          <td>".tgl_indo($dp['tanggal_daftar'])." 00:00:00 </td>
                          <td>DP</td>
                          <td></td>
                      </tr>";

                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $ex = explode(' ',$row['tanggal_bayar']);
                    $tgl_bayar = tgl_indo($ex[0]);

                    if ($row['status']=='Lunas'){ 
                      $status = '<i style="color:green">Lunas</i>'; 
                      $link= '<a class="btn btn-xs btn-default" href="#">Konfirmasi Bayar</a>';
                    }elseif ($row['status']=='Proses'){ 
                      $status = '<i style="color:blue">Proses</i>'; 
                      $link= '<a class="btn btn-xs btn-default" href="#">Konfirmasi Bayar</a>';
                    }else{ 
                      $status = '<i style="color:red">Pending</i>'; 
                      $link= '<a class="btn btn-xs btn-success" href='.base_url().'members/konfirmasitabungan/'.$row['id_tabungan_bayar'].'>Konfirmasi Bayar</a>';
                    }

                    echo "<tr><td>$no</td>
                              <td>Rp ".rupiah($row['total_bayar'])."</td>
                              <td>$tgl_bayar ".$ex[1]."</td>
                              <td>$status</td>
                              <td width='150px'>$dp[rekning_virtual]</td>
                          </tr>";
                      $no++;
                    }
                  ?>
                    <tr class='danger'>
                      <td></td>
                      <td colspan='5'><b>Rp <?php echo rupiah($total['total']+$dp['total_rp']); ?></b></td>
                    </tr>
                  </tbody>
                </table>