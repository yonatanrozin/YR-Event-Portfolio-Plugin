<?php

    global $post;
    setup_postdata($post);

    $filter_type = $block->attributes['postType'];
    $post_type = $block->context['generateblocks/loopItem']->post_type ?? $block->context['postType'];
?>
<?php if ($filter_type == $post_type): ?>
    <?= $content ?>
<?php else: ?>
    <script>
        document.currentScript.parentElement.remove();
    </script>
<?php endif; ?>
