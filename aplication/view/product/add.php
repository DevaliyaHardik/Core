<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD POST</title>
</head>
<body>
  
    <div id="form">
        <form action="<?php echo $this->getUrl('product','save'); ?>" method="POST" enctype="multipart/form-data">
            <table border=1>
                <tr>
                    <td width="10%">Name</td>
                    <td><input type="text" name="product[name]"></td>
                </tr>
                <tr>
                    <td width="10%">Prize</td>
                    <td><input type="float" name="product[prize]"></td>
                </tr>
                <tr>
                    <td width="10%">Quntity</td>
                    <td><input type="number" name="product[quntity]" id="quntity"></td>
                </tr>
                <tr>
                    <td width="10%">Staus</td>
                    <td>
                        <select name="product[status]" id="status">
                            <option value="1">active</option>
                            <option value="2">inactive</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="10%"></td>
                    <td>
                        <input type="submit" name="submit" id="submit" value="add">
                        <button><a href="<?php echo $this->getUrl('product','grid'); ?>">Cancel</a></button>
                    </td>
                </tr>
            </table>            
        </form>
    </div>
</body>
</html>