<?php 

    global $post;
    $post_id = $context['generateblocks/loopItem']->ID ?? $post->ID;

    $time_field = get_field('start_time_field_name');
    $end_time_field = get_field('end_time_field_name');
    
    if ($is_preview) {
        $time = date_create_from_format("G:ia", date("G:ia"));
        $end_time = isset($end_time_field) ? date_create_from_format("G:ia", date("G:ia")) : null;
    }
    else {
        $time = get_field($time_field, $post_id);
        if (empty($time)) return; 
        $time = date_create_from_format("G:ia", $time);
        if (!empty($end_time_field)) {
            $end_time = get_field($end_time_field, $post_id);
            $end_time = $end_time ? date_create_from_format("G:ia", get_field($end_time_field, $post_id))
                : null;
        }
    }

    $same_time = $time == $end_time;
    
    $time_str = $time->format(get_field("format"));
    if (isset($end_time) && !$same_time) {
        $end_time_str = $end_time->format(get_field("end_format"));
    }

    $allowed_blocks = ["generateblocks/shape"];

?>
<?php if (!$is_preview): ?><div <?= get_block_wrapper_attributes() ?>><?php endif; ?>
    <?= $time_str . (isset($end_time_str) ? ' - ' . $end_time_str : '')?>
<?php if (!$is_preview): ?></div><?php endif; ?>
