<?php
if (empty($this->session->userdata('UNWOMEN_USER_ID'))) 
{
  redirect(base_url());

}
$getprofil=$this->Model->getOne('admin_profil',array('PROFIL_ID'=>$this->session->userdata('UNWOMEN_PROFIL_ID')));

$affectations=$this->Model->getRequete("SELECT `TACHE_AFFECTATION_ID`,TACHE_ID, `DATE_DEBUT`, `DATE_FIN`, `ID_PROJET`, `ID_COLLABORATEUR` FROM `cra_tache_affectation` WHERE EST_TERMINE=0");

foreach ($affectations as $key) 
{

  $get_collab=$this->Model->getOne('cra_collaborateur',array('ID_COLLABORATEUR'=>$key['ID_COLLABORATEUR']));

  $message="Cher(ère) <b>".$get_collab['NOM']." ".$get_collab['PRENOM']." </b>,<br>vous n'avez pas donné(e) le CRA du ".$key['DATE_FIN'].".<br>Veuillez le remplir.";

  if ($key['DATE_FIN']<date('Y-m-d')) 
  {
    $get_test=$this->Model->getOne('cra_notifications',array('TACHE_AFFECTATION_ID'=>$key['TACHE_AFFECTATION_ID'],'ID_COLLABORATEUR'=>$key['ID_COLLABORATEUR']));
    if (empty($get_test)) 
    {
      $this->Model->create('cra_notifications',array('TACHE_AFFECTATION_ID'=>$key['TACHE_AFFECTATION_ID'],'MESSAGE'=>$message,'ID_COLLABORATEUR'=>$key['ID_COLLABORATEUR'],'TACHE_ID'=>$key['TACHE_ID']));
      $this->notifications->send_mail(array($get_collab['EMAIL']),"CRA non rempli",array(),$message,array());
    }




  }
    // }
}

