
<?php
    $collections = $this->getCollection();
    $columns = $this->getColumns();
    $actions =  $this->getActions();
    $pager = $this->getPager();
?>
<button type="button" id="addNew">Add</button>
<table align="center">
    <tr>
        <td>
        <select id="ppc">
            <?php foreach($this->pager->getPerPageCountOption() as $perPageCount) :?>	
            <option value="<?php echo $perPageCount ?>" <?php echo ($perPageCount == $this->getPager()->getPerPageCount() ? 'selected' : '') ?>><?php echo $perPageCount ?></option>
            <?php endforeach;?>
        </select>

        </td>
        <td><button type="button" class="pagerBtn" value="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getStart()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getStart()) ? 'none' : ''?>">Start</button></td>
        <td><button type="button" class="pagerBtn" value="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getPrev()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getPrev()) ? 'none' : ''?>">Prev</button></td>
        <td><button type="button" class="pagerBtn" value="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getCurrent()]) ?>" style="pointer-events: none "><?php echo $this->getPager()->getCurrent(); ?></button></td>
        <td><button type="button" class="pagerBtn" value="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getNext()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getNext()) ? 'none' : ''?>">Next</button></td>
        <td><button type="button" class="pagerBtn" value="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getEnd()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getEnd()) ? 'none' : ''?>">End</button></td>
    </tr>
</table>

<table border = "1" width="100%">
    <tr>
        <?php foreach ($columns as $key => $column) :?>
            <th><?php echo $column['title'] ?></th>
        <?php endforeach; ?>
        <?php foreach ($actions as $key => $action) :?>
            <th><?php echo $key ?></th>
        <?php endforeach; ?>
    </tr>

    <?php if(!$collections): ?>
        <tr>
            <td>No Record Found</td>
        </tr>
    <?php else: ?>
    <?php foreach ($collections as $collection) :?>
    <tr>
        <?php foreach ($columns as $key => $column):?>
            <td><?php echo $this->getColumnData($column['key'],$collection); ?></td>
        <?php endforeach; ?>
        <?php foreach ($actions as $action) : ?>
            <?php $key = $columns['id']['key']; ?>
            <td><button type="button" class="<?php echo $action['title'] ?>" value="<?php echo $collection->$key; ?>"><?php echo $action['title']; ?></button></td>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>
<script type="text/javascript">
    $("#addNew").click(function(){
        admin.setData({'id' : null});
        admin.setUrl("<?php echo $this->getUrl('addBlock'); ?>");
        admin.load();
    });

    $(".delete").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setType('GET');
        admin.setUrl("<?php echo $this->getUrl('delete'); ?>");
        admin.load();
    });

    $(".edit").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('editBlock'); ?>");
        admin.setType('GET');
        admin.load();
    });

    $("#price").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer_price'); ?>");
        admin.setType('GET');
        admin.load();
    });

    $("#ppc").change(function(){
        var data = $(this).val();
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer',['p'=>1,'ppc'=>null]); ?>&ppc="+data);
        admin.setType('GET');
        admin.load();
    });

    $(".pagerBtn").click(function(){
        var url = $(this).val();
        admin.setUrl(url);
        admin.setType('GET');
        admin.load();
    });
</script>

