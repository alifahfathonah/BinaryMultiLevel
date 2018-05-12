              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-pencil"></i>
                  <h3 class="box-title">Informasi Terbaru</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>

                <div class="box-body">
                    <?php 
                        foreach ($berita->result_array() as $row) {
                        $isi_berita = strip_tags($row['isi_berita']); 
                        $isi = substr($isi_berita,0,190); 
                        $isi = substr($isi_berita,0,strrpos($isi," "));
                            echo "<div style='padding:4px 10px' class='alert alert-info'>$row[judul]</div>
                                  <p style='margin-top:-15px'>".$isi."... <a target='_BLANK' href='".base_url()."berita/detail/$row[judul_seo]'>[ Baca Selanjutnya ]</a></p>";
                        }
                    ?>
                </div>
              </div>
