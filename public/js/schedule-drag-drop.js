/**
 * Created by Vincent on 19/03/2017.
 */
/**
 * Template for a Generic course panel. Can be used to create a listing or an offering.
 * @param course_id
 * @param crn
 * @param term_no
 * @param type
 * @constructor
 */
function CoursePanel (course_id, crn, term_no, type)
{
    this.crn = crn;
    this.coursePanel = createCoursePanel();
    this.coursePanelHeading = createCoursePanelHeading(course_id, crn);
    this.coursePanelBody = createCoursePanelBody(term_no, type);
    this.init = function () {
        this.coursePanel.append(this.coursePanelHeading);
        this.coursePanel.append(this.coursePanelBody);
    };
    this.get = function () {
        return this.coursePanel;
    };
}

/**
 * Creates a course offering panel.
 * Drag and Dropped not Drag and Copied.
 * @param course_id
 * @param crn
 * @param term_no
 * @param type
 * @constructor
 */
function CourseOfferingPanel (course_id, crn, term_no, type)
{
    var courseOfferingItem = new CoursePanel(course_id, crn, term_no, type);
    courseOfferingItem.coursePanel.classList.add('drag_course_offering_item');
    courseOfferingItem.coursePanelHeading.append(createDeleteCourseButton());
    courseOfferingItem.init();
    return courseOfferingItem;
}

function CourseOfferingPanelFromListing (listing)
{
    //remove '.drag_course_listing'
    var courseListingPanel = document.getElementById(listing).cloneNode(true);
    courseListingPanel.classList.remove('drag_course_listing');
    courseListingPanel.classList.add('drag_course_offering_item');
    //remove sessions pane
    courseListingPanel.id = 'dropcop';

    return courseListingPanel;
}

/**
 * Creates a course listing panel -- used in the side Course Lists bar.
 * Drag and Copied as opposed to Drag and Dropped.
 * @param course_id
 * @param crn
 * @param term_no
 * @param type
 * @param sessions
 * @constructor
 */
function CourseListingPanel (course_id, crn, term_no, type, sessions)
{
    var courseListing = new CoursePanel(course_id, crn, term_no, type);
    courseListing.coursePanel.classList.add('drag_course_listing');
    courseListing.coursePanelBody.append(createSessionsPane(sessions));
    var hiddenCRN = document.createElement('INPUT');
    hiddenCRN.setAttribute('type', 'hidden');
    hiddenCRN.setAttribute('value', crn);
    hiddenCRN.setAttribute('name', 'listing_crn');
    courseListing.coursePanel.append(hiddenCRN);
    courseListing.init();
    return courseListing.get();
}

function createCoursePanel()
{
    var coursePanel= document.createElement('DIV');
    coursePanel.className=['panel panel-default drag_course_offering'];
    coursePanel.setAttribute('id', 'slid');
    coursePanel.setAttribute('draggable', 'true');
    coursePanel.setAttribute('ondragstart','drag(event)');
    coursePanel.setAttribute('ondrop','return false;');
    coursePanel.setAttribute('ondragover', 'return false;');
    return coursePanel;
}

function createCoursePanelHeading(course_id, crn)
{
    var coursePanelHeading=document.createElement('DIV');
    coursePanelHeading.className='panel-heading';
    coursePanelHeading.append(document.createElement('P').appendChild(document.createTextNode(course_id + ' CRN:' +crn)));
    return coursePanelHeading;
}

function createCoursePanelBody(term_no, type)
{
    var coursePanelBody = document.createElement('DIV');
    coursePanelBody.className=['panel-body drag_course_offering_panel'];
    coursePanelBody.append(document.createElement('P').appendChild(document.createTextNode('Term:'+ term_no)));
    coursePanelBody.append(document.createElement('BR'));
    coursePanelBody.append(document.createElement('P').appendChild(document.createTextNode('Type:'+ type)));
    coursePanelBody.append(document.createElement('BR'));
    return coursePanelBody;
}

/**
 * Only used by a CourseListing to display number of sessions left for a particular course.
 * @param sessions
 * @returns {Element}
 */
function createSessionsPane(sessions)
{
    var sessionsPane = document.createElement('B');
    sessionsPane.className = 'drag_course_listing_sessions';
    sessionsPane.appendChild(document.createTextNode('Sessions:'));
    var sessionsNumber = document.createElement('SPAN');
    sessionsNumber.className = 'drag_course_listing_sessions_days';
    sessionsNumber.appendChild(document.createTextNode(sessions + '\n'));
    sessionsPane.append(sessionsNumber);
    sessionsPane.append(document.createElement('BR'));
    return sessionsPane;
}

/**
 * Only used by panels of the class .drag_course_offering_item
 * @returns {Element}
 */
