/**
 * Created by Vincent on 31/03/2017.
 */

function Panel (course_id, room_id, color, instructor)
{
    this.Panel = createPanel();
    this.PanelHeading = createPanelHeading(course_id, color);
    this.PanelBody = createPanelBody(room_id, instructor);
    this.Panel.append(this.PanelHeading);
    this.Panel.append(this.PanelBody);
    return this.Panel;
/*
    this.init = function () {
        this.Panel.append(this.PanelHeading);
        this.Panel.append(this.PanelBody);
    };
    this.get = function () {
        return this.Panel;
    };*/
}

function createPanel()
{
    var Panel= document.createElement('DIV');
    Panel.className=['panel panel-default'];
    return Panel;
}

function createPanelHeading(course_id, color)
{
    var PanelHeading=document.createElement('DIV');
    PanelHeading.className='panel-heading';
    PanelHeading.style.backgroundColor = color;
/*
    var colorBlock = document.createElement('DIV');
    colorBlock.className='colorblock';
    colorBlock.style.backgroundColor = color;
    PanelHeading.append(colorBlock);*/
    PanelHeading.append(document.createElement('P').appendChild(document.createTextNode(course_id)));
    return PanelHeading;
}

function createPanelBody(room_id,instructor)
{
    var PanelBody = document.createElement('DIV');
    PanelBody.className=['panel-body'];
    PanelBody.append(document.createElement('P').appendChild(document.createTextNode(instructor)));
    PanelBody.append(document.createElement('BR'));
    PanelBody.append(document.createElement('P').appendChild(document.createTextNode(room_id)));
    return PanelBody;
}

