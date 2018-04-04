
<h3>Hi <?=$this->session->userdata('username')?>!</h3>
<h4><?=$this->session->userdata('type')?></h4>


<?php if($this->session->userdata('message')): ?>
<?=$this->session->userdata('message')?>

<?php endif; ?>
<br />

<div>
    Join a classroom
    <form action="classrooms/join" method="post">
        <input type="text" name="classcode" id="classcode" placeholder="Enter Code">
        <button type="submit">Join</button>
    </form>
</div>
My Classrooms<input type="text" placeholder="Search Classroom">


<ul>
<?php foreach($classrooms as $classroom): ?>
    <a href="<?=base_url('classrooms/view/'.$classroom->id)?>">
    <li><?=$classroom->name?></li>
    </a>
<?php endforeach; ?>
</ul>

<a href="<?=base_url('main/logout')?>"><button>Logout</button></a>