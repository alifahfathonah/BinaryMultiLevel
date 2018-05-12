            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Semua Tabungan Konsumen</h3>
                  <a class='btn btn-sm btn-primary pull-right' href='<?php echo base_url(); ?>administrator/bayartabungan'>Tambahkan Data Tabungan</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php 
                  echo "<table id='example3' class='table table-bordered table-striped'>
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Username</th>
                        <th>Total Bayar</th>
                        <th>Keterangan</th>
                        <th>Tanggal Bayar</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>";

                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $ex = explode(' ',$row['tanggal_bayar']);
                    $tgl_bayar = tgl_indo($ex[0]);
                    echo "<tr><td>$no</td>
                              <td>$row[username]</td>
                              <td>Rp ".rupiah($row['total_bayar'])."</td>
                              <td>$row[keterangan]</td>
                              <td>$tgl_bayar ".$ex[1]."</td>
                              <td width='60px'>
                                  <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."administrator/edittabungan/$row[id_tabungan_bayar]'><span class='glyphicon glyphicon-edit'></span></a>
                                  <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/deletetabungan/$row[id_tabungan_bayar]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>