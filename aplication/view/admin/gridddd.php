1111
<?php
$admins = $this->getAdmin();
?>
<h1 id="post" align="center">Admin</h1>
<div id="add" align="center"><a href="<?php echo $this->getUrl('add') ?>">Add Admin</a></div>
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
    <table border=1 width=100% align="center">
        <tr>
            <th>admin Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php if(!$admins): ?>
            <tr>
                <td colspan="10">No Recored Found</td>
            </tr>
        <?php else: ?>
        <?php foreach ($admins as $admin): ?>
        <tr>
            <td><?php echo $admin->admin_id; ?></td>
            <td><?php echo $admin->firstName; ?></td>
            <td><?php echo $admin->lastName; ?></td>
            <td><?php echo $admin->email; ?></td>
            <td><?php echo $admin->getStatus($admin->status); ?></td>
            <td><?php echo $admin->createdDate; ?></td>
            <td><?php echo $admin->updatedDate; ?></td>
            <td><a href="<?php echo $this->getUrl('edit','admin',['id'=>$admin->admin_id]) ?>">Edit</a></td>
            <td><a href="<?php echo $this->getUrl('delete','admin',['id'=>$admin->admin_id]) ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </table>
</div>
