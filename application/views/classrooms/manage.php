<div class="container">

<div class="row">
    <div class="col-lg-5 col-md-offset-4">
        Subject: <?=$classroom->name?> <br/>
        Code: <input type="text" id="code" value="<?=$classroom->code?>" disabled>
        
        <?php if($this->session->userdata('message')): ?>
            <?=$this->session->userdata('message')?>
            <?php $this->session->unset_userdata('message'); ?>
        <?php endif; ?>
        <br>



<a href="<?=base_url('classrooms/students/'.$classroom->id)?>"><button>Students</button></a>
<a href="<?=base_url("exams/create/{$classroom->id}")?>"><button>Add Exam</button></a>
<a href="<?=base_url()?>"><button>back</button></a>
<br><br>
<form action="<?=base_url("posts/create/{$classroom->id}")?>" method="post" enctype="multipart/form-data">
Title:
<input type="text" name="title" id="title"><br>
Body:
<textarea name="body" id="body" cols="30" rows="3"></textarea>
<input name="fileToUpload" id="fileToUpload" type="file" />
<button type="submit">Post</button>

</form>


Posts:
    </div>
</div>

<?php foreach($posts as $post): ?>
<br><br><br><br>
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
                    </video><br>
                <?php endif; ?>
            <a href="<?=base_url("posts/file/{$post->attached}")?>"><button class="btn btn-default">Download Attachment</button></a><br>
    <?php endif; ?>
  </div>
  <div class="card-footer text-muted">
    posted by: <?=$post->created_by != $this->session->userdata('username')?: "You"?><br>
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
    <p class="card-text">Timelimit: <?=$post->timelimit?></p>
    <a href="<?=base_url("exams/scores/{$post->id}")?>"><button class="btn btn-primary">Scores</button></a>
  </div>
  <div class="card-footer text-muted">
    posted by: <?=$post->created_by != $this->session->userdata('username')?: "You"?><br>
    <?=$post->date->format('Y-m-d H:i')?><br>
  </div>
</div>
    <?php endif; ?>
<?php endforeach; ?>

</div>





