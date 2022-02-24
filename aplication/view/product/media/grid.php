<?php

$medias = $this->getMedias();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media</title>
</head>
<body>

    <form action="<?php echo $this->getUrl('product_media','edit') ?>" method="POST" align=center>
        <input type="submit" value="update">
        <button><a href="<?php echo $this->getUrl('product','grid',[],true); ?>">Cancel</a></button>
        <table border=3 align=center width=100% cellspacing=4>
            <tr>
                <th>Image Id</th>
                <th>Product Id</th>
                <th>Name</th>
                <th>Base</th>
                <th>Thumb</th>
                <th>Small</th>
                <th>Gallery</th>
                <th>Remove</th>
            </tr>
            <?php if(!$medias): ?>
                <tr>
                    <td colspan=8>No Recored Found</td>
                </tr>
            <?php else: ?>
            <?php $i = 1; ?>
            <?php foreach ($medias as $media): ?>
            <tr>
                <td><?php echo $media['image_id'] ?></td>
                <td><?php echo $media['product_id'] ?></td>
                <td><?php echo $media['name'] ?></td>
                <input type="hidden" name="media<?php echo $i; ?>[image_id]" value=<?php echo $media['image_id'] ?> >
                <input type="hidden" name="media<?php echo $i; ?>[name]" value=<?php echo $media['name'] ?> >
                <td>
                    <input type="radio" name="media[base]" value = "<?php echo $media['image_id'] ?>" <?php echo $media['base'] == 1 ? 'checked' : ''; ?> >
                </td>
                <td>
                    <input type="radio" name="media[thumb]" value = "<?php echo $media['image_id'] ?>" <?php echo $media['thumb'] == 1 ? 'checked' : ''; ?> >
                </td>
                <td>
                    <input type="radio" name="media[small]" value = "<?php echo $media['image_id'] ?>" <?php echo $media['small'] == 1 ? 'checked' : ''; ?> >
                </td>
                <td>
                    <input type="checkbox" name="media<?php echo $i; ?>[gallery]" <?php echo $media['gallery'] == 1 ? 'checked' : ''; ?>>
                </td>
                <td>
                    <input type="checkbox" name="media<?php echo $i; ?>[remove]" >
                </td>
            </tr>
            <?php $i++; endforeach; ?>
            <?php  endif; ?>
        </table>
    </form>

    <form action="<?php echo $this->getUrl('product_media','save') ?>" method="POST" enctype="multipart/form-data">
        <input type="file" name="name">
        <input type="submit" value="upload">
    </form>
    
</body>
</html>