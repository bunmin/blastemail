            <header class="main-header">
                <a href="<?php echo $config['base_url'];?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b></b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Blast</b>Email</span>
                </a>
            
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="glyphicon glyphicon-user"></i>
                                    <span>Mr. <?php echo $this->session->userdata('username'); ?> <i class="caret"></i></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header bg-light-blue">
                                        <img src="assets/img/avatar3.png" class="img-circle" alt="User Image" />

                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                        <!-- <div class="col-xs-12 text-center">
                                            <a href="app/logout">Logout</a>
                                        </div> -->

                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <!-- <div class="pull-left">
                                            <?php
                                            if ($this->session->userdata('level') == 'admin') {
                                                ?>
                                                <a href="app/profiladmin/profil/<?php echo $this->session->userdata('id_user'); ?>" class="btn btn-default btn-flat">
                                                Profile
                                                </a>
                                                <?php
                                            } else {
                                                ?>
                                                <a href="app/profiluser/<?php echo $this->session->userdata('id_user'); ?>" class="btn btn-default btn-flat">
                                                Profile
                                                </a>
                                            <?php } ?>
                                        </div> -->
                                        <div class="pull-right">
                                            <a href="login/logout" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
