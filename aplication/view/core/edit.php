<form action="save.php" id="form" method="POST">
<?php
    $this->getTab()->toHtml();
    $this->getTabContent()->toHtml();
?>
</form>
