<?php

	class GetWeather {
		
		const APIURL = 'http://weather.yahooapis.com/forecastrss';
		const WTHRGX = '/<yweather:condition  text="[a-z\s]+"  code="([0-9]+)"  temp="([0-9]+)" (.*)/is';
		const RELOAD = 1800; // 30 mins
	
		private $loc, $deg, $res;
		public $cache;
	
		public function __construct($loc, $deg) {
			$this->loc   = $this->safe($this->to_loc($loc));
			print $this->loc;
			$this->deg   = $this->safe(strtolower($deg));
			$this->cache = './cache/' . $this->deg . strtolower($this->loc);
		}
	
		public function get_degree() {
			if(file_exists($this->cache) && filemtime($this->cache) > (time()-self::RELOAD)) {
				return file_get_contents($this->cache);
			} else {
				$xml = $this->do_request(self::APIURL . '?p=' . $this->loc . '&u=' . $this->deg);
				preg_match(self::WTHRGX, $xml, $matches);
				return $this->res = isset($matches[2])? $matches[2] : null;
			}
		}

		private function do_request($url) {
			$curl = curl_init($url);
		
			// setopt
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_USERAGENT, 'iPhone Background Weather (sjaq.eu v1)');
		
			$data = curl_exec($curl);
			curl_close($curl);
			return $data;
		}
	
		private function to_loc($loc) {
			$loc = str_replace('_c', '', $loc);
			$loc = str_replace('http://weather.yahoo.com/forecast/', '', $loc);
			$loc = str_replace('.html', '', $loc);
			
			return $loc;
		}
	
		private function safe($str) {
			return preg_replace('/[\W]+/', '', $str);
		}
	}

?>