
const AJAXHELPER = (function(){

    let thisAjaxHelper = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisAjaxHelper.validateData = function(arrParams, returnSuccessData, returnErrorData)
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
                returnSuccessData(data);
            },
            error : function(data)
            {
                returnErrorData(data);
            }
        });
    }

    thisAjaxHelper.loadData = function(arrParams, returnSuccessData, returnErrorData)
    {
        $.ajax({
            url : `${baseUrl}${arrParams['route']}`,
            method : 'get',
            dataType: 'json',
            data : arrParams['data'],
            success : function(data)
            {
                returnSuccessData(data);
            },
            error : function(data)
            {
                returnErrorData(data);
            }
        });
    }

    thisAjaxHelper.addData = function(arrParams, returnSuccessData, returnErrorData)
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
                returnSuccessData(data);
            },
            error : function(data)
            {
                returnErrorData(data);
            }
        });
    }

    thisAjaxHelper.selectData = function(arrParams, returnSuccessData, returnErrorData)
    {
        $.ajax({
            url : `${baseUrl}${arrParams['route']}`,
            method : 'get',
            dataType: 'json',
            data : arrParams['data'],
            success : function(data)
            {
                returnSuccessData(data);
            },
            error : function(data)
            {
                returnErrorData(data);
            }
        });
    }

    thisAjaxHelper.editData = function(arrParams, returnSuccessData, returnErrorData)
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
                returnSuccessData(data);
            },
            error : function(data)
            {
                returnErrorData(data);
            }
        });
    }

    thisAjaxHelper.removeData = function(arrParams, returnSuccessData, returnErrorData)
    {
        $.ajax({
            url : `${baseUrl}${arrParams['route']}`,
            method : 'post',
            dataType: 'json',
            data : arrParams['data'],
            success : function(data)
            {
                returnSuccessData(data);
            },
            error : function(data)
            {
                returnErrorData(data);
            }
        });
    }

    return thisAjaxHelper;

})();