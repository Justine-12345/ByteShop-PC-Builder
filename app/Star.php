<?php
namespace App;
/**
 * 
 */
class Star
{
	public static function display($number)
	{
		$result = "";

		if($number <= 0 ){
			$result = <<<HTML
				No Ratings
			HTML;
		}
		if($number == "" ){
			$result = <<<HTML
				No Ratings
			HTML;
		}
		if($number == null ){
			$result = <<<HTML
				No Ratings
			HTML;
		}



		if( $number > 0 && $number <= 1){
			$result = <<<HTML
				<i class="fas fa-star"></i>
				<i class="far fa-star"></i>
				<i class="far fa-star"></i>
				<i class="far fa-star"></i>
				<i class="far fa-star"></i>
			HTML;
		}

		if( $number > 1 && $number <= 1.9){
			$result = <<<HTML
				<i class="fas fa-star"></i>
				<i class="fas fa-star-half-alt"></i>
				<i class="far fa-star"></i>
				<i class="far fa-star"></i>
				<i class="far fa-star"></i>
			HTML;
		}

		if( $number > 1.9 && $number <= 2.4){
			$result = <<<HTML
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="far fa-star"></i>
				<i class="far fa-star"></i>
				<i class="far fa-star"></i>
			HTML;
		}

		if( $number > 2.4 && $number <= 2.9){
			$result = <<<HTML
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star-half-alt"></i>
				<i class="far fa-star"></i>
				<i class="far fa-star"></i>
			HTML;
		}

		if( $number > 2.9 && $number <= 3.4){
			$result = <<<HTML
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="far fa-star"></i>
				<i class="far fa-star"></i>
			HTML;
		}
		if( $number > 3.4 && $number <= 3.9){
			$result = <<<HTML
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star-half-alt"></i>
				<i class="far fa-star"></i>
			HTML;
		}
		if( $number > 3.9 && $number <= 4.4){
			$result = <<<HTML
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="far fa-star"></i>
			HTML;
		}
		if( $number > 4.4 && $number <= 4.7){
			$result = <<<HTML
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star-half-alt"></i>
			HTML;
		}

		if( $number > 4.7){
			$result = <<<HTML
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
			HTML;
		}



		
		return $result;


	}
}
?>