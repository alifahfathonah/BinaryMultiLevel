<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Setting Bonus</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/settingbonus',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$record[id_setting]'>
                    <tr><th width='150px' scope='row'>Bonus Pasangan</th>   <td><input type='number' class='form-control' name='a' value='$record[bonus_pasangan]'></td></tr>
                    <tr><th scope='row'>Bonus Tabungan</th>                        <td><input type='number' class='form-control' name='b' value='$record[bonus_tabungan]'></td></tr>
                    <tr><th scope='row'>Gen. Tabungan</th>                       <td><input type='number' class='form-control' name='c' value='$record[gen_tabungan]'></td></tr>
                    <tr><th scope='row'>Min. Bonus R.O</th>               <td><input type='number' class='form-control' name='d' value='$record[min_bonus_ro]'></td></tr>
                    <tr><th scope='row'>Persen (%) R.O</th>                 <td><input type='text' class='form-control' name='e' value='$record[persen_ro]'></td></tr>
                    <tr><th scope='row'>Gen. R.O</th>                    <td><input type='number' class='form-control' name='f' value='$record[gen_ro]'></td></tr>
                    <tr><th scope='row'>Persen (%) Auto Save</th>               <td><input type='text' class='form-control' name='g' value='$record[persen_auto_save]'></td></tr>
                    <tr><th scope='row'>Max. Autosave</th>                 <td><input type='number' class='form-control' name='h' value='$record[max_auto_save]'></td></tr>
                    <tr><th scope='row'>Persen (%) PPN</th>                  <td><input type='text' class='form-control' name='i' value='$record[ppn]'></td></tr>

                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
