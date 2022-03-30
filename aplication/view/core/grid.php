
<?php
    $collections = $this->getCollection();
    $columns = $this->getColumns();
    $actions =  $this->getActions();
    $pager = $this->getPager();
?>
<button type="button" id="addNew" value="">Add</button>
<table align="center">
    <tr>
        <td>
        <select onchange="ppc()" id="ppc">
            <?php foreach($this->pager->getPerPageCountOption() as $perPageCount) :?>	
            <option value="<?php echo $perPageCount ?>" <?php echo ($perPageCount == $this->getPager()->getPerPageCount() ? 'selected' : '') ?>><?php echo $perPageCount ?></a></option>
            <?php endforeach;?>
        </select>

        </td>
        <td><a href="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getStart()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getStart()) ? 'none' : ''?>"><button>Start</button></a></td>
        <td><a href="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getPrev()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getPrev()) ? 'none' : ''?>"><button>Prev</button></a></td>
        <td><a href="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getCurrent()]) ?>" style="pointer-events: none "><button><?php echo $this->getPager()->getCurrent(); ?></button></a></td>
        <td><a href="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getNext()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getNext()) ? 'none' : ''?>"><button>Next</button></a></td>
        <td><a href="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getEnd()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getEnd()) ? 'none' : ''?>"><button>End</button></a></td>
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
</table>
<script>
    $("#addNew").click(function(){
        var url = "<?php echo $this->getUrl('add'); ?>";
        admin.setUrl(url);
        admin.setType('POST');
        admin.setData($(this).val());
        admin.load();
    });

    $(".delete").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('delete'); ?>");
        admin.callDeleteAjax();
        admin.setUrl("<?php echo $this->getUrl('grid1'); ?>");
        admin.setData({});
        admin.load();
    });

    $(".edit").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('edit'); ?>");
        admin.setType('GET');
        admin.load();
    });

    $(".price").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('grid1','customer_price'); ?>");
        admin.setType('GET');
        admin.load();
    });

</script>
