<?php $product = $this->getProduct(); ?>
<?php $categories = $this->getCategories(); ?>
<div id="form">
    <form action="<?php echo $this->getUrl('save','product',['id'=>$product->product_id],true) ?>" method="POST" enctype="multipart/form-data">
       
        <br>
        <table border=1 width="100%" cellspacing=4>
            
            <tr>
                <td width="10%">sku</td>
                <td><input type="text" name="product[sku]" value="<?php echo $product->sku;?>"></td>
            </tr>
            <tr>
                <td width="10%">Name</td>
                <td><input type="text" name="product[name]" value="<?php echo $product->name;?>"></td>
            </tr>
            <tr>
                <td width="10%">Prize</td>
                <td><input type="float" name="product[price]" value="<?php echo $product->price;?>"></td>
            </tr>
            <tr>
                <td width="10%">MSP</td>
                <td><input type="float" name="product[minimum_support_price]" value="<?php echo $product->minimum_support_price;?>"></td>
            </tr>
            <tr>
                <td width="10%">Cost Price</td>
                <td><input type="float" name="product[cost_price]" value="<?php echo $product->cost_price;?>"></td>
            </tr>
            <tr>
                <td width="10%">Quntity</td>
                <td><input type="number" name="product[quntity]" id="quntity" value="<?php echo $product->quntity;?>"></td>
            </tr>
            <tr>
                <td>Categories</td>
                <td>
                    <table border="1" width="100%">
                        <tr>
                            <th>Select</th>
                            <th>Category Id</th>
                            <th>Category</th>
                        </tr>
                        <?php if(!$categories): ?>
                        <tr>
                            <td colspan="3">No category Found</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach($categories as $category): ?>
                        <?php $tag = ($this->selected($category->category_id) == 'checked') ? 'exists' : 'new'; ?>
                        <tr>
                            <td> <input type="checkbox" name="category[<?php echo $tag ?>][]" value="<?php echo $category->category_id ?>" <?php echo $this->selected($category->category_id); ?>> </td>
                            <td><?php echo $category->category_id; ?></td>
                            <td><?php echo $this->getPath($category->category_id,$category->path) ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </table>                
                </td>
            </tr>
            <tr>
                <td width="10%">Staus</td>
                <td>
				<select name="product[status]">
					<option value="1" <?php echo ($product->getStatus($product->status)=='Enabel')?'selected':'' ?>>Enabel</option>
					<option value="2" <?php echo ($product->getStatus($product->status)=='Disabled')?'selected':'' ?>>Disabled</option>
				</select>			
			</td>
            </tr>
            <tr>
                <td width="10%"></td>
                <td>
                    <input type="submit" name="submit" id="submit" value="save">
                    <button><a href="<?php echo $this->getUrl('grid','product',); ?>">Cancel</a></button>
                </td>
            </tr>
        </table> 
    </form>
</div>