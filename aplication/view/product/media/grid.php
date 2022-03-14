<?php $medias = $this->getMedias(); ?>
<table align="center">
    <tr>
        <td>
        <script type="text/javascript"> 
			function ppc() {
				const ppcValue = document.getElementById('ppc').selectedOptions[0].value;
				let language = window.location.href;
				if(!language.includes('ppc'))
				{
				  	language+='&ppc=20';
				}
				const myArray = language.split("&");
				for (i = 0; i < myArray.length; i++)
				{
					if(myArray[i].includes('p='))
					{
					  	myArray[i]='p=1';
					}
					if(myArray[i].includes('ppc='))
					{
					  	myArray[i]='ppc='+ppcValue;
					}
				}
 				const str = myArray.join("&");
 				location.replace(str);
			}
        </script>
        <select onchange="ppc()" id="ppc">
            <?php foreach($this->pager->getPerPageCountOption() as $perPageCount) :?>	
            <option value="<?php echo $perPageCount ?>" <?php echo ($perPageCount == $this->getPager()->getPerPageCount() ? 'selected' : '') ?>> <?php echo $perPageCount ?> </a></option>
            <?php endforeach;?>
        </select>

        </td>
        <td><a href="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getStart()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getStart()) ? 'none' : ''?>"><button>Start</button></a></td>
        <td><a href="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getPrev()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getPrev()) ? 'none' : ''?>"><button>Prev</button></a></td>
        <td><a href="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getCurrent()]) ?>" style="pointer-events: none "><button><?php echo $this->getPager()->getCurrent(); ?></button></a></td>
        <td><a href="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getNext()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getNext()) ? 'none' : ''?>"><button>Next</button></a></td>
        <td><a href="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getEnd()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getEnd()) ? 'none' : ''?>"><button>End</button></a></td>
    </tr>
</table>

<form action="<?php echo $this->getUrl('save') ?>" method="POST" align=center>
    <input type="submit" value="update">
    <button><a href="<?php echo $this->getUrl('grid','product',['id' => null]); ?>">Cancel</a></button>
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
        <?php foreach ($medias as $media): ?>
        <tr>
            <td><?php echo $media->media_id ?></td>
            <td><?php echo $media->product_id ?></td>
            <td><?php echo $media->name ?></td>
            <td>
                <input type="radio" name="media[base]" value = "<?php echo $media->media_id ?>" <?php echo $this->selected($media->media_id,'base'); ?> >
            </td>
            <td>
                <input type="radio" name="media[thumb]" value = "<?php echo $media->media_id ?>" <?php echo $this->selected($media->media_id,'thumb'); ?> >
            </td>
            <td>
                <input type="radio" name="media[small]" value = "<?php echo $media->media_id ?>" <?php echo $this->selected($media->media_id,'small'); ?> >
            </td>
            <td>
                <input type="checkbox" name="media[gallery][]" value = "<?php echo $media->media_id ?>" <?php echo $media->gallery == 1 ? 'checked' : ''; ?>>
            </td>
            <td>
                <input type="checkbox" name="media[remove][]" value = "<?php echo $media->media_id ?>" >
            </td>
        </tr>
        <?php endforeach; ?>
        <?php  endif; ?>
    </table>
</form>

<form action="<?php echo $this->getUrl('save','product_media') ?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="name">
    <input type="submit" value="upload">
</form>