<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$this->set('title_for_layout','Accueil');
?>
    <div class="navbar">
        <div class="navbar-inner">
            
            <div class="container">
                
            <ul class="nav">
            <li><a href="#">Tous</a></li>
            <li class="active"><a href="#">Actif</a></li>
            <li><a href="#">Inactif</a></li>
            <li><a href="#">Fin de mission</a></li>
            <li><a href="#">Incomplet</a></li>
            <li class="divider-vertical"></li>
            </ul> 
            <form class="navbar-form clearfix pull-right ">
                <input class="span6" type="text">
                <button type="submit" class="btn">Rechercher</button>
            </form>
            </div>
        </div>
    </div>
<?php
	App::uses('ConnectionManager', 'Model');
	try {
		$connected = ConnectionManager::getDataSource('default');
	} catch (Exception $connectionError) {
		$connected = false;
	}
?>
<p>
	<?php
		if ($connected && $connected->isConnected()):
			echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>';
	 			echo __d('cake_dev', 'Cake peut se connecter à la base de données.');
			echo '</div>';
		else:
			echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>';
				echo __d('cake_dev', 'Cake NE peut pas se connecter à la base de données.');
				echo '<br /><u>Message :</u><br />';
				echo '<ul><li>'.$connectionError->getMessage().'</li></ul>';
			echo '</div>';
		endif;
	?>
    <?php
		echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>';
		echo __d('cake_dev', 'Cake NE peut pas se connecter à la base de données.');
		echo '<br /><u>Message :</u><br />';
		echo '<ul><li>Message d\'erreur</li></ul>';
		echo '</div>';	?>
    <?php
		echo '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button>';
		echo __d('cake_dev', 'Message d\'information.');
		echo '</div>';	?>
    <?php
		echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button>';
		echo __d('cake_dev', 'Message d\'alerte.');
		echo '</div>';	?>
</p>
<p>
    <div class="controls">
        <div class="input-append date" data-date="<?php echo date('d/m/Y'); ?>" data-date-format="dd/mm/yyyy">
            <input class="span5" size="16" type="text" placeholder="ex.: <?php echo date('d/m/Y'); ?>" readonly>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
            <button class="btninput datedefault" type="button" id="default" name="default" rel="tooltip" title="Date par défaut :<br/><?php echo "05/01/".(date('Y')+1); ?>"><i class="glyphicon_history"></i></button>
            <span class="add-on"><i class="glyphicon_calendar"></i></span>
        </div>
        <div class="input-prepend date offset4" data-date="<?php echo date('d/m/Y'); ?>" data-date-format="dd/mm/yyyy">
            <span class="add-on"><i class="glyphicon_calendar"></i></span>
            <button class="btninput datedefault" type="button" id="default" name="default" rel="tooltip" title="Date par défaut :<br/><?php echo "05/01/".(date('Y')+1); ?>"><i class="glyphicon_history"></i></button>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
            <input class="span5" size="16" type="text" placeholder="ex.: <?php echo date('d/m/Y'); ?>" readonly>
        </div>
    </div> 
        <label class="sstitre horizontal">Label name</label>
        <select class="span10">
            <option>Saisir une valeur</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
</p>

<p>
    <div class="btn-group">
    <button class="btn  btn-primary"><i class="icon-plus icon-white"></i></button>
    <button class="btn"><i class="icon-pencil"></i></button>
    <button class="btn"><i class="icon-retweet"></i></button>    
    <button class="btn"><i class="icon-zoom-in"></i></button>
    <button class="btn"><i class="icon-ok-circle"></i></button>
    <button class="btn"><i class="icon-trash"></i></button>
    </div>
</p>
    <p>
    <button class="btn btn-primary" type="button">Default button</button>
    <button class="btn" type="button">Default button</button>
    </p>
        <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <button class="btn btn-primary" type="button">Enregistrer</button>
                <button class="btn" type="button">Annuler</button>                
            </div>
        </div>
    </div>  
    <div class="tabbable"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Section 1</a></li>
    <li><a href="#tab2" data-toggle="tab">Section 2</a></li>
    </ul>
    <div class="tab-content">
    <div class="tab-pane active" id="tab1">
    <p><textarea id="wyswyg"></textarea></p>
    </div>
    <div class="tab-pane" id="tab2">
    <p>Howdy, I'm in Section 2.</p>
    </div>
    </div>
    </div>
