<?php
namespace models;
use PDO;
use components\DB;

class News
{

	public static function getNewsItemById($id)
	{
		$id = intval($id);

		$db = DB::getConnection();

		$result = $db->query('SELECT * FROM news WHERE id='.$id);

		$newsItem = $result->fetch(PDO::FETCH_ASSOC);

		return $newsItem;
	}

	public static function getNewsList()
	{

		$db = DB::getConnection();


		$newsList = array();

		$result = $db->query('SELECT * FROM news
			ORDER BY id DESC
			LIMIT 10');

		$i = 0;
		while($row = $result->fetch())
		{
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['title'] = $row['title'];
			$newsList[$i]['date'] = $row['date'];
			$newsList[$i]['short_content'] = $row['short_content'];
			$newsList[$i]['author_name'] = $row['author_name'];
			$i++;
		}

		return $newsList;
	}
}