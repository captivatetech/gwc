<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Questionaires;

class QuestionaireSeeder extends Seeder
{
    public function run()
    {
        $questionaires = new Questionaires();

        $arr = [
            [
                'Kayo ba ay nakakagawa ng budget at ito ay nasusundan sa isang buwan?',
                [
                    'Yes, ito ay laging nasusundan',
                    'Yes, ito ay bihirang masundan',
                    'No, hindi ako gumagawa ng budget'
                ]
            ],
            [
                'Ilang porsyento ng inyong sinasahod ang inyong naitatabi sa ipon kada buwan?',
                [
                    'Halos kalahati (50%) ng aking sahod ay aking naitatabi',
                    'Halos 30% ng aking sahod ang aking naitatabi',
                    'Halos 10% ng aking sahod ay aking naitatabi',
                    'Wala akong naitatabi sa aking sinasahod.'
                ]
            ],
            [
                'Ilang porsyento ng inyong sinasahod ang inyong naitatabi sa ipon kada buwan?',
                [
                    'Halos kalahati (50%) ng aking sahod ay aking naitatabi',
                    'Halos 30% ng aking sahod ang aking naitatabi',
                    'Halos 10% ng aking sahod ay aking naitatabi',
                    'Wala akong naitatabi sa aking sinasahod.'
                ]
            ],
        ];

        $arrData = [
            'question'              => 'Salary-Advance',
            'answer'                => json_encode($arrAnswers),
            'questionaire_status'   => 1,
            'created_date'          => date('Y-m-d H:i:s')
        ];

        $questionaires->insert($arrData);
    }
}
