<?php
$customers = $this->getCustomer();
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
            <th>Biling Address</th>
			<th>Shiping Address</th>
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
            <td>
                <?php $bilingAddress = $customer->getBilingAddress()  ?>
                <?php echo "Address : ".$bilingAddress->address."<br>"  ?>
                <?php echo "Postal Code : ".$bilingAddress->postalCode."<br>"  ?>
                <?php echo "Ciry : ".$bilingAddress->city."<br>"  ?>
                <?php echo "State : ".$bilingAddress->state."<br>"  ?>
                <?php echo "Country : ".$bilingAddress->country."<br>" ?>
			</td>
            <td><?php $shipingAddress = $customer->getShipingAddress()  ?>
                <?php echo "Address : ".$shipingAddress->address."<br>"  ?>
                <?php echo "Postal Code : ".$shipingAddress->postalCode."<br>"  ?>
                <?php echo "Ciry : ".$shipingAddress->city."<br>"  ?>
                <?php echo "State : ".$shipingAddress->state."<br>"  ?>
                <?php echo "Country : ".$shipingAddress->country."<br>" ?>
            </td>
            <td><?php echo $customer->createdDate; ?></td>
            <td><?php echo $customer->updatedDate; ?></td>
            <td><a href="<?php echo $this->getUrl('edit','customer',['id' => $customer->customer_id]); ?>">Edit</a></td>
            <td><a href="<?php echo $this->getUrl('delete','customer',['id' => $customer->customer_id]); ?>">Delete</a></td>
            <td><a href="<?php echo $this->getUrl('grid','customer_price',['id' => $customer->customer_id]); ?>">Price</a></td>
        </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </table>
</div>