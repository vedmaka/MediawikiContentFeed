Selected records was imported:
<ul>
	<? foreach( $titles as $title ): ?>
	<li>
		<a target="_blank" href="<?=$title->getFullUrl()?>">
			<?=$title->getBaseText()?>
		</a>
	</li>
	<? endforeach; ?>
</ul>
<br>
<a href="/index.php/Special:ContentFeed">Back</a>