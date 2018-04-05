
<div class="container">
    <h4 class="text-center">Teachers</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Created At</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
    <tbody>
        <?php foreach($teachers as $teacher): ?>
        <tr>
            <td><?=$teacher->id?></td>
            <td><?=$teacher->username?></td>
            <td><?=$teacher->created_at?></td>
            <td><a href="<?=base_url("teachers/edit/{$teacher->id}")?>"><button class="btn btn-default">Edit</button></a></td>
            <td><a href="<?=base_url("teachers/delete/{$teacher->id}")?>"><button class="btn btn-default" onclick="return confirm('This will also delete all of his classrooms. are you sure you want to do this?')">Delete</button></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    
    </table>

</div>