<?php
include '../globalScripts/quizzyDatabase.php';
$quizzyDat = new quizzyDatabase();

$tables = array('calendar','discovery','learnPlay','safari');
$randomTable = $tables[rand(0,3)];

switch ($randomTable) {
	case 'calendar';
		$randDate = rand(strtotime("Jan 01 2005"),strtotime("Dec 31 2024"));
		$randFormat = date('Y-m-d',$randDate);
		
		$webpage = 'http://'.$_SERVER['HTTP_HOST'].'/calendar/questions.php?date='.$randFormat;

		break;
	case 'learnPlay':
		$randID = $quizzyDat->getRandomQuestion();
		$webpage = 'http://'.$_SERVER['HTTP_HOST'].'/learnPlay/answer.php?quid='.$randID;
		break;
		
	case 'safari':
		$randID = $quizzyDat->getRandomSafari();
		$webpage = 'http://'.$_SERVER['HTTP_HOST'].'/safari/entry.php?&quid='.$randID;
		break;
	
	case 'discovery':
		$webpage = 'http://'.$_SERVER['HTTP_HOST'].'/discovery/entry.php?subID='.rand(1,22).'&question='.rand(1,50);
		break;
		
}

die('<html><meta http-equiv="refresh" content="0;url='.$webpage.'"></html>');