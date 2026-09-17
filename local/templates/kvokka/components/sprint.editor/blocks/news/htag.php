<?php

/** @var $block array */ ?>
<?php if (!empty($block['anchor'])) { ?><a name="<?= $block['anchor'] ?>"></a><?php } ?>
<<?= $block['type'] ?> <?= $block['type'] == 'h1' ? "class='main-title main-title--mode'" : "" ?>><?= $block['value'] ?></<?= $block['type'] ?>>