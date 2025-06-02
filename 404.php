<html>
<body style="background-image: url('../images/common/quizzy.svg');">
<link rel="stylesheet" href="../css/quizzy.css"/>
<link rel="stylesheet" href="../css/errorButton.css"/>
<center><img src="../images/common/quizzy.png"/><img src="../images/common/QuestionCornerLogo.png"/></center>

<center>
<div class="headerMenu"><a href="../index.php">Home</a> <a href="../random/index.php">Random</a> <a href="../about.php">About</a></div></br>

<h1 class="titleText">Oops!</h1>
<h2 class="titleText">An error occured trying to load something, sorry...</h2>
<h2 class="titleText">Click the pet to go to the home page.</h2>

<button onclick="location.href='../index.php';"><img src="../images/error/<?= rand(1,9) ?>.png"/></button>

</center>
</body>
</html>