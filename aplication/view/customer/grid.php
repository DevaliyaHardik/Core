<?php
$customers = $this->getCustomer();
$address = $this->getAddress();


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
    <div id="add"><a href="<?php echo $this->getUrl('add','customer'); ?>">Add Customre</a></div>
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
                <td><?php echo $this->getStatus($customer->status); ?></td>
                <td><?php echo $customer->createdDate; ?></td>
                <td><?php echo $customer->updatedDate; ?></td>
                <td><a href="<?php echo $this->getUrl('edit','customer',['id' => $customer->customer_id],true); ?>">Edit</a></td>
                <td><a href="<?php echo $this->getUrl('delete','customer',['id' => $customer->customer_id],true); ?>">Delete</a></td>
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
                <td><a href="<?php echo $this->getUrl('edit','customer',['id' => $customer->customer_id],true); ?>">Edit</a></td>
                <td><a href="<?php echo $this->getUrl('delete','customer',['id' => $customer->customer_id],true); ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </table>
    </div>
</body>
</html>