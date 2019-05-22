<?php if (strlen($this->session->flashdata('message')) > 0) {?>
  <div class="alert alert-<?php echo $this->session->flashdata('flag'); ?> alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo $this->session->flashdata('message');
          $this->session->unset_userdata('flag');
          $this->session->unset_userdata('message');
    ?>
  </div>
<?php }?>
<!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-footer clearfix">
      <?php echo anchor(site_url('user/create'),'Create', 'class="btn btn-sm btn-info btn-flat pull-left"'); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="table-responsive">
        <table id="table" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
              <?php
              foreach ($user_data as $user) {
              ?>
                <tr>
                  <td width="80px"><?php echo ++$start ?></td>
                  <td><?php echo $user->nama ?></td>
                  <td><?php echo $user->username ?></td>
                  <td style="text-align:center" width="200px">
                    <?php
                      echo anchor(site_url('app/profiladmin/list/'.$user->id_user),'Update');
                      if ($user->id_user != $this->session->userdata('id_user') & $user->id_user != 1) {
                      echo ' | ';
                      echo anchor(site_url('user/ubahpass/'.$user->id_user),'Ubah Password');
                        if ($user->id_user != 1) {
                          echo ' | ';
                          echo anchor(site_url('user/delete/'.$user->id_user),'Hapus','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                        }
                      }
                    ?>
                  </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
