<?php
$collections = $this->getCollection();
$columns = $this->getColumns();
$actions =  $this->getActions();
$pager = $this->getPager();
$colspan = count($columns)+count($actions);
?>
<h2>All Records</h2>
<div class="row d-flex justify-content-center">
    <div class="form-group col-1">
        <select class="form-control" id="ppc">
            <option selected>select</option>
            <?php foreach($this->pager->getPerPageCountOption() as $perPageCount) :?> 
            <option value="<?php echo $perPageCount ?>" <?php echo ($perPageCount == $this->getPager()->getPerPageCount() ? 'selected' : '') ?>><?php echo $perPageCount ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="form-group col-1">
    <button type="button" class="pagerBtn btn btn-block btn-warning" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getStart()]) ?>"  style="pointer-events: <?php echo (!$this->getPager()->getStart()) ? 'none' : ''?>">Start</button>
    </div>
    <div class="form-group col-1">
    <button type="button" class="pagerBtn btn btn-block btn-warning" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getPrev()]) ?>"  style="pointer-events: <?php echo (!$this->getPager()->getPrev()) ? 'none' : ''?>">Previous</button>
    </div>
    <div class="form-group col-1">
    <button type="button" class="pagerBtn btn btn-block btn-warning" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getCurrent()]) ?>"  style="pointer-events: none "><?php echo $pager->getCurrent(); ?></button>
    </div>
    <div class="form-group col-1">
    <button type="button" class="pagerBtn btn btn-block btn-warning" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getNext()]) ?>"  style="pointer-events: <?php echo (!$this->getPager()->getNext()) ? 'none' : ''?>">Next</button>
    </div>
    <div class="form-group col-1">
    <button type="button" class="pagerBtn btn btn-block btn-warning" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getEnd()]) ?>"  style="pointer-events: <?php echo (!$this->getPager()->getEnd()) ? 'none' : ''?>">End</button>
    </div>
</div>

<br>
<br>
<div class="row">
    <div class="col-md-2">
        <div class="card card-primary">
            <button class="btn btn-block btn-success" type="button" id="addNew">Add</button>
        </div>
    </div>
</div>
<br>
<br>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
    <?php foreach ($columns as $key => $column) :?>
        <th><?php echo $column['title'] ?></th>
        <?php endforeach; ?>
        <?php foreach ($actions as $key => $action) :?>
        <th><?php echo $key ?></th>
    <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
    <?php if(!$collections): ?>
    <tr>
        <td colspan="<?php echo $colspan ?>">No Record Found</td>
    </tr>
    <?php else: ?>
    <?php foreach ($collections as $collection) :?>
    <tr>
        <?php foreach ($columns as $key => $column):?>
        <td><?php echo $this->getColumnData($column['key'],$collection); ?></td>
        <?php endforeach; ?>
        <?php foreach ($actions as $action) : ?>
        <?php $key = $columns['id']['key']; ?>
        <td><button type="button" class="<?php echo $action['title'] ?> btn btn-block btn-light" value="<?php echo $collection->$key; ?>"><?php echo $action['title']; ?></button></td>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>


<script type="text/javascript">
    $("#addNew").click(function(){
        admin.setData({'id' : null});
        admin.setUrl("<?php echo $this->getUrl('addBlock',null,['id' => null,'tab' => 'personal']); ?>");
        admin.load();
    });

    $(".delete").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('delete',null,['id' => null]); ?>");
        admin.setType('GET');
        admin.load();
    });

    $(".edit").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('editBlock',null,['tab' => 'personal']); ?>");
        admin.setType('GET');
        admin.load();
    });

    $(".price").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer_price'); ?>");
        admin.setType('GET');
        admin.load();
    });

    $(".customer").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','salesman_SalesmanCustomer'); ?>");
        admin.setType('GET');
        admin.load();
    });

    $(".pagerBtn").click(function(){
        var data = $(this).val();
        admin.setUrl(data);
        admin.setType('GET');
        admin.load();
    });

    $("#ppc").change(function(){
        var data = $(this).val();
        admin.setUrl("<?php echo $this->getUrl('gridBlock',null,['p'=>1,'ppc'=>null]); ?>&ppc="+data);
        admin.setType('GET');
        admin.load();
    });
</script>