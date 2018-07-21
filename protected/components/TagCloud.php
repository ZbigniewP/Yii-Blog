<?php

Yii::import('zii.widgets.CPortlet');

class TagCloud extends CPortlet
{
	public $title = 'Tags';
	public $maxTags = 20;

	protected function renderContent()
	{
// echo "<pre>";
// print_r($this->owner->id);
// echo "</pre>";
// exit();
		switch ($this->owner->id) {
			case 'cakeposts':
				$tags = CakeCategories::model()->findCategoriesWeights($this->maxTags);
				break;
			case 'demopost':
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
					$link = CHtml::link(CHtml::encode($tag), array('cakeposts/index', 'tag' => $weight[0]));
					$weight = $weight[1];
					break;
				case 'demopost':
					$link = CHtml::link(CHtml::encode($tag), array('demopost/index', 'tag' => $tag));
					break;
				case 'comment':
				default:
					$link = CHtml::link(CHtml::encode($tag), array('post/index', 'tag' => $tag));
					break;
			}
			echo CHtml::tag('span', array('class' => 'tag', 'style' => "font-size:{$weight}pt", ), $link) . "\n";
		}
	}
}