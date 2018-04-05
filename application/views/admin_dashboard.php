
<h3>Hi <?=$this->session->userdata('username')?>!</h3>
<h4><?=$this->session->userdata('type')?></h4>


<?php if($this->session->userdata('message')): ?>
<?=$this->session->userdata('message')?>
<?php endif; ?>

<a href="<?=base_url('teachers')?>"><button>Teachers</button></a>
<a href="<?=base_url('students')?>"><button>Students</button></a>
<a href="<?=base_url('classrooms')?>"><button>Classrooms</button></a>