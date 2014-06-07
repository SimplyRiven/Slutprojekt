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

	<?php
		if(!empty($_POST))
			{
				if(isset($_POST["title"]))
				{
					$user_id = filter_input(INPUT_POST, 'user_id');
					$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
					$title = filter_input(INPUT_POST, 'title');
					$course_id = filter_input(INPUT_POST, 'course_id');
					$statement = $pdo->prepare("INSERT INTO summaries (user_id, content, date, title, course_id) VALUES (:user_id, :content, NOW(), :title, :course_id)");
					$statement->bindParam(':user_id', $user_id);
					$statement->bindParam(':content', $content);
					$statement->bindParam(':title', $title);
					$statement->bindParam(':course_id', $course_id);
					$_POST = null;
					if(!empty($content))
					{
						$statement->execute();
					}
					else
					{
						echo '<script> alert("You have to type something in the textfield before you post, noob."); </script>';
					}        
				}
			}
	?>
	
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
							echo "<li class='subject'><img class='sidebararrow' src='img/sidebararrowdown.png'><a href='addsummary.php?subject_id={$result['id']}' title='$result[field]'>{$result['field']}</a>";
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
							echo "<li class='subject'><img class='sidebararrow' src='img/sidebararrow.png'><a href='addsummary.php?subject_id={$result['id']}' title='$result[field]'>{$result['field']}</a>";
						}
					} 
					else 
					{
						echo "<li class='subject'><img class='sidebararrow' src='img/sidebararrow.png'><a href='addsummary.php?subject_id={$result['id']}' title='$result[field]'>{$result['field']}</a>";
					}
					echo "</li>";
				}
				?>
			</ul>
	</div>
	
	<div class="description">
		<h1> Just nu lägger du till en sammanfattning </h1>
		<span> Var vänlig och välj under vilket namn och vilken kurs du vill att sammanfattningen skall tillhöra </span>
	</div>
	
	<form id="postsummary" action="addsummary.php" method="POST">
		
			<p>
				<label for="user_id"> Användare: </label>
				<select name="user_id">
				<?php
					foreach ($pdo -> query("SELECT * FROM users ORDER BY name") as $row)
					{
						echo "<option value={$row['id']}>{$row['name']}</option>";
					}
				?>
				</select>
			</p>
			<p>
				<label for="course_id"> Kurs: </label>
				<select name="course_id">
				<?php
					foreach ($pdo -> query("SELECT * FROM courses ORDER BY course") as $row)
					{
						echo "<option value={$row['id']}>{$row['course']}</option>";
					}
				?>
				</select>
			</p>
			<p>
				<label for="post"> Titel: </label>
				<input type="text" name="title" />
				</br>
				<textarea name="content" rows="10" cols="70"></textarea>
				<input type="submit" value="Post" />
			</p>
	</form>
			
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