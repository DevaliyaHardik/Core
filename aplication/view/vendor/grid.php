<?php
$vendors = $this->getVendor();
$address = $this->getAddress();
?>

<h1>Vendor Details</h1>
<button><a href="<?php echo $this->getUrl('add'); ?>">Add Vendor</a></button>
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
            <option value="<?php echo $perPageCount ?>" <?php echo ($perPageCount == $this->getPager()->getPerPageCount() ? 'selected' : '') ?>> <?php echo $perPageCount ?> </a></option>
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
<table border="1" align="center" width="100%">
    <tr>
        <th>Vendor Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Status</th>
        <th>Created Date</th>
        <th>Updated Date</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php if(!$vendors): ?>
    <tr>
        <td colspan="10"> No Data Fount</td>
    </tr>
    <?php else: ?>
    <?php foreach($vendors as $vendor): ?>
    <tr>
        <td><?php echo $vendor->firstName; ?></td>
        <td><?php echo $vendor->lastName; ?></td>
        <td><?php echo $vendor->vendor_id; ?></td>
        <td><?php echo $vendor->email; ?></td>
        <td><?php echo $vendor->mobile; ?></td>
        <td><?php echo $vendor->getStatus($vendor->status); ?></td>
        <td><?php echo $vendor->createdDate; ?></td>
        <td><?php echo $vendor->updatedDate; ?></td>
        <td><a href="<?php echo $this->getUrl('edit','vendor',['id' => $vendor->vendor_id]) ?>">Edit</a></td>
        <td><a href="<?php echo $this->getUrl('delete','vendor',['id' => $vendor->vendor_id]) ?>">Delete</a></td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>
<br><br>
<table border="1" align="center" width="100%">
    <tr>
        <th>Address Id</th>
        <th>Vendor Id</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Postal Code</th>
        <th>Country</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php if(!$address): ?>
    <tr>
        <td colspan="9"> No Data Fount</td>
    </tr>
    <?php else: ?>
    <?php foreach($address as $address): ?>
    <tr>
        <td><?php echo $address->address_id; ?></td>
        <td><?php echo $address->vendor_id; ?></td>
        <td><?php echo $address->address; ?></td>
        <td><?php echo $address->city; ?></td>
        <td><?php echo $address->state; ?></td>
        <td><?php echo $address->postalCode; ?></td>
        <td><?php echo $address->country; ?></td>
        <td><a href="<?php echo $this->getUrl('edit','vendor',['id' => $vendor->vendor_id]) ?>">Edit</a></td>
        <td><a href="<?php echo $this->getUrl('delete','vendor',['id' => $vendor->vendor_id]) ?>">Delete</a></td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>