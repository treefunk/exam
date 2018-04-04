Subject: <?=$classroom->name?> <br/>
Code: <input type="text" id="code" value="<?=$classroom->code?>" disabled>

<?php if($this->session->userdata('message')): ?>
    <?=$this->session->userdata('message')?>
    <?php $this->session->unset_userdata('message'); ?>
<?php endif; ?>
<br>


<a href="<?=base_url('classrooms/students/'.$classroom->id)?>"><button>Students</button></a>
<a href="<?=base_url("exams/create/{$classroom->id}")?>"><button>Add Exam</button></a>

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
<br>
<?php foreach($posts as $post): ?>
---<br>
    <?php if($post->type == 'post'): ?>
    <b><?=$post->title?></b><br>
    <p><?=$post->body?></p><br>
    <?php if(isset($post->attached)): ?>
    <a href="<?=base_url("posts/file/{$post->attached}")?>"><button>Download Attachment</button></a><br>
    <?php endif; ?>
    posted by: <?=$post->created_by != $this->session->userdata('username')?: "You"?><br>
    <?=$post->date->format('Y-m-d H:i')?><br>
    <?php elseif($post->type == 'exam'): ?>
        Exam:
        <b><?=$post->name?></b><br>
        Timelimit:<?=$post->timelimit?> seconds.<br>
        <?=$post->date->format('Y-m-d H:i')?><br>
        posted by: <?=$post->created_by != $this->session->userdata('username')?: "You"?> <br>
    <?php endif; ?>
----<br>
<?php endforeach; ?>





