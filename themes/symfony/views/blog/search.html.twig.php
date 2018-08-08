<!-- {% extends 'base.html.twig' %} -->

<!-- {% block javascripts %} -->
	<!-- {{ parent() }} -->
	<script src="/build/js/search.js"></script>
<!-- {% endblock %} -->

<!-- {% block main %} -->
	<form action="<?= Yii::app()->createUrl('symfony/post/search') ?>" method="get">
		<div class="form-group">
			<input name="q" type="text" class="form-control search-field" placeholder="<?= Yii::t('messages', 'post.search_for') ?>" autocomplete="off" autofocus>
		</div>
	</form>

	<div id="results">
	</div>
<!-- {% endblock %} -->

<!-- {% block sidebar %} -->
	<!-- {{ parent() }} -->
	<!-- {{ show_source_code(_self) }} -->
<!-- {% endblock %} -->
