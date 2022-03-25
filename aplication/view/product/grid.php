<?php
$products = $this->getProduct();
?>

<h1 id="post">Products</h1>
<div id="add"><a href="<?php echo $this->getUrl('add') ?>">Add Product</a></div>
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
    <table border=1 width="100%">
        <tr>
            <th>ID</th>
            <th>sku</th>
            <th>Name</th>
            <th>Base Image</th>
            <th>Thumb Image</th>
            <th>Small Image</th>
            <th>Prize</th>
            <th>Cost</th>
            <th>Discount</th>
            <th>Tax</th>
            <th>Quntity</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Gallary</th>
        </tr>
        <?php if(!$products): ?>
        <tr><td colspan=13>No Recored Receive</td></tr>
        <?php else: ?>
        <?php foreach($products as $product): ?>
        <tr>
            <td><?php echo $product->product_id; ?></td>
            <td><?php echo $product->sku ?></td>
            <td><?php echo $product->name; ?></td>
            <?php if($product->base ): ?>
            <td><img src="<?php echo $product->getBase()->getImagePath(); ?>" alt="No Image found" width=50 height=50></td>
            <?php else: ?>
            <td>No base image</td>
            <?php endif; ?>

            <?php if($product->thumb ): ?>
            <td><img src="<?php echo $product->getThumb()->getImagePath(); ?>" alt="No Image found" width=50 height=50></td>
            <?php else: ?>
            <td>No thumb image</td>
            <?php endif; ?>

            <?php if($product->small ): ?>
            <td><img src="<?php echo $product->getSmall()->getImagePath(); ?>" alt="No Image found" width=50 height=50></td>
            <?php else: ?>
            <td>No small image</td>
            <?php endif; ?>

            <td><?php echo $product->price; ?></td>
            <td><?php echo $product->cost; ?></td>
            <td><?php echo $product->discount; ?></td>
            <td><?php echo $product->quntity; ?></td>
            <td><?php echo $product->tax; ?></td>
            <td><?php echo $product->getStatus($product->status); ?></td>
            <td><?php echo $product->createdDate; ?></td>
            <td><?php echo $product->updatedDate; ?></td>
            <td><a href='<?php echo $this->getUrl('edit','product',['id'=>$product->product_id],true) ?>' id='edit'>Edit</a></td>
            <td><a href='<?php echo $this->getUrl('delete','product',['id'=>$product->product_id],true) ?>' id='delete'><strong>Delete</strong></a></td>
            <td><a href="<?php echo $this->getUrl('grid','product_media',['id'=>$product->product_id],true) ?>">Gallary</a></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>