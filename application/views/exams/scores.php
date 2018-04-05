<h4><?=$exam->name?></h4>
<?php foreach($scores as $score): ?>
Student name: <?=$score->username?><br>
Score: <?=$score->score?>/<?=$score->total?>
<br><br>
<?php endforeach; ?>