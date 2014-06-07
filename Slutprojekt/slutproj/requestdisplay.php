<!DOCTYPE html>

<html lang="sv">

	<?php
		require_once('classes/global.inc.php');
		$GLOBALS["pdo"] = get_pdo();
	?>

	<head>
	
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width,user-scalable=yes"/>
	   	<title>3.141592653589793238462643383279</title>
	    <link rel="stylesheet" type="text/css" href="css/style.css"/>
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script>
		$(document).ready(function()
		{
			$("#sidebarbutton").click(function()
			{
				$("#sidebar").toggle(1000);
			});
		});
		</script>
		
	</head>

	<!--[if !IE 7]>
	<style type="text/css">
		#wrap {display:table;height:100%}
	</style>
	<![endif]-->

<body>
	
	<header id="navigationmenu">
	
		<ul>
		
			<li><a href="index.php">Hem</a></li>
			<li><a href="user.php">Användare</a></li>
			<li><a href="addsummary.php">Bidra</a></li>
			<li><a href="request.php">Förfråga</a></li>
			
			<form id="searchbar" action="searchfunction.php" method="GET">
				<input id="searchtext" type="text" name="query" />
				<input type="submit" value="Sök" />
			</form>
			
		</ul>
		
    </header>
	
	<div id="sidebar">
			<ul id="subcategory">
				<?php 
				foreach ($GLOBALS["pdo"]->query("SELECT * FROM fields ORDER BY field") as $result) 
				{
					
					if (isset($_GET['subject_id']))
					{
						if ($result['id'] == $_GET['subject_id'])
						{
							echo "<li class='subject'><img class='sidebararrow' src='img/sidebararrowdown.png'><a href='summarydisplay.php?subject_id={$result['id']}' title='$result[field]'>{$result['field']}</a>";
							if ($exist = array($GLOBALS["pdo"]->query("SELECT * FROM categories WHERE field_id=$result[id]' ORDER BY course")))
							{
								if (sizeof($exist) > 0) 
								{
									echo '<ul class="courses">';
									foreach ($GLOBALS["pdo"]->query("SELECT * FROM courses WHERE field_id='$result[id]' ORDER BY course") as $result2)
									{
										echo "<li id=\"course\"><a href=\"allsummaries.php?courseid={$result2['id']}\" title=\"$result2[course]\">{$result2['course']}</a></li>";
									}
									echo "</ul></li>";
								}
							}
						} 
						else
						{
							echo "<li class='subject'><img class='sidebararrow' src='img/sidebararrow.png'><a href='summarydisplay.php?subject_id={$result['id']}' title='$result[field]'>{$result['field']}</a>";
						}
					} 
					else 
					{
						echo "<li class='subject'><img class='sidebararrow' src='img/sidebararrow.png'><a href='summarydisplay.php?subject_id={$result['id']}' title='$result[field]'>{$result['field']}</a>";
					}
					echo "</li>";
				}
				?>
			</ul>
	</div>
	
	<div id="requests">
	<?php if ($_GET != null) {
					$request_id = filter_input(INPUT_GET, 'request_id', FILTER_VALIDATE_INT);
					$statement = $GLOBALS["pdo"]->prepare("SELECT * FROM summaries WHERE id=:request_id");
					$statement->bindParam(':request_id', $request_id);                 
					if ($statement->execute())
					{
						while ($summarydisplay = $statement->fetch()) {
							if ($statement->rowCount() > 0)
								echo "<h1>{$summarydisplay['title']}</h1><p>Tillagd: {$summarydisplay['date']} av {$summarydisplay['user_id']}</p><p>{$summarydisplay['content']}</p>";
						}
					}
					elseif (!$statement->execute())
					{
						echo $statement->errorInfo();
					}
	} else {
		echo "Ingen sammanfattning vald.";
		} ?>
	</div>
	
	<?php
	if (!isset($_GET['subject_id']))
	echo '<script> $("#sidebar").toggle(); </script> '; 
	?>
	
	<button id="sidebarbutton" type="button"> ||| </button>

	<footer>
		<p> Copyright © 2013-2014 Emil Hedström. All rights reserved. </p>
	</footer>

</body>

</html>