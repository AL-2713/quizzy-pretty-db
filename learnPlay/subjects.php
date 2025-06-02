<?php
include '../globalScripts/quizzyDatabase.php';

$quid = $_GET['quid'];

$quizzyDat = new quizzyDatabase();

$subjects = $quizzyDat->getSubjects();
$ageGroups = $quizzyDat->getAgeGroups();

$groupTable = "";
$subjTable = "";

foreach ($ageGroups as $g) {
	$groupTable .= "<th>$g</th>";
}
foreach ($subjects as $sid=>$s) {
	$subjDir = str_replace(' ','',$s);
	$subjDir = str_replace("'",'',$subjDir);
	
	$i = 1;
	$location = "";
	while ($i <= 6) {
		if ($sid >= 7) {
			if ($i == 6) {
				$location .= "<th><a href='questions.php?sj=$sid&g=$i'><img src='../images/subjects/$subjDir/1.png'/></a></th>";
			} else {
				$location .= "<th></th>";
			}
			
		} else if ($sid < 7) {
			if ($i != 6) {
				$location .= "<th><a href='questions.php?sj=$sid&g=$i'><img src='../images/subjects/$subjDir/$i.png'/></a></th>";
			} else {
				$location .= "<th></th>";
			}
		}
		
		$i++;
	}
	
	$subjTable .= "<tr><th>$s</th>$location</tr>";
}

?>
<html>
<body style="background-image: url('../images/common/quizzy.svg');">
<link rel="stylesheet" href="../css/quizzy.css"/>
<center><img src="../images/common/quizzy.png"/><img src="../images/common/QuestionCornerLogo.png"/></center>
<style>

table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;
}

</style>
<center>
<div class="headerMenu"><a href="../index.php">Home</a> <a href="../random/index.php">Random</a> <a href="../about.php">About</a></div></br>
<h1 class="titleText">Choose an age group and subject!</h1>
<div id="testBoard" >
<table id="testBoard">
	<tr>
		<th> </th>
		<?= $groupTable ?>
	</tr>
		<?= $subjTable ?>
</table>
</div>
</br></br>
<input type="button" onclick="location.href='../index.php';" value="Return to home" /></br>

</center>
</body>
</html>