<?php

	$calendarDate = date_create_from_format("Ym", $_GET['date']);
	if (!$calendarDate) $calendarDate = new DateTime();
	$yearView = $calendarDate->format("Y");
	$monthView = $calendarDate->format("m");

	$calendarDateEnd = new DateTime();
	$queryDate = new DateTime();
	$queryDateEnd = new DateTime();
	$dayDate = new DateTime();
	
	$calendarDate->setDate($yearView, $monthView, 1);
	$calendarDateEnd->setDate($yearView, $monthView + 1, 1);
	$queryDate->setDate($yearView, $monthView - 6, 1);
	$queryDateEnd->setDate($yearView, $monthView + 6, 1);

	global $wp_query;

	$events = array_map(function($event) {
		return [
			'date' => get_field("date", $event),
			'end_date' => get_field("end_date", $event)
		];
	}, $wp_query->have_posts() ? $wp_query->posts : []);
	
    $months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

?>

<?php if (!$is_preview): ?><div <?= get_block_wrapper_attributes(); ?>
	data-calendar-date="<?= esc_attr($calendarDate->format("c")) ?>"	
><?php endif; ?>

	<div class="calendar-date" id="calendar-month" >
		<select onChange="yr_event_calendar_set_date(event, event.target.value)">
			<?php for ($m = 1; $m <= 12; $m += 1): ?>
				<option value=<?= $yearView.str_pad($m, 2, '0', STR_PAD_LEFT) ?> <?= $m == $monthView ? "selected" : "" ?>>
					<?= $months[$m - 1]?>
				</option>
			<?php endfor; ?>
		</select>
	</div>
	<div class="calendar-date" id="calendar-year" >
        <select onChange="yr_event_calendar_set_date(event, event.target.value)">
            <?php for ($y = date("Y") + 1; $y >= 1985; $y -= 1): ?>
                <option value=<?= $y.$monthView ?> <?= $y == $yearView ? "selected" : "" ?>>
                    <?= $y; ?>
                </option>
            <?php endfor; ?>
        </select>
    </div>
	<div style="grid-column-start: 6; grid-column-end: 8;"></div>
    <?php foreach (["M", "T", "W", "Th", "F", "Sa", "Su"] as $d): ?>
        <div class="weekday" ><b><?= $d; ?></b></div>
    <?php endforeach; ?>
	<?php for ($d = 1; $d <= $calendarDate->format("t"); $d++): ?>
        <?php
            $dayDate->setDate($yearView, $monthView, $d);
            $dayDateNum = $dayDate->format("Ymd");
            $has_event = array_any($events, function ($event) use ($dayDateNum) {
                return empty($event['end_date']) ? $dayDateNum == $event['date'] : (
                    $dayDateNum >= $event['date'] && $dayDateNum <= $event['end_date']
                );
            }) || ($is_preview && ($d == 15));
            $style = implode(" ", [
				$d == 1 ? 'grid-column-start: '.$calendarDate->format("N").';' : ''
			]);
			$queried = $_GET['d'] == $d || ($is_preview && $d == 16);	
			$classes = implode(' ', [
				'day', $has_event ? "has-event": "",
				$queried ? "queried" : ""
			]);
			$href = $is_preview ? "#" : "?date=".$calendarDate->format("Ym")
				. (!$queried ? '&d='.$d : '')
        ?>
        <a href="<?= $href ?>" 
			onclick="yr_event_calendar_toggle_day(event)"
			class="<?= $classes ?>" style="<?= $style ?>" data-day="<?= $d ?>"
		>
            <?= $d; ?>
        </a>
    <?php endfor; ?>
	<style>
		.wp-block-yr-event-calendar .day.has-event::after {
			background: <?= get_field("has_event_color") ?>;
		}
		.wp-block-yr-event-calendar .day.queried {
			outline: 2px solid <?= get_field("selected_day_color") ?>;
		}
	</style>
<?php if (!$is_preview): ?></div><?php endif; ?>
