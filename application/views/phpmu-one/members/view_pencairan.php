  <p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> History Pencairan Bonus</p>                
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                                    <th>Pasangan</th>
                                    <th>Sponsor</th>
                                    <th>Tabungan</th>
                                    <th>RO</th>
                                    <th>PPN 10%</th>
                                    <th>Auto Save</th>
                                    <th>Total Bayar</th>
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
                                          <td>".rupiah($row['bonus_pasangan'])."</td>
                                          <td>".rupiah($row['bonus_sponsor'])."</td>
                                          <td>".rupiah($row['bonus_tabungan'])."</td>
                                          <td>".rupiah($row['bonus_ro'])."</td>
                                          <td>".rupiah($ppn)."</td>
                                          <td>".rupiah($sisa)."</td>
                                          <td style='font-weight:bold; color:red'>Rp ".rupiah($totalbonusbersih)."</td>
                                          <td></td>
                                      </tr>";
                                  $no++;
                    }
                  ?>
                  </tbody>
                </table>