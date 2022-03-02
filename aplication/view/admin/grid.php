<?php
$admins = $this->getAdmin();
?>
<h1 id="post" align="center">Admin</h1>
<div id="add" align="center"><a href="<?php echo $this->getUrl('add','admin') ?>">Add Admin</a></div>
<div id="item">
    <table border=1 width=100% align="center">
        <tr>
            <th>admin Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php if(!$admins): ?>
            <tr>
                <td colspan="10">No Recored Found</td>
            </tr>
        <?php else: ?>
        <?php foreach ($admins as $admin): ?>
        <tr>
            <td><?php echo $admin->admin_id; ?></td>
            <td><?php echo $admin->firstName; ?></td>
            <td><?php echo $admin->lastName; ?></td>
            <td><?php echo $admin->email; ?></td>
            <td><?php echo $this->getStatus($admin->status); ?></td>
            <td><?php echo $admin->createdDate; ?></td>
            <td><?php echo $admin->updatedDate; ?></td>
            <td><a href="<?php echo $this->getUrl('edit','admin',['id'=>$admin->admin_id],true) ?>">Edit</a></td>
            <td><a href="<?php echo $this->getUrl('delete','admin',['id'=>$admin->admin_id],true) ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </table>
</div>
