            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Tagihan Bonus Konsumen Sampai Saat Ini</h3>
                  <a style='margin-left:7px' class='btn btn-sm btn-primary pull-right' href='<?php echo base_url(); ?>administrator/bonushistory'><span class='glyphicon glyphicon-list'></span> History Pembayaran</a>
                  <a target='_BLANK' class='btn btn-sm btn-success pull-right' href='<?php echo base_url(); ?>administrator/exportexcel'><span class='glyphicon glyphicon-book'></span> Export Data Ke Excel</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example3" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Pasangan</th>
                        <th>Sponsor</th>
                        <th>Tabungan</th>
                        <th>RO</th>
                        <th>Pajak 10%</th>
                        <th>Auto Save</th>
                        <th>Tagihan</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
                    $sponsor = $this->model_members->keuangan($row['username'])->row_array();
                    $bonus = $this->model_members->bonussponsor($row['username'])->row_array();
                    $tabungan = $this->model_members->bonustabungan($row['username'])->row_array();
                    $ro = $this->model_members->bonusro($row['username'])->row_array();
                    $cairan = $this->model_members->totpencairan($row['username'],$set['bonus_pasangan'])->row_array();
                    $as = $this->model_members->autosavesum($row['username'],$set['persen_auto_save'],$set['ppn'])->row_array();

                        $kecil = min($sponsor['totfoot_left']-$cairan['bonus_pasangan'], $sponsor['totfoot_right']-$cairan['bonus_pasangan']);
                        $sisakiri = $sponsor['totfoot_left']-$cairan['bonus_pasangan'];
                        $sisakanan = $sponsor['totfoot_right']-$cairan['bonus_pasangan'];
                        $bonuspasangan = $kecil*$set['bonus_pasangan'];
                        $bonussponsor = $bonus['bonussponsor']-$cairan['bonus_sponsor'];
                        $bonustabungan = $tabungan['bonustabungan']-$cairan['bonus_tabungan'];
                        $bonusro = $ro['bonusro']-$cairan['bonus_ro'];

                        $totalbonus = $bonuspasangan+$bonussponsor+$bonustabungan+$bonusro;
                        $ppn = $set['ppn']/100*($totalbonus);
                        $bonus_pajak = $totalbonus-$ppn;
                        $autosave = $set['persen_auto_save']/100*($bonus_pajak);

                        $cekautosave = $as['auto_save'] + $autosave;
                        if ($as['auto_save'] >= $set['max_auto_save']){
                          $sisa = 0;
                          $totalbonusbersih = $totalbonus - $ppn - $sisa;
                        }elseif ($cekautosave >= $set['max_auto_save']){
                          $sisa = $autosave-($autosave - ($set['max_auto_save'] - $as['auto_save']));
                          $totalbonusbersih = ($totalbonus - $ppn - $sisa + ($autosave - ($set['max_auto_save'] - $as['auto_save']))+$sisa);
                        }else{
                          $sisa = $autosave;
                          $totalbonusbersih = $totalbonus - $ppn - $sisa;
                        }

                    echo "<tr>
                              <td>$row[username]</td>
                              <td>Rp ".rupiah($bonuspasangan)."</td>
                              <td>Rp ".rupiah($bonussponsor)."</td>
                              <td>Rp ".rupiah($bonustabungan)."</td>
                              <td>Rp ".rupiah($bonusro)."</td>
                              <td>Rp ".rupiah($ppn)."</td>
                              <td>Rp ".rupiah($sisa)."</td>
                              <td style='font-weight:bold; color:red'>Rp ".rupiah($totalbonusbersih)."</td>
                              <td><center>
                                <a style='margin-right:3px' class='btn btn-primary btn-xs' title='Detail' href='".base_url()."administrator/detail_konsumen/$row[id_konsumen]'><span class='glyphicon glyphicon-search'></span></a>";
                                  if ($totalbonusbersih > 1){
                                    echo "<a class='btn btn-info btn-xs' title='Bayarkan Secara Manual' href='".base_url()."administrator/keuanganbayarmanual/$row[username]'><span class='glyphicon glyphicon-pencil'></span> Manual</a>
                                          <a class='btn btn-success btn-xs' title='Sudah dibayarkan Semuanya' href='".base_url()."administrator/bayarrekapkeuangan/$row[id_konsumen]' onclick=\"return confirm('Apa anda yakin data ini sudah dibayarkan?')\"><span class='glyphicon glyphicon-ok'></span> Lunas</a>";
                                  }else{
                                    echo "<a class='btn btn-default btn-xs' title='Bayarkan Secara Manual' href='#' onclick=\"return confirm('Maaf, Tidak ada tagihan pada data ini.!!!')\"><span class='glyphicon glyphicon-pencil'></span> Manual</a>
                                          <a class='btn btn-default btn-xs' title='Sudah dibayarkan Semuanya' href='#' onclick=\"return confirm('Maaf, Tidak ada tagihan pada data ini.!!!')\"><span class='glyphicon glyphicon-ok'></span> Lunas</a>";
                                  }
                              echo "</center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>