
const ADMIN_FAQS = (function(){

    let thisAdminFaqs = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisAdminFaqs.loadFaqs = function()
    {
        AJAXHELPER.getData({
            // FaqController->loadAdminFaqs
            'route' : 'portal/admin/load-admin-faqs',
            'data'  : null
        }, function(data){
            let tbody = '';
            data.forEach(function(value, index){
                let faqsStatus = (value['faq_status'] == '1')? `<span class="text-success">Active</span>` : `<span class="text-danger">Inactive</span>`;
                tbody += `<tr>
                            <td>${value['question']}</td>
                            <td>${value['answer']}</td>
                            <td>${faqsStatus}</td>
                            <td>                                                        
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="ADMIN_FAQS.selectFaq(${value['id']})">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="ADMIN_FAQS.removeFaq(${value['id']})">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
            });
            $('#tbl_faqs').DataTable().destroy();
            $('#tbl_faqs tbody').html(tbody);
            $('#tbl_faqs').DataTable();
        });
    }

    thisAdminFaqs.addFaq = function(thisForm)
    {
        let formData = new FormData(thisForm);
        $('#btn_saveFaqs').prop('disabled',true);
        AJAXHELPER.postData({
            // FaqController->addAdminFaq
            'route' : 'portal/admin/add-admin-faq',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_saveFaqs').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/admin/maintenance-faqs`);
            }, 1000);
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_saveFaqs').prop('disabled',false);
        });
    }

    thisAdminFaqs.selectFaq = function(faqId)
    {
        $('#modal_faqs').modal('show');
        AJAXHELPER.getData({
            // FaqController->selectAdminFaq
            'route' : 'portal/admin/select-admin-faq',
            'data'  : {faqId : faqId}
        }, function(data){
            $('#txt_faqId').val(data['id']);
            $('#txt_question').val(data['question']);
            $('#txt_answer').val(data['answer']);
            $('#slc_faqsStatus').val(data['faq_status']);
        });
    }

    thisAdminFaqs.editFaq = function(thisForm)
    {
        let formData = new FormData(thisForm);
        $('#btn_saveFaqs').prop('disabled',true);
        AJAXHELPER.postData({
            // FaqController->editAdminFaq
            'route' : 'portal/admin/edit-admin-faq',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_saveFaqs').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/admin/maintenance-faqs`);
            }, 1000);
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_saveFaqs').prop('disabled',false);
        });
    }

    thisAdminFaqs.removeFaq = function(faqId)
    {
        if(confirm('Please Confirm!'))
        {
            AJAXHELPER.removeData({
                // FeeController->removeAdminFaq
                'route' : 'portal/admin/remove-admin-faq',
                'data'  : {faqId : faqId}
            }, function(data){
                COMMONHELPER.Toaster('success',data[0]);
                setTimeout(function(){
                    window.location.replace(`${baseUrl}portal/admin/maintenance-faqs`);
                }, 1000);
            }, function(data){
                COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            });
        }
    }

    return thisAdminFaqs;

})();