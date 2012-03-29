/* Dynamic images, change class */

// MooTools

window

    .addEvent('domready', function()

    {



        $$('*.dynamic_img').addEvents(

        {

            'mouseenter': function()

            {

                this.addClass('over');

            },

            'mouseleave': function()

            {

                this.removeClass('over');

                this.removeClass('clicked');

            },

            'mousedown': function()

            {

                this.removeClass('over');

                this.addClass('clicked');

            }

        });



        $$('img.tSwitch')

            .addEvents(

            {

                'mousedown': function()

                {

                    var tbody = this.getParent('thead').getNext('tbody');

                    tbody.toggleClass('hide');

                    if (tbody.hasClass('hide'))

                    {

                        document.cookie = 't3' + this.getParent('table')

                            .getProperty('id') + '=1; expires=Wed, 1 Jan 2020 00:00:00 GMT';

                        this.removeClass('opened');

                        this.addClass('closed');

                    }

                    else

                    {

                        document.cookie = 't3' + this.getParent('table')

                            .getProperty('id') + '=1; expires=Thu, 01-Jan-1970 00:00:01 GMT';

                        this.removeClass('closed');

                        this.addClass('opened');

                    }

                }

            });



        $$('table.row_table_data tbody tr').addEvents(

        {

            'mouseenter': function()

            {

                this.addClass('hlight');

            },

            'mouseleave': function()

            {

                this.removeClass('hlight');

            },

            'mousedown': function()

            {

                this.toggleClass('marked');

            }

        });



    });

    

// IE MooTools Fix

if (Browser.Engine.trident) // für IE

{

    /**

     * Element Erweiterungen

     *

     */

    Element.implement(

    {

        insertAtCursor: function(value, select)

        {

            var pos = this.getSelectedRange();



            // IE fix BEGIN

            if (pos.start == 0 && pos.end == 0)

            {

                this.focus();

                sel = document.selection.createRange();

                sel.text = value;

                this.focus();

                return this;

            }

            // IE fix END



            var text = this.get('value');

            this.set('value', text.substring(0, pos.start) + value + text.substring(pos.end, text.length));

            if ($pick(select, true))

            {

                this.selectRange(pos.start, pos.start + value.length);

            }

            else

            {

                this.setCaretPosition(pos.start + value.length);

            }



            return this;

        },



        insertAroundCursor: function(options, select)

        {

            options = $extend(

            {

                before: '',

                defaultMiddle: '',

                after: ''

            }, options);



            var value = this.getSelectedText() || options.defaultMiddle;

            var pos = this.getSelectedRange();



            // IE fix BEGIN

            if (pos.start == 0 && pos.end == 0)

            {

                this.focus();

                sel = document.selection.createRange();

                sel.text = options.before + options.after;

                this.focus();

                return this;

            }

            // IE fix END



            var text = this.get('value');

            if (pos.start == pos.end)

            {

                this.set('value', text.substring(0, pos.start) + options.before + value + options.after + text.substring(pos.end, text.length));

                this.selectRange(pos.start + options.before.length, pos.end + options.before.length + value.length);

            }

            else

            {

                var current = text.substring(pos.start, pos.end);

                this.set('value', text.substring(0, pos.start) + options.before + current + options.after + text.substring(pos.end, text.length));

                var selStart = pos.start + options.before.length;



                if ($pick(select, true))

                {

                    this.selectRange(selStart, selStart + current.length);

                }

                else

                {

                    this.setCaretPosition(selStart + text.length);

                }

            }

            return this;

        }

    });

}

    

