Subject: <?=$classroom->name?> <br/>
Code: <input type="text" id="code" value="<?=$classroom->code?>" disabled>

<?php if($this->session->userdata('message')): ?>
    <?=$this->session->userdata('message')?>
    <?php $this->session->unset_userdata('message'); ?>
<?php endif; ?>
<br>
Exams:
<?php foreach ($exams as $exam): ?>
    <li><?=$exam->name?></li>
<?php endforeach; ?>

<a href="<?=base_url('classrooms/students/'.$classroom->id)?>"><button>Students</button></a>
<a href="<?=base_url("exams/create/{$classroom->id}")?>"><button>Add Exam</button></a>