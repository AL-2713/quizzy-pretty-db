<?php
include '../globalScripts/quizzyDatabase.php';

$quizzyDat = new quizzyDatabase();

$qData = $quizzyDat->getDiscoveryQuestion($_GET['subID'], $_GET['question']);

$answers = str_replace("\n",'',$qData['answers']);
$answers = json_decode($answers,true);

$category = $quizzyDat->getDiscoveryIdCat($_GET['subID']);

$nextQ = $_GET['question'] + 1;
$prevQ = $_GET['question'] - 1;

if ($nextQ > 50) {
	$nextQ = 50;

} elseif ($prevQ < 1) {
	$prevQ = 1;
}

?>
<html>
<body style="background-image: url('../images/common/quizzy.svg');">
<link rel="stylesheet" href="../css/quizzy.css"/>
<center><img src="../images/common/quizzy.png"/><img src="../images/common/QuestionCornerLogo.png"/></center>
<center>
<div class="headerMenu"><a href="../index.php">Home</a> <a href="../random/index.php">Random</a> <a href="../about.php">About</a></div></br>
<img src="../images/modes/discovery.png"/>
<div id="boardQuestion" >

<h3><?= $category[0] ?> - <?= urldecode($category[2]) ?> - Question <?= $_GET['question'] ?></h3>
<h1><?= $qData['question'] ?></h1>


<h2 class="correctAns">A: <?= $answers[1]['answer'] ?></h2>
<h2>B: <?= $answers[2]['answer'] ?></h2>
<h2>C: <?= $answers[3]['answer'] ?></h2>
<h2>D: <?= $answers[4]['answer'] ?></h2>

<h3>Hint: <?= $qData['hint'] ?></h3>
<h3>Trivia: <?= $qData['comment'] ?></h3>


<script>

function toggleMetadata() {
  var x = document.getElementById("metaTable");
  if (x.style.display === "inline") {
    x.style.display = "none";
  } else {
    x.style.display = "inline";
  }
}

</script>

<button onclick="toggleMetadata()">Question Metadata</button></br>

<table hidden id="metaTable">
<tr><td>subCategoryID</td><td><?= $category[1] ?></td></tr>
<tr><td>subCategory</td><td><?= $category[2] ?></td></tr>
<tr><td>Category</td><td><?= $category[0] ?></td></tr>
<tr><td>Question</td><td><?= $_GET['question'] ?></td></tr>

<tr><td></td><td></td></tr>

</table>
</div>
</br>
<a href="entry.php?subID=<?= $_GET['subID'] ?>&question=<?= $prevQ ?>" ><img src="../images/common/arrowLeft.png"/></a>
<a href="entry.php?subID=<?= $_GET['subID'] ?>&question=<?= $nextQ ?>" ><img src="../images/common/arrowRight.png"/></a>
</br></br>
<input type="button" onclick="location.href='subCategory.php?id=<?= $_GET['subID'] ?>';" value="Return to questions" />

</center>
</body>
</html>