Subject: <?=$classroom->name?> <br/>
Code: <input type="text" id="code" value="<?=$classroom->code?>" disabled>


<a href="<?=base_url('classrooms/students/'.$classroom->id)?>"><button>Students</button></a>