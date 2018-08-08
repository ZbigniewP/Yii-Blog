<?php
Yii::app()->format->dateFormat = 'long';
Yii::app()->format->timeFormat = 'medium';
// Yii::app()->language = 'pl';
?>
<!-- {% extends 'base.html.twig' %} -->
<!-- {% block body_id 'blog-show' %} -->

<!-- {% block main %} -->
	<h1><?= $post->title ?></h1>
	<p class="post-metadata">
		<span class="metadata"><i class="fa fa-calendar"></i> <?= Yii::app()->format->datetime($post->publishedAt) ?></span>
		<span class="metadata"><i class="fa fa-user"></i> <?= $post->author->fullName ?></span>
	</p>
<?php
// |md2html
$this->beginWidget('CMarkdown', ['purifyOutput' => true]);
	// echo $this->Text->truncate($post->content, 450, ['ellipsis' => '...', 'exact' => false]);
	echo $post->content;
$this->endWidget();
?>
	<?= $this->renderPartial('//blog/_post_tags.html.twig', ['tags' => $post->symfonyDemoTags]) ?>

	<div id="post-add-comment" class="well">
		<!-- {# The 'IS_AUTHENTICATED_FULLY' role ensures that the user has entered
		his/her credentials (login + password) during this session. If he/she
		is automatically logged via the 'Remember Me' functionality, he/she won't
		be able to add a comment.
		See https://symfony.com/doc/current/cookbook/security/remember_me.html#forcing-the-user-to-re-authenticate-before-accessing-certain-resources
		#} -->
		<?php 
		// if is_granted('IS_AUTHENTICATED_FULLY')):
		if(!Yii::app()->user->isGuest):
			$this->commentForm();
		?>
			<!-- {{ render(controller('AppBundle:Blog:commentForm', ['id'=> $post->id])) }} -->
		<?php else: ?>
			<p>
				<a class="btn btn-success" href="<?= Yii::app()->createUrl('symfony/admin/login') ?>">
					<i class="fa fa-sign-in" aria-hidden="true"></i> <?= Yii::t('messages', 'action.sign_in') ?>
				</a>
				<?= Yii::t('messages', 'post.to_publish_a_comment') ?>
			</p>
		<?php endif; ?>
	</div>
<?php
Yii::app()->format->dateFormat = 'short';
Yii::app()->format->timeFormat = 'short';
// |transchoice(post.comments|length)
$post_num_comments = null;
$data = explode('|', Yii::t('messages', 'post.num_comments', ['%count%' => count($post->comments) ]));
if (isset($data[1])&&count($post->comments) >= 2) $post_num_comments = $data[1];
if (isset($data[2])&&count($post->comments) > 3) $post_num_comments = $data[2];
if (count($post->comments) <= 1) $post_num_comments = $data[0];
?>
	<h3>
		<i class="fa fa-comments" aria-hidden="true"></i> <?= $post_num_comments ?>
	</h3>
<?php if(count($post->comments)): ?>
	<?php foreach($post->comments as $comment ): ?>
		<div class="row post-comment">
			<a name="comment_<?= $comment->id?>"></a>
			<h4 class="col-sm-3">
				<strong><?= $comment->author->fullName ?></strong> <?= Yii::t('messages', 'post.commented_on') ?>
				<!-- {# it's not mandatory to set the timezone in localizeddate(). This is done to
				   avoid errors when the 'intl' PHP extension is not available and the application
				   is forced to use the limited "intl polyfill", which only supports UTC and GMT #} -->
				<strong><?= Yii::app()->format->datetime($comment->publishedAt) ?></strong>
			</h4>
			<div class="col-sm-9">
<?php
// |md2html
$this->beginWidget('CMarkdown', ['purifyOutput' => true]);
	// echo $this->Text->truncate($post->content, 450, ['ellipsis' => '...', 'exact' => false]);
	echo $comment->content;
$this->endWidget();
?>
			</div>
		</div>
	<?php endforeach; ?>
<?php else: ?>
	<div class="post-comment">
		<p><?= Yii::t('messages', 'post.no_comments') ?></p>
	</div>
<?php endif; ?>
<!-- {% endblock %} -->

<!-- {% block sidebar %} -->
	<?php 
		// if is_granted('IS_AUTHENTICATED_FULLY')):
		// {% if is_granted('edit', post) %}
		if(!Yii::app()->user->isGuest):
		?>
		<div class="section">
			<a class="btn btn-lg btn-block btn-success" href="<?= Yii::app()->createUrl('symfony/admin/post/edit', ['id'=>$post->id]) ?>">
				<i class="fa fa-edit" aria-hidden="true"></i> <?= Yii::t('messages', 'action.edit_post') ?>
			</a>
		</div>
	<?php endif; ?>
	<!-- {# the parent() function includes the contents defined by the parent template
	  ('base.html.twig') for this block ('sidebar'). This is a very convenient way
	  to share common contents in different templates #} -->
	<!-- {{ parent() }} -->
	<!-- {{ show_source_code(_self) }} -->
	<?= $this->renderPartial('//blog/_rss.html.twig')?>
<!-- {% endblock %} -->
