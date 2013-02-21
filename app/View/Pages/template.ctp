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
if (Configure::read('debug') == 0):
	throw new NotFoundException();
endif;
App::uses('Debugger', 'Utility');
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
            <input class="span5" size="16" type="text" placeholder="ex.: <?php echo date('d/m/Y'); ?>">
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="icon-remove"></i></button>
            <button class="btninput datedefault" type="button" id="default" name="default" rel="tooltip" title="Date par défaut :<br/><?php echo "05/01/".(date('Y')+1); ?>"><i class="icon-flag"></i></button>
            <span class="add-on"><i class="icon-calendar"></i></span>
        </div>
        <div class="input-prepend date offset4" data-date="<?php echo date('d/m/Y'); ?>" data-date-format="dd/mm/yyyy">
            <span class="add-on"><i class="icon-calendar"></i></span>
            <button class="btninput datedefault" type="button" id="default" name="default" rel="tooltip" title="Date par défaut :<br/><?php echo "05/01/".(date('Y')+1); ?>"><i class="icon-flag"></i></button>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" title="Effacer la date"><i class="icon-remove"></i></button>
            <input class="span5" size="16" type="text" placeholder="ex.: <?php echo date('d/m/Y'); ?>">
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
    <div class="btn-group pull-right" data-toggle="buttons-radio">
    <button class="btn" id="expand" onclick="$('.collapse').collapse('show');return false;"><i class="icon-resize-full"></i></button>
    <button class="btn btn-inverse disabled" id="collapse" onclick="$('.collapse').collapse('hide');return false;"><i class="icon-resize-small icon-white"></i></button>
    </div>
    <div class="accordion" style="clear:both;" id="accordion2" name="accordion2">
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse0">
                Identité
                <span class="pull-right">6404901Z</span>
                </a>
            </div>
            <div id="collapse0" class="accordion-body collapse"> <!-- ajouter 'in' si on veux que le bloc soit ouvert //-->
                <div class="accordion-inner">
                Contenu de la fiche d'identité de l'agent
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse1">
                Administration
                <span class="pull-right">C : 0 - RQ : 0 - VT : 0</span>
                </a>
            </div>
            <div id="collapse1" class="accordion-body collapse">
                <div class="accordion-inner">
                Contenu de l'administration de l'agent
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2">
                Logistique
                <span class="pull-right">Matériel : 0</span>
                </a>
            </div>
            <div id="collapse2" class="accordion-body collapse">
                <div class="accordion-inner">
                Contenu de la logistique de l'agent
                </div>
            </div>
        </div> 
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse3">
                Affectation
                <span class="pull-right">Activités : 0</span>
                </a>
            </div>
            <div id="collapse3" class="accordion-body collapse">
                <div class="accordion-inner">
                Contenu de l'affectation de l'agent
                </div>
            </div>
        </div>   
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse4">
                Ouverture des droits
                <span class="pull-right">Outils : 0 - Partages : 0 - Listes de diffusion : 0</span>
                </a>
            </div>
            <div id="collapse4" class="accordion-body collapse">
                <div class="accordion-inner">
                Contenu du suivi de l'ouverture des droits de l'agent
                </div>
            </div>
        </div>        
    </div>
        <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <button class="btn btn-primary" type="button">Enregistrer</button>
                <button class="btn" type="button">Annuler</button>                
            </div>
        </div>
    </div>  
    
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr><th><a class="asc" href="#">Nom</a></th><th>Prénom</th><th>Login</th><th>Assistance</th><th>Société</th><th style="width:100px;">Actions</th></tr>
        </thead>
        <tbody>
        <tr><td><div id="NOM" data-type="text" data-pk="1" data-name="NOM" data-url="post.php" data-original-title="Saisir le nom" style="cursor:url(img/pen_i.cur),pointer;;">Truc</div></td><td>Marcel</td><td>0000000</td><td>SAMBA</td><td>SNCF</td><td>
    <i class="icon-pencil"></i>
    <i class="icon-retweet"></i>  
    <i class="icon-zoom-in" rel="popover" data-title="<h3>Fiche identité :</h3>" data-content="<contenttitle>Tél:</contenttitle> 000000<br/><contenttitle>Mail:</contenttitle> <a href='mailto:marcel.truc@sncf.fr'>marcel.truc@sncf.fr</a>" data-trigger="click" style="cursor: pointer;"></i>
    <i class="icon-ok-circle" data-toggle="modal" data-target="#initpsw-msg" style="cursor: pointer;"></i>
    <i class="icon-trash" data-toggle="modal" data-target="#delete-msg" style="cursor: pointer;"></i>
    </td></tr>
        <tr><td>Dupleix</td><td>Auguste</td><td>1111111</td><td>SAMBA</td><td>SNCF</td><td><i class="icon-pencil"></i>
    <i class="icon-retweet"></i>  
    <i class="icon-zoom-in" rel="popover" data-title="<h3>Fiche identité :</h3>" data-content="<contenttitle>Tél:</contenttitle> 000001<br/><contenttitle>Mail:</contenttitle> <a href='mailto:auguste.dupleix@sncf.fr'>auguste.dupleix@sncf.fr</a>" data-trigger="click" style="cursor: pointer;"></i>
    <i class="icon-ok-circle"></i>
    <i class="icon-trash"></i>
    </td></tr>
        <tr><td>Calamity</td><td>Gontran</td><td>2222222</td><td>SAMBA</td><td>SNCF</td><td><i class="icon-pencil"></i>
    <i class="icon-retweet"></i>  
    <i class="icon-zoom-in"></i>
    <i class="icon-ok-circle"></i>
    <i class="icon-trash"></i>
    </td></tr>
        <tr><td>Dussolier</td><td>Emilie</td><td>33333333</td><td>SAMBA</td><td>SNCF</td><td><i class="icon-pencil"></i>
    <i class="icon-retweet"></i>  
    <i class="icon-zoom-in"></i>
    <i class="icon-ok-circle"></i>
    <i class="icon-trash"></i>
    </td></tr>
        <tr><td>Grosjean</td><td>Irène</td><td>4444444</td><td>SAMBA</td><td>SNCF</td><td><i class="icon-pencil"></i>
    <i class="icon-retweet"></i>  
    <i class="icon-zoom-in"></i>
    <i class="icon-ok-circle"></i>
    <i class="icon-trash"></i>
    </td></tr>
        <tr><td>Melchior</td><td>Lucie</td><td>5555555</td><td>SAMBA</td><td>SNCF</td><td><i class="icon-pencil"></i>
    <i class="icon-retweet"></i>  
    <i class="icon-zoom-in"></i>
    <i class="icon-ok-circle"></i>
    <i class="icon-trash"></i>
    </td></tr>
        </tbody>
        <!--<tfoot><tr><td class="pull-right">Gestion des actions groupées</td></tr></tfoot>//-->
    </table>
    <div class="pagination  pagination-centered">
    <ul>
    <li><a href="#">«</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">»</a></li>
    </ul>
    </div>
    
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
            <ul class="nav">
            <li><a href="#"><i class="icon-plus"></i></a></li>
            <li class="divider-vertical"></li>
            <li><a href="#">Prolonger</a></li>
            <li><a href="#">Supprimer</a></li>
            <li class="divider-vertical"></li>
            <li><a href="#"><i class="ico-xls"></i></a></li>
            </ul> 
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