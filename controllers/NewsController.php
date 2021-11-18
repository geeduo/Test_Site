<?php
namespace controllers;
use models\News;


class NewsController
{
	public function actionIndex()
	{
		$newsList = array();
		$newsList = News::getNewsList();
		require_once 'views/news/index.php';

	}

	public function actionView($id)
	{
		if ($id)
		{
			$newsItem = News::getNewsItemById($id);
			require_once 'views/news/view.php';

		}
	}
}