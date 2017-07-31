//This automatically calls the Pagination Function on page load
$(document).ready(function()
{
	vpb_pagination_system('1')
});

//This is the Pagination Function
function vpb_pagination_system(page_id)
{	
	var dataString = "page=" + page_id;
	$.ajax({  
		type: "POST",  
		url: "content_displayer.php",  
		data: dataString,
		beforeSend: function() 
		{
			$('#vpb_pagination_system_displayer').html('<br clear="all"><div style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait <img src="images/loadings.gif" align="absmiddle" /></div><br clear="all">');
		},  
		success: function(response)
		{
			$("#vpb_pagination_system_displayer").fadeIn(2000).html(response);
		}
	});
}