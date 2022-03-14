<?php $salesmans = $this->getSalesman(); ?>

<h1 id="post">Salesman Details</h1>
<div id="add"><a href="<?php echo $this->getUrl('add'); ?>">Add Salesman</a></div>
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
    <table border=1 width=100%>
        <tr>
            <th>Salesman Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Customer</th>
            <th>Percentage</th>
        </tr>
        <?php if(!$salesmans): ?>
            <tr>
                <td colspan="11">No Recored Found</td>
            </tr>
        <?php else: ?>
        <?php foreach ($salesmans as $salesman): ?>
        <tr>
            <td><?php echo $salesman->salesman_id; ?></td>
            <td><?php echo $salesman->firstName; ?></td>
            <td><?php echo $salesman->lastName; ?></td>
            <td><?php echo $salesman->email; ?></td>
            <td><?php echo $salesman->mobile; ?></td>
            <td><?php echo $salesman->getStatus($salesman->status); ?></td>
            <td><?php echo $salesman->createdDate; ?></td>
            <td><?php echo $salesman->updatedDate; ?></td>
            <td><a href="<?php echo $this->getUrl('edit','salesman',['id' => $salesman->salesman_id]); ?>">Edit</a></td>
            <td><a href="<?php echo $this->getUrl('delete','salesman',['id' => $salesman->salesman_id]); ?>">Delete</a></td>
            <td><a href="<?php echo $this->getUrl('grid','salesman_salesmanCustomer',['id' => $salesman->salesman_id]); ?>">Customer</a></td>
            <td><?php echo $salesman->discount; ?></td>                        
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>
