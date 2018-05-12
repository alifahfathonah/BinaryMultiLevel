            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Bonus Konsumen Sudah diBayarkan</h3>
                  <a style='margin-left:7px' class='btn btn-sm btn-primary pull-right' href='<?php echo base_url(); ?>administrator/rekapkeuangan'><span class='glyphicon glyphicon-list'></span> Tagihan Pembayaran</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Pasangan</th>
                        <th>Sponsor</th>
                        <th>Tabungan</th>
                        <th>RO</th>
                        <th>Pajak 10%</th>
                        <th>Auto Save</th>
                        <th>Total Bayar</th>
                        <th>Waktu</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
                    $as = $this->model_members->lastautosavesum($row['username'], $row['id_pembayaran_bonus'])->row_array();
                    $ppn = $set['ppn']/100*($row['bonus_pasangan']+$row['bonus_sponsor']+$row['bonus_tabungan']+$row['bonus_ro']);
                    $bonus_pajak = ($row['bonus_pasangan']+$row['bonus_sponsor']+$row['bonus_tabungan']+$row['bonus_ro'])-$ppn;
                    $totalbonus = $row['bonus_pasangan']+$row['bonus_sponsor']+$row['bonus_tabungan']+$row['bonus_ro'];
                    $autosave = $set['persen_auto_save']/100*$bonus_pajak;
                    
                    $cekautosave = $as['auto_save'] + $autosave;
                    if ($as['auto_save'] >= $set['max_auto_save']){
                        $sisa = 0;
                        $totalbonusbersih = $totalbonus - $ppn - $sisa;
                    }elseif ($cekautosave >= $set['max_auto_save']){
                        $sisa = $autosave-($autosave - ($set['max_auto_save'] - $as['auto_save']));
                        $totalbonusbersih = $totalbonus - $ppn - $sisa + ($autosave - ($set['max_auto_save'] - $as['auto_save']));
                    }else{
                        $sisa = $autosave;
                        $totalbonusbersih = $totalbonus - $ppn - $sisa;
                    }
                    echo "<tr><td>$no</td>
                              <td>$row[username]</td>
                              <td>Rp ".rupiah($row['bonus_pasangan'])."</td>
                              <td>Rp ".rupiah($row['bonus_sponsor'])."</td>
                              <td>Rp ".rupiah($row['bonus_tabungan'])."</td>
                              <td>Rp ".rupiah($row['bonus_ro'])."</td>
                              <td>Rp ".rupiah($ppn)."</td>
                              <td>Rp ".rupiah($sisa)."</td>
                              <td style='font-weight:bold; color:red'>Rp ".rupiah($totalbonusbersih)."</td>
                              <td>".tgl_indo($row['waktu_bayar'])."</td>
                              <td><center>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/bonushistory_delete/$row[id_pembayaran_bonus]' onclick=\"return confirm('Apa anda yakin data ini akan dihapus?')\"><span class='glyphicon glyphicon-trash'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>