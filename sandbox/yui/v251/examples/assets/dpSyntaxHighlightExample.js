(function () {
var d = document,
    f = [],fi = 0,
    head = function (content) {
            f[fi++] = '<h2>' + content + '</h2>';
        },
    code = function (content,type) {
            f[fi++] = '<textarea name="code" cols="60" rows="1" class="' +
                      (type || 'HTML') + '">' + content + '</textarea>';
        },
    getByClass = (function () {
            // Native support
            if (d.body.getElementsByClassName) {
                return function (c) {
                    return d.body.getElementsByClassName(c)
                };
            } else if (typeof(YAHOO) !== 'undefined' && YAHOO.util.Dom) {
                return function (c) {
                    return YAHOO.util.Dom.getElementsByClassName(c,'*');
                };
            } else {
                return function (c) {
                    var nodes = [],
                        elements = d.body.getElementsByTagName('*'),
                        re = new RegExp('(?:^|\\s+)' + c + '(?:\\s+|$)');

                    for (var i = 0, len = elements.length; i < len; ++i) {
                        if ( re.test(elements[i].className) ) {
                            nodes[nodes.length] = elements[i];
                        }
                    }
                    
                    return nodes;
                }
            }
        })(),
    i,len;

// Step 1. Add style blocks
var styles = d.getElementsByTagName('style');
if (styles.length) {
    head('CSS');
    for (i = 0,len = styles.length; i < len; ++i) {
        code(styles[i].innerHTML, 'CSS');
    }
}

// Step 2. Add markup blocks
var markup = getByClass('markup');
if (markup.length) {
    head('Markup');
    for (i = 0,len = markup.length; i < len; ++i) {
        code(markup[i].innerHTML, 'HTML');
    }
}

// Step 3. Add script blocks
var scripts = d.getElementsByTagName('script');
if (scripts.length) {
    head('Code');
    for (var i = 0, len = scripts.length; i < len; ++i) {
        if (/\S/.test(scripts[i].innerHTML)) {
            code(scripts[i].innerHTML,'JScript');
        }
    }
}

var div = d.createElement('div');
div.innerHTML = f.join('');
d.body.appendChild(div);

setTimeout(function () { dp.SyntaxHighlighter.HighlightAll('code'); },0);

})();
