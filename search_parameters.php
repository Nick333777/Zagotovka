<?php
	include("db.php");
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (isset($_POST['search_tag'])){$search_tag=mysqli_real_escape_string($db,$_POST['search_tag']);}
		if (isset($_POST['search_date'])){$search_date=mysqli_real_escape_string($db,$_POST['search_date']);}
		if (isset($_POST['search_category'])){$search_category=mysqli_real_escape_string($db,$_POST['search_category']);}
		
		$search_sql="SELECT `tags`,`id`,`date`,`category` FROM `news` WHERE `id` > 0";
		$search_query=mysqli_query($db, $search_sql);
		
		$tag_ids=array();
		$date_ids=array();
		$category_ids=array();

		while($search=mysqli_fetch_array($search_query)){
			$tag=$search['tags'];
			$id=$search['id'];
			$date=$search['date'];
			$category=$search['category'];
			
			// find by tag
			if ($search_tag!="")
			{
				$exp_tag=explode(",",$tag);
				$count=0;
				while ($count < count($exp_tag))
				{
					if (($search_tag == $exp_tag[$count]) && (isset($_POST['search_tag'])))
					{
						array_push($tag_ids,$id);
						echo "tags:";
						echo $id;
						echo "<br>";
						
					}
					$count = $count+1;
				}
			}
			
			//find by date
			if ($search_date!="")
			{
				if (($search_date==$date) && (isset($_POST['search_date'])))
				{
					array_push($date_ids,$id);
					echo "date:";
					echo $id;
					echo "<br>";
				}
			}
			
			//find by category
			if ($search_category!="")
			{
				if (($search_category==$category) && (isset($_POST['search_category'])))
				{
					array_push($category_ids,$id);
					echo "cate:";
					echo $id;
					echo "<br>";
				}
			}	
		}
		// all the search magic is here
		if ($search_tag!="")
		{
			if ($search_date!="")
			{
				if ($search_category!="")
				{
					$search_result=array_intersect($tag_ids,$date_ids,$category_ids);	
				}
				else
				{
					$search_result=array_intersect($tag_ids,$date_ids);	
				}
			}
			else
			{
				if ($search_category!="")
				{
					$search_result=array_intersect($tag_ids,$category_ids);	
				}
				else
				{
					$search_result=$tag_ids;	
				}
			}
		}
		else 
		{
			if ($search_date!="")
			{
				if ($search_category!="")
				{
					$search_result=array_intersect($date_ids,$category_ids);	
				}
				else
				{
					$search_result=$date_ids;	
				}
			}
			else
			{
				if ($search_category!="")
				{
					$search_result=$category_ids;	
				}
				else
				{
					echo "No input";
					$search_result=array();
				}
			}
		}
	/*	$count=0;
		$search_result_2=array();
		$size=count($search_result);
		
		while ($count < $size-1)
		{
			
			if ($search_result[$count]!="")
			{
				array_push($search_result_2,$search_result[$count]);
			}
			$count=$count+1;
		}
		print_r($search_result_2);*/
		print_r($search_result);
	}
?>
<form action="search_parameters.php" method="post">
	<input type="text" name="search_tag"/>
	<input type="text" name="search_date"/>
	<input type="text" name="search_category"/>
	<input type="submit"/>
</form>