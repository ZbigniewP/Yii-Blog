<!-- {% extends 'base.html.twig' %} -->

<!-- {% block body_id 'homepage' %} -->

<!-- {#
	the homepage is a special page which displays neither a header nor a footer.
	this is done with the 'trick' of defining empty Twig blocks without any content
#} -->
<!-- {% block header %}{% endblock %} -->
<!-- {% block footer %}{% endblock %} -->

<!-- {% block body %} -->
	<div class="page-header">
		<h1><?= Yii::t('messages', 'title.homepage') ?></h1>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div class="jumbotron">
				<p>
					<?= Yii::t('messages', 'help.browse_app') ?>
				</p>
				<p>
					<a class="btn btn-primary btn-lg" href="/symfony/blog/index">
						<i class="fa fa-users" aria-hidden="true"></i> <?= Yii::t('messages', 'action.browse_app') ?>
					</a>
				</p>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="jumbotron">
				<p>
					<?= Yii::t('messages', 'help.browse_admin') ?>
				</p>
				<p>
					<a class="btn btn-primary btn-lg" href="/symfony/admin/index">
						<i class="fa fa-lock" aria-hidden="true"></i> <?= Yii::t('messages', 'action.browse_admin') ?>
					</a>
				</p>
			</div>
		</div>
	</div>
<!-- {% endblock %} -->
