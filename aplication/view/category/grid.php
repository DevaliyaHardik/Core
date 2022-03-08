<?php

$categories = $this->getCategory();

?>

<h1 id="post">Categories</h1>
<div id="add"><a href="<?php echo $this->getUrl('add','category') ?>">Add CATEGORY</a></div>
<div id="item">
    <table border=1 width=100%>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Base Image</th>
            <th>Thumb Image</th>
            <th>Small Image</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Gallery</th>
        </tr>
        <?php if(!$categories): ?>
        <tr>
            <td colspan="11">No Recored Receive</td>
        </tr>
        <?php else: ?>
        <?php foreach($categories as $category): ?>
        <tr>
            <td><?php  echo $category->category_id; ?></td>
            <td><?php echo $this->getPath($category->category_id,$category->path); ?></td>
            <?php if($category->base ): ?>
            <td><img src="<?php echo 'Media/category/'.$this->getMedia($category->base)['name']; ?>" alt="No Image found" width=50 height=50></td>
            <?php else: ?>
            <td>No base image</td>
            <?php endif; ?>

            <?php if($category->thumb ): ?>
            <td><img src="<?php echo 'Media/category/'.$this->getMedia($category->thumb)['name']; ?>" alt="No Image found" width=50 height=50></td>
            <?php else: ?>
            <td>No thumb image</td>
            <?php endif; ?>

            <?php if($category->small ): ?>
            <td><img src="<?php echo 'Media/category/'.$this->getMedia($category->small)['name']; ?>" alt="No Image found" width=50 height=50></td>
            <?php else: ?>
            <td>No small image</td>
            <?php endif; ?>
            <td><?php echo $category->getStatus($category->status); ?></td>
            <td><?php echo $category->createdDate; ?></td>
            <td><?php echo $category->updatedDate; ?></td>
            <td><a href='<?php echo $this->getUrl('edit','category',['id'=>$category->category_id],true) ?>'>Edit</a></td>
            <td><a href='<?php echo $this->getUrl('delete','category',['id'=>$category->category_id],true) ?>'>Delete</a></td>
            <td><a href="<?php echo $this->getUrl('grid','category_media',['id'=>$category->category_id],true) ?>">Gallary</a></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>