<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>AJAX Notes</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script type="text/javascript" src= 'http://code.jquery.com/jquery-1.10.2.min.js'></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('form').submit(function(){
				$.post($(this).attr('action'),$(this).serialize(), function(value){
					$('#body').append
						("<div id='meat'>"+ 
							"<form action='/notes/update_note/"+value.id+"' method='post' class='update_note' >"+
								"<h2>" + value.title + "</h2>"+
								"<textarea id='posted_comment' rows='7' cols='25' name='description'>" + value.description +
								"</textarea>"+
								"<input type='submit' name='update' value='click to update!'><br>"+
								"<a href='/notes/delete_note/" +value.id+ "'>Delete</a>"+
							"</form>"+
						"</div>");	
				},'json');
			return false; 
			})
			//-----End of first AJAX (Adding Note)-----///
			$(document).on('click','a', function(){
				var test = this;
				$.post($(this).attr('href'), function(value){
					$(test).parent().parent().remove();
				})
				return false; 
			})
			///-----End of second AJAX (Delete Button)-----///
			$(document).on('submit', '.update_note', function(){
				var test2 = this;
				$.post($(test2).attr('action'), $(test2).serialize())
				return false;
			})
		})
	</script>
</head>
<body>
<div id="container">
	<h1>Notes</h1>
	<div id='body'>
			<?php
			foreach ($notes as $value) 
			{
				echo "<div id='meat'>
						<form action='/notes/update_note/".$value['id']."' method='post' class='update_note' >	
							<h2>".$value['title']."</h2>
								<textarea id='posted_comment' rows='7' cols='25' id='scroll' name='description'>".$value['description'].
								"</textarea>			
									<input type='submit' name='update' value='click to update!'><br>
									<a href='/notes/delete_note/{$value['id']}'>Delete</a>
							</form>
						</div>";											
			}
			?>

	</div>
	<div id="bottom">
		<form action='/notes/add_note' method='post'>
			<textarea name ='description' placeholder='Enter description here..'rows="5" cols="45"></textarea><br>
			<input type='text' id='tit'name ='title' placeholder='Enter note title here..'><br>
			<input type='submit' id='sub'value='Add Note'>
		</form>
	</div>
</div>
</body>
</html>