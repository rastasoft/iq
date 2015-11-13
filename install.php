<?php

include dirname(__FILE__) . "/config.php";
include dirname(__FILE__) . "/notorm/NotORM.php";
$connection = new PDO("mysql:host={$config['host']};dbname={$config['name']};port={$config['port']}", $config['user'], $config['pass']);
$software = new NotORM($connection);

$files = glob("files/*.t");
foreach ($files as $file) {
  $qid = pathinfo($file, PATHINFO_FILENAME);
  $title = file_get_contents($file);
  $software->questions()->insert_update(array("qid" => $qid), array("title" => $title));
}

$files = glob("files/*.q");
foreach ($files as $file) {
  $qid = pathinfo($file, PATHINFO_FILENAME);
  $question = markup_to_html(file_get_contents($file));
  $software->questions()->insert_update(array("qid" => $qid), array("question" => $question));
}

$files = glob("files/*.a");
foreach ($files as $file) {
  $qid = pathinfo($file, PATHINFO_FILENAME);
  $answer = markup_to_html(file_get_contents($file));
  $software->questions()->insert_update(array("qid" => $qid), array("answer" => $answer));
}

function markup_to_html($markup) {
  if (preg_match_all('/\[(.*):(.*)\]/', $markup, $medias)) {
    foreach ($medias[0] as $index => $pattern) {
      switch ($medias[1][$index]):
        case 'img':
          $tag = "<img src=\"files/images/{$medias[2][$index]}\" />";
          break;
		case 'video':
          $tag = '<video width="320" height="240" controls>'.
				  '<source src="files/videos/'.$medias[2][$index].'" type="video/mp4">'.
				'</video>';
          break;
        default :
          $tag = "<{$medias[1][$index]}>{$medias[2][$index]}</{$medias[1][$index]}>";
      endswitch;
      $markup = str_replace($medias[0][$index], $tag, $markup);
    }
  }
  return nl2br($markup);
}
