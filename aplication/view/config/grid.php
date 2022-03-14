<?php $configs = $this->getConfig(); ?>

<h1 id="post">Config Details</h1>
<div id="add"><a href="<?php echo $this->getUrl('add') ?>">Add Config</a></div>
<div id="item">
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
s			</script>
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
    <table border=1 width=100%>
        <tr>
            <th>Config Id</th>
            <th>Name</th>
            <th>code</th>
            <th>value</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php if(!$configs): ?>
            <tr>
                <td colspan="10">No Recored Found</td>
            </tr>
        <?php else: ?>
        <?php foreach ($configs as $config): ?>
        <tr>
            <td><?php echo $config->config_id; ?></td>
            <td><?php echo $config->name; ?></td>
            <td><?php echo $config->code; ?></td>
            <td><?php echo $config->value; ?></td>
            <td><?php echo $config->getStatus($config->status); ?></td>
            <td><?php echo $config->createdDate; ?></td>
            <td><a href="<?php echo $this->getUrl('edit','config',['id'=>$config->config_id]) ?>">Edit</a></td>
            <td><a href="<?php echo $this->getUrl('delete','config',['id'=>$config->config_id]) ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </table>
</div>
