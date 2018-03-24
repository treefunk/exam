Classroom:
<hr>
    <form action="<?=base_url('classrooms/create')?>" method="post">
        <?=form_error('name')?>
        <input type="text" name="name">
        <button type="submit">Add Classroom</button>
    </form>
<hr>