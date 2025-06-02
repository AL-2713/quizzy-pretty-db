<?php
include '../globalScripts/quizzyDatabase.php';

$quizzyDat = new quizzyDatabase();

$category = $quizzyDat->getDiscoveryIdCat($_GET['id']);

$i = 1;
while ($i <= 50) {
	$tablesArray .= '<div class="questionCircle"><a href="entry.php?subID='.$_GET['id'].'&question='.$i.'" class="circle">'.$i.'</a></div>';
	$i++;
}

?>
<html>
<body style="background-image: url('../images/common/quizzy.svg');">
<link rel="stylesheet" href="../css/quizzy.css"/>
<center><img src="../images/common/quizzy.png"/><img src="../images/common/QuestionCornerLogo.png"/></center>

<center>
<div class="headerMenu"><a href="../index.php">Home</a> <a href="../random/index.php">Random</a> <a href="../about.php">About</a></div></br>

<h1 class="titleText">Select a question</h1>
<div id="testBoard" >
	<h1><?= $category[0] ?> - <?= urldecode($category[2]) ?></h1>
	
	<?= $tablesArray ?>

</div>
</br></br>
<input type="button" onclick="location.href='categories.php';" value="Return to categories" /></br>

</center>
</body>
</html>