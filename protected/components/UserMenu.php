<?php

Yii::import('zii.widgets.CPortlet');

class UserMenu extends CPortlet
{
	public function init()
	{
		$this->title = CHtml::encode(Yii::app()->user->name);
		parent::init();
	}

	protected function renderContent()
	{
		switch ($this->owner->id) {
			case 'cakeposts':
			case 'cakecomments':
				$this->render('cakeUserMenu');
				break;
			case 'demopost':
				$this->render('symfonyUserMenu');
				break;
			case 'comment':
			default:
				$this->render('userMenu');
				break;
		}
	}
}