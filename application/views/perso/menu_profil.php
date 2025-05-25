
<?php 

$locat=$this->Model->getRequeteOne('SELECT * FROM `locataire` WHERE EMAIL="'.$this->session->userdata('LOCATAIRE_EMAIL').'" ');

// print_r($locat['IMAGE_LOCATAIRE']);


$year = date('Y');
$path;
if(!empty($locat['IMAGE_LOCATAIRE'])){

   $path="/uploads/doc_meuble/".$locat['IMAGE_LOCATAIRE']."";
    // $path="/uploads/doc_meuble/".$locat['IMAGE_LOCATAIRE']."";
    // if (file_exists($path)) {
    //     $path="/uploads/doc_meuble/".$locat['IMAGE_LOCATAIRE']."";
    // } else {
    //     $path="assets/frontend/images/avatar_male.png";
    // }
}else{
    $path="assets/frontend/images/avatar_male.png";
    
}



?>




<div class="card bg-white mb-4">
    <div class="text-center mt-3">
        <img width="100px" height="100px" style="border-radius:50px;" src="<?=base_url($path)?>">
    </div>
    <div class="p-4">
        <h4 class="text-center">
            <?= $this->session->userdata('LOCATAIRE_NOM').' '.$this->session->userdata('LOCATAIRE_PRENOM') ?>
        </h4>
        <center><div class="gradient_line mb-3"></div></center>
        <p><i class="fa fa-phone"></i> <?= $this->session->userdata('LOCATAIRE_TELEPHONE') ?></p>
        <p><i class="fa fa-envelope"></i> <?= $this->session->userdata('LOCATAIRE_EMAIL') ?></p>

        <ul class="list-group mt-3">
            <li class="list-group-item">
                <a href="<?= base_url('Perso/changePasswod') ?>">
                    <i class="fa fa-key"></i> Changer mot de passe
                </a>
            </li>
        </ul>
    </div>
</div>









