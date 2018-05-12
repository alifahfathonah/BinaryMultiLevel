            <a style='color:#000' href='<?php echo base_url(); ?>administrator/konsumen'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Konsumen</span>
                  <?php $jmla = $this->db->query("SELECT * FROM rb_konsumen")->num_rows(); ?>
                  <span class="info-box-number"><?php echo $jmla; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='<?php echo base_url(); ?>administrator/agen'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Agen</span>
                  <?php $jmlb = $this->db->query("SELECT * FROM rb_agen")->num_rows(); ?>
                  <span class="info-box-number"><?php echo $jmlb; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='<?php echo base_url(); ?>administrator/distributor'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-tower"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Distributor</span>
                  <?php $jmlc = $this->db->query("SELECT * FROM rb_distributor")->num_rows(); ?>
                  <span class="info-box-number"><?php echo $jmlc; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='<?php echo base_url(); ?>administrator/manajemenuser'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Perwakilan</span>
                  <?php $jmld = $this->db->query("SELECT * FROM rb_perwakilan")->num_rows(); ?>
                  <span class="info-box-number"><?php echo $jmld; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <section class="col-lg-7 connectedSortable">
                <?php include "home_grafik.php"; ?>
            </section><!-- /.Left col -->

            <section class="col-lg-5 connectedSortable">
                <?php include "home_berita.php"; ?>

            </section><!-- right col -->
            