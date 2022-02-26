<?php
$configs = $this->getConfig();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Config</title>
    <style>
        body{
            text-align : center;
        }
    </style>
</head>
<body>
    <h1 id="post">Config Details</h1>
    <div id="add"><a href="<?php echo $this->getUrl('add','config') ?>">Add Config</a></div>
    <div id="item">
        <table border=1 width=100%>
            <tr>
                <th>Config Id</th>
                <th>Name</th>
                <th>code</th>
                <th>value</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php if(!$configs): ?>
                <tr>
                    <td colspan="10">No Recored Found</td>
                </tr>
            <?php else: ?>
            <?php foreach ($configs as $config): ?>
            <tr>
                <td><?php echo $config->config_id; ?></td>
                <td><?php echo $config->name; ?></td>
                <td><?php echo $config->code; ?></td>
                <td><?php echo $config->value; ?></td>
                <td><?php echo $this->getStatus($config->status); ?></td>
                <td><?php echo $config->createdDate; ?></td>
                <td><a href="<?php echo $this->getUrl('edit','config',['id'=>$config->config_id],true) ?>">Edit</a></td>
                <td><a href="<?php echo $this->getUrl('delete','config',['id'=>$config->config_id],true) ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </table>
    </div>
</body>
</html>