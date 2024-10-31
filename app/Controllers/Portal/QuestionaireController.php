<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class QuestionaireController extends BaseController
{
    public function index()
    {
        //
    }

    public function e_choosePreferedLangauge()
    {
        $fields = $this->request->getGet();
        $jsonData = file_get_contents(base_url() . "/public/questionaires.json");
        $arrData = json_decode($jsonData, true);
        return $this->response->setJSON($arrData[$fields['preferedLanguage']]);
    }
}
