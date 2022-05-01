<?php 

namespace App\Omure\Utils;

class DateUtil
{
	public static function validateDate($date, $format = 'Y-m-d H:i:s')
	{
	    $d = \DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) === $date;
	}

	public static function timestamp($date)
	{
		return strtotime($date);
	}
}