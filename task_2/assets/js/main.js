var calculator = {
    init: function () {
        var form = document.getElementById('calculator');
        if (form.addEventListener) {
            form.addEventListener("submit", calculator.sendData, false);  //Modern browsers
        } else if (form.attachEvent) {
            form.attachEvent('onsubmit', calculator.sendData);            //Old IE
        }
    },
    sendData: function (event) {
        event.preventDefault();
        if (calculator.validData()) {
            calculator.requestData();
        } else {
            calculator.displayError('Not valid data');
        }
    },
    requestData: function () {
        ajax.send('/index.php' + calculator.collectData(), calculator.displayResult);
    },
    displayError: function (m) {
        console.log('displayError');
        console.log(m);
    },
    collectData: function () {
        var form = document.getElementById('calculator');
        var r = new URLSearchParams(new FormData(form)).toString();

        var to = (new Date().getTimezoneOffset() * -1) / 60;

        return '?' + r + '&tz_offset=' + to;

    },
    validData: function () {
        return true;
    },
    displayResult: function (r) {
        calculator.refreshTable();
        var data = JSON.parse(r);
        if (data.result == "OK") {
            calculator.updateItem('value', data.policy.value);
            calculator.updateItem('base_price_of_policy', data.policy.base_price_of_policy);
            calculator.updateItem('commission', data.policy.commission);
            calculator.updateItem('tax', data.policy.tax);
            calculator.updateItem('total', data.policy.total);


            calculator.removeClass('#inst', 'hidden-item');
            calculator.removeClass('.summary', 'hidden-item');


            for (var k in data.instalments) {
                var instalment = data.instalments[k];
                var id = parseInt(k) + 1;
                calculator.updateItem('base_price_of_policy_' + id, instalment.base_price_of_policy);
                calculator.updateItem('commission_' + id, instalment.commission);
                calculator.updateItem('tax_' + id, instalment.tax);
                calculator.updateItem('total_' + id, instalment.total);
                calculator.removeClass('#inst_' + id, 'hidden-item');
            }

            calculator.removeClass('#result', 'hidden');

            return true;
        }
        calculator.displayError('Wrong response');
        return false;
    },
    updateItem(id_selector, value) {
        document.getElementById(id_selector).innerHTML = value;
        calculator.removeClass('#' + id_selector, 'hidden-item');
    },
    refreshTable: function () {
        calculator.removeClass('td', 'hidden-item');
        calculator.addClass('td', 'hidden-item');
        calculator.removeClass('th', 'hidden-item');
        calculator.addClass('th', 'hidden-item');
        calculator.removeClass('#result', 'hidden');
        calculator.addClass('#result', 'hidden');
    },

    addClass: function (elements, myClass) {

        // if there are no elements, we're done
        if (!elements) {
            return;
        }

        // if we have a selector, get the chosen elements
        if (typeof(elements) === 'string') {
            elements = document.querySelectorAll(elements);
        }

        // if we have a single DOM element, make it an array to simplify behavior
        else if (elements.tagName) {
            elements = [elements];
        }

        // add class to all chosen elements
        for (var i = 0; i < elements.length; i++) {

            // if class is not already found
            if ((' ' + elements[i].className + ' ').indexOf(' ' + myClass + ' ') < 0) {

                // add class
                elements[i].className += ' ' + myClass;
            }
        }
    },
    removeClass: function (elements, myClass) {

        // if there are no elements, we're done
        if (!elements) {
            return;
        }

        // if we have a selector, get the chosen elements
        if (typeof(elements) === 'string') {
            elements = document.querySelectorAll(elements);
        }

        // if we have a single DOM element, make it an array to simplify behavior
        else if (elements.tagName) {
            elements = [elements];
        }

        // create pattern to find class name
        var reg = new RegExp('(^| )' + myClass + '($| )', 'g');

        // remove class from all chosen elements
        for (var i = 0; i < elements.length; i++) {
            elements[i].className = elements[i].className.replace(reg, ' ');
        }
    }


};

var ajax = {
    xhr: null,
    x: function () {
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
        x.open("GET", url, true);
        x.onreadystatechange = function () {
            if (x.readyState == 4) {
                callback(x.responseText)
            }
        };
        x.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        x.send(url)
    },
    get: function (url, callback, data) {
        var query = [];
        for (var key in data) {
            query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
        }
        ajax.send(url + (query.length ? '?' + query.join('&') : ''), callback)
    }
};