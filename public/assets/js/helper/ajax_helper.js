
const AJAXHELPER = (function(){

    let thisAjaxHelper = {};

    let baseUrl = $('#txt_baseUrl').val();

    let _waitMeLoaderConfig = {
        //none, rotateplane, stretch, orbit, roundBounce, win8,
        //win8_linear, ios, facebook, rotation, timer, pulse,
        //progressBar, bouncePulse or img
        effect:'roundBounce',
        //place text under the effect (string).
        text:'Processing, Please Wait...',
        //background for container (string).
        bg:'rgba(255,255,255,0.7)',
        //color for background animation and text (string).
        color:'#000',
        //max size
        // maxSize:'',
        //wait time im ms to close
        waitTime: 0,
        //url to image
        // source:`${baseUrl}/public/assets/Adminto/images/gwc-logo.png`,
        //or 'horizontal'
        textPos:'vertical',
        //font size
        fontSize:'',
    };

    thisAjaxHelper.getData = function(arrParams, returnSuccessData, returnErrorData)
    {
        $('body').waitMe(_waitMeLoaderConfig);
        $.ajax({
            url : `${baseUrl}${arrParams['route']}`,
            method : 'get',
            dataType: 'json',
            data : arrParams['data'],
            success : function(data)
            {
                $('body').waitMe('hide');
                returnSuccessData(data);
            },
            error : function(data)
            {
                $('body').waitMe('hide');
                returnErrorData(data);
            }
        });
    }

    thisAjaxHelper.postData = function(arrParams, returnSuccessData, returnErrorData)
    {
        $('body').waitMe(_waitMeLoaderConfig);
        $.ajax({
            url : `${baseUrl}${arrParams['route']}`,
            method : 'post',
            dataType: 'json',
            processData: false, // important
            contentType: false, // important
            data : arrParams['data'],
            success : function(data)
            {
                $('body').waitMe('hide');
                returnSuccessData(data);
            },
            error : function(data)
            {
                $('body').waitMe('hide');
                returnErrorData(data);
            }
        });
    }

    thisAjaxHelper.sendEmail = function(arrParams, returnSuccessData, returnErrorData)
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