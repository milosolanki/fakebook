$(document).ready(function(){
	$('#image').click(function(e){
		var left = e.clientX;
		var topi = e.clientY;
		$('#name').css('top',topi).css('left',left);
		$('#name').show().focus();
	});
	$('#del').click(function(e){
		var table = $('#table').val();
		$.post('deletetag.php', { table:table }, function(data){
			alert(data);
			location.reload();
		});
	});
	$('#name').keyup(function(e){
		if(e.keyCode==13){
		var name=$(this).val();
		$(this).val('');
		var top = $(this).position().top;
		var left = $(this).position().left;
		var table = $('#table').val();
		$.post('poster.php', { table:table, name:name, top:top, left:left}, function(data){
			alert(data);
			location.reload();
			});
		}
		else if(e.keyCode==27){
			$('#name').hide();
		}
	});
});
