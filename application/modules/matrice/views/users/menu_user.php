<ul class="nav nav-pills nav-fill justify-content-around rounded shadow m-4">
    <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['nouveau'])) echo 'active';?>"  href="<?=base_url('matrice/Users/nouveau/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
    <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('matrice/Users')?>"><i class="fa fa-list"></i>Liste</a></li>
</ul>