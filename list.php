<?php
include dirname(__FILE__) . "/config.php";
include dirname(__FILE__) . "/notorm/NotORM.php";
$connection = new PDO("mysql:host={$config['host']};dbname={$config['name']};port={$config['port']}", $config['user'], $config['pass']);
$software = new NotORM($connection);
$questions = $software->questions();
?>
<html>
  <head>
    <title>
      لیست معماها
    </title>
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
          <a target="_blank" class="btn btn-sm btn-primary" href="https://www.facebook.com/sharer/sharer.php?u=<?php print urlencode("http://iq.apps.rastasoft.ir/list.php"); ?>"><i class="glyphicon glyphicon-share-alt"></i></a>
        </div>
        <a class="btn btn-sm btn-success new-question" href="index.php?time=<?php print time(); ?>"><i class="glyphicon glyphicon-refresh pull-right"></i></a>
      </div>
    </nav>

    <div class="container">
      <!-- Main component for a primary marketing message or call to action -->
      <div class="questions">
        <ul>
          <?php foreach ($questions as $question): ?>
            <li>
              <a href="index.php?qid=<?php print $question['qid']; ?>">
                سوال شماره 
                <?php print $question['qid']; ?> - 
                <?php print $question['title']; ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div><!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>