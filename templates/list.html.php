<?php 
foreach($jokes as $joke) { 
	if ($joke['authorName']=='') {
		$joke['authorName'] = 'Unknown';
	}
	?>
<blockquote>
<p>
	
	<?=$joke['joketext']?> 
	
	<a href="/joke/edit?id=<?=$joke['id']?>"><button>edit</button></a>
	<a href="/joke/delete?id=<?=$joke['id']?>"><button>delete</button></a>
	<br>joke added by <?=$joke['authorName']?>

</p>
</blockquote>
<?php } ?>
