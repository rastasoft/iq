<?php
include dirname(__FILE__) . "/config.php";
include dirname(__FILE__) . "/notorm/NotORM.php";
$connection = new PDO("mysql:host={$config['host']};dbname={$config['name']};port={$config['port']}", $config['user'], $config['pass']);

$count = count(glob("files/*.q"));
$qid = isset($_GET['qid']) ? (int) $_GET['qid'] : 0;
if ($qid <= 0 || $qid > $count) {
  $qid = rand(1, $count);
}
$next = (($next = $qid + 1) <= $count) ? $next : 1;
$prev = ($prev = $qid - 1) ? $prev : $count;
$software = new NotORM($connection);
$question = $software->questions("qid", $qid);
?>
<html>
  <head>
    <title>
      معما
      |
      <?php print strip_tags($question[0]['title']); ?>
    </title>
    <meta name="description" content="<?php print strip_tags($question[0]['question']); ?>"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="publisher" href="https://plus.google.com/100862670780242731884"/>
    <link rel="alternate" type="application/rss+xml" title="RSS" href="http://iq.apps.rastasoft.ir/rss.php" />
    <link rel="index" title="Hafez" href="http://iq.apps.rastasoft.ir/list.php" />
    <link rel="alternate" href="http://iq.apps.rastasoft.ir" hreflang="fa-ir" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" >
    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="btn-group pull-left">
          <a class="btn btn-sm btn-primary" href="index.php?qid=<?php print $next; ?>"><i class="glyphicon glyphicon-chevron-left"></i></a>
          <a class="btn btn-sm btn-info" href="index.php?qid=<?php print $qid; ?>"><?php print $qid; ?></a>
          <a class="btn btn-sm btn-primary" href="index.php?qid=<?php print $prev; ?>"><i class="glyphicon glyphicon-chevron-right"></i></a>
          <a target="_blank" class="btn btn-sm btn-primary" href="https://www.facebook.com/sharer/sharer.php?u=<?php print urlencode("http://iq.apps.rastasoft.ir/index.php?qid=$qid"); ?>"><i class="glyphicon glyphicon-share-alt"></i></a>
        </div>
        <a class="btn btn-sm btn-success new-question" href="index.php?time=<?php print time(); ?>"><i class="glyphicon glyphicon-refresh pull-right"></i></a>
      </div>
    </nav>

    <div id="question" class="container">
      <!-- Main component for a primary marketing message or call to action -->
      <div class="well well-lg">
        <h1><?php print $question[0]['title']; ?></h1>
        <?php print $question[0]['question']; ?>
      </div>
      <?php if (isset($_GET['answer'])): ?>
        <div id="answer" class="well well-lg">
          <?php print $question[0]['answer']; ?>
        </div>
        <a class="btn btn-lg btn-danger questions-list" href="list.php">
          بازگشت به لیست معماها
        </a>
      <?php else: ?>
        <a class="btn btn-lg btn-success show-answer" href="index.php?qid=<?php print $qid; ?>&answer=show#answer">
          مشاهده پاسخ
        </a>
      <?php endif; ?>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
