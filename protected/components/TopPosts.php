<?php

Yii::import('zii.widgets.CPortlet');

class TopPosts extends CPortlet
{
	public $title = 'Last posts';
	public $maxPosts = 10;

	public function getLastPosts()
	{
		switch (strtolower($this->owner->id)) {
			case 'postcake': case 'cakeposts':
				return CakePosts::model()->findLastPosts($this->maxPosts);
			// case 'symfony/yiipost': return DemoPost::model()->findLastPosts($this->maxPosts);
			// case 'post':
			// default: return Post::model()->findLastPosts($this->maxPosts);
		}
		// return [];
	}

	protected function renderContent()
	{
		$this->render('lastPosts');
	}
}