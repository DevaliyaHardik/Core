<?php

$categories = $this->getCategory();

?>

<h1 id="post">Categories</h1>
<div id="add"><a href="<?php echo $this->getUrl('add') ?>">Add CATEGORY</a></div>
<div id="item">
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
				<option value="<?php echo $perPageCount ?>" <?php echo ($perPageCount == $this->getPager()->getPerPageCount() ? 'selected' : '') ?>><?php echo $perPageCount ?></a></option>
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
    <table border=1 width=100%>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Base Image</th>
            <th>Thumb Image</th>
            <th>Small Image</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Gallery</th>
        </tr>
        <?php if(!$categories): ?>
        <tr>
            <td colspan="11">No Recored Receive</td>
        </tr>
        <?php else: ?>
        <?php foreach($categories as $category): ?>
        <tr>
            <td><?php  echo $category->category_id; ?></td>
            <td><?php echo $this->getPath($category->category_id,$category->path); ?></td>
            <?php if($category->base ): ?>
            <td><img src="<?php echo 'Media/category/'.$this->getMedia($category->base)['name']; ?>" alt="No Image found" width=50 height=50></td>
            <?php else: ?>
            <td>No base image</td>
            <?php endif; ?>

            <?php if($category->thumb ): ?>
            <td><img src="<?php echo 'Media/category/'.$this->getMedia($category->thumb)['name']; ?>" alt="No Image found" width=50 height=50></td>
            <?php else: ?>
            <td>No thumb image</td>
            <?php endif; ?>

            <?php if($category->small ): ?>
            <td><img src="<?php echo 'Media/category/'.$this->getMedia($category->small)['name']; ?>" alt="No Image found" width=50 height=50></td>
            <?php else: ?>
            <td>No small image</td>
            <?php endif; ?>
            <td><?php echo $category->getStatus($category->status); ?></td>
            <td><?php echo $category->createdDate; ?></td>
            <td><?php echo $category->updatedDate; ?></td>
            <td><a href='<?php echo $this->getUrl('edit','category',['id'=>$category->category_id]) ?>'>Edit</a></td>
            <td><a href='<?php echo $this->getUrl('delete','category',['id'=>$category->category_id]) ?>'>Delete</a></td>
            <td><a href="<?php echo $this->getUrl('grid','category_media',['id'=>$category->category_id]) ?>">Gallary</a></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>