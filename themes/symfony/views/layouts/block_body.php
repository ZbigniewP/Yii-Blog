<?php $this->beginContent('/layouts/base.html.twig')?>
<div class="row">
	<div id="main" class="col-sm-9">
		<?php
// echo  Yii::app()->request->requestUri;//createUrl(Yii::app()->request->requestUri,['lang'=>'pl']);
// echo "<pre>";
// print_r(Yii::app()->getUrlManager());
// echo "</pre>";
		// exit();
		// $this->id . '/' . $this->action->id;
		// $this->renderPartial('//default/_flash_messages.html.twig') 
		// {{ include('default/_flash_messages.html.twig
		?>
		<!-- {% block main %}{% endblock %} -->
		<?= $content; ?>
	</div>

	<div id="sidebar" class="col-sm-3">
	<?= $this->renderPartial('//blog/about.html.twig')?>
	<!-- {% block sidebar %} -->
		<!-- {{ render_esi(controller('FrameworkBundle:Template:template', {
			'template': 'blog/about.html.twig',
			'sharedAge': 600,
			'_locale': <?= Yii::app()->getLanguage() ?>app.request.locale
		})) }} -->
	<!-- {% endblock %} -->
	</div>
</div>
<?php $this->endContent()?>