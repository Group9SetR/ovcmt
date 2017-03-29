
<br>
<ul class="nav nav-pills nav-stacked sidebar">
    <li><a href="{{ url('/masterscheduleview') }}" onClick="">Master Schedule</a></li>
</ul><br>

<ul class="nav nav-pills nav-stacked sidebar">
    <li id="expant"><a href="#schedule" data-toggle="collapse" >Manage Schedule</a></li>
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






