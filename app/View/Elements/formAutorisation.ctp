<?php echo $this->Form->create('Autorisation',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="AutorisationProfilId">Profil : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->input('profil_id',array('type'=>'hidden','value'=>$this->data['Autorisation']['profil_id'])); ?>
                <?php echo h($autorisation['Profil']['NOM']); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('profil_id',$profil,array('data-rule-required'=>'true','data-msg-required'=>"Le nom du profil est obligatoire",'selected' => '','empty' => 'Choisir un profil')); ?>
            <?php } ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="AutorisationMODEL">Modèle : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->input('MODEL',array('type'=>'hidden','value'=>$this->data['Autorisation']['MODEL'])); ?>
                <?php echo h($autorisation['Autorisation']['MODEL']); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('MODEL',$models,array('data-rule-required'=>'true','data-msg-required'=>"Le modèle est obligatoire",'selected' => '','empty' => 'Choisir un modèle')); ?>
            <?php } ?>
        </div>
    </div>
    <div class="offset2 control-group">
    <table  cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Lister</th>
            <th>Ajouter</th>            
            <th>Modifier</th>
            <th>Visualiser</th>
            <th>Supprimer</th>
            <th>Dupliquer</th>
            <th>Initialiser le mot de passe</th>
            <th>Calendrier des absences</th>
            <th>Rapports</th>
            <th>Mise à jour</th>
            <th>Mon profil</th>
            <th>Saisie en masse</th>
            <th>Tout</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <?php
		echo "<td style='text-align:center;'>".$this->Form->input('INDEX',array('type'=>'checkbox'))."</td>";
		echo "<td style='text-align:center;'>".$this->Form->input('ADD',array('type'=>'checkbox'))."</td>";
		echo "<td style='text-align:center;'>".$this->Form->input('EDIT',array('type'=>'checkbox'))."</td>";
		echo "<td style='text-align:center;'>".$this->Form->input('VIEW',array('type'=>'checkbox'))."</td>";
		echo "<td style='text-align:center;'>".$this->Form->input('DELETE',array('type'=>'checkbox'))."</td>";
		echo "<td style='text-align:center;'>".$this->Form->input('DUPLICATE',array('type'=>'checkbox'))."</td>";
		echo "<td style='text-align:center;'>".$this->Form->input('INITPASSWORD',array('type'=>'checkbox'))."</td>";
                echo "<td style='text-align:center;'>".$this->Form->input('ABSENCES',array('type'=>'checkbox'))."</td>";
                echo "<td style='text-align:center;'>".$this->Form->input('RAPPORTS',array('type'=>'checkbox'))."</td>";
                echo "<td style='text-align:center;'>".$this->Form->input('UPDATE',array('type'=>'checkbox'))."</td>";
                echo "<td style='text-align:center;'>".$this->Form->input('MYPROFIL',array('type'=>'checkbox'))."</td>";
                echo "<td style='text-align:center;'>".$this->Form->input('MASSE',array('type'=>'checkbox'))."</td>";
                echo "<td style='text-align:center;'>".$this->Form->input('ALL',array('type'=>'checkbox','id'=>"autorizeAll",'name'=>'autorizeAll','class'=>'checkall'))."</td>";
	?>
        </tr>
        </tbody>
    </table>
    </div>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container" style="margin-top:2px;text-align:center;">
                    <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".goPrev()."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
                </div>
            </div>
        </div> 
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
<?php echo $this->Form->end(); ?>