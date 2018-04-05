
<div class="container">
    <h4 class="text-center">Students</h4>
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
        <?php foreach($students as $student): ?>
        <tr>
            <td><?=$student->id?></td>
            <td><?=$student->username?></td>
            <td><?=$student->created_at?></td>
            <td><a href="<?=base_url("students/edit/{$student->id}")?>"><button class="btn btn-default">Edit</button></a></td>
            <td><a href="<?=base_url("students/delete/{$student->id}")?>"><button class="btn btn-default" onclick="return confirm('This will also delete all of his classrooms. are you sure you want to do this?')">Delete</button></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    
    </table>

</div>