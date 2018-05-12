            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Stok Produk</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                                <tr bgcolor='#e3e3e3'>
                                  <th width="30px">No</th>
                                  <th>Nama Produk</th>
                                  <th>Harga Modal</th>
                                  <th>Harga Cabang</th>
                                  <th>Harga Agen</th>
                                  <th>Harga Konsumen</th>
                                  <th><center>Sisa Stok</center></th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $no = 1;
                                foreach ($produk->result_array() as $row){
                                $jual = $this->db->query("SELECT sum(jumlah) as jumlah FROM rb_konsumen_order where id_penjual='".$this->session->id."' AND id_produk='$row[id_produk]' AND penjual='perwakilan'")->row_array();
                                echo "<tr><td>$no</td>
                                          <td>$row[nama_produk]</td>
                                          <td>Rp ".rupiah($row['cabang'])."</td>
                                          <td>Rp ".rupiah($row['distributor'])."</td>
                                          <td>Rp ".rupiah($row['agen'])."</td>
                                          <td>Rp ".rupiah($row['konsumen'])."</td>
                                          <td width='120px' align=center>".rupiah($row['stok']-$jual['jumlah'])."</td>
                                      </tr>";
                                  $no++;
                                }
                              ?>
                              </tbody>
                            </table>
              </div>