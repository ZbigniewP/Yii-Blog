<?php

Yii::import('zii.widgets.CPortlet');

class TagCloud extends CPortlet
{
	public $title = 'Tags';
	public $maxTags = 20;

	protected function renderContent()
	{
// echo "<pre>";
// print_r([$this->owner->pageTitle, $this->owner->id, $this->owner]);
// echo "</pre>";
// exit();
		switch ($this->owner->id) {
			case 'cakeposts':
				$tags = CakeCategories::model()->findCategoriesWeights($this->maxTags);
				break;
			case 'symfony/yiipost': case 'symfony/admin/blog':
				$tags = DemoTag::model()->findTagWeights($this->maxTags);
				// $tags=DemoPostTag::model()->findTagWeights($this->maxTags);
				break;
			case 'comment':
			default:
				$tags = Tag::model()->findTagWeights($this->maxTags);
				break;
		}

		foreach ($tags as $tag => $weight) {
			switch ($this->owner->id) {
				case 'cakeposts':
					$link = CHtml::link(CHtml::encode($tag), ['cakeposts/index', 'tag' => $weight[0]]);
					$weight = $weight[1];
					break;
				case 'symfony/yiipost': case 'symfony/admin/blog':
					$link = CHtml::link(CHtml::encode($tag), ['symfony/yiipost/index', 'tag' => $tag]);
					break;
				case 'comment':
				default:
					$link = CHtml::link(CHtml::encode($tag), ['post/index', 'tag' => $tag]);
					break;
			}
			// $this->owner->layout=='column2'
			echo CHtml::tag('span', ['class' => 'tag', 'style' => "font-size:{$weight}pt"], $link) . "\n";
		}
	}
}