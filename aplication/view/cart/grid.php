<?php $orders = $this->getOrders(); ?>
<a href="<?php echo $this->getUrl('edit','cart') ?>"><button>Add New Order</button></a>

<table border="1">
    <tr>
        <th>Order Id</th>
        <th>Customer Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Tax</th>
        <th>Discount</th>
        <th>Grand Total</th>
        <th>View Order</th>
    </tr>
    <?php if(!$orders): ?>
    <tr>
        <td colspan="10">No order found</td>
    </tr>
    <?php else: ?>
    <?php foreach($orders as $order): ?>
    <tr>
        <td><?php echo $order->order_id ?></td>
        <td><?php echo $order->customer_id ?></td>
        <td><?php echo $order->firstName ?></td>
        <td><?php echo $order->lastName ?></td>
        <td><?php echo $order->email ?></td>
        <td><?php echo $order->mobile ?></td>
        <td><?php echo $order->taxAmount ?></td>
        <td><?php echo $order->discount ?></td>
        <td><?php echo $order->grandTotal ?></td>
        <td><a href="<?php echo $this->getUrl('edit','order',['id' => $order->order_id],true); ?>">View Order</a></td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>