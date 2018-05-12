      <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Konsumen</h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#profile' id='profile-tab' role='tab' data-toggle='tab' aria-controls='profile' aria-expanded='true'>Data Konsumen </a></li>
                      <li role='presentation' class=''><a href='#jaringan' role='tab' id='jaringan-tab' data-toggle='tab' aria-controls='jaringan' aria-expanded='false'>Bonus Sponsorisasi</a></li>
                      <li role='presentation' class=''><a href='#btabungan' role='tab' id='btabungan-tab' data-toggle='tab' aria-controls='btabungan' aria-expanded='false'>Bonus Tabungan</a></li>
                      <li role='presentation' class=''><a href='#ro' role='tab' id='ro-tab' data-toggle='tab' aria-controls='ro' aria-expanded='false'>Bonus Repeat Order</a></li>
                      <li role='presentation' class=''><a href='#tabungan' role='tab' id='tabungan-tab' data-toggle='tab' aria-controls='tabungan' aria-expanded='false'>Data Tabungan</a></li>
                      <li role='presentation' class=''><a href='#keuangan' role='tab' id='keuangan-tab' data-toggle='tab' aria-controls='keuangan' aria-expanded='false'>Data Keuangan</a></li>
                      <li role='presentation' class=''><a href='#pencairan' role='tab' id='pencairan-tab' data-toggle='tab' aria-controls='pencairan' aria-expanded='false'>Pencairan Bonus</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='profile' aria-labelledby='profile-tab'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th width='130px' scope='row'>Kode Konsumen</th> <td><?php echo $rows['kode_konsumen']?></td></tr>
                              <tr><th scope='row'>Username</th> <td><?php echo $rows['username']?></td></tr>
                              <tr><th scope='row'>Password</th> <td>xxxxxxxxxxxxxxx</td></tr>
                              <tr><th scope='row'>Nama Lengkap</th> <td><?php echo $rows['nama_lengkap']?></td></tr>
                              <tr><th scope='row'>Alamat Email</th> <td><?php echo $rows['email']?></td></tr>
                              <tr><th scope='row'>Jenis Kelamin</th> <td><?php echo $rows['jenis_kelamin']?></td></tr>
                              <tr><th scope='row'>Tanggal Lahir</th> <td><?php echo tgl_indo($rows['tanggal_lahir']); ?></td></tr>
                              <tr><th scope='row'>No KTP</th> <td><?php echo $rows['no_ktp']?></td></tr>
                              <tr><th scope='row'>Alamat Lengkap</th> <td><?php echo $rows['alamat_lengkap']?></td></tr>
                              <tr><th scope='row'>Ahli Waris</th> <td><?php echo $rows['ahli_waris']?></td></tr>
                            </tbody>
                            </table>
                          </div>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th scope='row'>Kota</th> <td><?php echo $rows['kota']?></td></tr>
                              <tr><th width='130px' scope='row'>Provinsi</th> <td><?php echo $rows['provinsi']?></td></tr>
                              <tr><th scope='row'>No Hp</th> <td><?php echo $rows['no_hp']?></td></tr>
                              <tr><th scope='row'>Nama Bank</th> <td><?php echo $rows['nama_bank']?></td></tr>
                              <tr><th scope='row'>No Rekening</th> <td><?php echo $rows['no_rekening']?></td></tr>
                              <tr><th scope='row'>No Rek Virtual</th> <td><?php echo $rows['rekning_virtual']?></td></tr>
                              <tr><th scope='row'>Atas Nama</th> <td><?php echo $rows['atas_nama']?></td></tr>
                              <tr><th scope='row'>Sponsor</th> <td><?php echo $rows['sponsor']?></td></tr>
                              <tr><th scope='row'>Penempatan</th> <td><?php if ($rows['id_penempatan'] == '1'){ echo "Kiri"; }else{ echo "Kanan"; } ?></td></tr>
                              <tr><th scope='row'>Nama Paket</th> <td><?php echo $rows['nama_paket']?></td></tr>
                              <tr><th scope='row'>Tanggal Daftar</th> <td><?php echo tgl_indo($rows['tanggal_daftar']); ?></td></tr>
                            </tbody>
                            </table>
                          </div>  
                          <div style='clear:both'></div>
                      </div>



                      <div role='tabpanel' class='tab-pane fade' id='jaringan' aria-labelledby='jaringan-tab'>
                          <div class='col-md-12'>
                              <?php 
                                echo "<table class='table table-hover table-condensed'>
                                  <thead>
                                    <tr>
                                      <th style='width:40px'>No</th>
                                      <th>Nama Lengkap</th>
                                      <th>Username</th>
                                      <th>Waktu</th>
                                      <th>Total</th>
                                    </tr>
                                  </thead>
                                  <tbody>";
                                  $no = 1;
                                  foreach ($sponsorisasi->result_array() as $row){
                                  $ex = explode(' ',$row['timer']);
                                  $tgl_bayar = tgl_indo($ex[0]);
                                  echo "<tr><td>$no</td>
                                            <td>$row[nama_lengkap]</td>
                                            <td>$row[username]</td>
                                            <td>$tgl_bayar ".$ex[1]." WIB</td>
                                            <td>Rp ".rupiah($row['bonus_sponsor'])."</td>
                                            
                                        </tr>";
                                    $no++;
                                  }

                              ?>
                                  <tr class='info'>
                                    <td colspan='4'>Total Semua</td>
                                    <td><b>Rp <?php echo rupiah($total_sponsorisasi['total']); ?></b></td>
                                  </tr>
                                  <tr class='success'>
                                    <td colspan='4'>Sudah Bayar</td>
                                    <td><b>Rp <?php echo rupiah($cairan['bonus_sponsor']); ?></b></td>
                                  </tr>
                                  <tr class='danger'>
                                    <td colspan='4'>Sisa Bayar</td>
                                    <td><b>Rp <?php echo rupiah($total_sponsorisasi['total']-$cairan['bonus_sponsor']); ?></b></td>
                                  </tr>
                                </tbody>
                              </table>
                          </div>
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='btabungan' aria-labelledby='btabungan-tab'>
                          <div class='col-md-12'>
                            <table class='table table-condensed table-bordered'>
                                <thead>
                                  <tr>
                                    <th style='width:40px'>No</th>
                                    <th>Nama Upline</th>
                                    <th>Jumlah Bonus</th>
                                    <th>Waktu Masuk</th>
                                  </tr>
                                </thead>
                                <tbody>
                              <?php
                                $no = 1;
                                foreach ($tax->result_array() as $row){
                                $ex = explode(' ',$row['waktu_masuk']);
                                $tgl_bayar = tgl_indo($ex[0]);
                                echo "<tr><td>$no</td>
                                          <td>$row[upline]</td>
                                          <td>Rp ".rupiah($row['jumlah_bonus'])."</td>
                                          <td>$tgl_bayar ".$ex[1]."</td>
                                      </tr>";
                                  $no++;
                                }
                              ?>
                                  <tr class='info'>
                                    <td colspan='3'>Total Semua</td>
                                    <td><b>Rp <?php echo rupiah($total_tabungan['total']); ?></b></td>
                                  </tr>
                                  <tr class='success'>
                                    <td colspan='3'>Sudah Bayar</td>
                                    <td><b>Rp <?php echo rupiah($cairan['bonus_tabungan']); ?></b></td>
                                  </tr>
                                  <tr class='danger'>
                                    <td colspan='3'>Sisa Bayar</td>
                                    <td><b>Rp <?php echo rupiah($total_tabungan['total']-$cairan['bonus_tabungan']); ?></b></td>
                                  </tr>
                              </tbody>
                            </table>
                          </div>
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='ro' aria-labelledby='ro-tab'>
                          <div class='col-md-12'>
                            <table class='table table-condensed table-bordered'>
                                <thead>
                                  <tr>
                                    <th style='width:40px'>No</th>
                                    <th>Upline</th>
                                    <th>Jumlah Bonus</th>
                                    <th>Waktu Masuk</th>
                                  </tr>
                                </thead>
                                <tbody>
                              <?php
                                $no = 1;
                                foreach ($rox->result_array() as $row){
                                $ex = explode(' ',$row['waktu_masuk']);
                                $tgl_bayar = tgl_indo($ex[0]);

                                echo "<tr><td>$no</td>
                                          <td>$row[bonus_downline]</td>
                                          <td>Rp ".rupiah($row['jumlah_bonus'])."</td>
                                          <td>$tgl_bayar ".$ex[1]."</td>
                                      </tr>";
                                  $no++;
                                }
                              ?>
                                  <tr class='info'>
                                    <td colspan='3'>Total Semua</td>
                                    <td><b>Rp <?php echo rupiah($total_ro['total']); ?></b></td>
                                  </tr>
                                  <tr class='success'>
                                    <td colspan='3'>Sudah Bayar</td>
                                    <td><b>Rp <?php echo rupiah($cairan['bonus_ro']); ?></b></td>
                                  </tr>
                                  <tr class='danger'>
                                    <td colspan='3'>Sisa Bayar</td>
                                    <td><b>Rp <?php echo rupiah($total_ro['total']-$cairan['bonus_ro']); ?></b></td>
                                  </tr>
                              </tbody>
                            </table>
                          </div>
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='tabungan' aria-labelledby='tabungan-tab'>
                          <div class='col-md-12'>
                            <table class='table table-condensed table-bordered'>
                                <thead>
                                  <tr>
                                    <th style='width:40px'>No</th>
                                    <th>Total Bayar</th>
                                    <th>Tanggal Bayar</th>
                                  </tr>
                                <?php 
                                  echo "<tr>
                                    <td></td>
                                    <td>Rp ".rupiah($dp['total_rp'])."</td>
                                    <td>".tgl_indo($dp['tanggal_daftar'])." 00:00:00 </td>
                                    <td>DP</td>
                                    <td></td>
                                  </tr>";
                                ?>
                                </thead>
                                <tbody>
                              <?php
                                $no = 1;
                                foreach ($tabungan->result_array() as $row){
                                $ex = explode(' ',$row['tanggal_bayar']);
                                $tgl_bayar = tgl_indo($ex[0]);

                                echo "<tr><td>$no</td>
                                          <td>Rp ".rupiah($row['total_bayar'])."</td>
                                          <td>$tgl_bayar ".$ex[1]."</td>
                                      </tr>";
                                  $no++;
                                }
                              ?>
                              <tr class='danger'>
                                <td></td>
                                <td colspan='6'><b>Rp <?php echo rupiah($total['total']+$dp['total_rp']); ?></b></td>
                              </tr>
                              </tbody>
                            </table>
                          </div>
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='keuangan' aria-labelledby='keuangan-tab'>
                          <div class='col-md-12'>
                          <?php
                            $reword = $this->model_members->posisiawal($this->uri->segment(3), 25, 25)->num_rows();
                            $reword1 = $this->model_members->posisi($this->uri->segment(3), 25, 25, 75, 75, 1)->num_rows();
                            $reword2 = $this->model_members->posisi($this->uri->segment(3), 75, 75, 225, 225, 1)->num_rows();
                            $reword3 = $this->model_members->posisi($this->uri->segment(3), 225, 225, 675, 675, 1)->num_rows();
                            $reword4 = $this->model_members->posisi($this->uri->segment(3), 675, 675, 2025, 2025, 1)->num_rows();
                            $reword5 = $this->model_members->posisi($this->uri->segment(3), 2025, 2025, 6075, 6075, 1)->num_rows();
                            $reword6 = $this->model_members->posisimax($this->uri->segment(3), 6075, 6075, 1)->num_rows();

                            $reword1a = $this->model_members->posisi($this->uri->segment(3), 25, 25, 75, 75, 2)->num_rows();
                            $reword2a = $this->model_members->posisi($this->uri->segment(3), 75, 75, 225, 225, 2)->num_rows();
                            $reword3a = $this->model_members->posisi($this->uri->segment(3), 225, 225, 675, 675, 2)->num_rows();
                            $reword4a = $this->model_members->posisi($this->uri->segment(3), 675, 675, 2025, 2025, 2)->num_rows();
                            $reword5a = $this->model_members->posisi($this->uri->segment(3), 2025, 2025, 6075, 6075, 2)->num_rows();
                            $reword6a = $this->model_members->posisimax($this->uri->segment(3), 6075, 6075, 2)->num_rows();

                            if($reword6 >= 3 AND $reword6a >= 3){
                                $reword = 'CROWN';
                                $paket1 = 'Kiri 3 DIREKTUR';
                                $paket2 = 'Kanan 3 DIREKTUR';
                            }elseif($reword5 >= 3  AND $reword5a >= 3){
                                $reword = 'CROWN';
                                $paket1 = 'Kiri 3 DIREKTUR';
                                $paket2 = 'Kanan 3 DIREKTUR';
                            }elseif($reword4 >= 3  AND $reword4a >= 3){
                                $reword = 'DIREKTUR';
                                $paket1 = 'Kiri 3 DIAMOND';
                                $paket2 = 'Kanan 3 DIAMOND';
                            }elseif($reword3 >= 3  AND $reword3a >= 3){
                                $reword = 'DIAMOND';
                                $paket1 = 'Kiri 3 MANAGER';
                                $paket2 = 'Kanan 3 MANAGER';
                            }elseif($reword2 >= 3  AND $reword2a >= 3){
                                $reword = 'MANAGER';
                                $paket1 = 'Kiri 3 EXECUTIVE';
                                $paket2 = 'Kanan 3 EXECUTIVE';
                            }elseif ($reword1 >= 3  AND $reword1a >= 3){
                                $reword = 'EXECUTIVE';
                                $paket1 = 'Kiri 3 SILVER';
                                $paket2 = 'Kanan 3 SILVER';
                            }elseif ($reword >= 1){
                                $reword = 'SILVER';
                                $paket1 = 'Kiri '.rupiah($sponsor['totfoot_left']) .' Paket';
                                $paket2 = 'Kanan '.rupiah($sponsor['totfoot_right']) .' Paket';
                            }else{
                                $reword = '<span style="color:red">Belum Ada</span>';
                                $paket1 = 'Kiri '.rupiah($sponsor['totfoot_left']) .' Paket';
                                $paket2 = 'Kanan '.rupiah($sponsor['totfoot_right']) .' Paket';
                            }

                  $set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
                  $kecil = min($sponsor['totfoot_left']-$cairan['bonus_pasangan'], $sponsor['totfoot_right']-$cairan['bonus_pasangan']);
                  $sisakiri = $sponsor['totfoot_left']-$cairan['bonus_pasangan'];
                  $sisakanan = $sponsor['totfoot_right']-$cairan['bonus_pasangan'];
                  $bonuspasangan = $kecil*$set['bonus_pasangan'];
                  $bonussponsor = $bonus['bonussponsor']-$cairan['bonus_sponsor'];
                  $bonustabungan = $bonustabungan['bonustabungan']-$cairan['bonus_tabungan'];
                  $bonusro = $ro['bonusro']-$cairan['bonus_ro'];

                  $totalbonus = $bonuspasangan+$bonussponsor+$bonustabungan+$bonusro;
                  $ppn = $set['ppn']/100*($totalbonus);
                  $bonus_pajak = $totalbonus - $ppn;
                  $autosave = $set['persen_auto_save']/100*($bonus_pajak);
                  $cekautosave = $as['auto_save'] + $autosave;
                        
                        if ($as['auto_save'] >= $set['max_auto_save']){
                          $sisa = 0;
                          $totalbonusbersih = $totalbonus - $ppn - $sisa;
                        }elseif ($cekautosave >= $set['max_auto_save']){
                          $sisa = $autosave-($autosave - ($set['max_auto_save'] - $as['auto_save']));
                          $totalbonusbersih = ($totalbonus - $ppn - $sisa + ($autosave - ($set['max_auto_save'] - $as['auto_save']))+$sisa);
                          $info = "Sisa Rp ".rupiah($autosave - ($set['max_auto_save'] - $as['auto_save']))." Karena Auto Save Sudah Mencapai Rp ".rupiah($set['max_auto_save']).", <br> Sisa Akan kami Masukkan lagi ke total bonus...";
                        }else{
                          $sisa = $autosave;
                          $totalbonusbersih = $totalbonus - $ppn - $sisa;
                        }

                  echo "<table class='table table-hover'>
                        <thead>
                          <tr><td width='200px'><b>Sisa Kiri</b></td> <td>".rupiah($sisakiri)." Paket</td></tr>
                          <tr><td><b>Sisa Kanan</b></td>              <td>".rupiah($sisakanan)." Paket</td></tr>
                          <tr class='warning'><td><b>Bonus Pasangan</b></td>            <td>Rp ".rupiah($bonuspasangan)." </td></tr>
                          <tr class='warning'><td><b>Bonus Sponsor</b></td>             <td>Rp ".rupiah($bonussponsor)."</td></tr>
                          <tr class='warning'><td><b>Bonus Tabungan</b></td>             <td>Rp ".rupiah($bonustabungan)."</td></tr>
                          <tr class='warning'><td><b>Bonus R.O</b></td>             <td>Rp ".rupiah($bonusro)."</td></tr>
                          <tr class='info'><td><b>Bonus Reword</b></td>              <td>$reword </td></tr>
                          <tr><td><b>Total Bonus</b></td>               <td style='color:red; font-weight:bold'>Rp ".rupiah($totalbonus)."</td></tr>
                          <tr><td><b>Pajak 10%</b></td>                 <td style='color:red; font-weight:bold'>Rp ".rupiah($ppn)."</td></tr>
                          <tr><td><b>Total Bonus - Pajak</b></td>       <td style='color:red; font-weight:bold'>Rp ".rupiah($bonus_pajak)."</td></tr>
                          <tr class='success'><td><b>Auto Save 20%</b> <br><small><i>Untuk Bonus Reward sampai mencapai Rp ".rupiah($set['max_auto_save'])."</i></small></td>  <td><b style='color:red; font-weight:bold'>Rp ".rupiah($sisa)."</b> <br><small><i>$info</i></small></td></tr>
                          <tr class='danger'><td><b>Total Bonus Bersih</b></td>       <td style='color:red; font-weight:bold'>Rp ".rupiah($totalbonusbersih)."</td></tr>
                        </thead>
                    </table>";
                          ?>
                          </div>
                      </div>


                      <div role='tabpanel' class='tab-pane fade' id='pencairan' aria-labelledby='pencairan-tab'>
                          <div class='col-md-12'>
                          <table class='table table-condensed table-bordered'>
                                <thead>
                                  <tr>
                                    <th style='width:40px'>No</th>
                                    <th>Pasangan</th>
                                    <th>Sponsor</th>
                                    <th>Tabungan</th>
                                    <th>Bonus RO</th>
                                    <th>Pajak 10%</th>
                                    <th>Auto Save</th>
                                    <th>Total Bayar</th>
                                    <th>Waktu Proses</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                              <?php
                                $no = 1;
                                foreach ($pencairan->result_array() as $row){
                                $as = $this->model_members->lastautosavesum($row['username'], $row['id_pembayaran_bonus'])->row_array();
                                $ppn = 10/100*($row['bonus_pasangan']+$row['bonus_sponsor']+$row['bonus_tabungan']+$row['bonus_ro']);
                                $bonus_pajak = ($row['bonus_pasangan']+$row['bonus_sponsor']+$row['bonus_tabungan']+$row['bonus_ro'])-$ppn;
                                $totalbonus = $row['bonus_pasangan']+$row['bonus_sponsor']+$row['bonus_tabungan']+$row['bonus_ro'];
                                $autosave = 20/100*$bonus_pajak;
                                
                                $cekautosave = $as['auto_save'] + $autosave;
                                if ($as['auto_save'] >= 1000000){
                                    $sisa = 0;
                                    $totalbonusbersih = $totalbonus - $ppn - $sisa;
                                }elseif ($cekautosave >= 1000000){
                                    $sisa = $autosave-($autosave - (1000000 - $as['auto_save']));
                                    $totalbonusbersih = $totalbonus - $ppn - $sisa + ($autosave - (1000000 - $as['auto_save']));
                                }else{
                                    $sisa = $autosave;
                                    $totalbonusbersih = $totalbonus - $ppn - $sisa;
                                }

                                echo "<tr><td>$no</td>
                                          <td>Rp ".rupiah($row['bonus_pasangan'])."</td>
                                          <td>Rp ".rupiah($row['bonus_sponsor'])."</td>
                                          <td>Rp ".rupiah($row['bonus_tabungan'])."</td>
                                          <td>Rp ".rupiah($row['bonus_ro'])."</td>
                                          <td>Rp ".rupiah($ppn)."</td>
                                          <td>Rp ".rupiah($sisa)."</td>
                                          <td style='font-weight:bold; color:red'>Rp ".rupiah($totalbonusbersih)."</td>
                                          <td>".tgl_indo($row['waktu_bayar'])."</td>
                                          <td></td>
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