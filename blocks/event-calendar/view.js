function yr_event_calendar_set_date(e, date, day) {
    e.preventDefault();
    history.pushState({}, "", `?date=${date}${day ? `&d=${day}` : ""}`);
    window.location.reload();
}

function yr_event_calendar_toggle_day(e) {
    e.preventDefault();
    history.pushState({}, "", e.target.href);
    window.location.reload();
}