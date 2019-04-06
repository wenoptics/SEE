// Helper function to render a dom HTML string
function render(domHtmlString, targetNode) {
    targetNode.innerHTML = domHtmlString;
}

// Helper function to append html dom to a parent
function appendDom(parentNode, domHtmlString) {
    // const _wrap = document.createElement('div');
    // render(domHtmlString, _wrap);
    // parentNode.appendChild(_wrap);
    parentNode.innerHTML += domHtmlString;
}

// Helper function to join path
function pathJoin(parts, sep) {
    var separator = sep || '/';
    var replace = new RegExp(separator + '{1,}', 'g');
    return parts.join(separator).replace(replace, separator);
}

function ajax(method, url, data, ascyn, onSuccess, onFail) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (onSuccess) {
                onSuccess.call(this, this.responseText);
            }
        }
    };
    xhttp.open(method, url, ascyn);
    xhttp.send(data);
    if (ascyn === false) {
        return xhttp.responseText;
    }
}

function trim(s) {
    /// perform a string blank strip
    return s.replace(/^\s+|\s+$/g, '');
}

// Helper function to auto append 'px'
function px_(s) {
    return s + 'px';
}

function getImageIndexById(ecosystemObj, nid) {
    nid = parseInt(nid);
    for (var i = 0; i < ecosystemObj.nodeList.length; i++) {
        if (ecosystemObj.nodeList[i].id === nid) {
            return i;
        }
    }
    return null;
}

function getImageNodeById(ecosystemObj, nid) {
    /// todo Improve by using hashmap
    const i = getImageIndexById(ecosystemObj, nid);
    return i === null ? null : ecosystemObj.imageList[i];
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
        vars[key] = value;
    });
    return vars;
}

function getUrlParam(parameter, defaultvalue) {
    var urlparameter = defaultvalue;
    if (window.location.href.indexOf(parameter) > -1) {
        urlparameter = getUrlVars()[parameter];
    }
    return urlparameter;
}

// From https://blog.bitscry.com/2018/08/17/getting-and-setting-url-parameters-with-javascript/
function setUrlParameter(url, key, value) {
    key = encodeURIComponent(key);
    value = encodeURIComponent(value);

    var baseUrl = url.split('?')[0],
        newParam = key + '=' + value,
        params = '?' + newParam;

    if (url.split('?')[1] === undefined) { // if there are no query strings, make urlQueryString empty
        urlQueryString = '';
    } else {
        urlQueryString = '?' + url.split('?')[1];
    }

    // If the "search" string exists, then build params from it
    if (urlQueryString) {
        var updateRegex = new RegExp('([\?&])' + key + '[^&]*');
        var removeRegex = new RegExp('([\?&])' + key + '=[^&;]+[&;]?');

        if (typeof value === 'undefined' || value === null || value === '') { // Remove param if value is empty
            params = urlQueryString.replace(removeRegex, "$1");
            params = params.replace(/[&;]$/, "");

        } else if (urlQueryString.match(updateRegex) !== null) { // If param exists already, update it
            params = urlQueryString.replace(updateRegex, "$1" + newParam);

        } else if (urlQueryString == '') { // If there are no query strings
            params = '?' + newParam;
        } else { // Otherwise, add it to end of query string
            params = urlQueryString + '&' + newParam;
        }
    }

    // no parameter was set so we don't need the question mark
    params = params === '?' ? '' : params;

    return baseUrl + params;
}