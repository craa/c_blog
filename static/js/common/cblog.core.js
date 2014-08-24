var CBlog = function () {

    /*ajax加载内容到内容区*/
    this.loadUrl = function(url){
        this.AJAX.get({
            url:url,
            success:function(data){
                $("#desktop").html(data);
            }
        });
    };

    /*封装AJAX请求*/
    this.AJAX = {};
    this.AJAX.request = function (requestData) {
        requestData.data = exsit(requestData.data) ? requestData.data : {};
        requestData.beforeSend = exsit(requestData.beforeSend) ? requestData.beforeSend : this.beforeSend;
        requestData.complete = exsit(requestData.complete) ? requestData.complete : this.complete;
        requestData.success = exsit(requestData.success) ? requestData.success : this.success;
        requestData.error = exsit(requestData.error) ? requestData.error : this.error;
        $.ajax({
            type: requestData.type,
            url: requestData.url,
            data: requestData.data,
            beforeSend: requestData.beforeSend,
            complete: requestData.complete,
            success: requestData.success,
            error: requestData.error
        });
    };

    this.AJAX.post = function (requestData) {
        requestData.type = "POST";
        this.request(requestData);
    };

    this.AJAX.get = function (requestData) {
        requestData.type = "GET";
        this.request(requestData);
    };

    this.AJAX.success = function (data, status) {
        if (!exsit(data.message)) {
            data = JSON.parse(data);
        }
        alert(data.message);
    };

    this.AJAX.error = function (XMLHttpRequest, textStatus, errorThrown) {
        alert('服务器出错了！');
    };

    this.AJAX.beforeSend = function () {

    };

    this.AJAX.complete = function () {

    };
};

function exsit(variableName)
{
    return typeof(variableName) != "undefined";
}

CBLOG = new CBlog;