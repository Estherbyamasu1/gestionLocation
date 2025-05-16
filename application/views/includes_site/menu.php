        <!-- Navbar start -->
        <nav style="z-index: 2" class="navbar navbar-expand-lg navbar-light  sticky" data-offset="0">
            <div class="container">
                <a href="#" class="navbar-brand"><img alt="Commissariat Général des Migrations Burundi Logo" width='80'
                        src="<?= base_url() ?>logo/png_logo.png"></a>

                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse" id="navbarContent">

                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link <?php if($this->router->class == 'Home') echo 'active';?>"
                                href="<?=base_url('Home')?>">Accueil</a>
                        </li>
                       <li>
                            <a class="nav-link" href="<?=base_url('Appartement_site')?>" role="button" aria-haspopup="true"
                                aria-expanded="false">Appartement</a>

                        </li>
                        <li>
                            <a class="nav-link" href="<?=base_url('Appartement_site/apropos')?>" role="button" aria-haspopup="true"
                                aria-expanded="false">A propos</a>

                        </li>

                         <li>
                            <a class="nav-link" href="<?=base_url('Inscription_Locataire')?>" role="button" aria-haspopup="true"
                                aria-expanded="false">Inscription</a>

                        </li>
                      

                        <li>
                            <a class="nav-link" href="<?=base_url('Contact')?>" role="button" aria-haspopup="true"
                                aria-expanded="false">Contactez-nous</a>

                        </li>

                       

                        <li class="nav-item" style="display: none;">
                            <a class="nav-link <?php if($this->router->class == 'Rendez_vous') echo 'active';?>"
                                href="<?=base_url('Rendez_vous')?>">A propos</a>
                        </li>



                       <!--  <li class="nav-item">
                            <button data-toggle="modal" data-target="#myModalMessage" class="btn mybtn btn-split">
                                <?=$this->lang->line('menu_plainte')?> <div class="fab"><i class="fa fa-send"></i></div>
                            </button>
                        </li> -->
    

                        &nbsp;&nbsp;

                        <li class="nav-item">
                            <a style="text-decoration: blue" href="<?=base_url('Login_Front')?>"><button
                                    class="btn btn-primary rounded-pill px-5 py-2"> Connectez-vous <div class="fab">
                                        <i class="fa fa-sign-in"></i>
                                    </div></button></a>
                        </li>
                    </ul>

                </div>

            </div>
        </nav>
        <!-- Navbar end -->
