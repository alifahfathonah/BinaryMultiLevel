  <p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Data Pembelanjaan Produk Anda</p> 

                  <table class='table table-hover table-condensed'>
                    <thead>
                                <tr>
                                  <th width="20px">No</th>
                                  <th>Belanja Ke</th>
                                  <th>Produk Order</th>
                                  <th><center>Qty</center></th>
                                  <th>Satuan Rp</th>
                                  <th>Total Rp</th>
                                  <th><center>Waktu Beli</center></th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $no = 1;
                                foreach ($record->result_array() as $row){
                                $ex = explode(' ',$row['waktu_order']);
                                echo "<tr><td>$no</td>
                                          <td style='text-transform:capitalize'>$row[penjual]</td>
                                          <td>$row[nama_produk]</td>
                                          <td align=center>".rupiah($row['jumlah'])."</td>
                                          <td>Rp ".rupiah($row['konsumen'])."</td>
                                          <td style='color:red'><b>Rp ".rupiah($row['jumlah']*$row['konsumen'])."</b></td>
                                          <td>".tgl_indo($ex[0])."</td>
                                      </tr>";
                                  $no++;
                                }
                              ?>
                              </tbody>
                            </table>
