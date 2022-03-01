<?php
$pages = $this->getPage();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page</title>
    <style>
        body{
            text-align : center;
        }
    </style>
</head>
<body>
    <h1 id="post">Page Details</h1>
    <div id="add"><a href="<?php echo $this->getUrl('add','page') ?>">Add PSage</a></div>
    <div id="item">
        <table border=1 width=100%>
            <tr>
                <th>page Id</th>
                <th>Name</th>
                <th>code</th>
                <th>content</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php if(!$pages): ?>
                <tr>
                    <td colspan="10">No Recored Found</td>
                </tr>
            <?php else: ?>
            <?php foreach ($pages as $page): ?>
            <tr>
                <td><?php echo $page->page_id; ?></td>
                <td><?php echo $page->name; ?></td>
                <td><?php echo $page->code; ?></td>
                <td><?php echo $page->content; ?></td>
                <td><?php echo $this->getStatus($page->status); ?></td>
                <td><?php echo $page->createdDate; ?></td>
                <td><?php echo $page->updatedDate; ?></td>
                <td><a href="<?php echo $this->getUrl('edit','page',['id'=>$page->page_id],true) ?>">Edit</a></td>
                <td><a href="<?php echo $this->getUrl('delete','page',['id'=>$page->page_id],true) ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </table>
    </div>
</body>
</html>