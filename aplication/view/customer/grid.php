<?php

$load = new Model_Core_Adapter();
$address = $load->fetchAll("SELECT * FROM `address`");
$customer = $load->fetchAll("SELECT * FROM `customer`");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>
    <style>
        body{
            text-align : center;
        }
    </style>
</head>
<body>
    <h1 id="post">customer Details</h1>
    <div id="add"><a href="index.php?c=customer&a=add">Add Customre</a></div>
    <div id="item">
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
            </tr>
            <?php if(!$address): ?>
                <tr>
                    <td colspan="10">No Recored Found</td>
                </tr>
            <?php else: ?>
            <?php foreach ($customer as $customer): ?>
            <?php $result = ($customer['status'] == 1)? 'active':'inactive'; ?>
            <tr>
                <td><?php echo $customer['customer_id']; ?></td>
                <td><?php echo $customer['firstName']; ?></td>
                <td><?php echo $customer['lastName']; ?></td>
                <td><?php echo $customer['email']; ?></td>
                <td><?php echo $customer['mobile']; ?></td>
                <td><?php echo $result; ?></td>
                <td><?php echo $customer['createdDate']; ?></td>
                <td><?php echo $customer['updatedDate']; ?></td>
                <td><a href='index.php?c=customer&a=edit&id=<?php echo $customer['customer_id']; ?>'>Edit</a></td>
                <td><a href='index.php?c=customer&a=delete&id=<?php echo $customer['customer_id']; ?>'>Delete</a></td>
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
                <th>Address1</th>
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
            <?php $biling = ($address['biling'] == 1) ? 'Yes' : 'No'; ?>
            <?php $shiping = ($address['shiping'] == 1) ? 'Yes' : 'No'; ?>
            <tr>
                <td><?php echo $address['address_id']; ?></td>
                <td><?php echo $address['customer_id']; ?></td>
                <td><?php echo $address['address1']; ?></td>
                <td><?php echo $address['city']; ?></td>
                <td><?php echo $address['state']; ?></td>
                <td><?php echo $address['postalCode']; ?></td>
                <td><?php echo $address['country']; ?></td>
                <td><?php echo $biling; ?></td>
                <td><?php echo $shiping; ?></td>
                <td><a href='index.php?c=customer&a=edit&id=<?php echo $address['customer_id']; ?>'>Edit</a></td>
                <td><a href='index.php?c=customer&a=delete&id=<?php echo $address['customer_id']; ?>'>Delete</a></td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </table>
    </div>
</body>
</html>