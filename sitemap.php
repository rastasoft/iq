<?php
include dirname(__FILE__) . "/config.php";
include dirname(__FILE__) . "/notorm/NotORM.php";
$connection = new PDO("mysql:host={$config['host']};dbname={$config['name']};port={$config['port']}", $config['user'], $config['pass']);
$software = new NotORM($connection);
$questions = $software->questions();
header('Content-Type: application/rss+xml; charset=utf-8');
print '<?xml version="1.0" encoding="utf-8" ?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url><loc>http://iq.apps.rastasoft.ir/list.php</loc><changefreq>yearly</changefreq><priority>1.0</priority></url>
  <url><loc>http://iq.apps.rastasoft.ir/index.php</loc><changefreq>daily</changefreq><priority>1.0</priority></url>
  <url><loc>http://iq.apps.rastasoft.ir/rss.php</loc><changefreq>yearly</changefreq><priority>1.0</priority></url>
  <?php foreach ($questions as $question): ?>
    <url><loc><?php print "http://iq.apps.rastasoft.ir/index.php?qid={$question['qid']}"; ?></loc><changefreq>yearly</changefreq><priority>0.9</priority></url>
  <?php endforeach; ?>
</urlset>