<?php

class Slider extends CWidget
{
	public function run()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'visibility = 1';
		$criteria->order = 'sort_order';
		$criteria->limit = 16;

		$this->render('indexSlider',array(
			'slides'=>Slides::model()->findAll($criteria),
		));
	}
}