<p>
	Please review and select items to import:
</p>
<form method="post">
<ul>
<?
/** @var SimplePie_Item $item */
$i = 0;
foreach( $items as $item ):
	?>

	<li class="import-item">
		<input type="checkbox" name="items[]" value="<?=$i?>" />
		<div class="item-title">
			<?=$item->get_title()?>
		</div>
		<div class="item-content">
			<?=$item->get_content()?>
		</div>
	</li>

<? $i++; ?>
<? endforeach; ?>
</ul>
<input type="submit" value="Import" /> &nbsp; <a href="/index.php/Special:ContentFeed">Cancel</a>
<input type="hidden" name="step" value="2" />
<input type="hidden" name="url" value="<?=$url?>" />
</form>