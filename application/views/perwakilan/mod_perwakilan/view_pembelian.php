            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Pembelian Produk dari Pusat</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                                <tr bgcolor='#e3e3e3'>
                                  <th width="30px">No</th>
                                  <th>Nama Produk</th>
                                  <th width='120px'><center>Jumlah Beli</center></th>
                                  <th><center>Keterangan</center></th>
                                  <th width='200px'><center>Waktu Beli</center></th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $no = 1;
                                foreach ($pembelian->result_array() as $row){
                                $ex = explode(' ',$row['waktu_order']);
                                echo "<tr><td>$no</td>
                                          <td>$row[nama_produk]</td>
                                          <td align=center>".rupiah($row['jumlah'])."</td>
                                          <td>$row[keterangan]</td>
                                          <td>".tgl_indo($ex[0]).", ".$ex[1]." WIB</td>
                                      </tr>";
                                  $no++;
                                }
                              ?>
                              </tbody>
                            </table>
              </div>