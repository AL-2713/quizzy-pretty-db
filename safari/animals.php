<?php
include '../globalScripts/quizzyDatabase.php';

$quizzyDat = new quizzyDatabase();

$animalDat = $quizzyDat->getSafariAnimals();

$tables = array();
foreach ($animalDat as $x) {
	$year = explode('-',$x['y'])[0];
	$animal = ucwords(str_replace('_',' ',$x['safari_name']));
	
	$tables[$year][] = '<a href="questions.php?safari_id='.$x['safari_id'].'">'.$animal.'</a></br>';
	
}

foreach ($tables as $year=>$dat) {
	$returnTable .= '<h1>'.$year.'</h1>';
	
	foreach ($dat as $item) {
		$returnTable .= $item;
	}
}


?>
<html>
<body style="background-image: url('../images/common/quizzy.svg');">
<link rel="stylesheet" href="../css/quizzy.css"/>
<center><img src="../images/common/quizzy.png"/><img src="../images/common/QuestionCornerLogo.png"/></center>

<center>
<div class="headerMenu"><a href="../index.php">Home</a> <a href="../random/index.php">Random</a> <a href="../about.php">About</a></div></br>

<div id="testBoard" >

	<?= $returnTable ?>
</br>
</div>

</br>

</br></br>

<input type="button" onclick="location.href='../index.php';" value="Return to home" />

</center>
</body>
</html>