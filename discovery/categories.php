<?php
include '../globalScripts/quizzyDatabase.php';

$quizzyDat = new quizzyDatabase();

$categories = $quizzyDat->getDiscoveryCategories();

$table = "";
foreach($categories as $category=>$subCats) {
	
	$table .= "<h1>".$category."</h1>";
	
	foreach ($subCats as $id=>$name) {
		$table .= '<a href="subCategory.php?id='.$id.'">'.urldecode($name).'</a></br>';
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
	<?= $table ?>
</br>
</div>

</br>

</br></br>

<input type="button" onclick="location.href='../index.php';" value="Return to home" />

</center>
</body>
</html>