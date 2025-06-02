<?php
include '../globalScripts/quizzyDatabase.php';

$YMD = $_GET['date'] ?? '2005-01-01';

$quizzyDat = new quizzyDatabase();
$qData = $quizzyDat->getCalendarQuestion($YMD);

$dateTitle = date('F d, Y',strtotime($YMD));
$answers = json_decode($qData['answers'],true);

$nextQ = date('Y-m-d',strtotime($YMD . ' +1 day'));
$prevQ = date('Y-m-d',strtotime($YMD . ' -1 day'));


?>
<html>
<body style="background-image: url('../images/common/quizzy.svg');">
<link rel="stylesheet" href="../css/quizzy.css"/>

<center><img src="../images/common/quizzy.png"/><img src="../images/common/QuestionCornerLogo.png"/></center>
<center>
<div class="headerMenu"><a href="../index.php">Home</a> <a href="../random/index.php">Random</a> <a href="../about.php">About</a></div></br>
<img src="../images/modes/calendarTrivia.png"/>
<div id="boardQuestion" >
<h3><?= $dateTitle ?></h3>
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
<tr><td>Question Year</td><td><?= $qData['y'] ?></td></tr>
<tr><td>Question Month</td><td><?= $qData['m'] ?></td></tr>
<tr><td>Question Day</td><td><?= $qData['n'] ?></td></tr>
<tr><td></td><td></td></tr>
<tr><td>Question A ID</td><td><?= $answers[1]['id'] ?></td></tr>
<tr><td>Question B ID</td><td><?= $answers[2]['id'] ?></td></tr>
<tr><td>Question C ID</td><td><?= $answers[3]['id'] ?></td></tr>
<tr><td>Question D ID</td><td><?= $answers[4]['id'] ?></td></tr>
</table>
</div>
</br>

<form>
  <input type="date" id="date" name="date" min="2005-01-01" max="2025-01-01"  value="<?= $YMD ?>">
  <input type="submit">
</form>

<a href="?date=<?= $prevQ ?>" ><img src="../images/common/arrowLeft.png"/></a>
<a href="?date=<?= $nextQ ?>" ><img src="../images/common/arrowRight.png"/></a>
</br></br>

<input type="button" onclick="location.href='../index.php';" value="Return Home" />

</center>
</body>
</html>