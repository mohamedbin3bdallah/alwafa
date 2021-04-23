<script> window.print(); </script>
<?php
if(isset($printcodes) && !empty($printcodes))
{
	foreach($printcodes as $code)
	{
		?><img src="<?php echo base_url(); ?>barcode/barcode.php?codetype=Code39&size=55&text=<?php echo $itemcode.'NO'.$code; ?>&print=true" /><br><?php
	}
}
?>