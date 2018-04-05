<div class="container">
<div class="row">
<div class="col-lg-10 col-md-offset-4">
    Your teacher: <?=$teacher->username ?> <br>
    
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



</div>
</div>

<?php foreach($posts as $post): ?>
<br><br><br>
    <?php if($post->type == 'post'): ?>

<div class="card text-center">
  <div class="card-body">
    <h5 class="card-title"><?=$post->title?></h5>
    <p class="card-text"><?=$post->body?></p>
    <?php if(isset($post->attached)): ?>
             <?php if($post->file_type == 'video/mp4'): ?>
            <video width="320" height="240" controls>
            <source src="<?=base_url('uploads/'.basename($post->full_path))?>" type="video/mp4">
            <source src="<?=base_url('uploads/'.basename($post->full_path))?>" type="video/ogg">
            Your browser does not support the video tag.
        </video>
             <?php endif; ?>
        <a href="<?=base_url("posts/file/{$post->attached}")?>"><br>
        <button>Download Attachment</button></a><br>
    <?php endif; ?>
  </div>
  <div class="card-footer text-muted">
    posted by: <?=$post->created_by?><br>
    <?=$post->date->format('Y-m-d H:i')?><br>

  </div>
</div>

<?php elseif($post->type == 'exam'): ?>

<div class="card text-center">
  <div class="card-header">
    Exam
  </div>
  <div class="card-body">
    <h5 class="card-title"><?=$post->name?></h5>
    <p class="card-text">Timelimit:<?=$post->timelimit?> seconds.</p>
    <a href="<?=base_url('exams/take/'.$post->id)?>"><button>Take the exam</button></a><br>
  </div>
  <div class="card-footer text-muted">
    posted by: <?=$post->created_by?>(teacher)
    <?=$post->date->format('Y-m-d H:i')?><br>
  </div>
</div>

<?php elseif($post->type == 'score'): ?>
<div class="card text-center">
  <div class="card-header">
    Exam(Completed):
  </div>
  <div class="card-body">
    <h5 class="card-title"><?=$post->name?></h5>
    <p class="card-text"> Score: <?=$post->score?>/<?=$post->total?><br></p>
  </div>
  <div class="card-footer text-muted">
    Created at: <?=$post->created_at ?>
    Finished at: <?=$post->finished_at?>
  </div>
</div>

<?php endif; ?>
<?php endforeach; ?>
</div>