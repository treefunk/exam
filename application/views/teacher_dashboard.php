
Session Vars
<pre>
<?=var_dump($this->session->userdata())?>
</pre>

<h3>Hi <?=$this->session->userdata('username')?>!</h3>
<h4><?=$this->session->userdata('type')?></h4>

<!-- maganda sana kung nasa modal to   -->
<a href="<?=base_url('classrooms/')?>"><button>Classrooms</button></a>
<a href="<?=base_url('classrooms/create')?>"><button>Create Classroom</button></a>
<!--   -->

<div>

</div>
My Classrooms<input type="text" placeholder="Search Classroom">


<ul>
    <li>classroom math</li>
    <li>classroom physics</li>
    <li>classroom psychology</li>
</ul>

<a href="<?=base_url('main/logout')?>"><button>Logout</button></a>