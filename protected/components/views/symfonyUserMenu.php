<ul>
	<li><?= CHtml::link('Create New Post', ['//symfony/yiipost/create']) ?></li>
	<li><?= CHtml::link('Manage Posts', ['//symfony/yiipost/admin']) ?></li>
	<li><?= CHtml::link('Approve Comments', ['//symfony/yiicomment/index']) . ' (' . DemoComment::model()->pendingCommentCount . ')'; ?></li>
	<li><?= CHtml::link('Logout', ['//site/logout']) ?></li>
<?php
// echo "<pre>";
// print_r([$this->owner->pageTitle, $this->owner->id, $this->owner]);
// echo "</pre>";
// exit();
// if($this->owner->id=='symfony/blog')
// 'menu.admin' => 'Panel administracyjny',
// 'menu.back_to_blog' => 'Powrót do bloga',
// 'menu.choose_language' => 'Wybór języka',
// 'menu.homepage' => 'Strona główna',
// 'menu.logout' => 'Wyloguj się',
// 'menu.post_list' => 'Lista artykułów',
// 'menu.rss' => 'Blog kanał RSS',
// 'menu.search' => 'Szukaj',
// 'menu.toggle_nav' => 'Przełącz nawigację',
?>
</ul><hr />
<?= Yii::t('messages', 'menu.admin') ?>
<ul>
	<li><?= CHtml::link(Yii::t('messages', 'menu.homepage'), Yii::app()->homeUrl) ?></li>
	<li><?= CHtml::link(Yii::t('messages', 'menu.back_to_blog'), ['symfony/blog/index']) ?></li>
	<li><?= CHtml::link('<i class="fa fa-rss" aria-hidden="true"></i> '.Yii::t('messages', 'menu.rss'), ['symfony/blog/rss']) ?></li>
	<li><?= CHtml::link(Yii::t('messages', 'menu.search'), ['symfony/blog/search']) ?></li>
	<!-- <li><?= CHtml::link(Yii::t('messages', 'menu.choose_language'), ['merge({_locale: locale.code}))']) ?></li> -->
	<!-- <li><?= CHtml::link(Yii::t('messages', 'menu.toggle_nav'), ['//symfony/admin/blog']) ?></li> -->
	<!-- <li><?= CHtml::link(Yii::t('messages', 'menu.admin'), ['symfony/admin/blog/index']) ?></li> -->
	<li><?= CHtml::link(Yii::t('messages', 'menu.post_list'), ['symfony/admin/blog/index']) ?></li>
	<li><?= CHtml::link('<i class="fa fa-sign-in" aria-hidden="true"></i> '.Yii::t('messages', 'action.sign_in'), ['//symfony/admin/login']) ?></li>
	<li><?= CHtml::link('<i class="fa fa-sign-out" aria-hidden="true"></i> '.Yii::t('messages', 'menu.logout'), ['symfony/admin/logout']) ?></li>
</ul>
<?= $this->renderPartial('//blog/_rss.html.twig')?>