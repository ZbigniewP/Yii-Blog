<?php

Yii::import('zii.widgets.CPortlet');

class RecentComments extends CPortlet
{
	public $title = 'Recent Comments';
	public $maxComments = 10;

	public function getRecentComments()
	{
		switch ($this->owner->id) {
			case 'cakeposts': return CakeComments::model()->findRecentComments($this->maxComments);
			case 'demopost': return DemoComment::model()->findRecentComments($this->maxComments);
			case 'post':
			default: return Comment::model()->findRecentComments($this->maxComments);
		}
	}

	protected function renderContent()
	{
		$this->render('recentComments');
	}
}