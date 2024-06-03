
const SAMPLE = (function(){

    let thisSample = {};

    thisSample.loadSample = function()
    {
        AJAXHELPER.loadData({
            'route' : 'load-data',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){
            COMMONHELPER.clearFields({
                'text'  : [
                    ['txt_hello' , ''],
                    ['txt_hello2' , ''],
                ]
            });
        });
    }

    thisSample.addSample = function()
    {
        let formData = new FormData();
        formData.set("arrData", 'sample');
        AJAXHELPER.addData({
            'route' : 'add-data',
            'data'  : formData
        }, function(data){
            console.log(data);
        });
    }

    thisSample.selectSample = function()
    {
        AJAXHELPER.selectData({
            'route' : 'select-data',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){
            console.log(data);
        });
    }

    return thisSample;

})();