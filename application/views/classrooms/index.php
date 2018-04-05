
<div class="container">
    <h4 class="text-center">Classrooms</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created By</th>
                <th>Created At</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
    <tbody>
        <?php foreach($classrooms as $classroom): ?>
        <tr>
            <td><?=$classroom->id?></td>
            <td><?=$classroom->name?></td>
            <td><?=$classroom->username?></td>
            <td><?=$classroom->created_at?></td>
            <td><a href="<?=base_url("teachers/edit/{$classroom->id}")?>"><button class="btn btn-default">Edit</button></a></td>
            <td><a href="<?=base_url("teachers/delete/{$classroom->id}")?>"><button class="btn btn-default" onclick="return confirm('This will also delete all of his classrooms. are you sure you want to do this?')">Delete</button></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    
    </table>

</div>