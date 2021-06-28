<?php if(isset($url) && $url ) : ?>
    <a class="<?= $classes ?>" href="<?= $url ?>" <?= $attributes ?> >
        <?= $text ?>
    </a>
<?php endif;
