<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Form;

class FormSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = getNow();
		Form::truncate(); // 既存データを削除する
		Form::insert(array(
			array('userIp' => '127.0.0.1', 'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36', 'id' => '1','gender' => '男','age' => '10代','pref' => '沖縄県','facilitys' => '["24時間対応","駐車場"]','author' => 'MASTER','created_at' => '2021-10-05 05:29:15','updated_at' => '2021-10-07 05:29:15'),
			array('userIp' => '127.0.0.1', 'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36', 'id' => '2','gender' => '女','age' => '20代','pref' => '鹿児島県','facilitys' => '["24時間対応"]','author' => 'MASTER','created_at' => '2021-10-06 05:29:15','updated_at' => '2021-10-07 05:29:15'),
			array('userIp' => '127.0.0.1', 'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36', 'id' => '3','gender' => '男','age' => '70代以上','pref' => '青森県','facilitys' => '["24時間対応","コンビニ"]','author' => 'MASTER','created_at' => '2021-10-07 05:29:30','updated_at' => '2021-10-07 05:29:30'),
			array('userIp' => '127.0.0.1', 'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36', 'id' => '4','gender' => '男','age' => '30代','pref' => '山形県','facilitys' => '["駐車場"]','author' => 'MASTER','created_at' => '2021-10-07 05:38:06','updated_at' => '2021-10-07 05:38:06'),
			array('userIp' => '127.0.0.1', 'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36', 'id' => '5','gender' => '女','age' => '40代','pref' => '長野県','facilitys' => '["24時間対応"]','author' => 'Manager','created_at' => '2021-10-07 19:23:48','updated_at' => '2021-10-07 19:23:48'),
			array('userIp' => '127.0.0.1', 'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36', 'id' => '6','gender' => '男','age' => '10代','pref' => '福井県','facilitys' => '["駐車場","コンビニ","24時間対応"]','author' => 'MASTER','created_at' => '2021-10-07 19:25:33','updated_at' => '2021-10-07 19:25:33'),
			array('userIp' => '127.0.0.1', 'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36', 'id' => '7','gender' => '女','age' => '30代','pref' => '福井県','facilitys' => '["24時間対応"]','author' => 'Manager','created_at' => '2021-10-07 19:28:04','updated_at' => '2021-10-07 19:28:04'),
			array('userIp' => '127.0.0.1', 'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36', 'id' => '8','gender' => '男','age' => '60代','pref' => '福井県','facilitys' => '["駐車場"]','author' => 'MASTER','created_at' => '2021-10-07 19:30:52','updated_at' => '2021-10-07 19:30:52'),
			array('userIp' => '127.0.0.1', 'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36', 'id' => '9','gender' => '女','age' => '30代','pref' => '群馬県','facilitys' => '["駐車場","24時間対応"]','author' => 'Manager','created_at' => '2021-10-07 19:34:52','updated_at' => '2021-10-07 19:34:52'),
			array('userIp' => '127.0.0.1', 'userAgent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36', 'id' => '10','gender' => '女','age' => '30代','pref' => '富山県','facilitys' => '["駐車場"]','author' => 'guest','created_at' => '2021-10-07 22:52:01','updated_at' => '2021-10-07 22:52:01')
		));
	}
}
