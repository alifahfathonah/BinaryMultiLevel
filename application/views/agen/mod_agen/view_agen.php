      <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Agen </h3>
                  <a class='btn btn-success btn-sm pull-right' href='<?php echo base_url(); ?>agen/edit_agen'>Edit Profile</a>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#profile' id='profile-tab' role='tab' data-toggle='tab' aria-controls='profile' aria-expanded='true'>Data Agen </a></li>
                      <li role='presentation' class=''><a href='#produk' role='tab' id='produk-tab' data-toggle='tab' aria-controls='produk' aria-expanded='false'>Data Stok Produk</a></li>
                      <li role='presentation' class=''><a href='#pembelian' role='tab' id='pembelian-tab' data-toggle='tab' aria-controls='pembelian' aria-expanded='false'>Data Pembelian ke Pusat</a></li>
                      <li role='presentation' class=''><a href='#pembelianperw' role='tab' id='pembelianperw-tab' data-toggle='tab' aria-controls='pembelianperw' aria-expanded='false'>Data Pembelian ke Perwakilan</a></li>
                      <li role='presentation' class=''><a href='#pembeliancaba' role='tab' id='pembeliancaba-tab' data-toggle='tab' aria-controls='pembeliancaba' aria-expanded='false'>Data Pembelian ke Cabang</a></li>
                      <li role='presentation' class=''><a href='#penjualan' role='tab' id='penjualan-tab' data-toggle='tab' aria-controls='penjualan' aria-expanded='false'>Data Penjualan ke Konsumen</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='profile' aria-labelledby='profile-tab'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th width='130px' scope='row'>Username</th> <td><?php echo $rows['username']?></td></tr>
                              <tr><th scope='row'>Password</th> <td>xxxxxxxxxxxxxxx</td></tr>
                              <tr><th scope='row'>Nama Agen</th> <td><?php echo $rows['nama_agen']?></td></tr>
                              <tr><th scope='row'>Tempat Lahir</th> <td><?php echo $rows['tempat_lahir']?></td></tr>
                              <tr><th scope='row'>Tanggal Lahir</th> <td><?php echo tgl_indo($rows['tanggal_lahir']); ?></td></tr>
                              <tr><th scope='row'>No KTP / Sim</th> <td><?php echo $rows['no_ktp_sim']?></td></tr>
                              <tr><th scope='row'>Alamat Email</th> <td><?php echo $rows['email']?></td></tr>
                            </tbody>
                            </table>
                          </div>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th width='130px' scope='row'>Alamat Lengkap</th> <td><?php echo $rows['alamat_lengkap']?></td></tr>
                              <tr><th scope='row'>Kota</th> <td><?php echo $rows['kota']?></td></tr>
                              <tr><th scope='row'>Provinsi</th> <td><?php echo $rows['provinsi']?></td></tr>
                              <tr><th scope='row'>Kode Pos</th> <td><?php echo $rows['kode_pos']?></td></tr>
                              <tr><th scope='row'>No Telp / Hp</th> <td><?php echo $rows['telp_hp']?></td></tr>
                              <tr><th scope='row'>Waktu Daftar</th> <td><?php echo $rows['waktu_daftar']?></td></tr>
                              <tr><th scope='row'>Status</th> <td><?php if ($rows['aktif']=='Y'){ echo '<i style="color:green">Aktif</i>'; }else{ echo '<i style="color:red">Non Aktif</i>'; } ?></td></tr>
                            </tbody>
                            </table>
                          </div>  
                          <div style='clear:both'></div>
                      </div>



                      <div role='tabpanel' class='tab-pane fade' id='produk' aria-labelledby='produk-tab'>
                          <div class='col-md-12'>
                            <table class='table table-condensed table-bordered'>
                              <thead>
                                <tr bgcolor='#e3e3e3'>
                                  <th width="30px">No</th>
                                  <th>Nama Produk</th>
                                  <th><center>Sisa Stok</center></th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $no = 1;
                                foreach ($produk->result_array() as $row){
                                $jual = $this->db->query("SELECT sum(jumlah) as jumlah FROM rb_konsumen_order where id_penjual='$rows[id_agen]' AND id_produk='$row[id_produk]' AND penjual='agen'")->row_array();
                                echo "<tr><td>$no</td>
                                          <td>$row[nama_produk]</td>
                                          <td width='120px' align=center>".rupiah($row['stok']-$jual['jumlah'])."</td>
                                      </tr>";
                                  $no++;
                                }
                              ?>
                              </tbody>
                            </table>
                          </div>
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='pembelian' aria-labelledby='pembelian-tab'>
                          <div class='col-md-12'>
                            <table class='table table-condensed table-bordered'>
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
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='pembelianperw' aria-labelledby='pembelianperw-tab'>
                          <div class='col-md-12'>
                            <table class='table table-condensed table-bordered'>
                              <thead>
                                <tr bgcolor='#e3e3e3'>
                                  <th width="30px">No</th>
                                  <th>Nama Perwakilan</th>
                                  <th>Nama Produk</th>
                                  <th width='120px'><center>Jumlah Beli</center></th>
                                  <th><center>Keterangan</center></th>
                                  <th width='200px'><center>Waktu Beli</center></th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $no = 1;
                                foreach ($pembelianperw->result_array() as $row){
                                $ex = explode(' ',$row['waktu_order']);
                                echo "<tr><td>$no</td>
                                          <td>$row[nama_perwakilan]</td>
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
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='pembeliancaba' aria-labelledby='pembeliancaba-tab'>
                          <div class='col-md-12'>
                            <table class='table table-condensed table-bordered'>
                              <thead>
                                <tr bgcolor='#e3e3e3'>
                                  <th width="30px">No</th>
                                  <th>Nama Cabang</th>
                                  <th>Nama Produk</th>
                                  <th width='120px'><center>Jumlah Beli</center></th>
                                  <th><center>Keterangan</center></th>
                                  <th width='200px'><center>Waktu Beli</center></th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $no = 1;
                                foreach ($pembeliandist->result_array() as $row){
                                $ex = explode(' ',$row['waktu_order']);
                                echo "<tr><td>$no</td>
                                          <td>$row[nama_distributor]</td>
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
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='penjualan' aria-labelledby='penjualan-tab'>
                          <div class='col-md-12'>
                            <table class='table table-condensed table-bordered'>
                              <thead>
                                <tr bgcolor='#e3e3e3'>
                                  <th width="30px">No</th>
                                  <th>Nama Pembeli</th>
                                  <th>Produk Order</th>
                                  <th width='100px'><center>Jumlah</center></th>
                                  <th><center>Keterangan</center></th>
                                  <th width='200px'><center>Waktu Jual</center></th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $no = 1;
                                foreach ($penjualan->result_array() as $row){
                                $ex = explode(' ',$row['waktu_order']);
                                echo "<tr><td>$no</td>
                                          <td><a href='".base_url()."administrator/detail_konsumen/$row[id_konsumen]'>$row[nama_lengkap]</a></td>
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
                      </div>

                    </div>
                  </div>
                </div>
            </div>
        </div>