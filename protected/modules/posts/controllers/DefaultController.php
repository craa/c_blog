<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
        $this->layout = '//layouts/main';
		$this->render('index');
	}
}