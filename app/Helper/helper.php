<?php

function attributes()
{
	return array('XXS','XS','S','M','L','XL','XXL','XXXL');
}

function str_randoms($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function order_date($date)
{
	$arr = explode(' ', $date);
	$correction = $date;
	if(count($arr) == 3)
	{
		$ex = explode("-", $arr[0]);
		$correction = $ex[2].'-'.$ex[0].'-'.$ex[1].' '.$arr[1].' '.$arr[2];
	}
	return $correction;
}

function date_norm($date = '0000-00-00', $format = 'Y-m-d')
{
	return date($format, strtotime($date));
}

function date_alter($date_raw, $alter = '-1 day')
{
	return date('Y-m-d', strtotime($alter, strtotime($date_raw)));
}