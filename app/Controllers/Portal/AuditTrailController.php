<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class AuditTrailController extends BaseController
{
    public function __construct()
    {
        $this->activities = model('Activities');
    }

    /*
        USED IN:
        ADMIN_AUDIT_TRIALS->a_loadAuditTails()
    */
    public function a_loadAuditTrails()
    {
        $arrData = $this->activities->a_loadActivities();
        return $this->response->setJSON($arrData);
    }
}
