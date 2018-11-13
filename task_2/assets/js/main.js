var calculator = {
    init: function() {
        var form = document.getElementById('calculator');
        if(form.addEventListener){
            form.addEventListener("submit", calculator.sendData, false);  //Modern browsers
        }else if(form.attachEvent){
            form.attachEvent('onsubmit', calculator.sendData);            //Old IE
        }
    },
    sendData: function(event) {
        event.preventDefault();
        if (calculator.validData()) {
            calculator.requestData();
        } else {
            calculator.displayError('Not valid data');
        }
    },
    requestData: function() {
        ajax.send('/api/', calculator.displayResult, calculator.collectData());
    },
    displayError: function(m) {
        console.log('displayError');
        console.log(m);
    },
    collectData: function() {
        return {
            a: 1,
            b: 'test'
        }
    },
    validData: function() {
        return true;
    },
    displayResult: function(r) {
        console.log('displayResult');
        console.log(r);
    },

};

var ajax = {
    xhr: null,
    x: function() {
        if (typeof XMLHttpRequest !== 'undefined') {
            return new XMLHttpRequest();
        }
        var versions = [
            "MSXML2.XmlHttp.6.0",
            "MSXML2.XmlHttp.5.0",
            "MSXML2.XmlHttp.4.0",
            "MSXML2.XmlHttp.3.0",
            "MSXML2.XmlHttp.2.0",
            "Microsoft.XmlHttp"
        ];

        var xhr;
        for (var i = 0; i < versions.length; i++) {
            try {
                xhr = new ActiveXObject(versions[i]);
                break;
            } catch (e) {
            }
        }
        return xhr;
    },
    send: function (url, callback) {
        var x = this.x();
        x.open("GET" , url, true);
        x.onreadystatechange = function () {
            if (x.readyState == 4) {
                callback(x.responseText)
            }
        };
        x.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        x.send(url)
    },
    get: function(url, callback, data) {
        var query = [];
        for (var key in data) {
            query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
        }
        ajax.send(url + (query.length ? '?' + query.join('&') : ''), callback)
    }
};