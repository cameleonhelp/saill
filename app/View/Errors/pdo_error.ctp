<div class="">
    <div class="bs-callout bs-callout-danger">
        <h2><?php echo __d('cake_dev', 'Erreur en base de données'); ?></h2>
        <p class="error">
                <strong><?php echo __d('cake_dev', 'Erreur'); ?>: </strong>
                <?php echo $name; ?>
        </p>
        <?php if (!empty($error->queryString)) : ?>
                <p class="notice">
                        <strong><?php echo __d('cake_dev', 'Requête SQL'); ?>: </strong>
                        <?php echo h($error->queryString); ?>
                </p>
        <?php endif; ?>
        <?php if (!empty($error->params)) : ?>
                        <strong><?php echo __d('cake_dev', 'Paramétres de la requête SQL'); ?>: </strong>
                        <?php echo Debugger::dump($error->params); ?>
        <?php endif; ?>
        <?php echo $this->element('exception_stack_trace'); ?>
    </div>
</div> 