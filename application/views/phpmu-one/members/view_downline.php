<?php
        $belanja = $this->model_members->belanjatotal($this->session->id_konsumen)->row_array();       
        echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Data Downline Anda  <span class='pull-right'>Belanja Pribadi anda Rp. ".rupiah($belanja['total'])."</span></p>";
        echo "<table class='table table-hover table-condensed'>
              <tr bgcolor=#e3e3e3>
                <th>No</th>
                <th width='120px'>Generasi</th>
                <th>Username</th>
                <th>Tgl Daftar</th>
                <th>Sponsor</th>
                <th>Total Belanja</th>
                <th></th>
              </tr>";
              $no = $this->uri->segment(4) + 1;
              foreach ($record->result_array() as $row){
              $bel = $this->model_members->belanjatotal($row['id_konsumen'])->row_array();  
              echo "<tr>
                    <td>$no</td>
                    <td> Generasi $row[level]</td>
                    <td> $row[username]</td>
                    <td> ".tgl_indo($row['tanggal_daftar'])."</td>
                    <td><a href='".base_url()."members/downline/$row[sponsor_asli]'>$row[sponsor_asli]</a></td>
                    <td>Rp ".rupiah($bel['total'])."</td>
                    <td><a style='padding-left; 6px; padding-right:6px' class='btn btn-xs btn-success' href='".base_url()."members/downline/$row[sponsor_asli]'><span class='glyphicon glyphicon-menu-down'></span></a></td>
                  </tr>";
                $no++;
              }
            echo "</table>";
            echo $this->pagination->create_links();
      ?>