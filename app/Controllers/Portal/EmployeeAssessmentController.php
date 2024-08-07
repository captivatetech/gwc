<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class EmployeeAssessmentController extends BaseController
{
    public function __construct()
    {
        $this->employees = model('Employees');
    }

    public function e_addLoanReadinessAssessment()
    {
        $fields = $this->request->getPost();

        $arrAnswers = [
            'answer1' => $fields['answer4'],
            'answer2' => $fields['answer3'],
            'answer3' => $fields['answer5'],
            'answer4' => $fields['answer2'],
            'answer5' => $fields['answer1'],
            'answer6' => $fields['answer6'],
            'answer7' => $fields['answer7']
        ];

        $totalScore = 0;
        $arrLetters = [];
        for ($i=1; $i <= count($arrAnswers); $i++) 
        { 
            $score = explode('-',$arrAnswers["answer$i"]);
            $totalScore += (int)$score[1];
            $arrLetters[] = $score[0];
        }

        $arrPersonaTable = [
             #1  #2  #3  #4  #5  #6  #7
            ['D','C','D','A','A','D','A'], // a = The Law Abiding citizen
            ['C','C','D','A','A','D','C'], // b = The Law Abiding citizen
            ['B','C','D','A','A','D','B'], // c = The Dept Independent Seeker
            ['B','B','C','B','B','C','C'], // d = The Variable Payments Payer
            ['B','A','A','C','C','A','C'], // e = Seasonal Life Events and Consolidation Borrowers
            ['A','A','B','C','B','C','B'], // f = The Caught Between Cycles
        ];

        $arr = [];
        $persona = '';
        for ($i=0; $i < count($arrLetters); $i++) 
        { 
            if($arrPersonaTable[0][$i] == $arrLetters[$i])
            {
                if(!in_array('a', $arr))
                {
                    $arr[] = 'a';
                }
                else
                {
                    $persona = 'The Law Abiding Citizen';
                    break;
                }
            }

            if($arrPersonaTable[1][$i] == $arrLetters[$i])
            {
                if(!in_array('b', $arr))
                {
                    $arr[] = 'b';
                }
                else
                {
                    $persona = 'The Law Abiding Citizen';
                    break;
                }
            }

            if($arrPersonaTable[2][$i] == $arrLetters[$i])
            {
                if(!in_array('c', $arr))
                {
                    $arr[] = 'c';
                }
                else
                {
                    $persona = 'The Dept Independent Seeker';
                    break;
                }
            }

            if($arrPersonaTable[3][$i] == $arrLetters[$i])
            {
                if(!in_array('d', $arr))
                {
                    $arr[] = 'd';
                }
                else
                {
                    $persona = 'The Variable Payments Payer';
                    break;
                }
            }

            if($arrPersonaTable[4][$i] == $arrLetters[$i])
            {
                if(!in_array('e', $arr))
                {
                    $arr[] = 'e';
                }
                else
                {
                    $persona = 'Seasonal Life Events and Consolidation Borrowers';
                    break;
                }
            }

            if($arrPersonaTable[5][$i] == $arrLetters[$i])
            {
                if(!in_array('f', $arr))
                {
                    $arr[] = 'f';
                }
                else
                {
                    $persona = 'The Caught Between Cycles';
                    break;
                }
            }
        }

        $interestRate = 0;
        if($totalScore >= 30 && $totalScore <= 35)
        {
            $interestRate = 2.75;
        }
        else if($totalScore >= 22 && $totalScore <= 29)
        {
            $interestRate = 3.25;
        }
        else if($totalScore >= 0 && $totalScore <= 21)
        {
            $interestRate = 3.75;
        }

        $arrData['totalScore'] = $totalScore;
        $arrData['arrLetters'] = $arrLetters;
        $arrData['arrAnswers'] = $arrAnswers;
        $arrData['persona'] = $persona;
        $arrData['interestRate'] = $interestRate;

        return $this->response->setJSON($arrData);
    }
}
