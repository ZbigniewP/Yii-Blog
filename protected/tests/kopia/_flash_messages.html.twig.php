<!-- {#
   This is a template fragment designed to be included in other templates
   See https://symfony.com/doc/current/book/templating.html#including-other-templates

   A common practice to better distinguish between templates and fragments is to
   prefix fragments with an underscore. That's why this template is called
   '_flash_messages.html.twig' instead of 'flash_messages.html.twig'
#} -->

<div class="messages">
	<?php foreach ($app->flashes as [$messages,$type]) : ?>
		<?php foreach ($messages as $message) : ?>
			{# Bootstrap alert, see http://getbootstrap.com/components/#alerts #}
			<div class="alert alert-dismissible alert-{{ type }} fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<?= Yii::t('messages', $message) ?>
			</div>
		<?php endforeach; ?>
	<?php endforeach; ?>
</div>