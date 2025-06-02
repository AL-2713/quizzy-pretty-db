<?php
include '../globalScripts/quizzyDatabase.php';

$quid = $_GET['quid'];

$quizzyDat = new quizzyDatabase();
$qData = $quizzyDat->getSafariQuestion($quid);

$answers = json_decode($qData['answers'],true);

$nextQ = $quizzyDat->getNextSafari($qData['progress'],$qData['safari_id']) ?? $qData['quid'];
$prevQ = $quizzyDat->getNextSafari($qData['progress'],$qData['safari_id'], false) ?? $qData['quid'];


?>
<html>
<body style="background-image: url('../images/common/quizzy.svg');">
<link rel="stylesheet" href="../css/quizzy.css"/>
<center><img src="../images/common/quizzy.png"/><img src="../images/common/QuestionCornerLogo.png"/></center>
<center>
<div class="headerMenu"><a href="../index.php">Home</a> <a href="../random/index.php">Random</a> <a href="../about.php">About</a></div></br>
<img src="../images/modes/safari.png"/>
<div id="boardQuestion" >
<h3><?= ucwords(str_replace('_',' ',$qData['safari_name'])); ?> - Question <?= $qData['progress'] ?></h3>
<h1><?= $qData['q'] ?></h1>


<h2 class="correctAns">A: <?= $answers[1]['t'] ?></h2>
<h2>B: <?= $answers[2]['t'] ?></h2>
<h2>C: <?= $answers[3]['t'] ?></h2>
<h2>D: <?= $answers[4]['t'] ?></h2>

<h3>Hint: <?= $qData['h'] ?></h3>
<h3>Trivia: <?= $qData['ct'] ?></h3>


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
<tr><td>Question ID</td><td><?= $qData['quid'] ?></td></tr>
<tr><td>Date</td><td><?= $qData['y'] ?></td></tr>
<tr><td>Safari ID</td><td><?= $qData['safari_id'] ?></td></tr>
<tr><td>Safari Name</td><td><?= $qData['safari_name'] ?></td></tr>
<tr><td>Progress</td><td><?= $qData['progress'] ?></td></tr>

<tr><td></td><td></td></tr>
<tr><td>Question A ID</td><td><?= $answers[1]['id'] ?></td></tr>
<tr><td>Question B ID</td><td><?= $answers[2]['id'] ?></td></tr>
<tr><td>Question C ID</td><td><?= $answers[3]['id'] ?></td></tr>
<tr><td>Question D ID</td><td><?= $answers[4]['id'] ?></td></tr>
</table>
</div>
</br>
<a href="entry.php?quid=<?= $prevQ ?>" ><img src="../images/common/arrowLeft.png"/></a>
<a href="entry.php?quid=<?= $nextQ ?>" ><img src="../images/common/arrowRight.png"/></a>
</br></br>
<input type="button" onclick="location.href='questions.php?safari_id=<?= $qData['safari_id'] ?>';" value="Return to questions" />

</center>
</body>
</html>