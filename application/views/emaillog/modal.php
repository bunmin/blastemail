        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
                <table id="tableinmodal" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Log Action</th>
                            <th>Execution Date</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($email_log_detail as $details) {
                        ?>
                        <tr>
                            <td width="80px"><?php echo ++$no?></td>
                            <td width="80px"><?php echo $details->log_action;?></td>
                            <td width="80px"><?php echo $details->excuted_date;?></td>
                            <td width="80px"><?php echo $details->description;?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
              </div>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
        <!-- </div> -->
        <!-- /.modal -->