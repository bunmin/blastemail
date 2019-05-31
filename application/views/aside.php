            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="assets/dist/img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>
                              Hello, <?php echo $this->session->userdata('nama'); ?>
                            </p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <br>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <?php
                        if ($this->session->userdata('level') == 'admin') {
                        ?>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-plus"></i> <span>Compose</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="app"><i class="fa fa-angle-double-right"></i>Single Send</a></li>
                                <li><a href="app/blastemail"><i class="fa fa-angle-double-right"></i>Blast Send</a></li>
                            </ul>
                        </li>
                        <li>
                          <a href="emailgroup">
                              <i class="fa fa-envelope"></i> <span> Email Group</span>
                          </a>
                        </li>
                        <li>
                          <a href="emaillog">
                              <i class="fa fa-history"></i> <span> Email Log</span>
                          </a>
                        </li>
                        <li>
                          <a href="protocolconfig">
                              <i class="fa fa-cog"></i> <span> Protocol Config</span>
                          </a>
                        </li>
                        <li>
                          <a href="app/ubahpass/<?php echo $this->session->userdata('id_user'); ?>">
                              <i class="fa fa-edit"></i> <span> Change Password</span>
                          </a>
                        </li>
                        <li>
                            <a href="login/logout">
                                <i class="fa fa-sign-out"></i> <span>LogOut</span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
