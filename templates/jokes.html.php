<?php 
foreach($jokes as $joke) {
    ?>
	<blockquote>
    <p> <?= $joke;?></p>
	</blockquote>
<?php
}
?>