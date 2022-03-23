<?php 

$order = $this->getOrder();
$bilingAddress = $order->bilingAddress;
$shipingAddress = $order->shipingAddress;
$items = $order->items;

?>
</table>
<table border="1">
    <tr>
        <th>Biling Address</th>
        <th>Shiping Address</th>
    </tr>
    <tr>
        <td>
            <table border="1">
                <tr>
                    <td>First Name</td>
                    <td><?php echo $bilingAddress->firstName; ?></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><?php echo $bilingAddress->lastName; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $bilingAddress->email; ?></td>
                </tr>
                <tr>
                    <td>Mobile</td>
                    <td><?php echo $bilingAddress->mobile; ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo $bilingAddress->address; ?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td><?php echo $bilingAddress->city; ?></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td><?php echo $bilingAddress->state; ?></td>
                </tr>
                <tr>
                    <td>Postal Code</td>
                    <td><?php echo $bilingAddress->postalCode; ?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td><?php echo $bilingAddress->country; ?></td>
                </tr>
            </table>
        </td>
        <td>
            <table border="1">
                    <tr>
                        <td>First Name</td>
                        <td><?php echo $shipingAddress->firstName; ?></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><?php echo $shipingAddress->lastName; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $shipingAddress->email; ?></td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td><?php echo $shipingAddress->mobile; ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo $shipingAddress->address; ?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><?php echo $shipingAddress->city; ?></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><?php echo $shipingAddress->state; ?></td>
                    </tr>
                    <tr>
                        <td>Postal Code</td>
                        <td><?php echo $shipingAddress->postalCode; ?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><?php echo $shipingAddress->country; ?></td>
                    </tr>
            </table>
        </td>
    </tr>
</table>

<table border="1">
    <tr>
        <th>Item Id</th>
        <th>Order Id</th>
        <th>Product Id</th>
        <th>Image</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Tax</th>
        <th>Tax Amount</th>
        <th>Discount</th>
    </tr>
    <?php if(!$items): ?>
    <tr>
        <td colspan="6">no item found</td>
    </tr>
    <?php else: ?>
    <?php $i = 0; ?>
    <?php foreach($items as $item): ?>
    <tr>
        <td><?php echo $item->item_id ?></td>
        <td><?php echo $item->order_id ?></td>
        <td><?php echo $item->product_id ?></td>
        <td><img src="Media/Product/<?php echo $item->getProduct()->getBase()->name; ?>" alt="image not found" width="50" hight="50"></td>
        <td><?php echo $item->name; ?></td>
        <td><?php echo $item->quantity; ?></td>
        <td><?php echo $item->price; ?></td>
        <td><?php echo $item->tax; ?></td>
        <td><?php echo $item->taxAmount; ?></td>
        <td><?php echo $item->discount; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    <?php endif;?>
    <tr>
        <td>Shiping Charge</td>
        <td align="right" colspan="9"><?php echo $order->shipingCharge; ?></td>
    </tr>
    <tr>
        <td>Grand Total</td>
        <td align="right" colspan="9"><?php echo $order->grandTotal; ?></td>
    </tr>
</table>