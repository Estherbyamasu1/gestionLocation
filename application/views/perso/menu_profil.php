
<?php 

$locat=$this->Model->getRequete('SELECT * FROM `locataire` WHERE EMAIL="'.$this->session->userdata('LOCATAIRE_EMAIL').'" ');


$year = date('Y');
$path;
if(!empty($locat['IMAGE_LOCATAIRE'])){
    $path="/uploads/doc_meuble/".$locat['IMAGE_LOCATAIRE']."";
    if (file_exists($path)) {
        $path="/uploads/doc_meuble/".$locat['IMAGE_LOCATAIRE']."";
    } else {
        $path="assets/frontend/images/avatar_male.png";
    }
}else{
    $path="assets/frontend/images/avatar_male.png";
    
}



?>

<div style="height:100%; width:100%" class="col-lg-3 card bg-white mb-4">
    <div class="text-center mx-4 mt-3"><!-- <i style="font-size: 100px" class="fa fa-user-circle-o"></i>--> <img width="100px" height="100px" style="border-radius:50px;" src="<?=base_url(''.$path.'')?>"></div>
    <div class="p-4">
        <h4 class="text-center"><?=$this->session->userdata('LOCATAIRE_NOM').' '.$this->session->userdata('LOCATAIRE_PRENOM')?></h4>
        <center>
            <div class="gradient_line mb-3"></div>
        </center>
       

        <tr><p class="text-dark"><td><i class="fa fa-phone" aria-hidden="true"></i></td> <td><?=$this->session->userdata('LOCATAIRE_TELEPHONE')?></td></p></tr>
        <tr><p class="text-dark">
            <td><i class="fa fa-envelope" aria-hidden="true"></i></td>   <td><?=$this->session->userdata('EMAIL')?></td></p></tr>
        </div>




  <?php 


  $reqete= $this->Model->getOne('locataire',array('EMAIL'=>$this->session->userdata('LOCATAIRE_EMAIL'))) ;

  // $id_profile=!empty($reqete) ? $reqete['id'] : $formula['id_historique'] ;
  ?>
  <ul class="list-group">
   
   <li class="list-group-item"><a href="<?= base_url('person/Demande_Espace_Person/changePasswod')?>" ><i class="fa fa-key"> Changer mot de passe </i></a></li>
</ul>

<br>

</div>

