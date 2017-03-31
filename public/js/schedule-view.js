/**
 * Created by Vincent on 31/03/2017.
 */

function Panel (course_id, room_id)
{
    this.Panel = createPanel();
    this.PanelHeading = createPanelHeading(course_id);
    this.PanelBody = createPanelBody(room_id);
    this.init = function () {
        this.Panel.append(this.PanelHeading);
        this.Panel.append(this.PanelBody);
    };
    this.get = function () {
        return this.Panel;
    };
}

function createPanel()
{
    var Panel= document.createElement('DIV');
    Panel.className=['panel panel-default'];
    return Panel;
}

function createPanelHeading(course_id)
{
    var PanelHeading=document.createElement('DIV');
    PanelHeading.className='panel-heading';
    PanelHeading.append(document.createElement('P').appendChild(document.createTextNode(course_id)));
    return PanelHeading;
}

function createPanelBody(room_id)
{
    var PanelBody = document.createElement('DIV');
    PanelBody.className=['panel-body'];
    PanelBody.append(document.createElement('P').appendChild(document.createTextNode('Instructor:'+ 'instruct placeholder')));
    PanelBody.append(document.createElement('BR'));
    PanelBody.append(document.createElement('P').appendChild(document.createTextNode('Room:' + room_id)));
    PanelBody.append(document.createElement('BR'));
    return PanelBody;
}

