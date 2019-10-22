@extends('backpack::layout')

@section('after_styles')
<link href='/fullcalendar/core/main.css' rel='stylesheet' />
<link href='/fullcalendar/timeline/main.css' rel='stylesheet' />
<link href='/fullcalendar/resource-timeline/main.css' rel='stylesheet' />

<script src='/fullcalendar/core/main.js'></script>
<script src='/fullcalendar/timeline/main.js'></script>
<script src='/fullcalendar/resource-common/main.js'></script>
<script src='/fullcalendar/resource-timeline/main.js'></script>
<script src='/fullcalendar/interaction/main.js'></script>

@endsection

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row" id="app">

        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">                          
                        <strong>@lang('resource Calendars')</strong>
                    </div>
                    <div class="box-tools pull-right">

                    </div>
                </div>

                <div class="box-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('after_scripts')
    
<script>

document.addEventListener('DOMContentLoaded', function() { // page is now ready...
    var calendarEl = document.getElementById('calendar'); // grab element reference

    var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        plugins: [ 'resourceTimeline', 'interaction' ],
        defaultView: 'resourceTimelineWeek',
        resources: <?php echo json_encode($resources) ?>,
        height: "auto",
        minTime: "06:00:00",
        maxTime: "23:00:00",
        nowIndicator: true,
        hiddenDays: [ 0 ],
        firstDay: 1,
        slotWidth: 20,
        resourceAreaWidth: 150,
        eventSources: [
            {
                events: <?php echo json_encode($events) ?>
            },
            {
                events: <?php echo json_encode($unassigned_events) ?>
            },
            {
                events: <?php echo json_encode($leaves ?? null) ?>,
                color: 'red',
                textColor: 'white',
            },
        ],

        editable:true,
        
        eventDrop: function(info) {
            axios.patch(window.location.href, {
                    course_id: info.event.groupId,
                    resource_id: info.newResource.id,
                } )

            .then(function (response) {
                new PNotify({
                    title: "Operation successful",
                    text: "The course has been updated.",
                    type: "success"
                    });
            })
            
            .catch(function (error) {
                console.log(error);
            });
        }
    });

    calendar.render();
});

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js" integrity="sha256-XmdRbTre/3RulhYk/cOBUMpYlaAp2Rpo/s556u0OIKk=" crossorigin="anonymous"></script>
@endsection