require('foundation-sites/js/foundation.core')
require('foundation-sites/js/foundation.abide')
require('foundation-sites/js/foundation.accordion')
require('foundation-sites/js/foundation.accordionMenu')
require('foundation-sites/js/foundation.drilldown')
require('foundation-sites/js/foundation.dropdown')
require('foundation-sites/js/foundation.dropdownMenu')
require('foundation-sites/js/foundation.equalizer')
require('foundation-sites/js/foundation.interchange')
require('foundation-sites/js/foundation.magellan')
require('foundation-sites/js/foundation.offcanvas')
require('foundation-sites/js/foundation.orbit')
require('foundation-sites/js/foundation.responsiveMenu')
require('foundation-sites/js/foundation.responsiveToggle')
require('foundation-sites/js/foundation.reveal')
require('foundation-sites/js/foundation.slider')
require('foundation-sites/js/foundation.sticky')
require('foundation-sites/js/foundation.tabs')
require('foundation-sites/js/foundation.toggler')
require('foundation-sites/js/foundation.tooltip')
require('foundation-sites/js/foundation.util.box')
require('foundation-sites/js/foundation.util.keyboard')
require('foundation-sites/js/foundation.util.mediaQuery')
require('foundation-sites/js/foundation.util.motion')
require('foundation-sites/js/foundation.util.nest')
require('foundation-sites/js/foundation.util.timerAndImageLoader')
require('foundation-sites/js/foundation.util.touch')
require('foundation-sites/js/foundation.util.triggers')
require('foundation-sites/js/foundation.zf.responsiveAccordionTabs')


$.fn.foundation = function(method) {
    var
    type = typeof method,
    meta = $('meta.foundation-mq');

    if (!meta.length) {
        $('<meta class="foundation-mq">').appendTo(document.head);
    }

    if (type === 'undefined') {//needs to initialize the Foundation object, or an individual plugin.
        Foundation.MediaQuery._init();
        Foundation.reflow(this);
    } else if(type === 'string') {//an individual method to invoke on a plugin or group of plugins
        var args = Array.prototype.slice.call(arguments, 1);//collect all the arguments, if necessary
        var plugClass = this.data('zfPlugin');//determine the class of plugin

        if(plugClass !== undefined && plugClass[method] !== undefined){//make sure both the class and method exist
            if(this.length === 1){//if there's only one, call it directly.
                plugClass[method].apply(plugClass, args);
            } else {
                this.each(function(i, el){//otherwise loop through the jQuery collection and invoke the method on each
                    plugClass[method].apply($(el).data('zfPlugin'), args);
                });
            }
        } else {//error for no class or no method
            throw new ReferenceError("We're sorry, '" + method + "' is not an available method for " + (plugClass ? functionName(plugClass) : 'this element') + '.');
        }
    } else {//error for invalid argument type
        throw new TypeError(`We're sorry, ${type} is not a valid parameter. You must use a string representing the method you wish to invoke.`);
    }
    return this;
};

$(document).foundation();