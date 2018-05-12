            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $title; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
<?php                
                  $attributes = array('role'=>'form','id' => 'formku');
                  echo form_open_multipart('agen/tambah_orderkode',$attributes); 
                  $usr = $this->db->query("SELECT * FROM rb_agen where id_agen='".$this->session->id."'")->row_array();
                  echo "<table class='table table-hover'>
                        <thead>
                          <tr><td width='130px'><b>Nama Agen</b></td>     <td><input type='text' class='form-control' value='$usr[nama_agen]' disabled></td></tr>
                          <tr><td><b>Jumlah PIN</b></td>              <td><select class='required form-control' name='b'>
                                                                                      <option value=''>- Pilih -</option>";
                                                                                      for ($i = 1; $i <= 50; $i++){
                                                                                          echo "<option value='$i'>$i</option>";
                                                                                      }
                                                                                   echo "</select></td></tr>
                          <tr><td><b>Pilih Paket</b></td>              <td><select class='required form-control' name='a'>
                                                                                      <option value=''>- Pilih -</option>";
                                                                                      $row = $this->model_members->paket();
                                                                                      foreach ($row->result_array() as $r){
                                                                                        echo "<option value='$r[id_paket]'>$r[nama_paket] - Rp ".rupiah($r['total_rp'])."</option>";
                                                                                      }
                                                                                   echo "</select></td></tr>                                                        
                          <tr><td><b>Keterangan</b></td>                      <td><textarea class='form-control' style='height:100px' name='c' placeholder='Tuliskan Catatan / Pesan Tambahan Jika ada,...'></textarea></td></tr>                                                      
                          <tr><td></td>                                       <td><input class='btn btn-primary btn-sm' type='submit' value='Pesan Sekarang!' name='submit'></td></tr>   
                        </thead>
                    </table>";
                    echo form_close();
?>
</div>