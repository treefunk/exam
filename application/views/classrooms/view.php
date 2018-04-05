Your teacher: <?=$teacher->username ?>

Classroom name: <?=$classroom->name?>
<br>
<a href="<?=base_url()?>"><button>back</button></a>
<br><br><br><br>
<form action="<?=base_url("posts/create/{$classroom->id}")?>" method="post" enctype="form/multipart">
Title:
<input type="text" name="title" id="title"><br>
Body:
<textarea name="body" id="body" cols="30" rows="3"></textarea>
<button type="submit">Post</button>
</form>

Posts:
<br>
<?php foreach($posts as $post): ?>
<hr>
<br>
    <?php if($post->type == 'post'): ?>
    <b><?=$post->title?></b><br>
    <p><?=$post->body?></p><br>
        <?php if(isset($post->attached)): ?>
             <?php if($post->file_type == 'video/mp4'): ?>
            <video width="320" height="240" controls>
            <source src="<?=base_url('uploads/'.basename($post->full_path))?>" type="video/mp4">
            <source src="<?=base_url('uploads/'.basename($post->full_path))?>" type="video/ogg">
            Your browser does not support the video tag.
        </video><br>
        
             <?php endif; ?>
        <a href="<?=base_url("posts/file/{$post->attached}")?>"><button>Download Attachment</button></a><br>
        <?php endif; ?>
    posted by: <?=$post->created_by?>
    <?=$post->date->format('Y-m-d H:i')?><br>
    
    <?php elseif($post->type == 'exam'): ?>
        Exam:
        <b><?=$post->name?></b><br>
        Timelimit:<?=$post->timelimit?> seconds.<br>
        <a href="<?=base_url('exams/take/'.$post->id)?>"><button>Take the exam</button></a><br>
        <?=$post->date->format('Y-m-d H:i')?><br>
        posted by: <?=$post->created_by?>(teacher)
    <?php elseif($post->type == 'score'): ?>
        Exam(Completed):
        <b><?=$post->name?></b><br>
        Score: <?=$post->score?>/<?=$post->total?>
        <br>
        created at: <?=$post->created_at ?> <br>
        finished at: <?=$post->finished_at?>

    <?php endif; ?>
<hr>
<br>
<?php endforeach; ?>

