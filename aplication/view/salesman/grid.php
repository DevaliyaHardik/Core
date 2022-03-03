<?php $salesmans = $this->getSalesman(); ?>

<h1 id="post">Salesman Details</h1>
<div id="add"><a href="<?php echo $this->getUrl('add','salesman'); ?>">Add Salesman</a></div>
<div id="item">
    <table border=1 width=100%>
        <tr>
            <th>Salesman Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php if(!$salesmans): ?>
            <tr>
                <td colspan="10">No Recored Found</td>
            </tr>
        <?php else: ?>
        <?php foreach ($salesmans as $salesman): ?>
        <tr>
            <td><?php echo $salesman->salesman_id; ?></td>
            <td><?php echo $salesman->firstName; ?></td>
            <td><?php echo $salesman->lastName; ?></td>
            <td><?php echo $salesman->email; ?></td>
            <td><?php echo $salesman->mobile; ?></td>
            <td><?php echo $this->getStatus($salesman->status); ?></td>
            <td><?php echo $salesman->createdDate; ?></td>
            <td><?php echo $salesman->updatedDate; ?></td>
            <td><a href="<?php echo $this->getUrl('edit','salesman',['id' => $salesman->salesman_id],true); ?>">Edit</a></td>
            <td><a href="<?php echo $this->getUrl('delete','salesman',['id' => $salesman->salesman_id],true); ?>">Delete</a></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>
