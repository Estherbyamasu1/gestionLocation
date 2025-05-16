   <!-- ======= Top Bar start ======= -->
   <section style="background-image: url(<?=base_url()?>assets/img/top_bar_bg.svg)" id="topbar"
       class="d-flex align-items-center">
       <div class="container d-flex justify-content-center justify-content-md-between">
           <div class="contact-info d-none d-sm-flex align-items-center">
               <i class="fa fa-envelope d-flex align-items-center"><a
                       href="mailto:contact@migration.gov.bi"><?=$this->config->item('info_email')?></a></i>
               <i class="fa fa-phone d-flex align-items-center ms-4"><a
                       href="tel:+25722451278"><?=$this->config->item('info_tel')?></a></i>
           </div>
           <div class="contact-info d-none d-sm-flex align-items-center">
               <i class="fa fa-envelope d-flex align-items-center"><a
                       href="mailto:contact@migration.gov.bi"><?= $this->lang->line('support_tec')?></a></i>
               <i class="fa fa-phone d-flex align-items-center ms-4"><a href="tel:+25779128128">+257 79 12 81 28</a></i>
           </div>
           <div class="social-links d-flex align-items-center">
               <a href="<?=base_url('Language/index/fr')?>"><img
                       class="language-image active d-flex align-items-center ms-2"
                       src="<?=base_url()?>assets/img/FR.png"></a>
               <a href="<?=base_url('Language/index/en')?>"><img class="language-image d-flex align-items-center ms-2"
                       src="<?=base_url()?>assets/img/EN.png"></a>
           </div>
       </div>
   </section>
   <!-- ======= Top Bar end ======= -->