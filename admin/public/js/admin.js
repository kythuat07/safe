$(document).ready(function () {
    $('ul#menu>li>a[href="#"]').click(function(){
        $(this).next('ul').toggle();
        return false;
    });
	
	
	$('.a_stt').on('blur',function() {
		var table=$(this).attr('data-table');
		var col=$(this).attr('data-col');
		var id=$(this).attr('data-id');
		var val=$(this).val();
		$.ajax({
			url: './sources/ajax.php',
			type: "POST",
			data: {'table': table, 'col': col, 'val':val, 'id':id, 'do':'update_stt'},	
			dataType: "json",
		})
	});
	
	
	
	
	
	
	
	
	
	
	
});