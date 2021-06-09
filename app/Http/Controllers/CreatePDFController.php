<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade;
use Illuminate\Support\Facades\Response;

class CreatePDFController extends Controller
{
    public function createProofOfAcceptancePDF_IRBBM()
    {
        $data = [
            'irbNumber' => 'AS-IRB01-17007(N)',
            'isNormalReview' => true,
            'chName' => '申請人阿逼',
            'enName' => 'IRB',
            'institute' => 'Institute of Biomedical Sciences 生物醫學科學研究所',
            'phone' => '4234',
            'email' => 'asirb8722@gmail.com',
            'projChName' => '上皮黏附因子及其胞外結構與單一山中申彌因子能誘導人類體細胞形成誘導型多能幹細胞上皮黏附因子及其胞外結構與單一山中申彌因子能誘導人類體細胞形成誘導型多能幹細胞',
            'projEnName' => 'EpCAM/EpEX with single Yamanaka factor generate induced pluripoten tstem cell from human somatic',
            'sourceFromAS' => '生醫所',
            'sourceFromEX' => 'MOST',
            'collabAS' => [
                ['name' => '吳漢忠 Han-Chung Wu', 'inst' => 'Institute of Biomedical Sciences 細胞與個體生物學研究所', 'role' => '其他'],
                ['name' => '呂仁 JeanLu', 'inst' => 'Institute of Infomation Sciences 基因體研究中心', 'role' => '其他'],
                ['name' => '管奕奕 I-I Kuan', 'inst' => 'Institute of Biomedical Sciences 細胞與個體生物學研究所', 'role' => '計畫主持人'],
                // ['name' => 'Biomedical Sciences 2生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '其他'],
                // ['name' => ' Biomedical Sciences 3生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
                // ['name' => 'Institute of Biomedi4生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],

            ],
            'collabNonAS'=>[
                // ['name' => 'Biomedical Sciences 1生物醫學科學', 'inst' => '生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所', 'role' => '123'],
                ['name' => 'Biomedical Sciences 2生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '其他'],
                ['name' => ' Biomedical Sciences 3生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
                // ['name' => 'Institute of Biomedi4生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
                // ['name' => 'Institute of Biom 5生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
                // ['name' => 'Institute of Biomedic6生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
                // ['name' => 'Institute of B生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
            ],
            'startDate' => '2017/02/11',
            'endDate'=> '2017/02/15',
            'date' => '2017-02-14'
        ];
        $pdf = Facade::loadView('proof_of_acceptance_irbbm',$data)
        ->setPaper('a4', 'portrait');
        // $pdf = Facade::loadHtml('<h1>Test</h1>');
        // return $pdf->download('test.pdf');
        $headers = ['Content-Type' => 'application/pdf'];
        return Response::make($pdf->stream(), 200, $headers);
    }
    public function createViewProofOfAcceptancePDF_IRBBM()
    {
        $data = [
            // 'irbNumber' => 'AS-IRB01-17007(N)',
            // 'isNormalReview' => true,
            // 'chName' => '申請人阿逼',
            // 'enName' => 'IRB',
            // 'institute' => 'Institute of Biomedical Sciences 生物醫學科學研究所',
            // 'phone' => '4234',
            // 'email' => 'asirb8722@gmail.com',
            // 'projChName' => '上皮黏附因子及其胞外結構與單一山中申彌因子能誘導人類體細胞形成誘導型多能幹細胞上皮黏附因子及其胞外結構與單一山中申彌因子能誘導人類體細胞形成誘導型多能幹細胞',
            // 'projEnName' => 'EpCAM/EpEX with single Yamanaka factor generate induced pluripoten tstem cell from human somatic',
            // 'sourceFromAS' => '生醫所',
            // 'sourceFromEX' => 'MOST',
            // 'collabAS' => [
            //     ['name' => '吳漢忠 Han-Chung Wu', 'inst' => 'Institute of Biomedical Sciences 細胞與個體生物學研究所', 'role' => '其他'],
            //     ['name' => '呂仁 JeanLu', 'inst' => 'Institute of Infomation Sciences 基因體研究中心', 'role' => '其他'],
            //     ['name' => '管奕奕 I-I Kuan', 'inst' => 'Institute of Biomedical Sciences 細胞與個體生物學研究所', 'role' => '計畫主持人'],
            //     ['name' => 'Biomedical Sciences 2生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '其他'],
            //     ['name' => ' Biomedical Sciences 3生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
            //     ['name' => 'Institute of Biomedi4生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],

            // ],
            // 'collabNonAS'=>[
            //     // ['name' => 'Biomedical Sciences 1生物醫學科學', 'inst' => '生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所', 'role' => '123'],
            //     ['name' => 'Biomedical Sciences 2生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => ''],
            //     ['name' => ' Biomedical Sciences 3生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
            //     ['name' => 'Institute of Biomedi4生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
            //     ['name' => 'Institute of Biom 5生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
            //     ['name' => 'Institute of Biomedic6生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
            //     ['name' => 'Institute of B生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
            // ],
            // 'startDate' => '2017/02/11',
            // 'endDate'=> '2017/02/15',
            // 'date' => '2017-02-14'
        ];
        return view('proof_of_acceptance_irbbm',$data);
    }

    /*
     * 人文社會倫理
     *
     *
     *
     */
    public function createProofOfAcceptancePDF_IRBHS()
    {
        $data = [
            'irbNumber' => 'AS-IRB01-17007(N)',
            'isNormalReview' => true,
            'chName' => '申請人阿逼',
            'enName' => 'IRB',
            'institute' => '人文社會研究所',
            'phone' => '4234',
            'email' => 'asirb8722@gmail.com',
            'projChName' => '人文社會人文社會人文社會人文社會人文社會人文社會人文社會人文社會人文社會人文社會人文社會人文社會人文社會人文社會',
            'projEnName' => 'EpCAM/EpEX with single Yamanaka factor generate induced pluripoten tstem cell from human somatic',
            'sourceFromAS' => '人文社會所',
            'sourceFromEX' => 'MOST',
            'collabAS' => [
                ['name' => '吳漢忠 Han-Chung Wu', 'inst' => 'Institute of Biomedical Sciences 人文社會研究所', 'role' => '其他'],
                ['name' => '呂仁 JeanLu', 'inst' => 'Institute of Infomation Sciences 人文社會', 'role' => '其他'],
                ['name' => '管奕奕 I-I Kuan', 'inst' => 'Institute of Biomedical Sciences 人文社會學研究所', 'role' => '計畫主持人'],
                // ['name' => 'Biomedical Sciences 2生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '其他'],
                // ['name' => ' Biomedical Sciences 3生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
                // ['name' => 'Institute of Biomedi4生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],

            ],
            'collabNonAS'=>[
                // ['name' => 'Biomedical Sciences 1生物醫學科學', 'inst' => '生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所生物醫學科學研究所', 'role' => '123'],
                ['name' => 'Biomedical Sciences 人文社會', 'inst' => 'Institute of Biomedical Sciences 人文社會研究所', 'role' => '其他'],
                ['name' => ' Biomedical Sciences 3人文社會', 'inst' => 'Institute of Biomedical Sciences 人文社會研究所', 'role' => '身分2'],
                // ['name' => 'Institute of Biomedi4生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
                // ['name' => 'Institute of Biom 5生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
                // ['name' => 'Institute of Biomedic6生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
                // ['name' => 'Institute of B生物醫學科學', 'inst' => 'Institute of Biomedical Sciences 生物醫學科學研究所', 'role' => '身分2'],
            ],
            'startDate' => '2017/02/11',
            'endDate'=> '2017/02/15',
            'date' => '2017-02-14'
        ];
        $pdf = Facade::loadView('proof_of_acceptance_irbbm',$data)
        ->setPaper('a4', 'portrait');
        // $pdf = Facade::loadHtml('<h1>Test</h1>');
        // return $pdf->download('test.pdf');
        $headers = ['Content-Type' => 'application/pdf'];
        return Response::make($pdf->stream(), 200, $headers);
    }

}
