<?php 
$set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
$sponsor = $this->model_members->keuangan($this->uri->segment(3))->row_array();
$bonus = $this->model_members->bonussponsor($this->uri->segment(3))->row_array();
$tabungan = $this->model_members->bonustabungan($this->uri->segment(3))->row_array();
$ro = $this->model_members->bonusro($this->uri->segment(3))->row_array();
$cairan = $this->model_members->totpencairan($this->uri->segment(3),$set['bonus_pasangan'])->row_array();
$as = $this->model_members->autosavesum($this->uri->segment(3),$set['persen_auto_save'],$set['ppn'])->row_array();
if ($as['auto_save']==''){ $autosaveas = '0'; }else{ $autosaveas = $as['auto_save']; }
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
        $totalbonusbersih = $totalbonus - $ppn - $sisa + ($autosave - ($set['max_auto_save'] - $as['auto_save']));
    }else{
        $sisa = $autosave;
        $totalbonusbersih = $totalbonus - $ppn - $sisa;
    }
?>
<script type="text/javascript">
    $(document).ready(function(){
        function addCommas(nStr){
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
    $(".input").keyup(function(){
          var val1 = +$(".value1").val();
          var val2 = +$(".value2").val();
          var val3 = +$(".value3").val();
          var val4 = +$(".value4").val();
                $("#result").val(addCommas(<?php echo $set['ppn']; ?>/100*(val1+val2+val3+val4)));
          if (<?php echo $autosaveas; ?> >= <?php echo $set['max_auto_save']; ?>){
                $("#result2").val(addCommas(0));
                $("#result3").val(addCommas((val1+val2+val3+val4) - (<?php echo $set['ppn']; ?>/100*(val1+val2+val3+val4)) - (<?php echo $set['persen_auto_save']; ?>/100*((val1+val2+val3+val4)-(<?php echo $set['ppn']; ?>/100*(val1+val2+val3+val4))))));
          }else if (((<?php echo $set['persen_auto_save']; ?>/100*(val1+val2+val3+val4-(<?php echo $set['ppn']; ?>/100*(val1+val2+val3+val4))))+<?php echo $autosaveas; ?>) >= <?php echo $set['max_auto_save']; ?>){
                $("#result2").val(addCommas( <?php echo $set['persen_auto_save']; ?>/100*((val1+val2+val3+val4)-(<?php echo $set['ppn']; ?>/100*(val1+val2+val3+val4))) - (<?php echo $set['persen_auto_save']; ?>/100*((val1+val2+val3+val4)-(<?php echo $set['ppn']; ?>/100*(val1+val2+val3+val4))) - (<?php echo $set['max_auto_save']; ?> - <?php echo $autosaveas; ?>)) ));
                $("#result3").val(addCommas((val1+val2+val3+val4) - (<?php echo $set['ppn']; ?>/100*(val1+val2+val3+val4)) - (<?php echo $set['persen_auto_save']; ?>/100*((val1+val2+val3+val4)-(<?php echo $set['ppn']; ?>/100*(val1+val2+val3+val4))) - (<?php echo $set['persen_auto_save']; ?>/100*((val1+val2+val3+val4)-(<?php echo $set['ppn']; ?>/100*(val1+val2+val3+val4))) - (<?php echo $set['max_auto_save']; ?> - <?php echo $autosaveas; ?>))) ));
          }else{
                $("#result2").val(addCommas(<?php echo $set['persen_auto_save']; ?>/100*((val1+val2+val3+val4)-(<?php echo $set['ppn']; ?>/100*(val1+val2+val3+val4)))));
                $("#result3").val(addCommas((val1+val2+val3+val4) - (<?php echo $set['ppn']; ?>/100*(val1+val2+val3+val4)) - (<?php echo $set['persen_auto_save']; ?>/100*((val1+val2+val3+val4)-(<?php echo $set['ppn']; ?>/100*(val1+val2+val3+val4))))));
          }
   });
});
</script>
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Form Pembayaran Manual Bonus Konsumen</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
        <?php
            echo "<div class='col-md-12'>";
                $attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
                echo form_open_multipart('administrator/keuanganbayarmanual',$attributes); 
            echo "<table class='table table-condensed table-bordered'>
                      <tbody>
                        <input type='hidden' name='id' value=''>
                        <tr><th width='120px' scope='row'>Username</th>    <td><input type='text' value='".$this->uri->segment(3)."' class='required number form-control' name='a' readonly='on'></td></tr>
                        <tr><th>Bonus Pasangan </th>    <td><input type='number' class='required number form-control input value1' name='b' value='$bonuspasangan'></td></tr>
                        <tr><th>Bonus Sponsor</th>    <td><input type='number' class='required number form-control input value2' name='c' value='$bonussponsor'></td></tr>
                        <tr><th>Bonus Tabungan</th>    <td><input type='number' class='required number form-control input value3' name='d' value='$bonustabungan'></td></tr>
                        <tr><th>Bonus R.O</th>    <td><input type='number' class='required number form-control input value4' name='e' value='$bonusro'></td></tr>
                        <tr><th>Pajak 10%</th>    <td><input type='text' class='required number form-control' name='f' id='result' value='".rupiah($ppn)."' disabled></td></tr>
                        <tr><th>Auto Save</th>    <td><input type='text' class='required number form-control' name='g' id='result2' value='".rupiah($sisa)."' disabled></td></tr>
                        <tr><th>Total Tagihan</th>    <td><input type='text' class='required number form-control' name='h' id='result3' value='".rupiah($totalbonusbersih)."' disabled></td></tr>
                      </tbody>
                  </table>

                <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-success'>Proses Pembayaran</button>
                    <a href='".base_url()."administrator/rekapkeuangan'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                </div>
                </div>";

            ?>
        </div>
