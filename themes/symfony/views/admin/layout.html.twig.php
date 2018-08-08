<!-- {#
   This is the base template of the all backend pages. Since this layout is similar
   to the global layout, we inherit from it to just change the contents of some
   blocks. In practice, backend templates are using a three-level inheritance,
   showing how powerful, yet easy to use, is Twig's inheritance mechanism.
   See https://symfony.com/doc/current/book/templating.html#template-inheritance-and-layouts
#} -->
<!-- {% extends 'base.html.twig' %} -->

<!-- {% block stylesheets %} -->
	<!-- {{ parent() }} -->
	<link rel="stylesheet" href="/build/css/admin.css">
<!-- {% endblock %} -->

<!-- {% block javascripts %} -->
	<!-- {{ parent() }} -->
	<script src="/build/js/admin.js"></script>
<!-- {% endblock %} -->

<!-- {% block header_navigation_links %} -->
	<li>
		<a href="<?= Yii::app()->createUrl('symfony/admin/post/index') ?>">
			<i class="fa fa-list-alt" aria-hidden="true"></i> <?= Yii::t('messages', 'menu.post_list') ?>
		</a>
	</li>
	<li>
		<a href="<?= Yii::app()->createUrl('symfony/post/index') ?>">
			<i class="fa fa-home" aria-hidden="true"></i> <?= Yii::t('messages', 'menu.back_to_blog') ?>
		</a>
	</li>
<!-- {% endblock %} -->
