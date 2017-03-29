
{{-- Hansol's Commit
    <br>
    <ul class="nav nav-pills nav-stacked ">
        <li class="active "><a href="{{ url('/masterscheduleview') }}" onClick="">Master Schedule</a></li>
    </ul><br>

    <ul class="nav nav-pills nav-stacked">
        <li class="active"><a  href="{{ url('/addschedule') }}" onClick="">Create Schedule</a></li>
    </ul><br>

    <ul><br></ul>

    <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="{{ url('/manageTerm') }}" onClick="">Manage Term</a></li>
    </ul><br>

    <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="{{ url('/manageInstructor') }}" onClick="">Manage Instructor</a></li>
    </ul><br>

    <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="{{ url('/manageCourse') }}" onClick="">Manage Course</a></li>
    </ul><br>

    <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="{{ url('/editschedule') }}" onClick="">Edit Schedule</a></li>
    </ul><br>--}}

<script>
    $(document).ready(function(){
        $('#expand').on("click", function() {
            console.log($(this).attr('class'));
            if($(this).attr('class') == "active") {
                $('#expand').removeClass("active");
            } else {
                $(this).addClass("active");
            }
        });
    });
</script>
<br>
<ul class="nav nav-pills nav-stacked sidebar">
    <li><a href="{{ url('/masterscheduleview') }}" onClick="">Master Schedule</a></li>
</ul><br>

<ul class="nav nav-pills nav-stacked sidebar">
    <li id="expand"><a href="#schedule" data-toggle="collapse" id="manageclick">Manage Schedule</a></li>
    <div id="schedule" class="collapse">
        <ul class="nav nav-pills nav-stacked sidebar">
            <li><a href="{{ url('/assign') }}">Assign Courses</a></li>
            <li><a href="{{ url('/dragDrop') }}">Generate Weekly Schedule</a></li>
            <li><a href="{{ url('/propagateschedule') }}">Propagate Weekly Schedule</a></li>
        </ul>
    </div>
</ul><br>

<ul class="nav nav-pills nav-stacked sidebar">
    <li><a href="{{ url('/manageTerm') }}" onClick="">Manage Term</a></li>
</ul><br>

<ul class="nav nav-pills nav-stacked sidebar">
    <li><a href="{{ url('/manageInstructor') }}" onClick="">Manage Instructor</a></li>
</ul><br>

<ul class="nav nav-pills nav-stacked sidebar">
    <li><a href="{{ url('/manageCourse') }}" onClick="">Manage Course</a></li>
</ul><br>

<ul class="nav nav-pills nav-stacked sidebar">
    <li><a href="{{ url('/manageIntake') }}" onClick="">Manage Intake</a></li>
</ul><br>

<ul class="nav nav-pills nav-stacked sidebar">
    <li><a href="{{ url('/manageStudents') }}" onClick="">Manage Students</a></li>
</ul><br>





