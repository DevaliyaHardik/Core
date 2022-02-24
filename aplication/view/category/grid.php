<?php

$categories = $this->getCategory();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
    <h1 id="post">Categories</h1>
    <div id="add"><a href="<?php echo $this->getUrl('category','add') ?>">Add CATEGORY</a></div>
    <div id="item">
        <table border=1 width=100%>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php if(!$categories): ?>
            <tr><td colspan="7">No Recored Receive</td></tr>
            <?php else: ?>
            <?php foreach($categories as $category): ?>
            <?php $result = ($category['status'] == 1)? 'active':'inactive'; ?>
            <tr>
                <td><?php  echo $category['category_id']; ?></td>
                <td><?php echo $this->getPath($category['category_id'],$category['path']); ?></td>
                <td><?php echo $result; ?></td>
                <td><?php echo $category['createdDate']; ?></td>
                <td><?php echo $category['updatedDate']; ?></td>
                <td><a href='<?php echo $this->getUrl('category','edit',['id'=>$category['category_id']],true) ?>'>Edit</a></td>
                <td><a href='<?php echo $this->getUrl('category','delete',['id'=>$category['category_id']],true) ?>'>Delete</a></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tabel>
    </div>
</body>
</html>