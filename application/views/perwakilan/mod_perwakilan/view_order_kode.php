            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $title; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
<?php
        echo "<div class='pull-right'>
                <a class='btn btn-xs btn-primary' href='".base_url()."perwakilan/tambah_orderkode'>Order Kode Aktivasi</a>
                <a class='btn btn-xs btn-warning' href='#' data-toggle='modal' data-target='#rekening'>Order No Rekening Perusahaan</a>
              </div>";
        echo "<table id='example2' class='table table-bordered table-striped'>
            <thead>
              <tr>
                <th width='20px'>No</th>
                <th>Nama Paket</th>
                <th>Jumlah</th>
                <th>Total Tagihan</th>
                <th>Tgl Order</th>
                <th></th>
                <th width='100px'></th>
              </tr>
            </thead><tbody>";
              $no = 1;
              foreach ($record->result_array() as $row){
              $cekkirim = $this->db->query("SELECT * FROM rb_order_kode_kirim where id_order_kode_konsumen='$row[id_order_kode_konsumen]'")->num_rows();
              if ($cekkirim >= 1){ $status = "<span class='glyphicon glyphicon-ok'></span> Success"; }else{ $status = "<span class='glyphicon glyphicon-hourglass'></span> Pending"; }
              $ex = explode(' ',$row['waktu_order']);
              echo "<tr>
                    <td>$no</td>
                    <td>$row[nama_paket]</td>
                    <td>$row[jumlah]</td>
                    <td>Rp ".rupiah($row['total_rp']*$row['jumlah'])."</td>
                    <td>".tgl_indo($ex[0]).", ".$ex[1]." WIB</td>
                    <td>$status</td>
                    <td><a style='padding-left; 6px; padding-right:6px' class='btn btn-xs btn-success' href='".base_url()."perwakilan/detail_orderkode/$row[id_order_kode_konsumen]'><span class='glyphicon glyphicon-shopping-cart'></span> Lihat Pesanan</a></td>
                  </tr>";
                $no++;
              }
            echo "</tbody></table>
            </div>";
      ?>