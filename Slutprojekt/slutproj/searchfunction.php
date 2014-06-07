<!DOCTYPE html>

<html lang="sv">

	<?php
		require_once('classes/global.inc.php');
		$GLOBALS["pdo"] = get_pdo();
    mysql_connect("localhost", "root", "") or die("Godis är inte så gott" .mysql_error());
	mysql_select_db("slutprojekt") or die(mysql_error());
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
							echo "<li class='subject'><img class='sidebararrow' src='img/sidebararrowdown.png'><a href='index.php?subject_id={$result['id']}' title='$result[field]'>{$result['field']} (";
							foreach ($GLOBALS["pdo"]->query("SELECT COUNT(*) as course FROM courses WHERE field_id='$result[id]'") as $guggewow)
							{
								print $guggewow['course'];
							}
							echo ")</a>";
							if ($exist = array($GLOBALS["pdo"]->query("SELECT * FROM categories WHERE field_id=$result[id]' ORDER BY course")))
							{
							
								if (sizeof($exist) > 0) 
								{
									echo '<ul class="courses">';
									foreach ($GLOBALS["pdo"]->query("SELECT * FROM courses WHERE field_id='$result[id]' ORDER BY course") as $result2)
									{
										echo "<li id=\"course\"><a href=\"allsummaries.php?courseid={$result2['id']}\" title=\"$result2[course]\">{$result2['course']} (";
										foreach ($GLOBALS["pdo"]->query("SELECT COUNT(*) as summary FROM summaries WHERE course_id='$result2[id]'") as $guggec)
										{
											print $guggec['summary'];
										}
										echo ")</a></li>";
									}
									echo "</ul></li>";
								}
							}
						} 
						else
						{
							echo "<li class='subject'><img class='sidebararrow' src='img/sidebararrow.png'><a href='index.php?subject_id={$result['id']}' title='$result[field]'>{$result['field']} (</a>";
							foreach ($GLOBALS["pdo"]->query("SELECT COUNT(*) as course FROM courses WHERE field_id='$result[id]'") as $guggewow)
							{
								print $guggewow['course'];
							}
							echo ")</a>";
						}
					} 
					else 
					{
						echo "<li class='subject'><img class='sidebararrow' src='img/sidebararrow.png'><a href='index.php?subject_id={$result['id']}' title='$result[field]'>{$result['field']} (</a>";
							foreach ($GLOBALS["pdo"]->query("SELECT COUNT(*) as course FROM courses WHERE field_id='$result[id]'") as $guggewow)
							{
								print $guggewow['course'];
							}
							echo ")</a>";
					}
					echo "</li>";
				}
				?>
			</ul>
	</div>
	
	<?php
	if (!isset($_GET['subject_id']))
	echo '<script> $("#sidebar").toggle(); </script> '; 
	?>
	
	<button id="sidebarbutton" type="button"> ||| </button>
	
	<?php
		$query = $_GET["query"];
		$min_length = 3;
		if(strlen($query) >= $min_length)
		{
			$query = htmlspecialchars($query);
			$query = mysql_real_escape_string($query);
			$raw_results = mysql_query("SELECT * FROM summaries WHERE (`title` LIKE '%".$query."%') OR (`content` LIKE '%".$query."%')") or die(mysql_error());
			if(mysql_num_rows($raw_results) > 0)
			{
				while($results = mysql_fetch_array($raw_results))
				{
					echo "<h3>".$results['title']."</h3><p>".$results['content']."</p>";
				}
			}
			else
			{
				echo "Det finns inga sammanfattningar som innehåller liknande text som det du sökte på :(";
			}
			
		}
		else
		{
			echo "Din sökning måste innehålla minst ".$min_length. " tecken.";
		}
	?>

	<footer>
	
		<p> Copyright © 2013-2014 Emil Hedström. All rights reserved. </p>
		
	</footer>
	
</body>

</html>