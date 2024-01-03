<?php
require 'database_connection.php'; 
$display_query = "SELECT event_id, event_name, event_start_date, event_end_date, event_start_time, event_end_time FROM calendar_event_master";             
$results = mysqli_query($con, $display_query);   
$count = mysqli_num_rows($results);  

if ($count > 0) {
    $data_arr = array();
    $i = 1;
    while ($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {   
        $data_arr[$i]['event_id'] = $data_row['event_id'];
        $data_arr[$i]['title'] = $data_row['event_name'];

        // Combine date and time to create DateTime objects
        $start_datetime = new DateTime($data_row['event_start_date'] . ' ' . $data_row['event_start_time']);
        $end_datetime = new DateTime($data_row['event_end_date'] . ' ' . $data_row['event_end_time']);

        $data_arr[$i]['start'] = $start_datetime->format('Y-m-d H:i:s');
        $data_arr[$i]['end'] = $end_datetime->format('Y-m-d H:i:s');
        $data_arr[$i]['color'] = '#' . substr(uniqid(), -6);
        #$data_arr[$i]['url'] = 'https://www.shinerweb.com';
        $i++;
    }

    $data = array(
        'status' => true,
        'msg' => 'successfully!',
        'data' => $data_arr
    );
} else {
    $data = array(
        'status' => false,
        'msg' => 'Error!'              
    );
}

echo json_encode($data);
?>
