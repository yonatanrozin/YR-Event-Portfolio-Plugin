<?php 

    global $post;
    $post_id = $context['generateblocks/loopItem']->ID ?? $post->ID;

    $date_field = get_field('start_date_field_name');
    $end_date_field = get_field('end_date_field_name');
    
    if ($is_preview) {
        $date = date_create_from_format("Ymd", date("Ymd"));
        $end_date = isset($end_date_field) ? date_create_from_format("Ymd", date("Ymd")) : null;
    }
    else {
        $date = get_field($date_field, $post_id);
        if (empty($date)) return; 
        $date = date_create_from_format("Ymd", $date);
        if (!empty($end_date_field)) {
            $end_date = get_field($end_date_field, $post_id);
            $end_date = $end_date ? date_create_from_format("Ymd", get_field($end_date_field, $post_id))
                : null;
        }
    }

    $same_date = $date == $end_date;

    $equal_yrs = !$same_date && isset($end_date) && (($date->format("Y") == $end_date->format("Y")));
    
    $date_format = get_field("format");
    if ($equal_yrs && get_field("same_year_start_format") ) {
        $date_format = get_field("same_year_start_format");
    }
    $date_str = $date->format($date_format);
    if (isset($end_date) && !$same_date) {
        $end_date_str = $end_date->format(get_field("end_format"));
    }
?>
<?php if (!$is_preview): ?><span <?= get_block_wrapper_attributes() ?>><?php endif; ?>
    <?= $date_str . (isset($end_date_str) ? ' - ' . $end_date_str : '')?>
<?php if (!$is_preview): ?></span><?php endif; ?>
