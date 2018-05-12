            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Penjualan produk ke Konsumen</h3>
                  
                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action='<?php echo base_url(); ?>agen/tambah_penjualan' method='POST'>
                    Konsumen <input type='text' class='required' placeholder='Masukkan Username atau No KTP Konsumen...' name='id' style='width:300px; padding:3px; border:1px solid #e3e3e3; padding:4px 5px 4px 8px' required>
                    <input type="submit" name='proses' style='margin-top:-4px' class='btn btn-primary btn-sm' value='Transaksi'>
                  </form>

                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                                <tr bgcolor='#e3e3e3'>
                                  <th width="20px">No</th>
                                  <th>Nama Pembeli</th>
                                  <th>Produk Order</th>
                                  <th><center>Qty</center></th>
                                  <th>Satuan Rp</th>
                                  <th>Total Rp</th>
                                  <th><center>Keterangan</center></th>
                                  <th><center>Waktu Jual</center></th>
                                  <th width='30px'><center></center></th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $no = 1;
                                foreach ($penjualan->result_array() as $row){
                                $ex = explode(' ',$row['waktu_order']);
                                echo "<tr><td>$no</td>
                                          <td><a href='#'>$row[nama_lengkap]</a></td>
                                          <td>$row[nama_produk]</td>
                                          <td align=center>".rupiah($row['jumlah'])."</td>
                                          <td>Rp ".rupiah($row['konsumen'])."</td>
                                          <td>Rp ".rupiah($row['total'])."</td>
                                          <td>$row[keterangan]</td>
                                          <td>".tgl_indo($ex[0])."</td>
                                          <td><a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."agen/delete_penjualan/$row[id_konsumen_order]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a></td>
                                      </tr>";
                                  $no++;
                                }
                              ?>
                              </tbody>
                            </table>
              </div>