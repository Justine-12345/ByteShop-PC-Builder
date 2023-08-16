<?php
namespace App;
/**
 * 
 */
class Converter
{	


	public function translate($size){
		$converted = "";
		if ($size >= 1) {
			$converted = $size." GB";
		}
		elseif ($size == .5) {
			$converted = "520 MB";
		}
		elseif ($size == .25) {
			$converted = "256 MB";
		}
		elseif ($size == .125) {
			$converted = "128 MB";
		}
		if ($size >= 1000) {
			$terra =  $size/1000;
			$converted = $terra." TB";
		}

		return $converted;
	}

public static function translateS($size){
		$converted = "";
		if ($size >= 1) {
			$converted = $size." GB";
		}
		elseif ($size == .5) {
			$converted = "520 MB";
		}
		elseif ($size == .25) {
			$converted = "256 MB";
		}
		elseif ($size == .125) {
			$converted = "128 MB";
		}
		if ($size >= 1000) {
			$terra =  $size/1000;
			$converted = $terra." TB";
		}

		return $converted;
	}

	public static function thousand($thousand){
			$answer = 0;

		 	if($thousand >= 1000){
		 			$convert = $thousand/1000;
		 			$formated = number_format( $convert,1, ".","");
		 			$answer = $formated."K";
		 	}
		 	else{
		 		$answer = $thousand;
		 	}

		 	return $answer;

	}





}
  ?>