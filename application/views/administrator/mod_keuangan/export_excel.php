
<html>
<head>
<title>Export Excel</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/printer.css">
</head>
<body onload="window.print()">
<center><table border=0>
  <tr><td colspan='13'><center><h1>PT. MLM Binary System<br><span style='font-size:12px'>Jl. Angkasa Puri, Perundam</span></h1></center></td></tr>
  <tr><td colspan='13'><center>DATA KEUANGAN KONSUMEN</center></td></tr>
  <tr><td colspan='13'><center><?php echo "Sampai saat ini (".tgl_indo(date('Y-m-d'))." ".date('H:i:s').")"; ?></center></td></tr>
</table></center><br>
                  <table width='100%' border='1'>
                      <tr>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Nama Bank</th>
                        <th>No Rekening</th>
                        <th>No Rek Virtual</th>
                        <th>Atas Nama</th>
                        <th>Bonus Pasangan</th>
                        <th>Bonus Sponsor</th>
                        <th>Bonus Tabungan</th>
                        <th>Bonus RO</th>
                        <th>Pajak 10%</th>
                        <th>Auto Save</th>
                        <th>Tagihan</th>
                      </tr>
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
                        $autosave = $set['max_auto_save']/100*($bonus_pajak);

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

                    if ($totalbonusbersih > 1){
                    echo "<tr><td>$row[username]</td>
                              <td>$row[nama_lengkap]</td>
                              <td>$row[nama_bank]</td>
                              <td>$row[no_rekening]</td>
                              <td>$row[rekning_virtual]</td>
                              <td>$row[atas_nama]</td>
                              <td>Rp ".rupiah($bonuspasangan)."</td>
                              <td>Rp ".rupiah($bonussponsor)."</td>
                              <td>Rp ".rupiah($bonustabungan)."</td>
                              <td>Rp ".rupiah($bonusro)."</td>
                              <td>Rp ".rupiah($ppn)."</td>
                              <td>Rp ".rupiah($sisa)."</td>
                              <td style='font-weight:bold; color:red'>Rp ".rupiah($totalbonusbersih)."</td>
                          </tr>";
                    }
                      $no++;
                    }
                  ?>
                </table>
</body>
</html>