Your teacher: <?=$teacher->username ?>

Classroom name: <?=$classroom->name?>


Exams:

<!-- TODO -->
<?php foreach($exams as $exam):?>

<li><?=$exam->name?></li>
<a href="<?=base_url('exams/take/'.$exam->id)?>"><button>Take the exam</button></a>

<?php endforeach; ?>
