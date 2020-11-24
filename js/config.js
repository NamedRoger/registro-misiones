function makeRequest(url, method = "GET",data = null) {
    return new Promise(function (resolve, reject) {
        let xhr = new XMLHttpRequest();
        xhr.open(method, url);
        xhr.onload = function () {
            if (this.status >= 200 && this.status < 300) {
                let response;
                const contentType = xhr.getResponseHeader("content-type");
                if (contentType && contentType.indexOf("application/json") !== -1) {
                    response = JSON.parse(xhr.response);
                  }else{
                    response = xhr.response;
                  }
                return resolve(response);
            } else {
                reject({
                    status: this.status,
                    statusText: xhr.statusText
                });
            }
        };
        xhr.onerror = function () {
            reject({
                status: this.status,
                statusText: xhr.statusText
            });
        };

        if(data == null) xhr.send();
        else xhr.send(data);
    });
}