<?php
require './mysql_queries.php';
//echo "tes";
//user_x('a');
//echo "tes";
// user_x('b');
// echo "tes";
// user_x('c');

// event_x('some1', 'a');
// event_x('some2', 'b');
// event_x('some3', 'c');
// event_x('some4', 'a');

// register_for_event('a', 12);

// print_r(get_all_events());

// find_all_events('some1');

// print_r(find_events_with(0, 1535844203));

// echo num_tickets_sold(13); // Prints nothing if false

// find_events_for_user('a');

// print_r(find_bookings_for_imminent_events());

echo "\n";
$now = now();
echo $now;
function user_x($x) {
    try {
        create_user($x, "$x@z.com", $x);
    } catch (Exception $e) {
        echo "skip user $x";
    }
}

function event_x($x, $host) {
    try {
        create_event($host, event_details($x));
    } catch (Exception $e) {
        // Do nothing
    }
}

function event_details($x) {
    echo now();
    return Array(
    'name' => $x,
    'description' => "description... blah $x",
    'location' => "location $x",
    'event_date' => now() + 23123,
    'category' => "$x",
    'num_tickets_available' => 12399,
    'ticket_end_date' => now() + 2131244);
}

function now() {
    $now = new DateTime();
    return $now->getTimestamp();
}
?>
