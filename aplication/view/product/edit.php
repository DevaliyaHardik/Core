<?php $admin = $this->getProduct(); ?>
<?php $categories = $this->getCategories(); ?>

<div id="form">
    <form action="<?php echo $this->getUrl('save','product',['id'=>$admin->product_id],true) ?>" method="POST" enctype="multipart/form-data">
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
            
            <tr>
                <td> <input type="checkbox" name="category[]" value="<?php echo $category->category_id ?>" <?php echo $this->selected($category->category_id); ?>> </td>
                <td><?php echo $category->category_id; ?></td>
                <td><?php echo $this->getPath($category->category_id,$category->path) ?></td>
            </tr>

            <?php endforeach; ?>

            <?php endif; ?>
        </table>
        <br>
        <table border=1 width="100%" cellspacing=4>
            
            <tr>
                <td width="10%">sku</td>
                <td><input type="text" name="product[sku]" value="<?php echo $admin->sku;?>"></td>
            </tr>
            <tr>
                <td width="10%">Name</td>
                <td><input type="text" name="product[name]" value="<?php echo $admin->name;?>"></td>
            </tr>
            <tr>
                <td width="10%">Prize</td>
                <td><input type="float" name="product[price]" value="<?php echo $admin->price;?>"></td>
            </tr>
            <tr>
                <td width="10%">MSP</td>
                <td><input type="float" name="product[minimum_support_price]" value="<?php echo $admin->minimum_support_price;?>"></td>
            </tr>
            <tr>
                <td width="10%">Cost Price</td>
                <td><input type="float" name="product[cost_price]" value="<?php echo $admin->cost_price;?>"></td>
            </tr>
            <tr>
                <td width="10%">Quntity</td>
                <td><input type="number" name="product[quntity]" id="quntity" value="<?php echo $admin->quntity;?>"></td>
            </tr>
            <tr>
                <td width="10%">Staus</td>
                <td>
                    <select name="product[status]" id="status">
                        <?php if($admin->status == '1'): ?>
                            <option value="1" selected>Enabled</option>
                            <option value="2">Disabled</option>
                        <?php else: ?>
                            <option value="1">Enabled</option>
                            <option value="2" selected>Disabled</option>
                        <?php endif; ?>
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