<?php
$customers = $this->getCustomer();
$address = $this->getAddress();
?>
<h1 id="post">customer Details</h1>
<div id="add"><a href="<?php echo $this->getUrl('add'); ?>">Add Customre</a></div>
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
            <th>customer Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Price</th>
        </tr>
        <?php if(!$customers): ?>
            <tr>
                <td colspan="10">No Recored Found</td>
            </tr>
        <?php else: ?>
        <?php foreach ($customers as $customer): ?>
        <tr>
            <td><?php echo $customer->customer_id; ?></td>
            <td><?php echo $customer->firstName; ?></td>
            <td><?php echo $customer->lastName; ?></td>
            <td><?php echo $customer->email; ?></td>
            <td><?php echo $customer->mobile; ?></td>
            <td><?php echo $customer->getStatus($customer->status); ?></td>
            <td><?php echo $customer->createdDate; ?></td>
            <td><?php echo $customer->updatedDate; ?></td>
            <td><a href="<?php echo $this->getUrl('edit','customer',['id' => $customer->customer_id]); ?>">Edit</a></td>
            <td><a href="<?php echo $this->getUrl('delete','customer',['id' => $customer->customer_id]); ?>">Delete</a></td>
            <td><a href="<?php echo $this->getUrl('grid','customer_price',['id' => $customer->customer_id]); ?>">Price</a></td>
        </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </table>
    <br><br><br>
    <h1 id="post">Address Details</h1>
    <table border=1 width=100%>
        <tr>
            <th>Address Id</th>
            <th>Customer Id</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Postal Code</th>
            <th>Country</th>
            <th>Biling</th>
            <th>Shiping</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php if(!$address): ?>
            <tr>
                <td colspan="11">No Recored Found</td>
            </tr>
        <?php else: ?>
        <?php foreach ($address as $address): ?>
        <?php $biling = ($address->biling == 1) ? 'Yes' : 'No'; ?>
        <?php $shiping = ($address->shiping == 1) ? 'Yes' : 'No'; ?>
        <tr>
            <td><?php echo $address->address_id; ?></td>
            <td><?php echo $address->customer_id; ?></td>
            <td><?php echo $address->address; ?></td>
            <td><?php echo $address->city; ?></td>
            <td><?php echo $address->state; ?></td>
            <td><?php echo $address->postalCode; ?></td>
            <td><?php echo $address->country; ?></td>
            <td><?php echo $biling; ?></td>
            <td><?php echo $shiping; ?></td>
            <td><a href="<?php echo $this->getUrl('edit','customer',['id' => $customer->customer_id]); ?>">Edit</a></td>
            <td><a href="<?php echo $this->getUrl('delete','customer',['id' => $customer->customer_id]); ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </table>
</div>