            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                <h3 class="box-title">Kode Rahasia Konsumen Belum Terpakai</h3>
                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action='<?php echo base_url(); ?>administrator/koderahasia' method='POST'>
                    Jumlah Pin <select class='required' name='kode' style='padding:3px; border:1px solid #e3e3e3; padding:4px 5px 4px 8px' required> 
                      <?php 
                        for ($i = 1; $i <= 50; $i++){
                            echo "<option value='$i'>$i</option>";
                        }
                      ?>
                    </select>
                    <select class='required' name='paket' style='padding:3px; border:1px solid #e3e3e3; padding:4px 5px 4px 8px' required> 
                      <?php 
                        foreach ($paket->result_array() as $p){
                            echo "<option value='$p[id_paket]'>$p[nama_paket]</option>";
                        }
                      ?>
                    </select>
                    <input type="submit" name='submit' style='margin-top:-4px' class='btn btn-primary btn-sm' value='Tambahkan'>
                  </form>

                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Konsumen</th>
                        <th>Nama Paket</th>
                        <th>Status</th>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $cek = $this->db->query("SELECT * FROM rb_order_kode_kirim a JOIN rb_order_kode_konsumen b ON a.id_order_kode_konsumen=b.id_order_kode_konsumen where a.kode_aktivasi='$row[kode_konsumen]'");
                    $r = $cek ->row();
                    if ($cek->num_rows() >= 1){ $status = '<i style="color:green">Pesanan '.$r->status.'</i>'; }else{ $status = '-'; }
                    echo "<tr><td>$no</td>
                              <td>$row[kode_konsumen]</td>
                              <td>$row[nama_paket]</td>
                              <td>$status</td>
                              <td><center>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_konsumen/$row[id_konsumen]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>