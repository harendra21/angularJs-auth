<ul>
	<?php foreach ($lists as $list) { ?>
		<?php if ($list != '.' && $list != '..') { ?>
			<?php if(is_dir($list)){ ?>
				<li><a href="#"><?= $list ?></a></li>
			<?php }else{ ?>
				<li><?= $list ?></li>
			<?php } ?>
		<?php } ?>
	<?php } ?>
</ul>