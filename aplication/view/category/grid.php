<?php

$load = new Model_Core_Adapter();
$categories = $load->fetchAll("SELECT * FROM category");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <style>
        body{
            text-align : center;
        }
    </style>
</head>
<body>
    <h1 id="post">Categories</h1>
    <div id="add"><a href="index.php?c=category&a=add">Add CATEGORY</a></div>
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
                <td><?php echo $category['name']; ?></td>
                <td><?php echo $result; ?></td>
                <td><?php echo $category['createdDate']; ?></td>
                <td><?php echo $category['updatedDate']; ?></td>
                <td><a href='index.php?c=category&a=edit&id=<?php echo $category['category_id']; ?>'>Edit</a></td>
                <td><a href='index.php?c=category&a=delete&id=<?php echo $category['category_id']; ?>'>Delete</a></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tabel>
    </div>
</body>
</html>