      <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Pembelian Produk </h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#pembelian' id='pembelian-tab' role='tab' data-toggle='tab' aria-controls='pembelian' aria-expanded='true'>Data Pembelian ke Pusat </a></li>
                      <li role='presentation' class=''><a href='#pembelianperw' role='tab' id='pembelianperw-tab' data-toggle='tab' aria-controls='pembelianperw' aria-expanded='false'>Data Pembelian ke Perwakilan</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='pembelian' aria-labelledby='pembelian-tab'>
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

                    </div>
                  </div>
                </div>
            </div>
        </div>