
<?php
    $collections = $this->getCollection();
    $columns = $this->getColumns();
    $actions =  $this->getActions();
    $pager = $this->getPager();
?>
<button><a href="<?php echo $this->getUrl('add'); ?>">Add</a></button>
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
        <?php if($action['title'] == 'delete'): ?>
            <?php $key = $columns['id']['key']; ?>
            <td><button type="button" class="delete" value="<?php echo $collection->$key; ?>"><?php echo $action['title']; ?></button></td>
        <?php else: ?>
            <?php $method = $action['method']; ?>
            <td><a href="<?php echo $collection->$method(); ?>"><button><?php echo $action['title'] ?></button></a></td>
        <?php endif; ?>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
</table>