$affects=$this->Model->getRequete('SELECT
  `TACHE_ID`,AVG(`AVANCEMENT_TACHE`) AS moyenne
  FROM
  `cra_tache_affectation`
  WHERE
  1
  GROUP BY
  TACHE_ID
  ');

foreach ($affects as $value) 
{
  $this->Model->update('cra_taches',array('TACHE_ID'=>$value['TACHE_ID']),array('AVANCEMENT_TACHE'=>$value['moyenne']));

  if ($value['moyenne']==100) 
  {
    $this->Model->update('cra_taches',array('TACHE_ID'=>$value['TACHE_ID']),array('IS_FINISH'=>1));
  }
}


    // }



// function mise_jr_activite_etat_avancement()
// {

$taches=$this->Model->getRequete('SELECT
  AVG(`AVANCEMENT_TACHE`) as moyenne,
  `ACTIVITE_ID`
  FROM
  `cra_taches`
  WHERE
  1
  GROUP BY
  ACTIVITE_ID
  ');


foreach ($taches as $value) 
{
  $this->Model->update('cra_activites',array('ACTIVITE_ID'=>$value['ACTIVITE_ID']),array('AVANCEMENT_ACTIVITE'=>number_format($value['moyenne'],2,'.',' ')));

  if ($value['moyenne']==100) 
  {
    $this->Model->update('cra_activites',array('ACTIVITE_ID'=>$value['ACTIVITE_ID']),array('EST_ACTIVITE_TERMINE'=>1));
  }
}


// }





    // function mise_jr_projet_etat_avancement()
    // {

$activites=$this->Model->getRequete('SELECT
  `ID_PROJET`,
  AVG(`AVANCEMENT_ACTIVITE`) AS moyenne
  FROM
  `cra_activites`
  WHERE
  1
  GROUP BY
  ID_PROJET
  ');


foreach ($activites as $value) 
{
  $this->Model->update('se_projet',array('ID_PROJET'=>$value['ID_PROJET']),array('AVANCEMENT_PROJET'=>number_format($value['moyenne'],2,'.',' ')));


  if ($value['moyenne']==100) 
  {
    $this->Model->update('se_projet',array('ID_PROJET'=>$value['ID_PROJET']),array('EST_PROJET_TERMINE'=>1));
  }

}


    // }






// print_r($getprofil);die();
?>

<div class="quixnav">
  <div class="quixnav-scroll">
    <ul class="metismenu" id="menu">
      <?php
      if ($getprofil['PROFIL_CODE']!="COLLAB")
      {
        ?>

        <?php
        if($this->session->userdata('UNWOMEN_PROFIL_ID')==1 || $this->session->userdata('UNWOMEN_UTILISATEURS')==1 || $this->session->userdata('UNWOMEN_PILIER')==1 || $this->session->userdata('UNWOMEN_SOURCE_COLLECTE')==1 || $this->session->userdata('UNWOMEN_UNITE_MESURE')==1)
        {
          ?>
          <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-cogs"></i><span class="nav-text">Administration</span></a>
            <ul aria-expanded="false">
              <?php if($this->session->userdata('UNWOMEN_PROFIL_ID')==1){?>
                <li><a href="<?=base_url()?>administration/User_Profil/listing">Profil</a></li>
              <?php } ?>
              <?php if($this->session->userdata('UNWOMEN_UTILISATEURS')==1){?>
                <li><a href="<?=base_url()?>administration/Admin_User/listing">Utilisateur</a></li>
              <?php } ?>
              <?php if($this->session->userdata('UNWOMEN_PILIER')==1 || $this->session->userdata('UNWOMEN_SOURCE_COLLECTE')==1 || $this->session->userdata('UNWOMEN_UNITE_MESURE')==1){?>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Paramétrage</a>
                  <ul aria-expanded="false">
                    <!-- <li><a href="<?=base_url()?>donnees/S_Bailleur">Bailleur</a></li> -->
                    <?php if($this->session->userdata('UNWOMEN_PILIER')==1){?>
                      <li><a href="<?=base_url()?>donnees/S_Pilier/listing">Pilier</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('UNWOMEN_SOURCE_COLLECTE')==1){?>
                      <li><a href="<?=base_url()?>donnees/Source_Collecte/listing">Source de collecte</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('UNWOMEN_UNITE_MESURE')==1){?>
                      <li><a href="<?=base_url()?>donnees/Unite_Mesure/listing">Unité de mesure</a></li>
                    <?php } ?>
                  </ul>
                </li>
              <?php } ?>
            </ul>
          </li>
          <?php
        }
        ?>

        <?php
        if($this->session->userdata('UNWOMEN_BENEFICIAIRE')==1 || $this->session->userdata('UNWOMEN_INTERVENANT')==1 || $this->session->userdata('UNWOMEN_PROJET')==1)
        {
          ?>
          <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-file-text-o"></i><span class="nav-text">IHM</span></a>
            <ul aria-expanded="false">
              <?php if($this->session->userdata('UNWOMEN_BENEFICIAIRE')==1){?>
                <li><a href="<?=base_url()?>beneficaire/Beneficiaire/index">Bénéficiaire</a></li>
              <?php } ?>
              <?php if($this->session->userdata('UNWOMEN_INTERVENANT')==1){?>
                <li><a href="<?=base_url()?>donnees/Intervenant/listing">Intervenant</a></li>
              <?php } ?>
              <?php if($this->session->userdata('UNWOMEN_PROJET')==1){?>
                <li><a href="<?=base_url()?>donnees/Projet_new/listing">Projet</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php
        }
        ?>

        <?php
        // if($this->session->userdata('UNWOMEN_ACTIVITES')==1 || $this->session->userdata('UNWOMEN_TACHES')==1 || $this->session->userdata('UNWOMEN_AFFECTATIONS')==1 || $this->session->userdata('UNWOMEN_COLLABORATEUR')==1)
        // {
        ?>
        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
          class="icon icon-app-store"></i><span class="nav-text">Agenda & Activités</span></a>
          <ul aria-expanded="false">
            <?php 
            if ($getprofil['PROFIL_CODE']!="COLLAB") 
            {
              ?>
              <li><a href="<?=base_url()?>cra/Activites">Activités</a></li>
              <li><a href="<?=base_url()?>cra/Taches/liste">Tâches</a></li>
              <li><a href="<?=base_url()?>cra/Affectation">Affectations</a></li>
              <li><a href="<?=base_url()?>cra/Collaborateurs">Collaborateurs</a></li>
              <?php 
            }
            ?>
          </ul>
        </li>
        <?php
        // }
        ?>


        <?php
        if($this->session->userdata('UNWOMEN_ENQUETEURS')==1 || $this->session->userdata('UNWOMEN_LOGISTIQUE')==1)
        {
          ?>
          <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
            class="fa fa-database"></i><span class="nav-text">Données</span></a>
            <ul aria-expanded="false">
              <?php if($this->session->userdata('UNWOMEN_ENQUETEURS')==1){?>
                <li><a href="<?=base_url()?>donnees/Enqueteurs">Enqueteurs</a></li>
              <?php } ?>
              <?php if($this->session->userdata('UNWOMEN_LOGISTIQUE')==1){?>
                <li><a href="<?=base_url()?>donnees/Liste_Logistique">Logistique</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php
        }
        ?>

        <?php
        if($this->session->userdata('UNWOMEN_INCIDENT')==1 || $this->session->userdata('UNWOMEN_CENTRE_SITUATION')==1)
        {
          ?>
          <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-align-center"></i><span class="nav-text">Centre de situation</span></a>
            <ul aria-expanded="false">
              <?php if($this->session->userdata('UNWOMEN_INCIDENT')==1){?>
                <li><a href="<?=base_url()?>donnees/Incidents">Incidents</a></li>
              <?php } ?>
              <?php if($this->session->userdata('UNWOMEN_CENTRE_SITUATION')==1){?>
                <li><a href="<?=base_url()?>geo/Carte_Centre_Situation">Centre de situation</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php
        }
        ?>

        <?php
        if($this->session->userdata('UNWOMEN_CARTE_BENEFICIAIRE')==1 || $this->session->userdata('UNWOMEN_CARTE_PERIMETRE_INTERVENTION')==1)
        {
          ?>
          <li class='menu-item'><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
            class="fa fa-map"></i><span class="nav-text">Cartographie</span></a>
            <ul aria-expanded="false">
              <?php if($this->session->userdata('UNWOMEN_CARTE_BENEFICIAIRE')==1){?>
                <li><a href="<?=base_url()?>map/Map_ben">Bénéficiaires</a></li>
              <?php } ?>
              <?php if($this->session->userdata('UNWOMEN_CARTE_PERIMETRE_INTERVENTION')==1){?>
                <li><a href="<?=base_url()?>map/Map_Perimetre">Périmètres d'intervention</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php
        }
        ?>

        <?php
        if ($this->session->userdata('UNWOMEN_PRODUITS_DISPONIBLES')==1)
        {
          ?>
          <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-shopping-cart"></i><span class="nav-text">E-commerce</span></a>
            <ul aria-expanded="false">
              <?php if($this->session->userdata('UNWOMEN_PRODUITS_DISPONIBLES')==1){?>
                <li><a href="<?=base_url()?>publication/Recherche_Produit">Produits diponibles</a></li>
              <?php } ?>
              <!-- <li><a href="<?=base_url()?>">Article</a></li> -->
              <!-- <li><a href="<?=base_url()?>">Client</a></li> -->
              <!-- <li><a href="<?=base_url()?>">Commandes</a></li> -->
              <!-- <li><a href="<?=base_url()?>">Tâches</a></li> -->
            </ul>
          </li>
          <?php
        }
        ?>

        <?php
        if($this->session->userdata('UNWOMEN_TDB_BENEFICIAIRES')==1 || $this->session->userdata('UNWOMEN_TDB_COOPERATIVES')==1 || $this->session->userdata('UNWOMEN_TDB_PROJETS')==1 || $this->session->userdata('UNWOMEN_TDB_ACTIVITES')==1 || $this->session->userdata('UNWOMEN_TDB_FORMATIONS')==1 || $this->session->userdata('UNWOMEN_TDB_INCIDENTS')==1 || $this->session->userdata('UNWOMEN_RA_EVOLUTION_JOURNALIERE')==1)
        {
          ?>

          <li class='menu-item'><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
            class="fa fa-tachometer"></i><span class="nav-text">Reporting</span></a>
            <ul aria-expanded="false">
              <?php
              if($this->session->userdata('UNWOMEN_TDB_BENEFICIAIRES')==1 || $this->session->userdata('UNWOMEN_TDB_COOPERATIVES')==1 || $this->session->userdata('UNWOMEN_TDB_PROJETS')==1 || $this->session->userdata('UNWOMEN_TDB_ACTIVITES')==1 || $this->session->userdata('UNWOMEN_TDB_FORMATIONS')==1 || $this->session->userdata('UNWOMEN_TDB_INCIDENTS')==1)
              {
                ?>
                <li class='menu-item'><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                  class="fa fa-tachometer"></i><span class="nav-text">Tableaux de bord</span></a>
                  <ul aria-expanded="false">
                    <?php if($this->session->userdata('UNWOMEN_TDB_BENEFICIAIRES')==1){?>
                      <li><a href="<?=base_url()?>dashboard/Dashboard_Benefaiciaire_Projet"> Bénéficiaires</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('UNWOMEN_TDB_COOPERATIVES')==1){?>
                      <li><a href="<?=base_url()?>dashboard/Dashboard_Cooperative">Coopératives</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('UNWOMEN_TDB_PROJETS')==1){?>
                      <li><a href="<?=base_url()?>dashboard/Dashboard_Projets"> S/E Projets</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('UNWOMEN_TDB_ACTIVITES')==1){?>
                      <li><a href="<?=base_url()?>dashboard/Dashboard_Activite_Cra">Activités</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('UNWOMEN_TDB_FORMATIONS')==1){?>
                      <li><a href="<?=base_url()?>dashboard/Dashboard_Foramation_mediabox">Formations</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('UNWOMEN_TDB_INCIDENTS')==1){?>
                      <li><a href="<?=base_url()?>dashboard/Dashboard_Incident">Incidents</a></li>
                    <?php } ?> 
                  </ul>
                </li>
                <?php
              }
              ?>
              <?php
              if($this->session->userdata('UNWOMEN_RA_EVOLUTION_JOURNALIERE')==1)
              {
                ?>
                <li class='menu-item'><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="nav-text">Rapports</span></a>
                  <ul aria-expanded="false">
                    <?php if($this->session->userdata('UNWOMEN_RA_EVOLUTION_JOURNALIERE')==1){?>
                      <li><a href="<?=base_url()?>rapport/Rapport_Evolution_Journaliaire_Ben">Evolution journalière</a></li>
                    <?php } ?>
                  </ul>
                </li>
                <?php
              }
              ?>
            </ul>
          </li>
          <?php
        }
        ?>




      <?php }
      ?>

      <?php
      if ($getprofil['PROFIL_CODE']=="COLLAB") {?>
        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
          class="icon icon-app-store"></i><span class="nav-text">CRA</span></a>
          <ul aria-expanded="false">
            <li><a href="<?=base_url()?>cra/Affectation">Affectations</a></li>

          </ul>
        </li> 
      <?php }
      ?>




                    <!--  <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="fa fa-comments-o"></i><span class="nav-text">Messagerie</span></a>
                        <ul aria-expanded="false">
                            <li><a href="<?=base_url()?>cra/Affectation">Affectations</a></li>
                            <li><a href="#">Messages reçues</a></li>
                            <li><a href="#">Messages envoyés</a></li>

                        </ul>
                      </li> -->

                      <?php
                      if($this->session->userdata('UNWOMEN_NOTIFICATIONS')==1 || $this->session->userdata('UNWOMEN_MESSAGERIE')==1)
                      {
                        ?>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-bell-o"></i><span class="nav-text">Communication</span></a>
                          <ul aria-expanded="false">
                            <?php
                            if($this->session->userdata('UNWOMEN_NOTIFICATIONS')==1)
                            {
                              ?>
                              <li><a href="<?=base_url('donnees/Liste_Cra_Notifications')?>">Notification</a></li>
                              <?php
                            }
                            ?>
                            <?php
                            if($this->session->userdata('UNWOMEN_MESSAGERIE')==1)
                            {
                              ?>
                              <li><a class="" href="<?=base_url('notification/Notification')?>" aria-expanded="false"> <span class="nav-text">Messagerie</span></a></li>
                              <?php
                            }
                            ?>
                          </ul>
                        </li>
                        <?php
                      }
                      ?>

                      <?php
                      if($this->session->userdata('UNWOMEN_COMPTABILITE')==1)
                      {
                        ?>
                        <li><a class="" href="<?=base_url('comptabilite/Comptabilite')?>" aria-expanded="false"><i class="fa fa-list"></i><span class="nav-text">Comptabilité</span></a></li>
                        <?php
                      }
                      ?>
                      <?php
                      if($this->session->userdata('UNWOMEN_ARCHIVAGE')==1)
                      {
                        ?>
                        <li><a class="" href="<?=base_url('archive/Archivage')?>" aria-expanded="false"><i class="fa fa-file-archive-o"></i><span class="nav-text">Fichiers & Archivage</span></a></li>
                        <?php
                      }
                      ?>
                    </ul>
                  </div>
                </div>
