<?php
include '../globalScripts/quizzyDatabase.php';

$subject = $_GET['sj'];
$group = $_GET['g'];

$quizzyDat = new quizzyDatabase();

$questions = $quizzyDat->getQuestionList($subject,$group);

$subjName = $quizzyDat->getSubjects()[$subject];
$ageName = $quizzyDat->getAgeGroups()[$group];

$subjDir = $quizzyDat->getSubjects()[$subject];
$subjDir = str_replace(' ','',$subjDir);
$subjDir = str_replace("'",'',$subjDir);


$tablesArray = array();
foreach ($questions as $x) {
	$tablesArray[$x['s']] .= '<div class="questionCircle"><a href="answer.php?quid='.$x['quid'].'" class="circle">'.$x['n'].'</a></div>';
	
}
$tableDat = "";
foreach ($tablesArray as $series=>$data) {
	$tableDat .= '<table><h2 class="seriesHead">Series '.$series.'</h2>'.$data.'</table>';
	
}

if ($subject > 6) {
	$group = 1;
}

?>
<html>
<body style="background-image: url('../images/common/quizzy.svg');">
<link rel="stylesheet" href="../css/quizzy.css"/>
<center><img src="../images/common/quizzy.png"/><img src="../images/common/QuestionCornerLogo.png"/></center>
<center>
<div class="headerMenu"><a href="../index.php">Home</a> <a href="../random/index.php">Random</a> <a href="../about.php">About</a></div></br>
<img src='../images/subjects/<?= $subjDir ?>/<?= $group ?>.png'/>
<h1 class="titleText"><?= $ageName ?> : <?= $subjName ?></h1>
<h1 class="titleText">Select a question</h1>
<div id="testBoard" >
	
  <?= $tableDat ?>

</div>
</br></br>
<input type="button" onclick="location.href='subjects.php';" value="Return to home" /></br>

</center>
</body>
</html>