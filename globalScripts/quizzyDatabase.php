<?php

class quizzyDatabase {

	private function connectDB($query) {
		$dbName = 'quizzyPretty.db';
		
		$db = new PDO('sqlite:../' . $dbName);
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_NAMED);
		return $result;
	}
	
	// Redirect to error page upon error
	function errorRedirect() {
		header('Location:http://'.$_SERVER['HTTP_HOST'].'/404.php');
		die;
	}
	
	// Checks if input is an integer
	private function varTypeCheck($var) {

		if (gettype((int)$var) != 'string' && (int)$var == 0) {
			$this->errorRedirect();
		}
	}
	
	private function decodeData($questionDat) {
		$decoded = $questionDat;
		foreach ($decoded as $x=>$y) {
			$decoded[$x] = urldecode($y);
		}
		return $decoded;
	}
	
	
	// Calendar function
	
	function getCalendarQuestion($date) {
		$YMD = explode('-',$date);
		
		$i = 0;
		foreach ($YMD as $x) {
			$this->varTypeCheck($x);
			
			// Trim leading zeros
			if ($x[0] == 0) {
				$YMD[$i] = substr($x,1);
			}
			$i++;
		}
		
		$query = 'SELECT * FROM calendar WHERE y="'.$YMD[0].'" AND m="'.$YMD[1].'" AND n="'.$YMD[2].'"';
		$data = $this->connectDB($query)[0] ?? $this->errorRedirect();
		return $this->decodeData($data);
		
	}
	
	
	// Learn and Play functions
	
	function getQuestion($quid) {
		$this->varTypeCheck($quid);
		
		$query = 'SELECT * FROM learnPlay WHERE quid="'.$quid.'"';
		
		$data = $this->connectDB($query)[0] ?? $this->errorRedirect();
		
		return $this->decodeData($data);
		
	}
	
	function getNextQuestion($quid) {
		$this->varTypeCheck($quid);
		
		$currentMeta = $this->getQuestion($quid);
		
		$n = $currentMeta['n'] + 1;
		$s = $currentMeta['s'];
		if ($n > 50) {
			$n = 1;
			$s++;
		}
		
		$nextQuestion = $this->connectDB('SELECT * FROM learnPlay WHERE sj="'.$currentMeta['sj'].'" AND n="'.$n.'" AND s="'.$s.'" AND g="'.$currentMeta['g'].'"')[0]['quid'] ?? $quid;
		
		return $nextQuestion;
		
	}
	
	function getPreviousQuestion($quid) {
		$this->varTypeCheck($quid);
		
		$currentMeta = $this->getQuestion($quid);
		$n = $currentMeta['n'] - 1;
		$s = $currentMeta['s'];
		
		if ($n < 1) {
			$n = 50;
			$s = $s - 1;
		}
		
		$prevQuestion = $this->connectDB('SELECT * FROM learnPlay WHERE sj="'.$currentMeta['sj'].'" AND n="'.$n.'" AND s="'.$s.'" AND g="'.$currentMeta['g'].'"')[0]['quid'] ?? $quid;
		
		return $prevQuestion;
		
	}
	
	function getQuestionList($subject, $group) {
		$this->varTypeCheck($subject);
		$this->varTypeCheck($group);
		
		$query = 'SELECT quid,s,n FROM learnPlay WHERE sj="'.$subject.'" AND g="'.$group.'" ORDER BY n';

		$data = $this->connectDB($query) ?? null;
		$errorCheck = $data[0] ?? $this->errorRedirect();
		
		return $data;
		
	}
	
	function getRandomQuestion() {
		$query = 'SELECT quid FROM learnPlay ORDER BY RANDOM() LIMIT 1';
		return $this->connectDB($query)[0]['quid'];
	}
	
	
	
	
	// Safari functions
	
	function getSafariAnimals() {
		$query = 'SELECT DISTINCT y,safari_id,safari_name FROM safari';
		return $this->connectDB($query);
	}
	
	function getSafariList($safari_id) {
		$this->varTypeCheck($safari_id);
		
		$query = 'SELECT * FROM safari WHERE safari_id="'.$safari_id.'"';
		return $this->connectDB($query);
		
	}
	
	function getSafariQuestion($quid) {
		$this->varTypeCheck($quid);
		$query = 'SELECT * FROM safari WHERE quid="'.$quid.'"';
		
		$data = $this->connectDB($query)[0] ?? $this->errorRedirect();
		
		return $this->decodeData($data);
		
	}
	
	function getNextSafari($progress, $safari_id, $next = true) {
		$this->varTypeCheck($progress);
		$this->varTypeCheck($safari_id);
		
		switch($next) {
			case true:
				$nextProgress = $progress + 1;
				break;
			case false:
				$nextProgress = $progress - 1;
				break;
		}
		
		if ($nextProgress > 30 || $nextProgress < 1) {
			return null;
		}
		
		return $this->connectDB('SELECT quid FROM safari WHERE progress="'.$nextProgress.'" AND safari_id="'.$safari_id.'"')[0]['quid'];
		
	}
	
	function getRandomSafari() {
		$query = 'SELECT quid FROM safari ORDER BY RANDOM() LIMIT 1';
		return $this->connectDB($query)[0]['quid'];
	}
	
	
	
	// Discovery functions
	
	function getDiscoveryIdCat($id) {
		$this->varTypeCheck($id);
		
		$categoryArray = $this->getDiscoveryCategories();
		
		foreach ($categoryArray as $category=>$subCats) {
			foreach ($subCats as $catID=>$subName) {
				if ($catID == $id) {
					return array($category,$catID,$subName);
				}
			}
		}
		$this->errorRedirect();
	}
	
	function getDiscoveryQuestion($subCategory, $question) {
		$this->varTypeCheck($subCategory);
		$this->varTypeCheck($question);
		
		if ($subCategory < 1 || $subCategory > 22) {
			$this->errorRedirect();
		}
		if ($question < 1 || $question > 50) {
			$this->errorRedirect();
		}
		
		$query = 'SELECT * FROM discovery WHERE subCategory="'.$subCategory.'" AND questionNumber="'.$question.'"';
		$data = $this->connectDB($query)[0] ?? $this->errorRedirect();
		
		return $this->decodeData($data);
		
	}
	
	
	// Static funcitons
	
	function getSubjects() {
		return array('1'=>'Math','2'=>'Language','3'=>'Social Studies','4'=>'The Arts','5'=>'Science','6'=>'Health','7'=>'Kid\'s World','8'=>'Pop Culture','9'=>'Animals','10'=>'Sports','11'=>'Fun Facts','12'=>'Green Thumb','13'=>'The Environment');
	}
	
	function getAgeGroups() {
		return array ('1'=>'Ages 5-6', '2'=>'Ages 7-8', '3'=>'Ages 9-10', '4'=>'Ages 11-12', '5'=>'Ages 13+', '6'=>'Everyone');
	}
	
	function getDiscoveryCategories() {
		return json_decode(file_get_contents('../globalScripts/discoveryCategories.json'),true);
	}

}