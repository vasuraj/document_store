	<?php 	
	// namespace App\Http;

 	class Helpers {

 		public static function mysql_to_php_date_and_time($mysql_date=null)
        {
        	$date_and_time=new stdClass();
	        $date_time=explode(" ", $mysql_date);

			$date_and_time->date=$date_time[0];
			$date_and_time->time=$date_time[1];
			
			return $date_and_time;

        }

        public static function extract_date($string_date)
        {
        	
        	$string_date=explode('-',$string_date);
			
			$date=new stdClass();

			$date->year=$string_date[0];
			$date->month=$string_date[1];
			$date->day=$string_date[2];
			
			return $date;
		

        }

        public static function get_months_between_dates($date1,$date2)
        {
        	
        	$ts1 = strtotime($date1);
			$ts2 = strtotime($date2);

			$year1 = date('Y', $ts1);
			$year2 = date('Y', $ts2);

			$month1 = date('m', $ts1);
			$month2 = date('m', $ts2);

			$diff = (($year2 - $year1) * 12) + ($month2 - $month1);

			return $diff;

        }
 	



 	}
	


?>