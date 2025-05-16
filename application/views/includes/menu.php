
   <?php 

      // $user_id=$this->backend_member->mbr_id;

      // if (empty($user_id)) {
      //   redirect(base_url());
      // }

      $menu = $this->uri->segment(1);
      $sousmenu = $this->uri->segment(2);


      // $PROFIL=$this->Model->getRequeteOne('SELECT `rol_id` FROM `members` WHERE `mbr_id`='.$user_id);

   // print_r($PROFIL['rol_id']);
      ?>
<div class="quixnav">
  <div class="quixnav-scroll">
    <ul class="metismenu" id="menu">


     <?php

      $modules=$this->Model->getRequete("SELECT DISTINCT module.ID_MODULE,module.DESCRIPTION,module.CONTROLLER,module.MOT_CLE, module.ICONE FROM `module` JOIN module_profil ON module_profil.ID_MODULE=module.ID_MODULE WHERE STATUT = 1 ORDER BY DESCRIPTION ASC");
//  AND module_profil.ID_PROFIL=".$PROFIL['rol_id']."
      foreach ($modules as $key) {

    if (!empty($key['CONTROLLER'])) { 

      $url_module=$key['MOT_CLE'].'/'.$key['CONTROLLER'];
      ?>
      <li class="sidebar-item <?php if($menu == $key['CONTROLLER']) echo 'active' ?>"><a href="<?= base_url() ?><?=$url_module;?>"><i
                        class="<?=$key['ICONE']?>"></i><?=$key['DESCRIPTION']?></a></li>
      <?php
      }else{
        ?>
      <li><a class="has-arrow <?php if($this->router->class == $key['MOT_CLE']) echo 'active' ?>" href="#pub<?=$key['ID_MODULE']?>" aria-expanded="false"><i class="<?=$key['ICONE']?>"></i><span class="nav-text"><?=$key['DESCRIPTION']?></span></a>
        <ul id="pub<?=$key['ID_MODULE']?>" aria-expanded="false">

          
         <?php
          $menu_new=$this->Model->getRequete("SELECT DISTINCT menu.ID_MENU, menu.DESCRIPTION,menu.URL,menu.CONTROLLER, menu.STATUT,menu.ID_MODULE FROM `menu` JOIN module on menu.ID_MODULE=module.ID_MODULE JOIN menu_profil on menu_profil.ID_MENU=menu.ID_MENU  WHERE menu.STATUT = 1 and menu.ID_MODULE NOT IN(8,9,18,33) and menu.ID_MODULE=".$key['ID_MODULE']."  ORDER BY menu.DESCRIPTION ASC");
// AND menu_profil.ID_PROFIL=".$PROFIL['rol_id']."
          foreach ($menu_new as $keymenu) {
           ?>

         <li><a href="<?= base_url() ?><?=$keymenu['URL']?>"><?=$keymenu['DESCRIPTION']?></a></li>

         <?php
        
      }

         ?>


        </ul>
      </li>


      <?php
      }
      }
     ?>

     
     
    </ul>
          
  </div>
</div>


















