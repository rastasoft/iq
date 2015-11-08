<?php
include dirname(__FILE__) . "/config.php";
include dirname(__FILE__) . "/notorm/NotORM.php";
$connection = new PDO("mysql:host={$config['host']};dbname={$config['name']};port={$config['port']}", $config['user'], $config['pass']);
$software = new NotORM($connection);
$questions = $software->questions();
header('Content-Type: application/rss+xml; charset=utf-8');
print '<?xml version="1.0" encoding="utf-8" ?>';
?>
<rss version="2.0" xml:base="http://iq.apps.rastasoft.ir" xmlns:dc="http://purl.org/dc/elements/1.1/">
  <channel>
    <title>معما</title>
    <link>http://iq.apps.rastasoft.ir/</link>
    <description>معما</description>
    <language>fa</language>
    <?php foreach ($questions as $question): ?>
      <item>
        <title>
          <?php print $question['title']; ?>
        </title>
        <link><?php print "http://iq.apps.rastasoft.ir/index.php?qid={$question['qid']}"; ?></link>
        <description><?php print strip_tags($question['question']); ?></description>
      </item>
    <?php endforeach; ?>
  </channel>
</rss>