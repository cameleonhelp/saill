<h2><?php echo $name; ?></h2>
<p class="error">
	<strong>Erreur : </strong>
	Vérifiez que l'adresse dans votre navigateur est correcte, si vous voyez deux fois les mêmes éléments, corrigez l'adresse et validez.
        <br>Sinon cliquez <?php echo $this->Html->link('ici',array('controller'=>'pages','action'=>'home')); ?> pour être redirigé vers la page d'accueil.
</p>
<?php
   // $errormsg = 'Suite à une erreur, vous êtes redirigé vers cette page.<br>Veuillez essayer de nouveau, si cette erreur persiste, merci de contacter l\'administrateur en expliquant votre erreur.';
   // $this->Session->setFlash(__($errormsg),'default',array('class'=>'alert alert-error'));
   // $this->redirect(array('controller'=>'pages','action'=>'home'));  
?>