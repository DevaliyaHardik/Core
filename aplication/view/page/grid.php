<?php $pages = $this->getPage(); ?>

<h1 id="post">Page Details</h1>
<div id="add"><a href="<?php echo $this->getUrl('add') ?>">Add Page</a></div>
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
            <td><?php echo $page->getStatus($page->status); ?></td>
            <td><?php echo $page->createdDate; ?></td>
            <td><?php echo $page->updatedDate; ?></td>
            <td><a href="<?php echo $this->getUrl('edit','page',['id'=>$page->page_id],true) ?>">Edit</a></td>
            <td><a href="<?php echo $this->getUrl('delete','page',['id'=>$page->page_id],true) ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </table>
</div>