<?php if ($is_preview): ?>
    <?php 
        $page_ids = get_field("carousel_featured_items", "option");
    ?>
    <InnerBlocks 
        template="<?php echo esc_attr(wp_json_encode([
            ['generateblocks/query', [
                'query' => [
                    "post_type" => ['page', 'post', 'event'],
                    "post__in" => $page_ids,
                    "order" => "ASC"
                ],
                "styles" => [ "height" => "400px", 'maxHeight' => '120vw'],
                "className" => "homepage-carousel"
            ], [
                ['generateblocks/looper', [
                    "tagName" => "section",
                    "styles" => ["display" => "flex", "overflowX" => "scroll", "height" => "100%"],
                ], [
                    ['generateblocks/loop-item', [
                        'tagName' => 'article', 
                        "htmlAttributes" => [
                            "style" => "--inline-bg-image: url({{featured_image key:url}})"
                        ],
                        'styles' => [
                            'height' => '100%', 
                            'min-width' => '100%', 'position' => 'relative',
                            "backgroundImage" => "var(--inline-bg-image)",
                            "backgroundSize" => "cover",
                            "backgroundPosition" => "center"
                        ]
                    ], [
                        ['generateblocks/element', [
                            'styles' => [
                                'width' => '100%',
                                'position' => 'absolute', 'bottom' => '0px', 
                                'backgroundColor' => 'rgba(0,0,0,0.6)',
                                'backdropFilter' => 'blur(5px)'
                            ]
                        ], [
                            ['core/group', [
                                'textColor' => 'white',
                                'style' => [
                                    "elements" => [
                                        "link" => [
                                            "color" => ["text" => "var:preset|color|white"]
                                        ]
                                    ],
                                    "spacing" => [
                                        "padding" => [
                                            "top" => "var:preset|spacing|30",
                                            "bottom" => "var:preset|spacing|30",
                                            "left" => "var:preset|spacing|40",
                                            "right" => "var:preset|spacing|40"
                                        ],
                                        "blockGap" => "var:preset|spacing|20"
                                    ]
                                ]
                            ], [
                                ['core/post-title', ['isLink' => true]]
                            ]]
                        ]]
                    ]]
                ]]
            ]]
        ])); ?>"
        allowedBlocks="<?php echo esc_attr(wp_json_encode([
            'generateblocks/query'
        ])); ?>"
    />
<?php else: ?>
    <?php $scroll_interval = (get_field("scroll_interval") * 1000) ?? 10000; ?>

    <div <?= get_block_wrapper_attributes() ?> data-scroll-interval="<?= $scroll_interval ?>">
        <?= $content ?>
        <div class="carousel-nav prev"><?= esc_html("<")?></div>
        <div class="carousel-nav next"><?= esc_html(">")?></div>
    </div>
<?php endif; ?>

