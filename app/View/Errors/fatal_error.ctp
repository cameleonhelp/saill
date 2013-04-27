<h2><?php echo 'Erreur fatale'; ?></h2>
<p class="error">
	<strong><?php echo __d('cake', 'Erreur'); ?>: </strong>
</p>
<?php
if (Configure::read('debug') > 0):
	echo $this->element('exception_stack_trace');
endif;
?>