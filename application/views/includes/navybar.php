 <div class="nav-header">
    
        <a href="#" class="brand-logo" style="padding-left: 85px">
                <center><img  style="width: 100px; height:85px;" src="<?= base_url() ?>logo/png_logo.png" alt=""></center>
            </a>
    
            

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
 </div>



 <div style="background-color: #007bac" class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <h4 style='color:white'>  </h4>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <!-- <p style='color:white'><?=$this->session->userdata('UNWOMEN_EMAIL')?></p> -->
                            
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a  class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i style='color: white' class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2"><?=$this->session->userdata('NOM_USER').' '.$this->session->userdata('PRENOM_USER')?></span>
                                    </a>
                                <a href="<?= base_url('Recover_pwd')?>" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Changer le mot de passe</span>
                                    </a>
                                    
                                    
                                    <a href="<?= base_url('Login/do_logout')?>" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Déconnexion </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
