<?php

namespace App\Controllers;
use App\Models\ModelKomentar;
use App\Models\ModelCrm;
use App\Controllers\BaseController;
use Codeigniter\HTTP\RequestInterface;
use Config\services;

class NotificationController  extends BaseController
{
    public function checkNewComments()
    {
        $lastChecked = $this->request->getVar('lastChecked');
        $crmModel = new CrmModel();
        $newComments = $ModelCrm->getNewComments($lastChecked);

        return $this->response->setJSON($newComments);
    }
}