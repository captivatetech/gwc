
const AJAXHELPER = (function(){

    let thisAjaxHelper = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisAjaxHelper.loadData = function(arrParams, returnLoadData)
    {
        $.ajax({
            url : `${baseUrl}${arrParams['route']}`,
            method : 'get',
            dataType: 'json',
            data : arrParams['data'],
            success : function(data)
            {
                returnLoadData(data);
            },
            error : function(data)
            {
                returnLoadData(data);
            }
        });
    }

    thisAjaxHelper.addData = function(arrParams, returnLoadData)
    {
        $.ajax({
            url : `${baseUrl}${arrParams['route']}`,
            method : 'post',
            dataType: 'json',
            processData: false, // important
            contentType: false, // important
            data : arrParams['data'],
            success : function(data)
            {
                returnLoadData(data);
            },
            error : function(data)
            {
                returnLoadData(data);
            }
        });
    }

    thisAjaxHelper.selectData = function(arrParams, returnLoadData)
    {
        $.ajax({
            url : `${baseUrl}${arrParams['route']}`,
            method : 'get',
            dataType: 'json',
            data : arrParams['data'],
            success : function(data)
            {
                returnLoadData(data);
            },
            error : function(data)
            {
                returnLoadData(data);
            }
        });
    }

    thisAjaxHelper.editData = function(arrParams, returnLoadData)
    {
        $.ajax({
            url : `${baseUrl}${arrParams['route']}`,
            method : 'post',
            dataType: 'json',
            processData: false, // important
            contentType: false, // important
            data : arrParams['data'],
            success : function(data)
            {
                returnLoadData(data);
            },
            error : function(data)
            {
                returnLoadData(data);
            }
        });
    }

    thisAjaxHelper.removeData = function(arrParams, returnLoadData)
    {
        $.ajax({
            url : `${baseUrl}${arrParams['route']}`,
            method : 'post',
            dataType: 'json',
            data : arrParams['data'],
            success : function(data)
            {
                returnLoadData(data);
            },
            error : function(data)
            {
                returnLoadData(data);
            }
        });
    }

    return thisAjaxHelper;

})();