            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Semua Data Agen</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_agen'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Agen</th>
                        <th>Alamat Email</th>
                        <th>No Telp / Hp</th>
                        <th>Alamat Lengkap</th>
                        <th>Status</th>
                        <th style='width:75px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    if ($row['aktif']=='Y'){ $aktif = '<i style="color:green">Aktif</i>'; }else{ $aktif = '<i style="color:red">Non Aktif</i>'; }
                    echo "<tr><td>$no</td>
                              <td>$row[nama_agen]</td>
                              <td>$row[email]</td>
                              <td>$row[telp_hp]</td>
                              <td>$row[alamat_lengkap]</td>
                              <td>$aktif</td>
                              <td><center>
                                <a class='btn btn-primary btn-xs' title='Detail Data' href='".base_url()."administrator/detail_agen/$row[id_agen]'><span class='glyphicon glyphicon-search'></span></a>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."administrator/edit_agen/$row[id_agen]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_agen/$row[id_agen]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>