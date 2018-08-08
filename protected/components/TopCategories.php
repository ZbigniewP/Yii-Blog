<?php

Yii::import('zii.widgets.CPortlet');

class TopCategories extends CPortlet
{
	public $title = 'Categories';
	public $maxCategories = 10;

	public function getTopCategories()
	{
		switch (strtolower($this->owner->id)) {
			case 'postcake':
			case 'cakeposts':
				return CakeCategories::model()->findTopCategories($this->maxCategories);
			// case 'symfony/yiipost': return DemoTag::model()->findTopTags($this->maxCategories);
			// case 'post':
			// default: return Tag::model()->findTopTags($this->maxCategories);
		}
		// return [];
	}

	protected function renderContent()
	{
		$this->render('topCategories');
	}
}