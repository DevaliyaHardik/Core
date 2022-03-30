<form action="<?php echo $this->getUrl('save'); ?>" id="form" method="POST">
<?php
    $this->getTab()->toHtml();
    $this->getTabContent()->toHtml();
?>
</form>
