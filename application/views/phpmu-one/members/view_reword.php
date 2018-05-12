  <p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Bonus Reword </p>  
                <?php 
                  $reword = $this->model_members->posisiawal($this->session->username, 25, 25)->num_rows();
                  $reword1 = $this->model_members->posisi($this->session->username, 25, 25, 75, 75, 1)->num_rows();
                  $reword2 = $this->model_members->posisi($this->session->username, 75, 75, 225, 225, 1)->num_rows();
                  $reword3 = $this->model_members->posisi($this->session->username, 225, 225, 675, 675, 1)->num_rows();
                  $reword4 = $this->model_members->posisi($this->session->username, 675, 675, 2025, 2025, 1)->num_rows();
                  $reword5 = $this->model_members->posisi($this->session->username, 2025, 2025, 6075, 6075, 1)->num_rows();
                  $reword6 = $this->model_members->posisimax($this->session->username, 6075, 6075, 1)->num_rows();

                  $reword1a = $this->model_members->posisi($this->session->username, 25, 25, 75, 75, 2)->num_rows();
                  $reword2a = $this->model_members->posisi($this->session->username, 75, 75, 225, 225, 2)->num_rows();
                  $reword3a = $this->model_members->posisi($this->session->username, 225, 225, 675, 675, 2)->num_rows();
                  $reword4a = $this->model_members->posisi($this->session->username, 675, 675, 2025, 2025, 2)->num_rows();
                  $reword5a = $this->model_members->posisi($this->session->username, 2025, 2025, 6075, 6075, 2)->num_rows();
                  $reword6a = $this->model_members->posisimax($this->session->username, 6075, 6075, 2)->num_rows();

                  if($reword6 >= 3 AND $reword6a >= 3){
                      $reword = 'CROWN';
                      $paket1 = '3 DIREKTUR';
                      $paket2 = '3 DIREKTUR';
                  }elseif($reword5 >= 3  AND $reword5a >= 3){
                      $reword = 'CROWN';
                      $paket1 = '3 DIREKTUR';
                      $paket2 = '3 DIREKTUR';
                  }elseif($reword4 >= 3  AND $reword4a >= 3){
                      $reword = 'DIREKTUR';
                      $paket1 = '3 DIAMOND';
                      $paket2 = '3 DIAMOND';
                  }elseif($reword3 >= 3  AND $reword3a >= 3){
                      $reword = 'DIAMOND';
                      $paket1 = '3 MANAGER';
                      $paket2 = '3 MANAGER';
                  }elseif($reword2 >= 3  AND $reword2a >= 3){
                      $reword = 'MANAGER';
                      $paket1 = '3 EXECUTIVE';
                      $paket2 = '3 EXECUTIVE';
                  }elseif ($reword1 >= 3  AND $reword1a >= 3){
                      $reword = 'EXECUTIVE';
                      $paket1 = '3 SILVER';
                      $paket2 = '3 SILVER';
                  }elseif ($reword >= 1){
                      $reword = 'SILVER';
                      $paket1 = rupiah($sponsor['totfoot_left']) .' Paket';
                      $paket2 = rupiah($sponsor['totfoot_right']) .' Paket';
                  }else{
                      $reword = '<span style="color:red">Belum Ada</span>';
                      $paket1 = rupiah($sponsor['totfoot_left']) .' Paket';
                      $paket2 = rupiah($sponsor['totfoot_right']) .' Paket';
                  }

                  if ($r['posisi'] == ''){ $position = '-'; }else{ $position = $r['posisi']; }
                  echo "<p>Posisi Anda Saat ini :</p>
                  <table class='table table-condensed'>
                        <thead>
                          <tr class='info'><td width='110px'><b>Kiri</b></td>           <td>$paket1</td></tr>
                          <tr class='info'><td><b>Kanan</b></td>                        <td>$paket2</td></tr>
                          <tr class='warning'><td><b>Posisi</b></td>                    <td><b style='color:red'>$reword</b></td></tr>
                        </thead>
                  </table>

                  <table class='table table-bordered table-condensed'>
                    <thead>
                      <tr class='active'>
                        <th style='width:40px'>No</th>
                        <th>Posisi</th>
                        <th>Kanan</th>
                        <th>Kiri</th>
                        <th>Reword</th>
                      </tr>
                    </thead>
                    <tbody>";

                    $no = 1;
                    foreach ($record->result_array() as $row){
                    echo "<tr><td>$no</td>
                              <td>$row[posisi]</td>
                              <td>$row[ket_kanan]</td>
                              <td>$row[ket_kiri]</td>
                              <td>$row[reword]</td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>