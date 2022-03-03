<?php $admin = $this->getProduct(); ?>

<div id="form">
    <form action="<?php echo $this->getUrl('save','product',['id'=>$admin->product_id],true) ?>" method="POST" enctype="multipart/form-data">
        <table border=1 width="100%" cellspacing=4>

            <tr>
                <td width="10%">Name</td>
                <td><input type="text" name="product[name]" value="<?php echo $admin->name;?>"></td>
            </tr>
            <tr>
                <td width="10%">Prize</td>
                <td><input type="float" name="product[prize]" value="<?php echo $admin->prize;?>"></td>
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