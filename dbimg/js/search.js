/*$(function(){
	
		
var atai=1;
	
search(atai);
});


function search(atai){
	
		$.ajax ({
		type: "POST",
		url: "search.php",
		data: {co : atai},
		success: function(data, dataType)
		{
			var result=JSON.parse(data);
			console.log(result);
			//$("#search_disp").html(result);
			$('#search_disp').append(result);
		},
	});
		
}
*/