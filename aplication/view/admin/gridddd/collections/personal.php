<pre>
<?php 
$columns = $this->getCollection($this->getCurrentCollection())['columns']; 
$actions = $this->getCollection($this->getCurrentCollection())['action'];
$headers = $this->getCollection($this->getCurrentCollection())['header'];

?>
<a href="<?php echo $this->getUrl('add'); ?>">Add Admin</a>
<table align="center">
    <tr>
        <td>
        <script type="text/javascript"> 
        function ppc() {
            const ppcValue = document.getElementById('ppc').selectedOptions[0].value;
            let language = window.location.href;
            if(!language.includes('ppc'))
            {
                language+='&ppc=20';
            }
            const myArray = language.split("&");
            for (i = 0; i < myArray.length; i++)
            {
                if(myArray[i].includes('p='))
                {
                    myArray[i]='p=1';
                }
                if(myArray[i].includes('ppc='))
                {
                    myArray[i]='ppc='+ppcValue;
                }
            }
            const str = myArray.join("&");
            location.replace(str);
        }
        </script>
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
<table border="1" width="100%">
    <tr>
    <?php foreach($headers as $header): ?>
        <th><?php echo $header; ?></th>
    <?php endforeach; ?>
    <?php foreach($actions as $key => $action): ?>
            <th><?php echo $key; ?></th>   
    <?php endforeach; ?>
    </tr>

    <?php foreach($columns as $column): ?>
        <tr>
        <?php foreach($column->getData() as $key => $coulmnValue): ?>
            <td><?php echo $coulmnValue; ?></td>   
        <?php endforeach; ?>
        <?php foreach($actions as $key => $action): ?>
            <td><a href="<?php echo $column->callActionMethod($action['method']); ?>"><?php echo $action['title']; ?></a></td>
        <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>