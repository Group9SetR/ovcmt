/**
 * Created by Vincent on 19/03/2017.
 */
function createCourseOfferingSessionPanel(course_id, crn, term_no, type, sessions, copy) {
    var coursePanel= document.createElement('DIV');
    coursePanel.className=['panel panel-default drag_course_offering'];
    if(copy === true) {
        coursePanel.classList.add('drag_course_offering_listing');
    }
    coursePanel.setAttribute('id', 'slid');
    coursePanel.setAttribute('draggable', 'true');
    coursePanel.setAttribute('ondragstart','drag(event)');
    coursePanel.setAttribute('ondrop','return false;');
    coursePanel.setAttribute('ondragover', 'return false;');
    var coursePanelHeading=document.createElement('DIV');
    coursePanelHeading.className='panel-heading';
    coursePanelHeading.append(document.createElement('P').appendChild(document.createTextNode(course_id + ' CRN:' +crn)));
    coursePanel.append(coursePanelHeading);
    var coursePanelBody = document.createElement('DIV');
    coursePanelBody.className=['panel-body drag_course_offering_panel'];
    if(!coursePanel.classList.contains('drag_course_offering_listing')) {
        coursePanelHeading.append(createDeleteCourseButton());
    }
    if(sessions !== undefined) {
        var sessionsP = document.createElement('B');
        sessionsP.className = 'drag_course_offering_listing_sessions';
        sessionsP.appendChild(document.createTextNode('Sessions:'));
        var sessionsNumber = document.createElement('SPAN');
        sessionsNumber.className = 'drag_course_offering_listing_sessions_days';
        sessionsNumber.appendChild(document.createTextNode(sessions + '\n'));
        sessionsP.append(sessionsNumber);
        sessionsP.append(document.createElement('BR'));
        coursePanelBody.append(sessionsP);
    }
    coursePanelBody.append(document.createElement('P').appendChild(document.createTextNode('Term:'+ term_no)));
    coursePanelBody.append(document.createElement('BR'));
    coursePanelBody.append(document.createElement('P').appendChild(document.createTextNode('Type:'+ type)));
    coursePanel.append(coursePanelBody);
    return coursePanel;
}

function appendToTimeSlot(panel, slotName, dayOfWeek) {
    document.getElementsByClassName(slotName)[dayOfWeek].append(panel);
}

function appendToCourseListings(panel) {
    document.getElementById('courses_listing_panel').append(panel);
}

function createDeleteCourseButton() {
    var deleteCourseOffering = document.createElement('BUTTON');
    deleteCourseOffering.addEventListener('click', onDeleteClick, true);
    deleteCourseOffering.setAttribute('type', 'button');
    deleteCourseOffering.className = ['close'];
    deleteCourseOffering.setAttribute('aria-label', 'Close');
    var delSpan = document.createElement('SPAN');
    delSpan.innerHTML = '&times;';
    delSpan.setAttribute('aria-hidden', true);
    deleteCourseOffering.append(delSpan);
    return deleteCourseOffering;
}

/*TODO If a copydrop is deleted, increment the sessions counter*/
function onDeleteClick(event) {
    var source = event.source || event.srcElement;
    var panelSource = findAncestor(source,'drag_course_offering');
    panelSource.remove(); //remove the course offering panel
    var courseOfferingId = findAncestor(source, 'panel-heading').firstChild.textContent;
    //find in course offering listing panel and increment
    var courseOfferingsListed = document.getElementsByClassName('drag_course_offering_listing');
    for(var i=0; i<courseOfferingsListed.length; i++) {
        if(courseOfferingsListed.item(i).firstChild.innerHTML == courseOfferingId){
            console.log(document.getElementById(courseOfferingsListed.item(i).id).childNodes[1].firstChild.firstChild);
            console.log($('#'+courseOfferingsListed.item(i).id+' .drag_course_offering_listing_sessions_days'));
        }
    }
}

function findAncestor (element, className) {
    while ((!element.classList.contains(className) && (element = element.parentElement))) {}
    return element;
}

//Base drag and drop functionality goes here
/*TODO Disallow placing a copied course offering within another -- this only happens on the first copy*/
/*TODO Prevent dropping multiple courses offerings within one time slot*/
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev, el) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    if(document.getElementById(data).classList.contains('drag_course_offering_listing')) {
        var nodeCopy = document.getElementById(data).cloneNode(true);
        nodeCopy.id = 'dropcop';
        nodeCopy.classList.remove('drag_course_offering_listing');
        nodeCopy.classList.add('drag_course_offering_copy');
        nodeCopy.firstChild.append(createDeleteCourseButton());
        var text = $('#'+data+' .drag_course_offering_listing_sessions_days').contents().filter(function() {
            return this.nodeType == Node.TEXT_NODE;
        }).text();
        var sessionsDays = parseInt(text)-1;
        if(sessionsDays>0) {
            $('#'+data+' .drag_course_offering_listing_sessions_days').first()[0].innerHTML = sessionsDays;
            ev.target.appendChild(nodeCopy);
            $('#'+nodeCopy.id+' .drag_course_offering_listing_sessions').remove();
        } else if(sessionsDays==0){
            $('#'+data+' .drag_course_offering_listing_sessions_days').first()[0].innerHTML = sessionsDays;
            ev.target.appendChild(nodeCopy);
            $('#'+nodeCopy.id+' .drag_course_offering_listing_sessions').remove();
            $('#'+data).hide();
        }
    } else {
        el.appendChild(document.getElementById(data));
    }
    /*TODO Change naming of copies so you can easily retrace and find the original -- even when it is hidden*/
    $("div[id^='dropcop']").attr('id', function(i) {
        return "dropcopy" + ++i;
    });
}

$(document).ready(function() {
    $("div[id^='slid']").attr('id', function(i) {
        return "slide" + ++i;
    });
});