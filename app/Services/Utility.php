<?php

namespace App\Services;

use Illuminate\Support\Facades\Schema;
/**
 *
 */
class Utility
{

		public static function generator($length = 20)
		{
			$char = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			$random = '';

			for ($i=0; $i < $length; $i++) {
				# code...
				$index = rand(0, strlen($char) - 1);
				$random .=$char[$index];
			}
			return $random;
		}

		public static function generateInteger($length = 6)
		{
			$char = '0123456789';
			$random = '';

			for ($i=0; $i < $length; $i++) {
				# code...
				$index = rand(0, strlen($char) - 1);
				$random .=$char[$index];
			}
			return $random;
		}

	public static function alpha($elem)
	{
		return preg_replace('/[^a-zA-Z ]/', '', strip_tags(trim($elem)));
	}
	public static function alphanumeric($elem)
	{
		return preg_replace('/[^a-zA-Z0-9, ]/', '', strip_tags(trim($elem)));
	}
	public static function numeric($elem)
	{
		return preg_replace('/[^0-9]/', '', strip_tags(trim($elem)));
	}

}
