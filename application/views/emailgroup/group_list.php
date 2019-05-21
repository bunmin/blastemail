            <?php if (strlen($this->session->flashdata('message')) > 0) {?>
            	<div class="alert alert-<?php echo $this->session->flashdata('flag'); ?> alert-dismissible">
            		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            	  <?php echo $this->session->flashdata('message'); ?>
            	</div>
            <?php }?>
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-footer clearfix">
                  <?php echo anchor(site_url('emailgroup/create'),'Create', 'class="btn btn-sm btn-info btn-flat pull-left"'); ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Group Name</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($group_data as $groups) {
                            ?>
                            <tr>
                                <td width="80px"><?php echo ++$no?></td>
                                <td><?php echo $groups->group_name ?></td>
                                <td><?php echo $groups->created_dt ?></td>
                                <td style="text-align:center" width="200px">
                                <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-default" onclick="load_detail('<?php echo $groups->uuid; ?>','<?php echo $groups->group_name ?>')">
                                    <i class="fa fa-eye" title-"Detail"></i>
                                  </a>
                                  <a href="emailgroup/delete/<?php echo $groups->uuid?>" class="btn btn-sm btn-danger" onclick="javasciprt: return confirm('Are You Sure ?')">
                                    <i class="fa fa-trash" title-"delete"></i>
                                  </a>
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
              <!-- <div class="modal_show">
              </div> -->
              <!-- /.box -->
              <div class="modal fade modal_show" id="modal-default">
              </div>