var BBEditor = new Class ({

    preview: null,

    textArea: null,

    id: null,



    Binds: ['fetchPreview', 'showToolbarWindow', 'insertTag', 'insertSingleTag', 'insertSmilieTag', 'hideToolbarWindow', 'showPreview', 'hidePreview'],



    /**

     * Initialisiert den Editor

     */

    initialize: function(textAreaId) {



        //connect elements

        this.id = textAreaId;

        this.textArea = $(textAreaId);

        this.toolbar = $(textAreaId + '_toolbar');

        this.preview = $(textAreaId + '_preview');



        //init elements

        this.preview.setStyle('display', 'none');



        //add Events

        $(textAreaId + '_previewButton').addEvent('click', this.fetchPreview);

        $(textAreaId + '_resourceButton').addEvent('click', this.showToolbarWindow);

        $(textAreaId + '_smilieButton').addEvent('click', this.showToolbarWindow);

        $(textAreaId + '_troopButton').addEvent('click', this.showToolbarWindow);

        $(textAreaId).addEvent('click', this.hideToolbarWindow);

        this.addEvent($(textAreaId + '_toolbar'), this.insertTag);

        this.addEvent($(textAreaId + '_resources'), this.insertTag);

        this.addEvent($(textAreaId + '_smilies'), this.insertTag);

        this.addEvent($(textAreaId + '_troops'), this.insertTag);

    },



    /**

     * Fügt den klickbaren Objekten die Events hinzu

     *

     * @param object containerObjekt

     * @param string callback

     */

    addEvent: function(div, call) {

        var childen =  div.getChildren();

        for (i = 0; i < childen.length; i++) {

            if ($(childen[i]).get('bbTag')) {

                $(childen[i]).addEvent('click', call);

            }

        }

    },



    /**

     * Fügt einen ausgewählten Tag in die

     * Textarea ein

     *

     * @param Object

     */

    insertTag: function(Event) {

        this.hidePreview();

        var link = $(Event.target.parentNode);

        var tag = link.get('bbTag');



        switch (link.get('bbType')) {

            //double tag

            case 'd':

                this.textArea.insertAroundCursor({before: '[' + tag + ']', after: '[/' + tag + ']'});

                break;

            //smilie

            case 's':

                this.textArea.insertAtCursor(tag, false);

                break;

            //once

            case 'o':

                this.textArea.insertAtCursor('[' + link.get('bbTag') + ']', false);

                break;

        }

    },



    /**

     * Zeigt ein Unterfenster der Toolbar

     * an

     *

     * @param Object

     */

    showToolbarWindow: function(Event) {

        var targetDiv = Event.target.parentNode;

        var window = $(this.id + '_' +  targetDiv.get('bbWin'));



        var show = true;

        if (window.getStyle('display') == 'block') {

            show = false;

        }



        this.hideToolbarWindow();



        if (show) {

            window.fade('hide').fade('in');

            window.setStyle('display', 'block');

        }

    },



    /**

     * Versteckt die Fenster der Toolbar

     *

     * @param Object

     */

    hideToolbarWindow: function() {

        var childen =  $(this.id + '_toolbarWindows').getChildren();

        for (i = 0; i < childen.length; i++) {

            $(childen[i]).setStyle('display', 'none');

        }

    },



    /**

     * Holt die Vorschau vom Server

     *

     * @param Object

     */

    fetchPreview: function(Event) {

        if (this.textArea.getStyle('display') == 'none' || this.textArea.value.length < 1) {

            this.hidePreview();

            return;

        }



        var jsonRequest = new Request.JSON({

            method: 'post',

            url: 'ajax.php?f=bb',

            data:

            {

                nl2br:  1,

                target: this.id,

                text:   this.textArea.value

            },

            onSuccess: this.showPreview

        });

        jsonRequest.post();

    },



    /**

     * Zeigt die Vorschau

     *

     * @param string textAreaId

     */

    showPreview: function(data) {

        if (data.error == true) {

            alert(data.errorMsg);

            return;

        } else {

            this.preview.innerHTML = data.text;

            this.preview.setStyle('display','block');

            this.textArea.setStyle('display','none');

        }

    },



    /**

     * Versteckt die Vorschau

     *

     * @param string textAreaId

     */

    hidePreview: function() {

        this.preview.setStyle('display','none');

        this.textArea.setStyle('display','inline');

    }

});







var attackSysbolState = new Array();



function getAttackSymbolState(id)

{

    var state = attackSysbolState[id];



    if (!state)

    {

        state = new Object();



        var type = 0;



        var imgClass = $('markSybol_'+id).get('class');



        var color = imgClass.substr(imgClass.lastIndexOf('_')+1, 11);



        switch (color)

        {

            case 'green':

                type = 1;

                break;

            case 'yellow':

                type = 2;

                break;

            case 'red':

                type = 3;

                break;

            default:

                type = 0;

                break;

        }

        state.type = type;

        state.oldType = type;





        attackSysbolState[id] = state;

    }



    return state;

}



function drawAttackSymbol(id)

{

    var state = getAttackSymbolState(id);



    if (state.type == 4)

    {

        state.type = 0;

    }



    switch (state.type)

    {

        case 1:

            img = 'img/green.gif';

            color = 'green';

            break;

        case 2:

            img = 'img/yellow.gif';

            color = 'yellow';

            break;

        case 3:

            img = 'img/red.gif';

            color = 'red';

            break;

        default:

            img = 'img/grey.gif';

            color = 'grey';

            break;

    }

    $('markSybol_'+id).set('class', 'attack_symbol_'+color);

}



function markAttackSymbol(id)

{



    var state = getAttackSymbolState(id);

    state.type ++ ;



    drawAttackSymbol(id);



    if (state.isSaving != true)

    {

        state.isSaving = true;



        (function()

        {

            if (state.type != state.oldType)

            {

                var jsonRequest = new Request.JSON(

                {

                   method: 'post',

                   url: 'ajax.php?f=vp&id='+id+'&state='+state.type,

                   onSuccess: function(data)

                   {

                        var state = getAttackSymbolState(data.id);



                        state.isSaving = false;



                        state.type = data.type;

                        state.oldType = data.type;



                        drawAttackSymbol(data.id);

                   }

                });

                jsonRequest.post();

            }

            else

            {

                state.isSaving = false;



            }



         }).delay(1000);

    }



}