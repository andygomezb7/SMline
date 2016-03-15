/*
 * imgAreaSelect jQuery plugin
 * version 0.9.6
 *
 * Copyright (c) 2008-2011 Michal Wojciechowski (odyniec.net)
 *
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * http://odyniec.net/projects/imgareaselect/
 *
 */

(function($) {

var abs = Math.abs,
    max = Math.max,
    min = Math.min,
    round = Math.round;

function div() {
    return $('<div/>');
}

$.imgAreaSelect = function (img, options) {
    var

        $img = $(img),

        imgLoaded,

        $box = div(),
        $area = div(),
        $border = div().add(div()).add(div()).add(div()),
        $outer = div().add(div()).add(div()).add(div()),
        $handles = $([]),

        $areaOpera,

        left, top,

        imgOfs = { left: 0, top: 0 },

        imgWidth, imgHeight,

        $parent,

        parOfs = { left: 0, top: 0 },

        zIndex = 0,

        position = 'absolute',

        startX, startY,

        scaleX, scaleY,

        resizeMargin = 10,

        resize,

        minWidth, minHeight, maxWidth, maxHeight,

        aspectRatio,

        shown,

        x1, y1, x2, y2,

        selection = { x1: 0, y1: 0, x2: 0, y2: 0, width: 0, height: 0 },

        docElem = document.documentElement,

        $p, d, i, o, w, h, adjusted;

    function viewX(x) {
        return x + imgOfs.left - parOfs.left;
    }

    function viewY(y) {
        return y + imgOfs.top - parOfs.top;
    }

    function selX(x) {
        return x - imgOfs.left + parOfs.left;
    }

    function selY(y) {
        return y - imgOfs.top + parOfs.top;
    }

    function evX(event) {
        return event.pageX - parOfs.left;
    }

    function evY(event) {
        return event.pageY - parOfs.top;
    }

    function getSelection(noScale) {
        var sx = noScale || scaleX, sy = noScale || scaleY;

        return { x1: round(selection.x1 * sx),
            y1: round(selection.y1 * sy),
            x2: round(selection.x2 * sx),
            y2: round(selection.y2 * sy),
            width: round(selection.x2 * sx) - round(selection.x1 * sx),
            height: round(selection.y2 * sy) - round(selection.y1 * sy) };
    }

    function setSelection(x1, y1, x2, y2, noScale) {
        var sx = noScale || scaleX, sy = noScale || scaleY;

        selection = {
            x1: round(x1 / sx || 0),
            y1: round(y1 / sy || 0),
            x2: round(x2 / sx || 0),
            y2: round(y2 / sy || 0)
        };

        selection.width = selection.x2 - selection.x1;
        selection.height = selection.y2 - selection.y1;
    }

    function adjust() {
        if (!$img.width())
            return;

        imgOfs = { left: round($img.offset().left), top: round($img.offset().top) };

        imgWidth = $img.innerWidth();
        imgHeight = $img.innerHeight();

        imgOfs.top += ($img.outerHeight() - imgHeight) >> 1;
        imgOfs.left += ($img.outerWidth() - imgWidth) >> 1;

        minWidth = options.minWidth || 0;
        minHeight = options.minHeight || 0;
        maxWidth = min(options.maxWidth || 1<<24, imgWidth);
        maxHeight = min(options.maxHeight || 1<<24, imgHeight);

        if ($().jquery == '1.3.2' && position == 'fixed' &&
            !docElem['getBoundingClientRect'])
        {
            imgOfs.top += max(document.body.scrollTop, docElem.scrollTop);
            imgOfs.left += max(document.body.scrollLeft, docElem.scrollLeft);
        }

        parOfs = $.inArray($parent.css('position'), ['absolute', 'relative']) + 1 ?
            { left: round($parent.offset().left) - $parent.scrollLeft(),
                top: round($parent.offset().top) - $parent.scrollTop() } :
            position == 'fixed' ?
                { left: $(document).scrollLeft(), top: $(document).scrollTop() } :
                { left: 0, top: 0 };

        left = viewX(0);
        top = viewY(0);

        if (selection.x2 > imgWidth || selection.y2 > imgHeight)
            doResize();
    }

    function update(resetKeyPress) {
        if (!shown) return;

        $box.css({ left: viewX(selection.x1), top: viewY(selection.y1) })
            .add($area).width(w = selection.width).height(h = selection.height);

        $area.add($border).add($handles).css({ left: 0, top: 0 });

        $border
            .width(max(w - $border.outerWidth() + $border.innerWidth(), 0))
            .height(max(h - $border.outerHeight() + $border.innerHeight(), 0));

        $($outer[0]).css({ left: left, top: top,
            width: selection.x1, height: imgHeight });
        $($outer[1]).css({ left: left + selection.x1, top: top,
            width: w, height: selection.y1 });
        $($outer[2]).css({ left: left + selection.x2, top: top,
            width: imgWidth - selection.x2, height: imgHeight });
        $($outer[3]).css({ left: left + selection.x1, top: top + selection.y2,
            width: w, height: imgHeight - selection.y2 });

        w -= $handles.outerWidth();
        h -= $handles.outerHeight();

        switch ($handles.length) {
        case 8:
            $($handles[4]).css({ left: w >> 1 });
            $($handles[5]).css({ left: w, top: h >> 1 });
            $($handles[6]).css({ left: w >> 1, top: h });
            $($handles[7]).css({ top: h >> 1 });
        case 4:
            $handles.slice(1,3).css({ left: w });
            $handles.slice(2,4).css({ top: h });
        }

        if (resetKeyPress !== false) {
            if ($.imgAreaSelect.keyPress != docKeyPress)
                $(document).unbind($.imgAreaSelect.keyPress,
                    $.imgAreaSelect.onKeyPress);

            if (options.keys)
                $(document)[$.imgAreaSelect.keyPress](
                    $.imgAreaSelect.onKeyPress = docKeyPress);
        }

        if ($.browser.msie && $border.outerWidth() - $border.innerWidth() == 2) {
            $border.css('margin', 0);
            setTimeout(function () { $border.css('margin', 'auto'); }, 0);
        }
    }

    function doUpdate(resetKeyPress) {
        adjust();
        update(resetKeyPress);
        x1 = viewX(selection.x1); y1 = viewY(selection.y1);
        x2 = viewX(selection.x2); y2 = viewY(selection.y2);
    }

    function hide($elem, fn) {
        options.fadeSpeed ? $elem.fadeOut(options.fadeSpeed, fn) : $elem.hide();

    }

    function areaMouseMove(event) {
        var x = selX(evX(event)) - selection.x1,
            y = selY(evY(event)) - selection.y1;

        if (!adjusted) {
            adjust();
            adjusted = true;

            $box.one('mouseout', function () { adjusted = false; });
        }

        resize = '';

        if (options.resizable) {
            if (y <= options.resizeMargin)
                resize = 'n';
            else if (y >= selection.height - options.resizeMargin)
                resize = 's';
            if (x <= options.resizeMargin)
                resize += 'w';
            else if (x >= selection.width - options.resizeMargin)
                resize += 'e';
        }

        $box.css('cursor', resize ? resize + '-resize' :
            options.movable ? 'move' : '');
        if ($areaOpera)
            $areaOpera.toggle();
    }

    function docMouseUp(event) {
        $('body').css('cursor', '');
        if (options.autoHide || selection.width * selection.height == 0)
            hide($box.add($outer), function () { $(this).hide(); });

        $(document).unbind('mousemove', selectingMouseMove);
        $box.mousemove(areaMouseMove);

        options.onSelectEnd(img, getSelection());
    }

    function areaMouseDown(event) {
        if (event.which != 1) return false;

        adjust();

        if (resize) {
            $('body').css('cursor', resize + '-resize');

            x1 = viewX(selection[/w/.test(resize) ? 'x2' : 'x1']);
            y1 = viewY(selection[/n/.test(resize) ? 'y2' : 'y1']);

            $(document).mousemove(selectingMouseMove)
                .one('mouseup', docMouseUp);
            $box.unbind('mousemove', areaMouseMove);
        }
        else if (options.movable) {
            startX = left + selection.x1 - evX(event);
            startY = top + selection.y1 - evY(event);

            $box.unbind('mousemove', areaMouseMove);

            $(document).mousemove(movingMouseMove)
                .one('mouseup', function () {
                    options.onSelectEnd(img, getSelection());

                    $(document).unbind('mousemove', movingMouseMove);
                    $box.mousemove(areaMouseMove);
                });
        }
        else
            $img.mousedown(event);

        return false;
    }

    function fixAspectRatio(xFirst) {
        if (aspectRatio)
            if (xFirst) {
                x2 = max(left, min(left + imgWidth,
                    x1 + abs(y2 - y1) * aspectRatio * (x2 > x1 || -1)));

                y2 = round(max(top, min(top + imgHeight,
                    y1 + abs(x2 - x1) / aspectRatio * (y2 > y1 || -1))));
                x2 = round(x2);
            }
            else {
                y2 = max(top, min(top + imgHeight,
                    y1 + abs(x2 - x1) / aspectRatio * (y2 > y1 || -1)));
                x2 = round(max(left, min(left + imgWidth,
                    x1 + abs(y2 - y1) * aspectRatio * (x2 > x1 || -1))));
                y2 = round(y2);
            }
    }

    function doResize() {
        x1 = min(x1, left + imgWidth);
        y1 = min(y1, top + imgHeight);

        if (abs(x2 - x1) < minWidth) {
            x2 = x1 - minWidth * (x2 < x1 || -1);

            if (x2 < left)
                x1 = left + minWidth;
            else if (x2 > left + imgWidth)
                x1 = left + imgWidth - minWidth;
        }

        if (abs(y2 - y1) < minHeight) {
            y2 = y1 - minHeight * (y2 < y1 || -1);

            if (y2 < top)
                y1 = top + minHeight;
            else if (y2 > top + imgHeight)
                y1 = top + imgHeight - minHeight;
        }

        x2 = max(left, min(x2, left + imgWidth));
        y2 = max(top, min(y2, top + imgHeight));

        fixAspectRatio(abs(x2 - x1) < abs(y2 - y1) * aspectRatio);

        if (abs(x2 - x1) > maxWidth) {
            x2 = x1 - maxWidth * (x2 < x1 || -1);
            fixAspectRatio();
        }

        if (abs(y2 - y1) > maxHeight) {
            y2 = y1 - maxHeight * (y2 < y1 || -1);
            fixAspectRatio(true);
        }

        selection = { x1: selX(min(x1, x2)), x2: selX(max(x1, x2)),
            y1: selY(min(y1, y2)), y2: selY(max(y1, y2)),
            width: abs(x2 - x1), height: abs(y2 - y1) };

        update();

        options.onSelectChange(img, getSelection());
    }

    function selectingMouseMove(event) {
        x2 = resize == '' || /w|e/.test(resize) || aspectRatio ? evX(event) : viewX(selection.x2);
        y2 = resize == '' || /n|s/.test(resize) || aspectRatio ? evY(event) : viewY(selection.y2);

        doResize();

        return false;

    }

    function doMove(newX1, newY1) {
        x2 = (x1 = newX1) + selection.width;
        y2 = (y1 = newY1) + selection.height;

        $.extend(selection, { x1: selX(x1), y1: selY(y1), x2: selX(x2),
            y2: selY(y2) });

        update();

        options.onSelectChange(img, getSelection());
    }

    function movingMouseMove(event) {
        x1 = max(left, min(startX + evX(event), left + imgWidth - selection.width));
        y1 = max(top, min(startY + evY(event), top + imgHeight - selection.height));

        doMove(x1, y1);

        event.preventDefault();

        return false;
    }

    function startSelection() {
        $(document).unbind('mousemove', startSelection);
        adjust();

        x2 = x1;
        y2 = y1;

        doResize();

        resize = '';

        if ($outer.is(':not(:visible)'))
            $box.add($outer).hide().fadeIn(options.fadeSpeed||0);

        shown = true;

        $(document).unbind('mouseup', cancelSelection)
            .mousemove(selectingMouseMove).one('mouseup', docMouseUp);
        $box.unbind('mousemove', areaMouseMove);

        options.onSelectStart(img, getSelection());
    }

    function cancelSelection() {
        $(document).unbind('mousemove', startSelection)
            .unbind('mouseup', cancelSelection);
        hide($box.add($outer));

        setSelection(selX(x1), selY(y1), selX(x1), selY(y1));

        options.onSelectChange(img, getSelection());
        options.onSelectEnd(img, getSelection());
    }

    function imgMouseDown(event) {
        if (event.which != 1 || $outer.is(':animated')) return false;

        adjust();
        startX = x1 = evX(event);
        startY = y1 = evY(event);

        $(document).mousemove(startSelection).mouseup(cancelSelection);

        return false;
    }

    function windowResize() {
        doUpdate(false);
    }

    function imgLoad() {
        imgLoaded = true;

        setOptions(options = $.extend({
            classPrefix: 'imgareaselect',
            movable: true,
            parent: 'body',
            resizable: true,
            resizeMargin: 10,
            onInit: function () {},
            onSelectStart: function () {},
            onSelectChange: function () {},
            onSelectEnd: function () {}
        }, options));

        $box.add($outer).css({ visibility: '' });

        if (options.show) {
            shown = true;
            adjust();
            update();
            $box.add($outer).hide().fadeIn(options.fadeSpeed||0);
        }

        setTimeout(function () { options.onInit(img, getSelection()); }, 0);
    }

    var docKeyPress = function(event) {
        var k = options.keys, d, t, key = event.keyCode;

        d = !isNaN(k.alt) && (event.altKey || event.originalEvent.altKey) ? k.alt :
            !isNaN(k.ctrl) && event.ctrlKey ? k.ctrl :
            !isNaN(k.shift) && event.shiftKey ? k.shift :
            !isNaN(k.arrows) ? k.arrows : 10;

        if (k.arrows == 'resize' || (k.shift == 'resize' && event.shiftKey) ||
            (k.ctrl == 'resize' && event.ctrlKey) ||
            (k.alt == 'resize' && (event.altKey || event.originalEvent.altKey)))
        {
            switch (key) {
            case 37:
                d = -d;
            case 39:
                t = max(x1, x2);
                x1 = min(x1, x2);
                x2 = max(t + d, x1);
                fixAspectRatio();
                break;
            case 38:
                d = -d;
            case 40:
                t = max(y1, y2);
                y1 = min(y1, y2);
                y2 = max(t + d, y1);
                fixAspectRatio(true);
                break;
            default:
                return;
            }

            doResize();
        }
        else {
            x1 = min(x1, x2);
            y1 = min(y1, y2);

            switch (key) {
            case 37:
                doMove(max(x1 - d, left), y1);
                break;
            case 38:
                doMove(x1, max(y1 - d, top));
                break;
            case 39:
                doMove(x1 + min(d, imgWidth - selX(x2)), y1);
                break;
            case 40:
                doMove(x1, y1 + min(d, imgHeight - selY(y2)));
                break;
            default:
                return;
            }
        }

        return false;
    };

    function styleOptions($elem, props) {
        for (option in props)
            if (options[option] !== undefined)
                $elem.css(props[option], options[option]);
    }

    function setOptions(newOptions) {
        if (newOptions.parent)
            ($parent = $(newOptions.parent)).append($box.add($outer));

        $.extend(options, newOptions);

        adjust();

        if (newOptions.handles != null) {
            $handles.remove();
            $handles = $([]);

            i = newOptions.handles ? newOptions.handles == 'corners' ? 4 : 8 : 0;

            while (i--)
                $handles = $handles.add(div());

            $handles.addClass(options.classPrefix + '-handle').css({
                position: 'absolute',
                fontSize: 0,
                zIndex: zIndex + 1 || 1
            });

            if (!parseInt($handles.css('width')) >= 0)
                $handles.width(5).height(5);

            if (o = options.borderWidth)
                $handles.css({ borderWidth: o, borderStyle: 'solid' });

            styleOptions($handles, { borderColor1: 'border-color',
                borderColor2: 'background-color',
                borderOpacity: 'opacity' });
        }

        scaleX = options.imageWidth / imgWidth || 1;
        scaleY = options.imageHeight / imgHeight || 1;

        if (newOptions.x1 != null) {
            setSelection(newOptions.x1, newOptions.y1, newOptions.x2,
                newOptions.y2);
            newOptions.show = !newOptions.hide;
        }

        if (newOptions.keys)
            options.keys = $.extend({ shift: 1, ctrl: 'resize' },
                newOptions.keys);

        $outer.addClass(options.classPrefix + '-outer');
        $area.addClass(options.classPrefix + '-selection');
        for (i = 0; i++ < 4;)
            $($border[i-1]).addClass(options.classPrefix + '-border' + i);

        styleOptions($area, { selectionColor: 'background-color',
            selectionOpacity: 'opacity' });
        styleOptions($border, { borderOpacity: 'opacity',
            borderWidth: 'border-width' });
        styleOptions($outer, { outerColor: 'background-color',
            outerOpacity: 'opacity' });
        if (o = options.borderColor1)
            $($border[0]).css({ borderStyle: 'solid', borderColor: o });
        if (o = options.borderColor2)
            $($border[1]).css({ borderStyle: 'dashed', borderColor: o });

        $box.append($area.add($border).add($areaOpera).add($handles));

        if ($.browser.msie) {
            if (o = $outer.css('filter').match(/opacity=([0-9]+)/))
                $outer.css('opacity', o[1]/100);
            if (o = $border.css('filter').match(/opacity=([0-9]+)/))
                $border.css('opacity', o[1]/100);
        }

        if (newOptions.hide)
            hide($box.add($outer));
        else if (newOptions.show && imgLoaded) {
            shown = true;
            $box.add($outer).fadeIn(options.fadeSpeed||0);
            doUpdate();
        }

        aspectRatio = (d = (options.aspectRatio || '').split(/:/))[0] / d[1];

        $img.add($outer).unbind('mousedown', imgMouseDown);

        if (options.disable || options.enable === false) {
            $box.unbind('mousemove', areaMouseMove).unbind('mousedown', areaMouseDown);
            $(window).unbind('resize', windowResize);
        }
        else {
            if (options.enable || options.disable === false) {
                if (options.resizable || options.movable)
                    $box.mousemove(areaMouseMove).mousedown(areaMouseDown);

                $(window).resize(windowResize);
            }

            if (!options.persistent)
                $img.add($outer).mousedown(imgMouseDown);
        }

        options.enable = options.disable = undefined;
    }

    this.remove = function () {
        setOptions({ disable: true });
        $box.add($outer).remove();
    };

    this.getOptions = function () { return options; };

    this.setOptions = setOptions;

    this.getSelection = getSelection;

    this.setSelection = setSelection;

    this.update = doUpdate;

    $p = $img;

    while ($p.length) {
        zIndex = max(zIndex,
            !isNaN($p.css('z-index')) ? $p.css('z-index') : zIndex);
        if ($p.css('position') == 'fixed')
            position = 'fixed';

        $p = $p.parent(':not(body)');
    }

    zIndex = options.zIndex || zIndex;

    if ($.browser.msie)
        $img.attr('unselectable', 'on');

    $.imgAreaSelect.keyPress = $.browser.msie ||
        $.browser.safari ? 'keydown' : 'keypress';

    if ($.browser.opera)
        $areaOpera = div().css({ width: '100%', height: '100%',
            position: 'absolute', zIndex: zIndex + 2 || 2 });

    $box.add($outer).css({ visibility: 'hidden', position: position,
        overflow: 'hidden', zIndex: zIndex || '0' });
    $box.css({ zIndex: zIndex + 2 || 2 });
    $area.add($border).css({ position: 'absolute', fontSize: 0 });

    img.complete || img.readyState == 'complete' || !$img.is('img') ?
        imgLoad() : $img.one('load', imgLoad);

    if ($.browser.msie && $.browser.version >= 9)
        img.src = img.src;
};

$.fn.imgAreaSelect = function (options) {
    options = options || {};

    this.each(function () {
        if ($(this).data('imgAreaSelect')) {
            if (options.remove) {
                $(this).data('imgAreaSelect').remove();
                $(this).removeData('imgAreaSelect');
            }
            else
                $(this).data('imgAreaSelect').setOptions(options);
        }
        else if (!options.remove) {
            if (options.enable === undefined && options.disable === undefined)
                options.enable = true;

            $(this).data('imgAreaSelect', new $.imgAreaSelect(this, options));
        }
    });

    if (options.instance)
        return $(this).data('imgAreaSelect');

    return this;
};

})(jQuery);


eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(q($){1l X=2w.4O,D=2w.4N,F=2w.4M,H=2w.4L;q W(){C $("<4K/>")};$.P=q(U,f){1l Q=$(U),2F,A=W(),1j=W(),J=W().u(W()).u(W()).u(W()),B=W().u(W()).u(W()).u(W()),E=$([]),1I,G,m,18={v:0,m:0},S,M,1k,1g={v:0,m:0},13=0,1H="1F",2k,2j,2b,2a,4J=10,N,1z,1y,2p,2o,15,1M,a,c,l,j,g={a:0,c:0,l:0,j:0,I:0,L:0},2v=T.4I,$p,d,i,o,w,h,2q;q 1n(x){C x+18.v-1g.v};q 1m(y){C y+18.m-1g.m};q 1b(x){C x-18.v+1g.v};q 1a(y){C y-18.m+1g.m};q 1x(3J){C 3J.4H-1g.v};q 1w(3I){C 3I.4G-1g.m};q 14(31){1l 1i=31||2b,1h=31||2a;C{a:H(g.a*1i),c:H(g.c*1h),l:H(g.l*1i),j:H(g.j*1h),I:H(g.l*1i)-H(g.a*1i),L:H(g.j*1h)-H(g.c*1h)}};q 20(a,c,l,j,30){1l 1i=30||2b,1h=30||2a;g={a:H(a/1i||0),c:H(c/1h||0),l:H(l/1i||0),j:H(j/1h||0)};g.I=g.l-g.a;g.L=g.j-g.c};q 1f(){b(!Q.I()){C}18={v:H(Q.2u().v),m:H(Q.2u().m)};S=Q.2Y();M=Q.3H();18.m+=(Q.2Z()-M)>>1;18.v+=(Q.2r()-S)>>1;1z=f.4F||0;1y=f.4E||0;2p=F(f.4D||1<<24,S);2o=F(f.4C||1<<24,M);b($().4B=="1.3.2"&&1H=="1Y"&&!2v["4A"]){18.m+=D(T.1q.2s,2v.2s);18.v+=D(T.1q.2t,2v.2t)}1g=$.4z(1k.r("1p"),["1F","4y"])+1?{v:H(1k.2u().v)-1k.2t(),m:H(1k.2u().m)-1k.2s()}:1H=="1Y"?{v:$(T).2t(),m:$(T).2s()}:{v:0,m:0};G=1n(0);m=1m(0);b(g.l>S||g.j>M){1Q()}};q 1R(3F){b(!1M){C}A.r({v:1n(g.a),m:1m(g.c)}).u(1j).I(w=g.I).L(h=g.L);1j.u(J).u(E).r({v:0,m:0});J.I(D(w-J.2r()+J.2Y(),0)).L(D(h-J.2Z()+J.3H(),0));$(B[0]).r({v:G,m:m,I:g.a,L:M});$(B[1]).r({v:G+g.a,m:m,I:w,L:g.c});$(B[2]).r({v:G+g.l,m:m,I:S-g.l,L:M});$(B[3]).r({v:G+g.a,m:m+g.j,I:w,L:M-g.j});w-=E.2r();h-=E.2Z();2O(E.3d){16 8:$(E[4]).r({v:w>>1});$(E[5]).r({v:w,m:h>>1});$(E[6]).r({v:w>>1,m:h});$(E[7]).r({m:h>>1});16 4:E.3G(1,3).r({v:w});E.3G(2,4).r({m:h})}b(3F!==Z){b($.P.1W!=2R){$(T).V($.P.1W,$.P.3E)}b(f.1P){$(T)[$.P.1W]($.P.3E=2R)}}b($.1c.1D&&J.2r()-J.2Y()==2){J.r("3D",0);3w(q(){J.r("3D","4x")},0)}};q 1Z(3C){1f();1R(3C);a=1n(g.a);c=1m(g.c);l=1n(g.l);j=1m(g.j)};q 23(2X,2x){f.1L?2X.4w(f.1L,2x):2X.1r()};q 1d(2W){1l x=1b(1x(2W))-g.a,y=1a(1w(2W))-g.c;b(!2q){1f();2q=12;A.1E("4v",q(){2q=Z})}N="";b(f.2D){b(y<=f.1S){N="n"}Y{b(y>=g.L-f.1S){N="s"}}b(x<=f.1S){N+="w"}Y{b(x>=g.I-f.1S){N+="e"}}}A.r("2V",N?N+"-19":f.22?"4u":"");b(1I){1I.4t()}};q 2S(4s){$("1q").r("2V","");b(f.4r||g.I*g.L==0){23(A.u(B),q(){$(O).1r()})}$(T).V("R",2l);A.R(1d);f.2e(U,14())};q 2C(1T){b(1T.3y!=1){C Z}1f();b(N){$("1q").r("2V",N+"-19");a=1n(g[/w/.2n(N)?"l":"a"]);c=1m(g[/n/.2n(N)?"j":"c"]);$(T).R(2l).1E("1v",2S);A.V("R",1d)}Y{b(f.22){2k=G+g.a-1x(1T);2j=m+g.c-1w(1T);A.V("R",1d);$(T).R(2T).1E("1v",q(){f.2e(U,14());$(T).V("R",2T);A.R(1d)})}Y{Q.1K(1T)}}C Z};q 1u(3B){b(15){b(3B){l=D(G,F(G+S,a+X(j-c)*15*(l>a||-1)));j=H(D(m,F(m+M,c+X(l-a)/15*(j>c||-1))));l=H(l)}Y{j=D(m,F(m+M,c+X(l-a)/15*(j>c||-1)));l=H(D(G,F(G+S,a+X(j-c)*15*(l>a||-1))));j=H(j)}}};q 1Q(){a=F(a,G+S);c=F(c,m+M);b(X(l-a)<1z){l=a-1z*(l<a||-1);b(l<G){a=G+1z}Y{b(l>G+S){a=G+S-1z}}}b(X(j-c)<1y){j=c-1y*(j<c||-1);b(j<m){c=m+1y}Y{b(j>m+M){c=m+M-1y}}}l=D(G,F(l,G+S));j=D(m,F(j,m+M));1u(X(l-a)<X(j-c)*15);b(X(l-a)>2p){l=a-2p*(l<a||-1);1u()}b(X(j-c)>2o){j=c-2o*(j<c||-1);1u(12)}g={a:1b(F(a,l)),l:1b(D(a,l)),c:1a(F(c,j)),j:1a(D(c,j)),I:X(l-a),L:X(j-c)};1R();f.2f(U,14())};q 2l(2U){l=N==""||/w|e/.2n(N)||15?1x(2U):1n(g.l);j=N==""||/n|s/.2n(N)||15?1w(2U):1m(g.j);1Q();C Z};q 1t(3A,3z){l=(a=3A)+g.I;j=(c=3z)+g.L;$.29(g,{a:1b(a),c:1a(c),l:1b(l),j:1a(j)});1R();f.2f(U,14())};q 2T(2m){a=D(G,F(2k+1x(2m),G+S-g.I));c=D(m,F(2j+1w(2m),m+M-g.L));1t(a,c);2m.4q();C Z};q 2h(){$(T).V("R",2h);1f();l=a;j=c;1Q();N="";b(B.2z(":3b(:4p)")){A.u(B).1r().2E(f.1L||0)}1M=12;$(T).V("1v",2g).R(2l).1E("1v",2S);A.V("R",1d);f.3x(U,14())};q 2g(){$(T).V("R",2h).V("1v",2g);23(A.u(B));20(1b(a),1a(c),1b(a),1a(c));f.2f(U,14());f.2e(U,14())};q 2A(2i){b(2i.3y!=1||B.2z(":4o")){C Z}1f();2k=a=1x(2i);2j=c=1w(2i);$(T).R(2h).1v(2g);C Z};q 2B(){1Z(Z)};q 2y(){2F=12;21(f=$.29({1O:"4n",22:12,1X:"1q",2D:12,1S:10,3v:q(){},3x:q(){},2f:q(){},2e:q(){}},f));A.u(B).r({3a:""});b(f.2G){1M=12;1f();1R();A.u(B).1r().2E(f.1L||0)}3w(q(){f.3v(U,14())},0)};1l 2R=q(17){1l k=f.1P,d,t,2N=17.4m;d=!1J(k.2P)&&(17.2d||17.3s.2d)?k.2P:!1J(k.27)&&17.3t?k.27:!1J(k.28)&&17.3u?k.28:!1J(k.2Q)?k.2Q:10;b(k.2Q=="19"||(k.28=="19"&&17.3u)||(k.27=="19"&&17.3t)||(k.2P=="19"&&(17.2d||17.3s.2d))){2O(2N){16 37:d=-d;16 39:t=D(a,l);a=F(a,l);l=D(t+d,a);1u();1s;16 38:d=-d;16 40:t=D(c,j);c=F(c,j);j=D(t+d,c);1u(12);1s;3r:C}1Q()}Y{a=F(a,l);c=F(c,j);2O(2N){16 37:1t(D(a-d,G),c);1s;16 38:1t(a,D(c-d,m));1s;16 39:1t(a+F(d,S-1b(l)),c);1s;16 40:1t(a,c+F(d,M-1a(j)));1s;3r:C}}C Z};q 1N(3q,2M){3o(2c 4l 2M){b(f[2c]!==1U){3q.r(2M[2c],f[2c])}}};q 21(K){b(K.1X){(1k=$(K.1X)).3i(A.u(B))}$.29(f,K);1f();b(K.2L!=3p){E.1o();E=$([]);i=K.2L?K.2L=="4k"?4:8:0;3e(i--){E=E.u(W())}E.26(f.1O+"-4j").r({1p:"1F",35:0,1G:13+1||1});b(!4i(E.r("I"))>=0){E.I(5).L(5)}b(o=f.2K){E.r({2K:o,2H:"3l"})}1N(E,{3m:"2J-25",3k:"2I-25",3n:"1e"})}2b=f.4h/S||1;2a=f.4g/M||1;b(K.a!=3p){20(K.a,K.c,K.l,K.j);K.2G=!K.1r}b(K.1P){f.1P=$.29({28:1,27:"19"},K.1P)}B.26(f.1O+"-4f");1j.26(f.1O+"-4e");3o(i=0;i++<4;){$(J[i-1]).26(f.1O+"-2J"+i)}1N(1j,{4d:"2I-25",4c:"1e"});1N(J,{3n:"1e",2K:"2J-I"});1N(B,{4b:"2I-25",4a:"1e"});b(o=f.3m){$(J[0]).r({2H:"3l",3j:o})}b(o=f.3k){$(J[1]).r({2H:"49",3j:o})}A.3i(1j.u(J).u(1I).u(E));b($.1c.1D){b(o=B.r("3h").3g(/1e=([0-9]+)/)){B.r("1e",o[1]/1V)}b(o=J.r("3h").3g(/1e=([0-9]+)/)){J.r("1e",o[1]/1V)}}b(K.1r){23(A.u(B))}Y{b(K.2G&&2F){1M=12;A.u(B).2E(f.1L||0);1Z()}}15=(d=(f.48||"").47(/:/))[0]/d[1];Q.u(B).V("1K",2A);b(f.1C||f.1B===Z){A.V("R",1d).V("1K",2C);$(3f).V("19",2B)}Y{b(f.1B||f.1C===Z){b(f.2D||f.22){A.R(1d).1K(2C)}$(3f).19(2B)}b(!f.46){Q.u(B).1K(2A)}}f.1B=f.1C=1U};O.1o=q(){21({1C:12});A.u(B).1o()};O.45=q(){C f};O.32=21;O.44=14;O.43=20;O.42=1Z;$p=Q;3e($p.3d){13=D(13,!1J($p.r("z-3c"))?$p.r("z-3c"):13);b($p.r("1p")=="1Y"){1H="1Y"}$p=$p.1X(":3b(1q)")}13=f.1G||13;b($.1c.1D){Q.41("3Z","3Y")}$.P.1W=$.1c.1D||$.1c.3X?"3W":"3V";b($.1c.3U){1I=W().r({I:"1V%",L:"1V%",1p:"1F",1G:13+2||2})}A.u(B).r({3a:"36",1p:1H,3T:"36",1G:13||"0"});A.r({1G:13+2||2});1j.u(J).r({1p:"1F",35:0});U.34||U.3S=="34"||!Q.2z("3R")?2y():Q.1E("3Q",2y);b($.1c.1D&&$.1c.3P>=9){U.33=U.33}};$.2x.P=q(11){11=11||{};O.3O(q(){b($(O).1A("P")){b(11.1o){$(O).1A("P").1o();$(O).3N("P")}Y{$(O).1A("P").32(11)}}Y{b(!11.1o){b(11.1B===1U&&11.1C===1U){11.1B=12}$(O).1A("P",3M $.P(O,11))}}});b(11.3L){C $(O).1A("P")}C O}})(3K);',62,299,'||||||||||x1|if|y1|||_7|_24|||y2||x2|top||||function|css|||add|left|||||_a|_d|return|_2|_e|_3|_10|_4|width|_c|_54|height|_13|_1d|this|imgAreaSelect|_8|mousemove|_12|document|_6|unbind|_5|_1|else|false||_55|true|_16|_2d|_22|case|_50|_11|resize|_2a|_29|browser|_3a|opacity|_31|_15|sy|sx|_b|_14|var|_28|_27|remove|position|body|hide|break|_45|_42|mouseup|evY|evX|_1f|_1e|data|enable|disable|msie|one|absolute|zIndex|_17|_f|isNaN|mousedown|fadeSpeed|_23|_51|classPrefix|keys|_32|_33|resizeMargin|_40|undefined|100|keyPress|parent|fixed|_36|_2f|_4f|movable|_38||color|addClass|ctrl|shift|extend|_1b|_1a|option|altKey|onSelectEnd|onSelectChange|_4a|_49|_4c|_19|_18|_3e|_48|test|_21|_20|_26|outerWidth|scrollTop|scrollLeft|offset|_25|Math|fn|_4e|is|_4b|_4d|_3f|resizable|fadeIn|_9|show|borderStyle|background|border|borderWidth|handles|_53|key|switch|alt|arrows|_35|_3c|_41|_44|cursor|_3b|_39|innerWidth|outerHeight|_30|_2e|setOptions|src|complete|fontSize|hidden||||visibility|not|index|length|while|window|match|filter|append|borderColor|borderColor2|solid|borderColor1|borderOpacity|for|null|_52|default|originalEvent|ctrlKey|shiftKey|onInit|setTimeout|onSelectStart|which|_47|_46|_43|_37|margin|onKeyPress|_34|slice|innerHeight|_2c|_2b|jQuery|instance|new|removeData|each|version|load|img|readyState|overflow|opera|keypress|keydown|safari|on|unselectable||attr|update|setSelection|getSelection|getOptions|persistent|split|aspectRatio|dashed|outerOpacity|outerColor|selectionOpacity|selectionColor|selection|outer|imageHeight|imageWidth|parseInt|handle|corners|in|keyCode|imgareaselect|animated|visible|preventDefault|autoHide|_3d|toggle|move|mouseout|fadeOut|auto|relative|inArray|getBoundingClientRect|jquery|maxHeight|maxWidth|minHeight|minWidth|pageY|pageX|documentElement|_1c|div|round|min|max|abs'.split('|')))

