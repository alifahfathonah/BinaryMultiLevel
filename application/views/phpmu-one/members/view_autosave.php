  <p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> History Auto Save</p>                
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Auto Save</th>
                        <th>Waktu</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    echo "<tr><td>$no</td>
                              <td>Rp ".rupiah($row['auto_save'])."</td>
                              <td>".tgl_indo($row['waktu_bayar'])."</td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>