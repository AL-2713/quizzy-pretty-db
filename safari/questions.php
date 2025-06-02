<?php
include '../globalScripts/quizzyDatabase.php';

$quizzyDat = new quizzyDatabase();


$questions = $quizzyDat->getSafariList($_GET['safari_id']);

$animal = ucwords(str_replace('_',' ',$questions[0]['safari_name']));

$i = 1;
foreach ($questions as $x) {
	$tablesArray .= '<div class="questionCircle"><a href="entry.php?quid='.$x['quid'].'" class="circle">'.$i.'</a></div>';
	$i++;
}

?>
<html>
<body style="background-image: url('../images/common/quizzy.svg');">
<link rel="stylesheet" href="../css/quizzy.css"/>
<center><img src="../images/common/quizzy.png"/><img src="../images/common/QuestionCornerLogo.png"/></center>

<center>
<div class="headerMenu"><a href="../index.php">Home</a> <a href="../random/index.php">Random</a> <a href="../about.php">About</a></div></br>
<img src='../images/safari/<?= $questions[0]['safari_name'] ?>.png'/>
<h1 class="titleText"><?= $animal ?></h1>
<h1 class="titleText">Select a question</h1>
<div id="testBoard" >
	
	<?= $tablesArray ?>

</div>
</br></br>
<input type="button" onclick="location.href='animals.php';" value="Return to animals" /></br>

</center>
</body>
</html>