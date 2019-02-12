
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
function pathJoin(parts, sep){
    var separator = sep || '/';
    var replace = new RegExp(separator+'{1,}', 'g');
    return parts.join(separator).replace(replace, separator);
}

function ajax(method, url, ascyn, onSuccess, onFail) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            onSuccess.call(this.responseText);
        }
    };
    xhttp.open(method, url, ascyn);
    xhttp.send();
    if (ascyn === false) {
        return xhttp.responseText;
    }
}

// Helper function to auto append 'px'
function px_(s) {
    return s + 'px';
}

function getImageIndexById(ecosystemObj, nid) {
    for (var i = 0; i < ecosystemObj.imageList.length; i++) {
        if (ecosystemObj.imageList[i].scale_id === nid) {
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
