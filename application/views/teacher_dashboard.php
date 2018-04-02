
Session Vars
<pre>
<?=var_dump($this->session->userdata())?>   sige 
<?php echo var_dump($this->session->userdata()) ?> 
</pre>teka eto na
dba may dndagdag tayo ngayon etong tntype ko
pag balik sa gitkraken
di pa to nkasave diba try save
oy joanna

<h3>Hi <?=$this->session->userdata('username')?>!</h3>
<h4><?=$this->session->userdata('type')?></h4>


JOANNA MARIE TADEO NICOLAS

oy bigti na tayo joanna ^_^

<?php if($this->session->userdata('message')): ?>
<?=$this->session->userdata('message')?>

<?php endif; ?>
<br />
<!-- maganda sana kung nasa modal to   -->
<a href="<?=base_url('classrooms/')?>"><button>Classrooms</button></a>
<a href="<?=base_url('classrooms/create')?>"><button>Create Classroom</button></a>
<!--   -->

<div>

</div>
My Classrooms<input type="text" placeholder="Search Classroom">


<ul>
<?php foreach($classrooms as $classroom): ?>
    <a href="<?=base_url('classrooms/manage/'.$classroom->id)?>">
    <li><?=$classroom->name?></li>
    </a>
<?php endforeach; ?>
</ul>

<a href="<?=base_url('main/logout')?>"><button>Logout</button></a>