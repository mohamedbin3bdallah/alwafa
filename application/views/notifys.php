<script>
	$(document).ready(function(){
		$("#unreadNTs").click(function(){
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>home/read',
				data: {
				},
				success: function (response) { $( "#unreadNTsC" ).hide(); }
			});
		});
	});
</script>
<script>
	$(document).ready(function(){
		$("#unreadORs").click(function(){
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>orders/read',
				data: {
				},
				success: function (response) { $( "#unreadORsC" ).hide(); }
			});
		});
	});
</script>
<script>
	$(document).ready(function(){
		$("#unreadJOs").click(function(){
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>joborders/read',
				data: {
				},
				success: function (response) { $( "#unreadJOsC" ).hide(); }
			});
		});
	});
</script>
<script>
	$(document).ready(function(){
		$("#unreadPVs").click(function(){
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>paymentvouchers/read',
				data: {
				},
				success: function (response) { $( "#unreadPVsC" ).hide(); }
			});
		});
	});
</script>
<script>
	$(document).ready(function(){
		$("#unreadBLs").click(function(){
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>bills/read',
				data: {
				},
				success: function (response) { $( "#unreadBLsC" ).hide(); }
			});
		});
	});
</script>