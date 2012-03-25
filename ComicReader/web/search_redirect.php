<?php

if (isset($_POST['search']) && $_POST['search'] != "")
{
    $url = 'app_dev.php/search/'.htmlentities($_POST['search']);
}
else
{
    $url = 'app_dev.php/ComicReader';
}

?>
<script type="text/javascript">
<!--
    window.location = "<?php echo $url; ?>" 
//-->
</script>