(function($){var abs=Math.abs,max=Math.max,min=Math.min,round=Math.round;function div(){return $('<div/>')}$.imgAreaSelect=function(img,options){var $img=$(img),imgLoaded,$box=div(),$area=div(),$border=div().add(div()).add(div()).add(div()),$outer=div().add(div()).add(div()).add(div()),$handles=$([]),$areaOpera,left,top,imgOfs={left:0,top:0},imgWidth,imgHeight,$parent,parOfs={left:0,top:0},zIndex=0,position='absolute',startX,startY,scaleX,scaleY,resizeMargin=10,resize,minWidth,minHeight,maxWidth,maxHeight,aspectRatio,shown,x1,y1,x2,y2,selection={x1:0,y1:0,x2:0,y2:0,width:0,height:0},docElem=document.documentElement,$p,d,i,o,w,h,adjusted;function viewX(x){return x+imgOfs.left-parOfs.left}function viewY(y){return y+imgOfs.top-parOfs.top}function selX(x){return x-imgOfs.left+parOfs.left}function selY(y){return y-imgOfs.top+parOfs.top}function evX(event){return event.pageX-parOfs.left}function evY(event){return event.pageY-parOfs.top}function getSelection(noScale){var sx=noScale||scaleX,sy=noScale||scaleY;return{x1:round(selection.x1*sx),y1:round(selection.y1*sy),x2:round(selection.x2*sx),y2:round(selection.y2*sy),width:round(selection.x2*sx)-round(selection.x1*sx),height:round(selection.y2*sy)-round(selection.y1*sy)}}function setSelection(x1,y1,x2,y2,noScale){var sx=noScale||scaleX,sy=noScale||scaleY;selection={x1:round(x1/sx||0),y1:round(y1/sy||0),x2:round(x2/sx||0),y2:round(y2/sy||0)};selection.width=selection.x2-selection.x1;selection.height=selection.y2-selection.y1}function adjust(){if(!$img.width())return;imgOfs={left:round($img.offset().left),top:round($img.offset().top)};imgWidth=$img.innerWidth();imgHeight=$img.innerHeight();imgOfs.top+=($img.outerHeight()-imgHeight)>>1;imgOfs.left+=($img.outerWidth()-imgWidth)>>1;minWidth=options.minWidth||0;minHeight=options.minHeight||0;maxWidth=min(options.maxWidth||1<<24,imgWidth);maxHeight=min(options.maxHeight||1<<24,imgHeight);if($().jquery=='1.3.2'&&position=='fixed'&&!docElem['getBoundingClientRect']){imgOfs.top+=max(document.body.scrollTop,docElem.scrollTop);imgOfs.left+=max(document.body.scrollLeft,docElem.scrollLeft)}parOfs=$.inArray($parent.css('position'),['absolute','relative'])+1?{left:round($parent.offset().left)-$parent.scrollLeft(),top:round($parent.offset().top)-$parent.scrollTop()}:position=='fixed'?{left:$(document).scrollLeft(),top:$(document).scrollTop()}:{left:0,top:0};left=viewX(0);top=viewY(0);if(selection.x2>imgWidth||selection.y2>imgHeight)doResize()}function update(resetKeyPress){if(!shown)return;$box.css({left:viewX(selection.x1),top:viewY(selection.y1)}).add($area).width(w=selection.width).height(h=selection.height);$area.add($border).add($handles).css({left:0,top:0});$border.width(max(w-$border.outerWidth()+$border.innerWidth(),0)).height(max(h-$border.outerHeight()+$border.innerHeight(),0));$($outer[0]).css({left:left,top:top,width:selection.x1,height:imgHeight});$($outer[1]).css({left:left+selection.x1,top:top,width:w,height:selection.y1});$($outer[2]).css({left:left+selection.x2,top:top,width:imgWidth-selection.x2,height:imgHeight});$($outer[3]).css({left:left+selection.x1,top:top+selection.y2,width:w,height:imgHeight-selection.y2});w-=$handles.outerWidth();h-=$handles.outerHeight();switch($handles.length){case 8:$($handles[4]).css({left:w>>1});$($handles[5]).css({left:w,top:h>>1});$($handles[6]).css({left:w>>1,top:h});$($handles[7]).css({top:h>>1});case 4:$handles.slice(1,3).css({left:w});$handles.slice(2,4).css({top:h})}if(resetKeyPress!==false){if($.imgAreaSelect.keyPress!=docKeyPress)$(document).unbind($.imgAreaSelect.keyPress,$.imgAreaSelect.onKeyPress);if(options.keys)$(document)[$.imgAreaSelect.keyPress]($.imgAreaSelect.onKeyPress=docKeyPress)}if($.browser.msie&&$border.outerWidth()-$border.innerWidth()==2){$border.css('margin',0);setTimeout(function(){$border.css('margin','auto')},0)}}function doUpdate(resetKeyPress){adjust();update(resetKeyPress);x1=viewX(selection.x1);y1=viewY(selection.y1);x2=viewX(selection.x2);y2=viewY(selection.y2)}function hide($elem,fn){options.fadeSpeed?$elem.fadeOut(options.fadeSpeed,fn):$elem.hide()}function areaMouseMove(event){var x=selX(evX(event))-selection.x1,y=selY(evY(event))-selection.y1;if(!adjusted){adjust();adjusted=true;$box.one('mouseout',function(){adjusted=false})}resize='';if(options.resizable){if(y<=options.resizeMargin)resize='n';else if(y>=selection.height-options.resizeMargin)resize='s';if(x<=options.resizeMargin)resize+='w';else if(x>=selection.width-options.resizeMargin)resize+='e'}$box.css('cursor',resize?resize+'-resize':options.movable?'move':'');if($areaOpera)$areaOpera.toggle()}function docMouseUp(event){$('body').css('cursor','');if(options.autoHide||selection.width*selection.height==0)hide($box.add($outer),function(){$(this).hide()});$(document).unbind('mousemove',selectingMouseMove);$box.mousemove(areaMouseMove);options.onSelectEnd(img,getSelection())}function areaMouseDown(event){if(event.which!=1)return false;adjust();if(resize){$('body').css('cursor',resize+'-resize');x1=viewX(selection[/w/.test(resize)?'x2':'x1']);y1=viewY(selection[/n/.test(resize)?'y2':'y1']);$(document).mousemove(selectingMouseMove).one('mouseup',docMouseUp);$box.unbind('mousemove',areaMouseMove)}else if(options.movable){startX=left+selection.x1-evX(event);startY=top+selection.y1-evY(event);$box.unbind('mousemove',areaMouseMove);$(document).mousemove(movingMouseMove).one('mouseup',function(){options.onSelectEnd(img,getSelection());$(document).unbind('mousemove',movingMouseMove);$box.mousemove(areaMouseMove)})}else $img.mousedown(event);return false}function fixAspectRatio(xFirst){if(aspectRatio)if(xFirst){x2=max(left,min(left+imgWidth,x1+abs(y2-y1)*aspectRatio*(x2>x1||-1)));y2=round(max(top,min(top+imgHeight,y1+abs(x2-x1)/aspectRatio*(y2>y1||-1))));x2=round(x2)}else{y2=max(top,min(top+imgHeight,y1+abs(x2-x1)/aspectRatio*(y2>y1||-1)));x2=round(max(left,min(left+imgWidth,x1+abs(y2-y1)*aspectRatio*(x2>x1||-1))));y2=round(y2)}}function doResize(){x1=min(x1,left+imgWidth);y1=min(y1,top+imgHeight);if(abs(x2-x1)<minWidth){x2=x1-minWidth*(x2<x1||-1);if(x2<left)x1=left+minWidth;else if(x2>left+imgWidth)x1=left+imgWidth-minWidth}if(abs(y2-y1)<minHeight){y2=y1-minHeight*(y2<y1||-1);if(y2<top)y1=top+minHeight;else if(y2>top+imgHeight)y1=top+imgHeight-minHeight}x2=max(left,min(x2,left+imgWidth));y2=max(top,min(y2,top+imgHeight));fixAspectRatio(abs(x2-x1)<abs(y2-y1)*aspectRatio);if(abs(x2-x1)>maxWidth){x2=x1-maxWidth*(x2<x1||-1);fixAspectRatio()}if(abs(y2-y1)>maxHeight){y2=y1-maxHeight*(y2<y1||-1);fixAspectRatio(true)}selection={x1:selX(min(x1,x2)),x2:selX(max(x1,x2)),y1:selY(min(y1,y2)),y2:selY(max(y1,y2)),width:abs(x2-x1),height:abs(y2-y1)};update();options.onSelectChange(img,getSelection())}function selectingMouseMove(event){x2=resize==''||/w|e/.test(resize)||aspectRatio?evX(event):viewX(selection.x2);y2=resize==''||/n|s/.test(resize)||aspectRatio?evY(event):viewY(selection.y2);doResize();return false}function doMove(newX1,newY1){x2=(x1=newX1)+selection.width;y2=(y1=newY1)+selection.height;$.extend(selection,{x1:selX(x1),y1:selY(y1),x2:selX(x2),y2:selY(y2)});update();options.onSelectChange(img,getSelection())}function movingMouseMove(event){x1=max(left,min(startX+evX(event),left+imgWidth-selection.width));y1=max(top,min(startY+evY(event),top+imgHeight-selection.height));doMove(x1,y1);event.preventDefault();return false}function startSelection(){$(document).unbind('mousemove',startSelection);adjust();x2=x1;y2=y1;doResize();resize='';if($outer.is(':not(:visible)'))$box.add($outer).hide().fadeIn(options.fadeSpeed||0);shown=true;$(document).unbind('mouseup',cancelSelection).mousemove(selectingMouseMove).one('mouseup',docMouseUp);$box.unbind('mousemove',areaMouseMove);options.onSelectStart(img,getSelection())}function cancelSelection(){$(document).unbind('mousemove',startSelection).unbind('mouseup',cancelSelection);hide($box.add($outer));setSelection(selX(x1),selY(y1),selX(x1),selY(y1));options.onSelectChange(img,getSelection());options.onSelectEnd(img,getSelection())}function imgMouseDown(event){if(event.which!=1||$outer.is(':animated'))return false;adjust();startX=x1=evX(event);startY=y1=evY(event);$(document).mousemove(startSelection).mouseup(cancelSelection);return false}function windowResize(){doUpdate(false)}function imgLoad(){imgLoaded=true;setOptions(options=$.extend({classPrefix:'imgareaselect',movable:true,parent:'body',resizable:true,resizeMargin:10,onInit:function(){},onSelectStart:function(){},onSelectChange:function(){},onSelectEnd:function(){}},options));$box.add($outer).css({visibility:''});if(options.show){shown=true;adjust();update();$box.add($outer).hide().fadeIn(options.fadeSpeed||0)}setTimeout(function(){options.onInit(img,getSelection())},0)}var docKeyPress=function(event){var k=options.keys,d,t,key=event.keyCode;d=!isNaN(k.alt)&&(event.altKey||event.originalEvent.altKey)?k.alt:!isNaN(k.ctrl)&&event.ctrlKey?k.ctrl:!isNaN(k.shift)&&event.shiftKey?k.shift:!isNaN(k.arrows)?k.arrows:10;if(k.arrows=='resize'||(k.shift=='resize'&&event.shiftKey)||(k.ctrl=='resize'&&event.ctrlKey)||(k.alt=='resize'&&(event.altKey||event.originalEvent.altKey))){switch(key){case 37:d=-d;case 39:t=max(x1,x2);x1=min(x1,x2);x2=max(t+d,x1);fixAspectRatio();break;case 38:d=-d;case 40:t=max(y1,y2);y1=min(y1,y2);y2=max(t+d,y1);fixAspectRatio(true);break;default:return}doResize()}else{x1=min(x1,x2);y1=min(y1,y2);switch(key){case 37:doMove(max(x1-d,left),y1);break;case 38:doMove(x1,max(y1-d,top));break;case 39:doMove(x1+min(d,imgWidth-selX(x2)),y1);break;case 40:doMove(x1,y1+min(d,imgHeight-selY(y2)));break;default:return}}return false};function styleOptions($elem,props){for(option in props)if(options[option]!==undefined)$elem.css(props[option],options[option])}function setOptions(newOptions){if(newOptions.parent)($parent=$(newOptions.parent)).append($box.add($outer));$.extend(options,newOptions);adjust();if(newOptions.handles!=null){$handles.remove();$handles=$([]);i=newOptions.handles?newOptions.handles=='corners'?4:8:0;while(i--)$handles=$handles.add(div());$handles.addClass(options.classPrefix+'-handle').css({position:'absolute',fontSize:0,zIndex:zIndex+1||1});if(!parseInt($handles.css('width'))>=0)$handles.width(5).height(5);if(o=options.borderWidth)$handles.css({borderWidth:o,borderStyle:'solid'});styleOptions($handles,{borderColor1:'border-color',borderColor2:'background-color',borderOpacity:'opacity'})}scaleX=options.imageWidth/imgWidth||1;scaleY=options.imageHeight/imgHeight||1;if(newOptions.x1!=null){setSelection(newOptions.x1,newOptions.y1,newOptions.x2,newOptions.y2);newOptions.show=!newOptions.hide}if(newOptions.keys)options.keys=$.extend({shift:1,ctrl:'resize'},newOptions.keys);$outer.addClass(options.classPrefix+'-outer');$area.addClass(options.classPrefix+'-selection');for(i=0;i++<4;)$($border[i-1]).addClass(options.classPrefix+'-border'+i);styleOptions($area,{selectionColor:'background-color',selectionOpacity:'opacity'});styleOptions($border,{borderOpacity:'opacity',borderWidth:'border-width'});styleOptions($outer,{outerColor:'background-color',outerOpacity:'opacity'});if(o=options.borderColor1)$($border[0]).css({borderStyle:'solid',borderColor:o});if(o=options.borderColor2)$($border[1]).css({borderStyle:'dashed',borderColor:o});$box.append($area.add($border).add($areaOpera).add($handles));if($.browser.msie){if(o=$outer.css('filter').match(/opacity=([0-9]+)/))$outer.css('opacity',o[1]/100);if(o=$border.css('filter').match(/opacity=([0-9]+)/))$border.css('opacity',o[1]/100)}if(newOptions.hide)hide($box.add($outer));else if(newOptions.show&&imgLoaded){shown=true;$box.add($outer).fadeIn(options.fadeSpeed||0);doUpdate()}aspectRatio=(d=(options.aspectRatio||'').split(/:/))[0]/d[1];$img.add($outer).unbind('mousedown',imgMouseDown);if(options.disable||options.enable===false){$box.unbind('mousemove',areaMouseMove).unbind('mousedown',areaMouseDown);$(window).unbind('resize',windowResize)}else{if(options.enable||options.disable===false){if(options.resizable||options.movable)$box.mousemove(areaMouseMove).mousedown(areaMouseDown);$(window).resize(windowResize)}if(!options.persistent)$img.add($outer).mousedown(imgMouseDown)}options.enable=options.disable=undefined}this.remove=function(){setOptions({disable:true});$box.add($outer).remove()};this.getOptions=function(){return options};this.setOptions=setOptions;this.getSelection=getSelection;this.setSelection=setSelection;this.update=doUpdate;$p=$img;while($p.length){zIndex=max(zIndex,!isNaN($p.css('z-index'))?$p.css('z-index'):zIndex);if($p.css('position')=='fixed')position='fixed';$p=$p.parent(':not(body)')}zIndex=options.zIndex||zIndex;if($.browser.msie)$img.attr('unselectable','on');$.imgAreaSelect.keyPress=$.browser.msie||$.browser.safari?'keydown':'keypress';if($.browser.opera)$areaOpera=div().css({width:'100%',height:'100%',position:'absolute',zIndex:zIndex+2||2});$box.add($outer).css({visibility:'hidden',position:position,overflow:'hidden',zIndex:zIndex||'0'});$box.css({zIndex:zIndex+2||2});$area.add($border).css({position:'absolute',fontSize:0});img.complete||img.readyState=='complete'||!$img.is('img')?imgLoad():$img.one('load',imgLoad);if($.browser.msie&&$.browser.version>=9)img.src=img.src};$.fn.imgAreaSelect=function(options){options=options||{};this.each(function(){if($(this).data('imgAreaSelect')){if(options.remove){$(this).data('imgAreaSelect').remove();$(this).removeData('imgAreaSelect')}else $(this).data('imgAreaSelect').setOptions(options)}else if(!options.remove){if(options.enable===undefined&&options.disable===undefined)options.enable=true;$(this).data('imgAreaSelect',new $.imgAreaSelect(this,options))}});if(options.instance)return $(this).data('imgAreaSelect');return this}})(jQuery);