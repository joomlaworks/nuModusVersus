/**
 * nuSlider 2.0 (vanilla JS) - content slider for JoomlaWorks templates
 *
 * Same options, markup and CSS hooks as nuSlider 1.x, without Hammer.js, Minimit Anima or jQuery animations:
 * movement uses CSS transitions, swipe & the draggable scrollbar use Pointer Events.
 * Usage: jQuery('.selector').nuSlider({...}) (jQuery bridge) or new NuSlider(element, {...}).
 *
 * @version    2.0
 * @package    nuSlider
 * @author     JoomlaWorks - https://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2026 JoomlaWorks Ltd. All rights reserved.
 * @license    https://www.joomlaworks.net/license
 */

(function(window, document) {
    'use strict';

    var defaults = {
        step: 1,
        viewport: 1,
        transitionTime: 1000,
        interval: 0,
        minItemWidth: 0,
        aspectRatio: false,
        scrollbar: false,
        orientation: 'vertical',
        itemsWrapperClass: '.itemsWrapper',
        itemsContainerClass: '.items',
        itemClass: '.item',
        scrollbarClass: '.scrollbar',
        scrollbarHandlerClass: '.handler',
        scrollbarProgressClass: '.progress',
        navigationScrolling: false,
        navigationStep: 3,
        navigationItemWidth: 100
    };
    var SWIPE_THRESHOLD = 30;
    var EASING = 'cubic-bezier(.42, 0, .58, 1)'; // ease-in-out, as jQuery's "swing"

    function extend(target) {
        for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i] || {};
            for (var key in source) {
                if (Object.prototype.hasOwnProperty.call(source, key)) {
                    target[key] = source[key];
                }
            }
        }
        return target;
    }

    function all(root, selector) {
        return root ? Array.prototype.slice.call(root.querySelectorAll(selector)) : [];
    }

    function first(root, selector) {
        return root ? root.querySelector(selector) : null;
    }

    function css(elements, styles) {
        (Array.isArray(elements) ? elements : [elements]).forEach(function(el) {
            if (el) {
                extend(el.style, styles);
            }
        });
    }

    // Content box size (what jQuery's .width()/.height() return)
    function contentWidth(el) {
        if (!el) {
            return 0;
        }
        var s = window.getComputedStyle(el);
        return el.clientWidth - parseFloat(s.paddingLeft) - parseFloat(s.paddingRight);
    }

    function contentHeight(el) {
        if (!el) {
            return 0;
        }
        var s = window.getComputedStyle(el);
        return el.clientHeight - parseFloat(s.paddingTop) - parseFloat(s.paddingBottom);
    }

    function closestList(el) {
        while (el && el.tagName !== 'UL') {
            el = el.parentElement;
        }
        return el;
    }

    function NuSlider(element, options) {
        if (!(this instanceof NuSlider)) {
            return new NuSlider(element, options);
        }
        this.element = element && element.jquery ? element[0] : element;
        if (!this.element) {
            return;
        }
        this.init(options);
    }

    NuSlider.prototype = {
        init: function(options) {
            var el = this.element;
            var s = this.settings = extend({}, defaults, options);
            // The *Class options are class names: accept them with or without the leading dot
            ['itemsWrapperClass', 'itemsContainerClass', 'itemClass', 'scrollbarClass', 'scrollbarHandlerClass', 'scrollbarProgressClass'].forEach(function(key) {
                if (typeof s[key] === 'string' && /^[\w-]+$/.test(s[key])) {
                    s[key] = '.' + s[key];
                }
            });
            s.InitViewport = s.viewport;
            s.InitStep = s.step;
            this.items = all(el, s.itemClass);
            this.itemsContainer = first(el, s.itemsContainerClass);
            this.itemsWrapper = first(el, s.itemsWrapperClass);
            this.nextButton = all(el, '.nextButton');
            this.previousButton = all(el, '.previousButton');
            this.navWrapper = first(el, '.navigationWrapper');
            this.nav = first(el, '.navigation');
            this.navNextButton = all(el, '.navigationNextButton');
            this.navPreviousButton = all(el, '.navigationPreviousButton');
            this.navigationButtons = all(el, '.navigationButton');
            this.scrollbar = first(el, s.scrollbarClass);
            this.scrollbarHandler = first(this.scrollbar, s.scrollbarHandlerClass);
            this.scrollbarProgress = first(this.scrollbar, s.scrollbarProgressClass);
            this.index = 0;
            this.offset = { x: 0, y: 0 };
            this.navOffset = 0;
            if (!this.itemsWrapper || !this.itemsContainer || !this.items.length) {
                return;
            }
            this.applyStyles();
            this.addEvents();
            if (s.scrollbar) {
                s.interval = false;
                var firstWidth = contentWidth(this.items[0]);
                s.viewport = firstWidth ? Math.max(1, parseInt(contentWidth(this.itemsWrapper) / firstWidth, 10)) : s.viewport;
            }
            this.startLoop();
        },

        startLoop: function() {
            var self = this;
            if (this.settings.interval) {
                this.loop = window.setInterval(function() {
                    self.setNextItem();
                    self.navigate(self.index);
                }, this.settings.interval);
            }
        },

        stopLoop: function() {
            if (this.loop) {
                window.clearInterval(this.loop);
                this.loop = null;
            }
        },

        applyStyles: function() {
            var self = this;
            var s = this.settings;
            var wrapper = this.itemsWrapper;
            css(wrapper, { position: 'relative', overflow: 'hidden' });
            if (s.aspectRatio) {
                var n = String(s.aspectRatio).split('/');
                wrapper.style.aspectRatio = n[0] + ' / ' + n[1];
            }
            css(this.itemsContainer, { position: 'absolute', display: 'block', top: '0', left: '0' });
            if (s.orientation == 'horizontal') {
                var width = contentWidth(wrapper);
                this.itemWidth = width / s.viewport;
                if (s.minItemWidth) {
                    // Start again from the configured viewport & step (they may have been changed for smaller screens)
                    s.viewport = s.InitViewport;
                    s.step = s.InitStep;
                    this.itemWidth = width / s.viewport;
                    while (this.itemWidth < s.minItemWidth && s.viewport > 1) {
                        s.viewport--;
                        s.step = s.viewport;
                        this.itemWidth = width / s.viewport;
                    }
                    // Hidden instances
                    if (this.itemWidth === 0) {
                        this.itemWidth = s.minItemWidth;
                    }
                }
                this.items.forEach(function(item, index) {
                    css(item, { width: self.itemWidth + 'px', position: 'absolute', top: '0', left: index * self.itemWidth + 'px', overflow: 'hidden' });
                });
                css(this.itemsContainer, { width: this.items.length * this.itemWidth + 'px' });
            } else {
                this.itemHeight = contentHeight(wrapper) / s.viewport;
                var wrapperWidth = contentWidth(wrapper);
                this.items.forEach(function(item, index) {
                    css(item, { width: wrapperWidth + 'px', height: self.itemHeight + 'px', position: 'absolute', left: '0', top: index * self.itemHeight + 'px', overflow: 'hidden' });
                });
                css(this.itemsContainer, { height: this.items.length * this.itemHeight + 'px' });
            }
            var navList = closestList(this.navigationButtons[0]);
            if (s.scrollbar) {
                css(this.nextButton.concat(this.previousButton), { display: 'none' });
                css(navList, { display: 'none' });
                css(this.scrollbar, { position: 'relative' });
                css(this.scrollbarHandler, { position: 'absolute' });
            } else {
                css(this.scrollbar, { display: 'none' });
                css(navList, { display: 'block' });
                this.navigationButtons.forEach(function(button, index) {
                    css(button.parentElement, { display: index > 0 && index % s.step !== 0 ? 'none' : 'inline-block' });
                });
            }
            if (s.navigationScrolling && this.nav) {
                css(this.navWrapper, { position: 'relative', overflow: 'hidden' });
                css(this.nav, { position: 'absolute', padding: '0', margin: '0', width: this.navigationButtons.length * s.navigationItemWidth + 'px' });
            }
            // Keep the current item in view after a resize
            this.setOffset(this.items[this.index], false);
            wrapper.classList.remove('nuSliderLoading');
        },

        addEvents: function() {
            var self = this;
            var s = this.settings;
            function on(elements, handler) {
                elements.forEach(function(el) {
                    el.addEventListener('click', function(event) {
                        event.preventDefault();
                        handler.call(el, event);
                    });
                });
            }
            on(this.nextButton, function() {
                self.setNextItem();
                self.navigate(self.index);
            });
            on(this.previousButton, function() {
                self.setPreviousItem();
                self.navigate(self.index);
            });
            on(this.navigationButtons, function() {
                self.index = self.navigationButtons.indexOf(this);
                self.navigate(self.index);
            });
            this.addSwipe();
            var resizeTimer;
            window.addEventListener('resize', function() {
                window.clearTimeout(resizeTimer);
                resizeTimer = window.setTimeout(function() {
                    var current = contentWidth(self.itemsWrapper);
                    if (s.orientation == 'horizontal') {
                        current = current / s.viewport;
                    }
                    if (self.itemWidth !== current) {
                        self.applyStyles();
                    }
                }, 100);
            });
            if (s.scrollbar && this.scrollbarHandler) {
                this.addScrollbarDrag();
            }
            if (s.navigationScrolling && this.nav) {
                var increment = s.navigationItemWidth * s.navigationStep;
                on(this.navNextButton, function() {
                    if (self.nav.offsetWidth >= Math.abs(self.navOffset - increment)) {
                        self.moveNav(self.navOffset - increment);
                    }
                });
                on(this.navPreviousButton, function() {
                    if (self.navOffset + increment <= 0) {
                        self.moveNav(self.navOffset + increment);
                    }
                });
            }
        },

        // Horizontal swipes (touch, pen & mouse) go to the next/previous item; vertical ones scroll the page
        addSwipe: function() {
            var self = this;
            var area = this.itemsWrapper;
            var start = null;
            var swiped = false;
            area.style.touchAction = 'pan-y';
            area.addEventListener('pointerdown', function(event) {
                if (event.pointerType === 'mouse' && event.button !== 0) {
                    return;
                }
                start = { x: event.clientX, y: event.clientY };
                swiped = false;
            });
            area.addEventListener('pointerup', function(event) {
                if (!start) {
                    return;
                }
                var dx = event.clientX - start.x;
                var dy = event.clientY - start.y;
                start = null;
                if (Math.abs(dx) < SWIPE_THRESHOLD || Math.abs(dx) < Math.abs(dy)) {
                    return;
                }
                swiped = true;
                if (dx < 0) {
                    self.setNextItem();
                } else {
                    self.setPreviousItem();
                }
                self.navigate(self.index);
                self.moveScrollbar();
            });
            area.addEventListener('pointercancel', function() {
                start = null;
            });
            // A mouse swipe must not also follow the link it started on
            area.addEventListener('click', function(event) {
                if (swiped) {
                    event.preventDefault();
                    event.stopPropagation();
                    swiped = false;
                }
            }, true);
            area.addEventListener('dragstart', function(event) {
                event.preventDefault();
            });
        },

        addScrollbarDrag: function() {
            var self = this;
            var handler = this.scrollbarHandler;
            var drag = null;
            handler.style.left = '0';
            handler.style.touchAction = 'none';
            handler.addEventListener('pointerdown', function(event) {
                drag = { x: event.clientX, left: parseFloat(handler.style.left) || 0 };
                if (handler.setPointerCapture) {
                    handler.setPointerCapture(event.pointerId);
                }
                event.preventDefault();
            });
            handler.addEventListener('pointermove', function(event) {
                if (!drag) {
                    return;
                }
                var range = self.scrollbar.offsetWidth - handler.offsetWidth;
                var offset = Math.min(Math.max(drag.left + event.clientX - drag.x, 0), range);
                handler.style.left = offset + 'px';
                if (self.scrollbarProgress) {
                    self.scrollbarProgress.style.width = offset + 'px';
                }
                var percentage = range > 0 ? offset / range : 0;
                var viewportRange = self.itemsContainer.offsetWidth - self.itemWidth * self.settings.viewport;
                self.translate(-viewportRange * percentage, 0, false);
            });
            ['pointerup', 'pointercancel', 'lostpointercapture'].forEach(function(type) {
                handler.addEventListener(type, function() {
                    drag = null;
                });
            });
        },

        moveNav: function(offset) {
            this.navOffset = offset;
            this.nav.style.transition = 'transform 400ms ' + EASING;
            this.nav.style.transform = 'translateX(' + offset + 'px)';
        },

        translate: function(x, y, animate) {
            var container = this.itemsContainer;
            this.offset = { x: x, y: y };
            container.style.transition = animate ? 'transform ' + this.settings.transitionTime + 'ms ' + EASING : 'none';
            container.style.transform = 'translate3d(' + x + 'px, ' + y + 'px, 0)';
        },

        setOffset: function(item, animate) {
            if (item) {
                this.translate(-item.offsetLeft, -item.offsetTop, animate);
            }
        },

        navigate: function(index) {
            var self = this;
            var el = this.element;
            this.stopLoop();
            this.navigationButtons.forEach(function(button, i) {
                button.classList.toggle('navigationButtonActive', i === self.index);
            });
            el.classList.add('nuSliderAnimating');
            window.clearTimeout(this.animationTimer);
            this.animationTimer = window.setTimeout(function() {
                el.classList.remove('nuSliderAnimating');
            }, this.settings.transitionTime);
            this.setOffset(this.items[index], true);
            this.startLoop();
        },

        setNextItem: function() {
            var count = this.items.length;
            var step = this.settings.step;
            if (this.index < count - step) {
                this.index += step;
                if (count < this.index + step) {
                    this.index = count - step;
                }
            } else {
                this.index = 0;
            }
        },

        setPreviousItem: function() {
            var step = this.settings.step;
            if (this.index > 0) {
                this.index -= step;
            } else {
                this.index = this.items.length - step;
            }
            if (this.index < 0) {
                this.index = 0;
            }
        },

        moveScrollbar: function() {
            if (!this.settings.scrollbar || !this.scrollbarHandler) {
                return;
            }
            var steps = this.items.length - this.settings.step;
            var percentage = steps > 0 ? this.index / steps : 0;
            var offset = (this.scrollbar.offsetWidth - this.scrollbarHandler.offsetWidth) * percentage;
            if (this.scrollbarProgress) {
                this.scrollbarProgress.style.width = offset + 'px';
            }
            this.scrollbarHandler.style.left = offset + 'px';
        }
    };

    window.NuSlider = NuSlider;

    // jQuery bridge: $(selector).nuSlider(options) and $.nuSlider(element, options), as in nuSlider 1.x
    var $ = window.jQuery;
    if ($) {
        // Older layouts and modules call the slider through this jQuery alias
        if (!window.$nuSlider) {
            window.$nuSlider = $;
        }
        $.nuSlider = NuSlider;
        $.fn.nuSlider = function(options) {
            return this.each(function() {
                if (undefined === $(this).data('nuSlider')) {
                    $(this).data('nuSlider', new NuSlider(this, options));
                }
            });
        };
    }
})(window, document);
