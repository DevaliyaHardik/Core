<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
</head>
<body>
    <form action="index.php?c=category&a=save" method="post">
        <table border="1" width="100%" cellspacing="4">
            <tr>
                <td width="10%">Category Name</td>
                <td><input type="text" name="category[name]" id="name"></td>
            </tr>
            <tr>
                <td width="10%">Status</td>
                <td><select name="category[status]" id="status">
                    <option value="1">active</option>
                    <option value="2">inactie</option>
                </select></td>
            </tr>
            <tr>
                <td width="10%"></td>
                <td>
                    <input type="submit" value="add" name="submit">
                    <button><a href="index.php?c=category&a=grid">Cancel</a></button>
                </td>
            </tr>

        </table>
        
    </form>
</body>
</html>