<?php 
// if is_granted('IS_AUTHENTICATED_FULLY')):
// {% if is_granted('edit', post) %}
if(!Yii::app()->user->isGuest):
?>
	<div class="section">
		<a class="btn btn-lg btn-block btn-success" href="<?= Yii::app()->createUrl('symfony/admin/post/edit') ?>">
			<i class="fa fa-edit" aria-hidden="true"></i> <?= Yii::t('messages', 'action.edit_post') ?>
		</a>
	</div>
<?php endif; ?>
<div class="section">
	<a href="<?= Yii::app()->createUrl('symfony/admin/post/edit') ?>" class="btn btn-lg btn-block btn-success">
		<i class="fa fa-edit" aria-hidden="true"></i> <?= Yii::t('messages', 'action.edit_contents') ?>
	</a>
</div>

<div class="section">
	<?php 
	// $this->renderPartial('//admin/blog/_delete_form.html.twig') 
	?>
	<!-- , with_context = false -->
</div>
<div class="section">
	<a href="<?= Yii::app()->createUrl('symfony/admin/post/show') ?>" class="btn btn-lg btn-block btn-success">
		<i class="fa fa-eye" aria-hidden="true"></i> <?= Yii::t('messages', 'action.show_post') ?>
	</a>
</div>

<div class="section actions">
<button type="submit" class="btn btn-lg btn-block btn-danger">
		<i class="fa fa-trash" aria-hidden="true"></i>
		<?= Yii::t('messages', 'action.delete_post') ?>
	</button>
	<?php 
	// $this->renderPartial('//admin/blog/_delete_form.html.twig', with_context = false) }}) 
	?>
</div>

<div class="section actions">
	<a href="<?= Yii::app()->createUrl('symfony/admin/post/new') ?>" class="btn btn-lg btn-block btn-success">
		<i class="fa fa-plus" aria-hidden="true"></i> <?= Yii::t('messages', 'action.create_post') ?>
	</a>
</div>

<div class="portlet">
<div class="portlet-decoration"><div class="portlet-title">Symfony Demo</div></div>
<div class="portlet-content">
<div class="section about">
	<div class="well well-lg">
		<p>
			<?= Yii::t('messages', 'help.app_description')?>
		</p>
		<p>
			<?= Yii::t('messages', 'help.more_information')?>
		</p>
	</div>
</div>
<?php
Yii::app()->format->dateFormat = 'long';
Yii::app()->format->timeFormat = 'full';
?>
<!-- {# it's not mandatory to set the timezone in localizeddate(). This is done to
   avoid errors when the 'intl' PHP extension is not available and the application
   is forced to use the limited "intl polyfill", which only supports UTC and GMT #} -->
<!-- Fragment rendered on <?= Yii::app()->format->datetime(time()) ?> -->

</div>
</div>

<?php
echo "<h3>{$this->id}</h3>";
// echo "<pre>";
// print_r(get_class($this)); 
// echo "</pre>";
// exit();
// echo($this->action->id);
// echo "<h3>{$this->id}</h3>";
if ($this->id == 'symfony/blog') :
	$this->renderPartial('//blog/_rss.html.twig')
?>
<div class="section"><?= CHtml::link(Yii::t('messages', 'title.login'), ['//symfony/admin/login']) ?></div>
<?php endif; ?>

<!-- <?= strftime('%c %Z') ?>
<?= date('d-M-Y H:i:s T') ?>
<?= gmdate('d-M-Y H:i:s T') ?>
<?= gmdate('c') ?>
<?= CTimestamp::formatDate('d-M-Y H:i:s T') ?> -->
<!-- <?= Yii::t('zii', 'Home') ?><br />
<?= CHtml::link('<i class="fa fa-home" aria-hidden="true"></i> ' . Yii::t('messages', 'menu.homepage'), Yii::app()->homeUrl); ?><br />
<?= strftime('%#c', time()) ?><br />
<?= strftime('%#x', time()) ?><br />
<?= strftime('%c', time()) ?><br />
<?= strftime('%x %X', time()) ?><br />
<?= Yii::app()->format->datetime(time()) ?><br />
<?= Yii::app()->getLanguage() ?><br />
<?= Yii::app()->homeUrl ?><br />
<?= Yii::t('messages', 'menu.search', ['pl'], 'pl', 'pl') ?><br /> -->