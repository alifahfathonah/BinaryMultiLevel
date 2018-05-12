                    <?php 
                            $reword = $this->model_members->posisiawal($idk, 25, 25)->num_rows();
                            $reword1 = $this->model_members->posisi($idk, 25, 25, 75, 75, 1)->num_rows();
                            $reword2 = $this->model_members->posisi($idk, 75, 75, 225, 225, 1)->num_rows();
                            $reword3 = $this->model_members->posisi($idk, 225, 225, 675, 675, 1)->num_rows();
                            $reword4 = $this->model_members->posisi($idk, 675, 675, 2025, 2025, 1)->num_rows();
                            $reword5 = $this->model_members->posisi($idk, 2025, 2025, 6075, 6075, 1)->num_rows();
                            $reword6 = $this->model_members->posisimax($idk, 6075, 6075, 1)->num_rows();
                            $reword1a = $this->model_members->posisi($idk, 25, 25, 75, 75, 2)->num_rows();
                            $reword2a = $this->model_members->posisi($idk, 75, 75, 225, 225, 2)->num_rows();
                            $reword3a = $this->model_members->posisi($idk, 225, 225, 675, 675, 2)->num_rows();
                            $reword4a = $this->model_members->posisi($idk, 675, 675, 2025, 2025, 2)->num_rows();
                            $reword5a = $this->model_members->posisi($idk, 2025, 2025, 6075, 6075, 2)->num_rows();
                            $reword6a = $this->model_members->posisimax($idk, 6075, 6075, 2)->num_rows();

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

 
  echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Data Keuangan Anda</p>
        <p>Berikut Informasi Data Keuangan Anda sampai saat ini.<br> 
           Pastikan data No Rekening anda benar, agar tidak terjadi kesalahan saat transfer nanti.</p>";                          
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
                          $info = "Total Auto Save anda sampai saat ini Rp ".rupiah($as['auto_save']).", <br> Tidak ada Pemotongan lagi karena sudah Mencapai 1 Juta...";
                        }elseif ($cekautosave >= $set['max_auto_save']){
                          $sisa = $autosave-($autosave - ($set['max_auto_save'] - $as['auto_save']));
                          $totalbonusbersih = ($totalbonus - $ppn - $sisa + ($autosave - ($set['max_auto_save'] - $as['auto_save']))+$sisa);
                          $info = "Sisa Rp ".rupiah($autosave - ($set['max_auto_save'] - $as['auto_save']))." Karena Auto Save Sudah Mencapai Rp ".rupiah($set['max_auto_save']).", Sisa Akan kami Masukkan lagi ke total bonus...";
                        }else{
                          $sisa = $autosave;
                          $totalbonusbersih = $totalbonus - $ppn - $sisa;
                          $info = "Total Auto Save anda sampai saat ini Rp ".rupiah($as['auto_save']).", <br> Tidak Akan di Potong lagi jika sudah Mencapai Rp ".rupiah($set['max_auto_save'])."...";
                        }

                  echo "<table class='table table-hover'>
                        <thead>
                          <tr><td width='200px'><b>Sisa Kiri</b></td> <td>".rupiah($sisakiri)." Paket</td></tr>
                          <tr><td><b>Sisa Kanan</b></td>              <td>".rupiah($sisakanan)." Paket</td></tr>
                          <tr class='warning'><td><b>Bonus Pasangan</b></td>            <td>Rp ".rupiah($bonuspasangan)." </td></tr>
                          <tr class='warning'><td><b>Bonus Sponsor</b></td>             <td>Rp ".rupiah($bonussponsor)." <a class='btn btn-warning btn-xs pull-right' href='".base_url()."members/sponsorisasi'>Lihat Detail</a></td></tr>
                          <tr class='warning'><td><b>Bonus Tabungan</b></td>             <td>Rp ".rupiah($bonustabungan)."</td></tr>
                          <tr class='warning'><td><b>Bonus R.O</b></td>             <td>Rp ".rupiah($bonusro)."</td></tr>

                          <tr class='info'><td><b>Bonus Reword</b></td>              <td>$reword <a class='btn btn-info btn-xs pull-right' href='".base_url()."members/reword'>Lihat Detail</a></td></tr>
                          <tr><td><b>Total Bonus</b></td>               <td style='color:red; font-weight:bold'>Rp ".rupiah($totalbonus)."</td></tr>
                          <tr><td><b>Pajak 10%</b></td>                 <td style='color:red; font-weight:bold'>Rp ".rupiah($ppn)."</td></tr>
                          <tr><td><b>Total Bonus - Pajak</b></td>       <td style='color:red; font-weight:bold'>Rp ".rupiah($bonus_pajak)."</td></tr>
                          <tr class='success'><td><b>Auto Save 20%</b> <br><small><i>Untuk Bonus Reward sampai mencapai Rp ".rupiah($set['max_auto_save'])."</i></small></td>  
                                              <td><b style='color:red; font-weight:bold'>Rp ".rupiah($sisa)."</b> <br>
                                                     <a class='btn btn-success btn-xs pull-right' href='".base_url()."members/autosave'>Lihat Detail</a>
                                                     <small><i>$info</i></small> 
                                              </td>
                          </tr>
                          <tr class='danger'><td><b>Total Bonus Bersih</b></td>       <td style='color:red; font-weight:bold'>Rp ".rupiah($totalbonusbersih)."</td></tr>
                        </thead>
                    </table>
                    <hr>
                    <p class='sidebar-title'> Keterangan : </p>
                    <table>
                      <tr><td>$ket[keterangan]</td></tr>
                    </table>";

?>

