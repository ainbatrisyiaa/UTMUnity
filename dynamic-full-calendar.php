<!DOCTYPE html>
<html lang="en">

<head>
    <!-- CSS for full calendar -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
    <!-- JS for jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- JS for full calendar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <!-- bootstrap css and js -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="styles.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body id="index">

    <?php include "nav.php" ?>
    <?php include "header.php" ?>

    <div id="calendar"></div>

    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        #calendar {
            margin: 0 auto;
            max-width: 800px;
            height: 600px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .modal-dialog {
            margin: 30px auto;
        }

        .modal-content {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .modal-title {
            color: #333;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>

    <!-- Start popup dialog box -->
    <div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Add New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="event_name">Event name</label>
                                    <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Enter your event name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="event_start_date">Event start date</label>
                                    <input type="date" name="event_start_date" id="event_start_date" class="form-control onlydatepicker" placeholder="Event start date">
                                </div>
                                <div class="form-group">
                                    <label for="event_start_time">Event start time</label>
                                    <input type="time" name="event_start_time" id="event_start_time" class="form-control" placeholder="Event start time">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="event_end_date">Event end date</label>
                                    <input type="date" name="event_end_date" id="event_end_date" class="form-control" placeholder="Event end date">
                                </div>
                                <div class="form-group">
                                    <label for="event_end_time">Event end time</label>
                                    <input type="time" name="event_end_time" id="event_end_time" class="form-control" placeholder="Event end time">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="deleteEvent()">Delete Event</button>
                    <button type="button" class="btn btn-primary" onclick="saveEvent()">Save Event</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End popup dialog box -->

    <?php include "footer.php" ?>
</body>

<script>
    $(document).ready(function () {
        displayEvents();
    }); //end document.ready block

    function displayEvents() {
        var events = new Array();     
        $.ajax({
            url: 'display_event.php',
            dataType: 'json',
            success: function (response) {

                var result = response.data;
                $.each(result, function (i, item) {
					
                    events.push({
                        event_id: result[i].event_id,
                        title: result[i].title,
                        start: result[i].start,
                        end: result[i].end,
                        color: "lightskyblue",   <!-- result[i].color, -->
                        url: result[i].url
                    });
                })
                var calendar = $('#calendar').fullCalendar({
                    defaultView: 'month',
                    timeZone: 'local',
                    editable: true,
                    selectable: true,
                    selectHelper: true,
                    select: function (start, end) {
                        $('#event_start_date').val(moment(start).format('YYYY-MM-DD'));
                        $('#event_end_date').val(moment(end).format('YYYY-MM-DD'));
                        $('#event_start_time').val(moment(start).format('HH:mm'));
                        $('#event_end_time').val(moment(end).format('HH:mm'));
                        $('#event_entry_modal').modal('show');
                    },

                    events: events,
                    eventRender: function (event, element, view) {
                        element.bind('click', function () {
							showEventDetails(event); 
                        });
                    }
                }); //end fullCalendar block	
            }, //end success block
            error: function (xhr, status) {
                alert(response.msg);
            }
        });//end ajax block	
    }
	

    function saveEvent() {
        var event_name = $("#event_name").val();
        var event_start_date = $("#event_start_date").val();
        var event_end_date = $("#event_end_date").val();
        var event_start_time = $("#event_start_time").val();
        var event_end_time = $("#event_end_time").val();

        if (event_name == "" || event_start_date == "" || event_end_date == "") {
            alert("Please enter all required details.");
            return false;
        }

        $.ajax({
            url: "save_event.php",
            type: "POST",
            dataType: 'json',
            data: {
                event_name: event_name,
                event_start_date: event_start_date,
                event_end_date: event_end_date,
                event_start_time: event_start_time,
                event_end_time: event_end_time
            },
            success: function (response) {
                $('#event_entry_modal').modal('hide');
                if (response.status == true) {
                    alert(response.msg);
                    // Reload the page to refresh the calendar
                    location.reload();
                } else {
                    alert(response.msg);
                }
            },
            error: function (xhr, status) {
                console.log('ajax error = ' + xhr.statusText);
                alert(response.msg);
            }
        });

        return false;
    }

    function showEventDetails(event) {
        // Display event details in the modal
        $('#event_name').val(event.title);
        $('#event_start_date').val(event.start.format('YYYY-MM-DD'));
        $('#event_start_time').val(event.start.format('HH:mm'));
        $('#event_end_date').val(event.end.format('YYYY-MM-DD'));
        $('#event_end_time').val(event.end.format('HH:mm'));

        // Store event ID in a data attribute for later use
        $('#event_entry_modal').data('event_id', event.event_id);

        // Show the modal
        $('#event_entry_modal').modal('show');
    }

    function deleteEvent() {
        var event_id = $('#event_entry_modal').data('event_id');

        if (confirm("Are you sure you want to delete this event?")) {
            $.ajax({
                url: 'delete_events.php',
                type: 'POST',
                dataType: 'json',
                data: { event_id: event_id },
                success: function (response) {
                    if (response.status == true) {
                        alert(response.msg);
                        $('#calendar').fullCalendar('removeEvents', event_id); // Remove the event from the calendar
                        $('#event_entry_modal').modal('hide');
						
						window.location.href = 'dynamic-full-calendar.php';
						
                    } else {
                        alert(response.msg);
                    }
                },
                error: function (xhr, status) {
                    alert(response.msg);
                }
            });
        }
    }
</script>

</html>
