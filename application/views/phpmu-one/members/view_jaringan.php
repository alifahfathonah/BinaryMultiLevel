<?php
echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Jaringan Anda 
          <a class='btn btn-xs btn-danger pull-right' href='' onclick=\"window.history.back();\">Kembali</a></p>";

$idmember = $this->session->username;
if($this->uri->segment(3) != ''){
  $useridd = $this->uri->segment(3);
}else{
  $useridd = $this->session->username;
}
    //menampilkan level1 downline:
    if($this->uri->segment(3) != ''){
      $row = $this->model_members->paketkonsumen($useridd)->row_array();
    }else{
      $row = $this->model_members->paketkonsumen($idmember)->row_array();
    }

    $d1 = $row['foot1']; 
    $d2 = $row['foot2'];
    $photo_member1 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>";
    $totfoottopal=$this->model_members->totalkonsumen($idmember)->row_array();
    $totfoottopbr=$this->model_members->totalkonsumen($useridd)->row_array();

    if($idmember==$useridd){
      $member_id = "<a class='link' href='#'>
                    <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_member1</a><br>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href=''>".rupiah($totfoottopbr['totfoot_left'])."</a> 
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href=''>".rupiah($totfoottopbr['totfoot_right'])."</a><br>

                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($totfoottopbr['totfoot_left_day'])."</a>
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($totfoottopbr['totfoot_right_day'])."</a><br>

                    <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href=''>$idmember</a>";
    }elseif($row['upline']!=''){
      $member_id = "<a class='link' href='".base_url()."members/jaringan/$row[upline]'>
                    <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_member1</a><br>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href='#'>".rupiah($totfoottopbr['totfoot_left'])."</a>
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href='#'>".rupiah($totfoottopbr['totfoot_right'])."</a><br>

                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($totfoottopbr['totfoot_left_day'])."</a>
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($totfoottopbr['totfoot_right_day'])."</a><br>

                    <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href='#'>$useridd</a>";
    }else{
      $member_id = "<a class='link' href='#'>
                    <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_member1</a><br>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href=''>".rupiah($totfoottopal['totfoot_left'])."</a>
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href=''>".rupiah($totfoottopal['totfoot_right'])."</a><br>

                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($totfoottopal['totfoot_left_day'])."</a>
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($totfoottopal['totfoot_right_day'])."</a><br>

                    <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href=''>$idmember</a>";
    }

    $row=$this->model_members->paketkonsumen($d1)->row_array();
    $photo_d1 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>";
      if($d1!=''){
        $down1 = "<a class='link' href='".base_url()."members/jaringan/$d1'>
                  <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_d1</a><br>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href='#'>".rupiah($row['totfoot_left'])."</a>
                  <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href='#'>".rupiah($row['totfoot_right'])."</a><br>

                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($row['totfoot_left_day'])."</a>
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($row['totfoot_right_day'])."</a><br>

                  <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href='#'>$d1</a>";
      }else{
        $down1 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$useridd/0'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan/$useridd/0'>Tambahkan</a>";
      }

    $row=$this->model_members->paketkonsumen($d2)->row_array();
    $photo_d2 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>";
      if($d2!=''){
        $down2 = "<a class='link' href='".base_url()."members/jaringan/$d2'>
                  <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_d2</a><br>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href='#'>".rupiah($row['totfoot_left'])."</a>
                  <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href='#'>".rupiah($row['totfoot_right'])."</a><br>

                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($row['totfoot_left_day'])."</a>
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($row['totfoot_right_day'])."</a><br>

                  <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href='#'>$d2</a>";
      }else{
        $down2 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$useridd/1'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan/$useridd/1'>Tambahkan</a>";
      }

    $row=$this->model_members->totalkonsumen($d1)->row_array();
    $d3 = $row['foot1']; 
    $d4 = $row['foot2'];
    $row=$this->model_members->paketkonsumen($d3)->row_array();
    $photo_d3 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>";
    if($d3!=''){
       $down3 = "<a class='link' href='".base_url()."members/jaringan/$d3'>
                 <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_d3</a><br>
                 <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href='#'>".rupiah($row['totfoot_left'])."</a>
                 <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href='#'>".rupiah($row['totfoot_right'])."</a><br>

                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($row['totfoot_left_day'])."</a>
                  <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($row['totfoot_right_day'])."</a><br>

                 <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href='#'>$d3</a>";
    }else{
       if(!empty($d1)){
          $down3 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d1/0'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan/$d1/0'>Tambahkan</a>";
        }else{
          $down3 = "<a class='link0' href='#'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
    }

    $row=$this->model_members->paketkonsumen($d4)->row_array();
    $photo_d4 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>";
      if($d4!=''){
        $down4 = "<a class='link' href='".base_url()."members/jaringan/$d4'>
                  <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_d4</a><br>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href='#'>".rupiah($row['totfoot_left'])."</a>
                  <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href='#'>".rupiah($row['totfoot_right'])."</a><br>

                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($row['totfoot_left_day'])."</a>
                  <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($row['totfoot_right_day'])."</a><br>

                  <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href='#'>$d4</a>";
      }else{
        if(!empty($d1)){
          $down4 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d1/1'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan/$d1/1'>Tambahkan</a>";
        }else{
          $down4 = "<a class='link0' href='#'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
      }

    $row=$this->model_members->totalkonsumen($d2)->row_array();
    $d5=$row['foot1']; 
    $d6=$row['foot2'];
    $row=$this->model_members->paketkonsumen($d5)->row_array();
    $photo_d5 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>";
    if($d5!=''){
       $down5 = "<a class='link' href='".base_url()."members/jaringan/$d5'>
                 <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_d5</a><br>
                 <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href='#'>".rupiah($row['totfoot_left'])."</a>
                 <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href='#'>".rupiah($row['totfoot_right'])."</a><br>

                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($row['totfoot_left_day'])."</a>
                  <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($row['totfoot_right_day'])."</a><br>

                 <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href='#'>$d5</a>";
    }else{
       if(!empty($d2)){
          $down5 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d2/0'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan/$d2/0'>Tambahkan</a>";
        }else{
          $down5 = "<a class='link0' href='#'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
    }

    $row=$this->model_members->paketkonsumen($d6)->row_array();
    $photo_d6 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>";
    if($d6!=''){
       $down6 = "<a class='link' href='".base_url()."members/jaringan/$d6'>
                 <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_d6</a><br>
                 <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href='#'>".rupiah($row['totfoot_left'])."</a>
                 <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href='#'>".rupiah($row['totfoot_right'])."</a><br>

                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($row['totfoot_left_day'])."</a>
                  <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($row['totfoot_right_day'])."</a><br>

                 <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href='#'>$d6</a>";
    }else{
       if(!empty($d2)){
          $down6 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d2/1'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan/$d2/1'>Tambahkan</a>";
        }else{
          $down6 = "<a class='link0' href='#'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
    }

    $row=$this->model_members->totalkonsumen($d3)->row_array();
    $d7=$row['foot1']; 
    $d8=$row['foot2'];
    $row=$this->model_members->paketkonsumen($d7)->row_array();
    $photo_d7 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>";
      if($d7!=''){
         $down7 = "<a class='link' href='".base_url()."members/jaringan/$d7'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_d7</a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href='#'>".rupiah($row['totfoot_left'])."</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href='#'>".rupiah($row['totfoot_right'])."</a><br>

                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($row['totfoot_left_day'])."</a>
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($row['totfoot_right_day'])."</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href='#'>$d7</a>";
      }else{
        if(!empty($d3)){
          $down7 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d3/0'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan/$d3/0'>Tambahkan</a>";
        }else{
          $down7 = "<a class='link0' href='#'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
      }

    $row=$this->model_members->paketkonsumen($d8)->row_array();
    $photo_d8 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>";
      if($d8!=''){
          $down8 = "<a class='link' href='".base_url()."members/jaringan/$d8'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_d8</a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href='#'>".rupiah($row['totfoot_left'])."</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href='#'>".rupiah($row['totfoot_right'])."</a><br>

                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($row['totfoot_left_day'])."</a>
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($row['totfoot_right_day'])."</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href='#'>$d8</a>";
       }else{
         if(!empty($d3)){
          $down8 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d3/1'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan/$d3/1'>Tambahkan</a>";
        }else{
          $down8 = "<a class='link0' href='#'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
       }

    $row=$this->model_members->totalkonsumen($d4)->row_array();
    $d9=$row['foot1']; 
    $d10=$row['foot2'];
    $row=$this->model_members->paketkonsumen($d9)->row_array();
    $photo_d9 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>";
    if($d9!=''){
       $down9 = "<a class='link' href='".base_url()."members/jaringan/$d9'>
                 <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_d9</a><br>
                 <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href='#'>".rupiah($row['totfoot_left'])."</a>
                 <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href='#'>".rupiah($row['totfoot_right'])."</a><br>

                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($row['totfoot_left_day'])."</a>
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($row['totfoot_right_day'])."</a><br>

                 <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href='#'>$d9</a>";
    }else{
      if(!empty($d4)){
          $down9 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d4/0'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan/$d4/0'>Tambahkan</a>";
        }else{
          $down9 = "<a class='link0' href='#'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
    }

    $row=$this->model_members->paketkonsumen($d10)->row_array();
    $photo_d10 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>";

    if($d10!=''){
       $down10 = "<a class='link' href='".base_url()."members/jaringan/$d10'>
                 <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_d10</a><br>
                 <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href='#'>".rupiah($row['totfoot_left'])."</a>
                 <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href='#'>".rupiah($row['totfoot_right'])."</a><br>

                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($row['totfoot_left_day'])."</a>
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($row['totfoot_right_day'])."</a><br>

                 <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href='#'>$d10</a>";
    }else{
       if(!empty($d4)){
          $down10 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d4/1'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan/$d4/1'>Tambahkan</a>";
        }else{
          $down10 = "<a class='link0' href='#'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
    }

    $row=$this->model_members->totalkonsumen($d5)->row_array();
    $d11=$row['foot1']; 
    $d12=$row['foot2'];
    $row=$this->model_members->paketkonsumen($d11)->row_array();
    $photo_d11 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>";

      if($d11!=''){
         $down11 = "<a class='link' href='".base_url()."members/jaringan/$d11'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_d11</a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href='#'>".rupiah($row['totfoot_left'])."</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href='#'>".rupiah($row['totfoot_right'])."</a><br>

                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($row['totfoot_left_day'])."</a>
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($row['totfoot_right_day'])."</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href='#'>$d11</a>";
      }else{
         if(!empty($d5)){
          $down11 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d5/0'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan/$d5/0'>Tambahkan</a>";
        }else{
          $down11 = "<a class='link0' href='#'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
      }

    $row=$this->model_members->paketkonsumen($d12)->row_array();
    $photo_d12 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>";
      if($d12!=''){
         $down12 = "<a class='link' href='".base_url()."members/jaringan/$d12'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_d12</a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href='#'>".rupiah($row['totfoot_left'])."</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href='#'>".rupiah($row['totfoot_right'])."</a><br>

                  <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($row['totfoot_left_day'])."</a>
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($row['totfoot_right_day'])."</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href='#'>$d12</a>";
      }else{
        if(!empty($d5)){
          $down12 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d5/1'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan/$d5/1'>Tambahkan</a>";
        }else{
          $down12 = "<a class='link0' href='#'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
      }

    $row=$this->model_members->paketkonsumen($d6)->row_array();
    $d13=$row['foot1']; 
    $d14=$row['foot2'];
    $row=$this->model_members->paketkonsumen($d13)->row_array();
    $photo_d13 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>";
    if($d13!=''){
      $down13 = "<a class='link' href='".base_url()."members/jaringan/$d13'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_d13</a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href='#'>".rupiah($row['totfoot_left'])."</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href='#'>".rupiah($row['totfoot_right'])."</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($row['totfoot_left_day'])."</a>
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($row['totfoot_right_day'])."</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href='#'>$d13</a>";
    }else{
        if(!empty($d6)){
          $down13 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d6/0'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan/$d6/0'>Tambahkan</a>";
        }else{
          $down13 = "<a class='link0' href='#'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
    }

    $row=$this->model_members->paketkonsumen($d14)->row_array();
    $photo_d14 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>";
      if($d14!=''){
         $down14 = "<a class='link' href='".base_url()."members/jaringan/$d14'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>$row[nama_paket]</p> $photo_d14</a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-info' href='#'>".rupiah($row['totfoot_left'])."</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-success' href='#'>".rupiah($row['totfoot_right'])."</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-warning' href=''>".rupiah($row['totfoot_left_day'])."</a>
                    <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                    <a style='width:36px; border-radius:0px' class='btn btn-xs btn-primary' href=''>".rupiah($row['totfoot_right_day'])."</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-danger' href='#'>$d14</a>";
      }else{
        if(!empty($d6)){
          $down14 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d6/1'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan/$d6/1'>Tambahkan</a>";
        }else{
          $down14 = "<a class='link0' href='#'>
                   <p style='font-size:10px; font-weight:bold; margin-bottom:5px;'>?</p> <img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>All</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a>
                   <span style='width:32px; border-radius:0px' class='btn btn-xs' href=''>Day</span>
                   <a style='width:36px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>0</a><br>

                   <a style='width:112px; border-radius:0px' class='btn btn-xs btn-default' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
      }

                                  echo "<div style='overflow-x:scroll; width:100%' align='center'>
                                          <div style='width:1000px' class='tree'>
                                            <ul>
                                              <li>$member_id
                                                  <ul>
                                                    <li>$down1
                                                          <ul>
                                                            <li>$down3
                                                                  <ul>
                                                                    <li>$down7</li>
                                                                    <li>$down8</li>
                                                                  </ul>
                                                            </li>
                                                            <li>$down4
                                                                  <ul>
                                                                    <li>$down9</li>
                                                                    <li>$down10</li>
                                                                  </ul>
                                                            </li>
                                                          </ul>
                                                    </li>
                                                    <li>$down2
                                                          <ul>
                                                            <li>$down5
                                                                  <ul>
                                                                    <li>$down11</li>
                                                                    <li>$down12</li>
                                                                  </ul>
                                                            </li>
                                                            <li>$down6
                                                                  <ul>
                                                                    <li>$down13</li>
                                                                    <li>$down14</li>
                                                                  </ul>
                                                            </li>
                                                          </ul>
                                                    </li>
                                                  </ul>
                                              </li>
                                            </ul>
                                          </div>
                                        </div>
                                <div style='clear:both'></div><br>";

                      
