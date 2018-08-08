<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<rss version="2.0">
	<channel>
		<title><?= Yii::t('messages', 'rss.title') ?></title>
		<description><?= Yii::t('messages', 'rss.description') ?></description>
		<pubDate><?= CTimestamp::formatDate('d-M-Y H:i:s T') ?>|date('r', timezone='GMT') }}</pubDate>
		<lastBuildDate>{{ (posts|last).publishedAt|default('now')|date('r', timezone='GMT') }}</lastBuildDate>
		<link><?= Yii::app()->createUrl('index') ?></link>
		<language><?= Yii::app()->getLanguage() ?></language>

		<?php foreach ($posts as $post) : ?>
			<item>
				<title><?= $post->title ?></title>
				<description><?= $post->summary ?></description>
				<link><?= Yii::app()->createUrl('symfony/post/show', ['slug' => $post->slug]) ?></link>
				<guid><?= Yii::app()->createUrl('symfony/post/show', ['slug' => $post->slug]) ?></guid>
				<pubDate><?= CTimestamp::formatDate('d-M-Y H:i:s T', strtotime($post->publishedAt)) ?></pubDate>
				<author><?= $post->author->email ?></author>
				<?php foreach ($post->symfonyDemoTags as $tag) : ?>
					<category><?= $tag->name ?></category>
				<?php endforeach; ?>
			</item>
		<?php endforeach; ?>
	</channel>
</rss>
