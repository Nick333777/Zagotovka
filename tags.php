<?php
	include("db.php");
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$st_tag=mysqli_real_escape_string($db,$_POST['tag']);
		$tag_sql="SELECT `tags`,`id` FROM `news` WHERE `id` > 0";
		$tag_result=mysqli_query($db, $tag_sql);
		while($tags=mysqli_fetch_array($tag_result)){
			$tag=$tags['tags'];
			$id=$tags['id'];
			
			$exp_tag=explode(",",$tag);
			$count=0;
			while ($count < count($exp_tag))
			{
				if ($st_tag == $exp_tag[$count])
				{
					echo $id;
				}
				$count = $count+1;
			}
		}
	}
?>
<form action="tags.php" method="post">
	<input type="text" name="tag"/>
	<input type="submit"/>
</form>