function createDeleteCourseButton() {
    var deleteCourseOffering = document.createElement('BUTTON');
    deleteCourseOffering.addEventListener('click', onClickDelete, true);
    deleteCourseOffering.setAttribute('type', 'button');
    deleteCourseOffering.className = ['close delete_course_offering_item'];
    deleteCourseOffering.setAttribute('aria-label', 'Close');
    var delSpan = document.createElement('SPAN');
    delSpan.innerHTML = '&times;';
    delSpan.setAttribute('aria-hidden', true);
    deleteCourseOffering.append(delSpan);
    return deleteCourseOffering;
}

function appendToTimeSlot(panel, slotName, dayOfWeek) {
    $('#'+panel.get().id+' .timeslot_input').attr('name',slotName+'['+dayOfWeek+']');
    document.getElementsByName(slotName)[dayOfWeek].setAttribute('value', panel.crn);
    document.getElementsByClassName(slotName)[dayOfWeek].append(panel.get());
}

function appendToCourseListings(panel) {
    document.getElementById('courses_listing_panel').append(panel);
}

/**
 * Delete a course_offering_item and increment the corresponding sessions counter.
 * @param event
 */
function onClickDelete(event) {
    var source = event.source || event.srcElement;
    var panelSource = findAncestor(source,'drag_course_offering');
    var inputSource = findChild(findAncestor(panelSource, 'drop-timeslot'), 'timeslot_input');
    panelSource.remove(); //remove the course offering panel
    inputSource.setAttribute('value', 'empty');
    var courseOfferingId = getCourseIdentifier(source);
    var courseListing = findCourseListing(courseOfferingId);
    setSessionsDays(courseListing.id, extractSessionsDays(courseListing.id)+1);
    checkCourseOfferingDisplay(courseListing.id);
}

function findAncestor (element, className) {
    while ((!element.classList.contains(className) && (element = element.parentElement))) {}
    return element;
}

function findChild(element, className)
{
    var child = element.firstElementChild;
    while((child.hasClass && !child.classList.contains(className) && (child = child.nextElementSibling))) {}
    return child;
}

function getCourseIdentifier(element)
{
    return findAncestor(element, 'panel-heading').firstChild.textContent;
}

function findCourseListing(identifier)
{
    var courseOfferingsListed = $('.drag_course_listing .panel-heading');
    for(var i=0; i<courseOfferingsListed.length; i++) {

        if(courseOfferingsListed[i].innerHTML == identifier){
            return findAncestor(courseOfferingsListed[i], 'drag_course_offering');
        }
    }
}

/**
 *
 * @param id of a course offering Panel
 * @return sessions as an integer
 */
function extractSessionsDays(panelId)
{
    var sessionsText = $('#'+panelId+' .drag_course_listing_sessions_days').text();
    return parseInt(sessionsText);
}

function setSessionsDays(panelId, sessions)
{
    $('#'+panelId+' .drag_course_listing_sessions_days').text(sessions);
}

function checkCourseOfferingDisplay(panelId)
{
    if(extractSessionsDays(panelId) > 0) {
        $('#'+panelId).show();
    }
}

function clearSchedule()
{
    var deleteButtons = document.getElementsByClassName('delete_course_offering_item');
    for(var i=deleteButtons.length-1; i>=0; i--) {
        deleteButtons[i].click();
    }
    var allInputs = document.getElementsByClassName('timeslot-input');
    allInputs.forEach(function(element){
        element.setAttribute('value', 'empty');
    });
}

//Basic drag and drop functionality goes here

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev, el) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");

    if(el.childNodes.length > 2) {
        alert("Error: Cannot place more than one entry in a time slot!");
    } else if(!el.classList.contains('drop-timeslot')) {
        alert('Error: you can only drop in empty time slots!');
    } else {
        if(document.getElementById(data).classList.contains('drag_course_listing')) {
            var transferCRN = $('#'+data+" input[name='listing_crn']").attr('value');
            findChild(el, 'timeslot_input').setAttribute('value', transferCRN);
            var nodeCopy = CourseOfferingPanelFromListing(data);
            var sessionsDays = extractSessionsDays(data)-1;
            setSessionsDays(data,sessionsDays);
            ev.target.appendChild(nodeCopy);
            $('#'+nodeCopy.id+' .drag_course_listing_sessions').remove(); //remove session counter
            $('#'+nodeCopy.id+" input[name='listing_crn']").remove();
            //add delete button
            $('#'+nodeCopy.id+' .panel-heading').append(createDeleteCourseButton());
            if(sessionsDays == 0) {
                $('#'+data).hide();
            }
            $("div[id^='dropcop']").attr('id', function(i) {
                return "dropcopy" + ++i;
            });
        } else {
            var source = document.getElementById(data).parentNode;
            var transferCRN = source.childNodes[1].getAttribute('value');
            findChild(el, 'timeslot_input').setAttribute('value', transferCRN);
            findChild(source, 'timeslot_input').setAttribute('value', 'empty');
            el.appendChild(document.getElementById(data));
        }


    }
}

$(document).ready(function() {
    $("div[id^='slid']").attr('id', function(i) {
        return "slide" + ++i;
    });
});