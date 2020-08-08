<!--=*= BOOTSTRAP DATE PICKER =*=-->
<script type="text/javascript">
	$(".default-date-picker").datepicker({format: 'yyyy-mm-dd'});
	
	$(".default-date-picker").click(function(){
		var edit_start_date = $(".edit_start_date").val();
		var edit_end_date = $(".edit_end_date").val();
		
		if(edit_start_date == "0000-00-00")
			$(".edit_start_date").datepicker("setDate", new Date());
		if(edit_end_date == "0000-00-00")
			$(".edit_end_date").datepicker("setDate", new Date());
	});
</script>
<!--=*= BOOTSTRAP DATE PICKER =*=-->