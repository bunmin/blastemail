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
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Receiver</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Send Date</th>
                                <th>Read Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($log_data as $logs) {
                            ?>
                            <tr>
                                <td width="80px"><?php echo ++$no?></td>
                                <td><?php echo $logs->receiver ?></td>
                                <td><?php echo $logs->subject ?></td>
                                <td><?php echo $logs->status ?></td>
                                <td><?php echo $logs->send_dt ?></td>
                                <td><?php echo $logs->read_dt ?>
                                  <?php if ($logs->read_dt){?>
                                    <a href="#" class="pull-right" data-toggle="modal" data-target="#modal-default" onclick="load_detail('<?php echo $logs->uuid; ?>','<?php echo $logs->subject ?>')">
                                      <i class="fa fa-eye" title-"Detail"></i>
                                    </a>
                                  <?php }?>
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
              <div class="modal fade modal_show" id="modal-default">
                    <?php include 'modal.php'; ?>
              </div>