<?php
include '../globalScripts/quizzyDatabase.php';

$quid = $_GET['quid'];

$quizzyDat = new quizzyDatabase();
$qData = $quizzyDat->getQuestion($quid);

$answers = json_decode($qData['answers'],true);
$subject = $quizzyDat->getSubjects()[$qData['sj']];
$ageGroup = $quizzyDat->getAgeGroups()[$qData['g']];

$nextQ = $quizzyDat->getNextQuestion($quid);
$prevQ = $quizzyDat->getPreviousQuestion($quid);

?>
<html>
<body style="background-image: url('../images/common/quizzy.svg');">
<link rel="stylesheet" href="../css/quizzy.css"/>
<center><img src="../images/common/quizzy.png"/><img src="../images/common/QuestionCornerLogo.png"/></center>
<center>
<div class="headerMenu"><a href="../index.php">Home</a> <a href="../random/index.php">Random</a> <a href="../about.php">About</a></div></br>
<img src="../images/modes/learnPlay.png"/>
<div id="boardQuestion" >
<h3><?= $ageGroup ?> - <?= $subject ?> - Series <?= $qData['s'] ?> - Question <?= $qData['n'] ?></h3>
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
<tr><td>Subject ID</td><td><?= $qData['sj'] ?></td></tr>
<tr><td>Series ID</td><td><?= $qData['s'] ?></td></tr>
<tr><td>Age Group ID</td><td><?= $qData['g'] ?></td></tr>
<tr><td>Question Number</td><td><?= $qData['n'] ?></td></tr>
<tr><td></td><td></td></tr>
<tr><td>Question A ID</td><td><?= $answers[1]['id'] ?></td></tr>
<tr><td>Question B ID</td><td><?= $answers[2]['id'] ?></td></tr>
<tr><td>Question C ID</td><td><?= $answers[3]['id'] ?></td></tr>
<tr><td>Question D ID</td><td><?= $answers[4]['id'] ?></td></tr>
</table>
</div>
</br>
<a href="answer.php?quid=<?= $prevQ ?>" ><img src="../images/common/arrowLeft.png"/></a>
<a href="answer.php?quid=<?= $nextQ ?>" ><img src="../images/common/arrowRight.png"/></a>
</br></br>
<input type="button" onclick="location.href='questions.php?sj=<?= $qData['sj'] ?>&g=<?= $qData['g'] ?>';" value="Return to questions" />

</center>
</body>
</html>