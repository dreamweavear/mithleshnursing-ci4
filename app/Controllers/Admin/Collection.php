<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Dompdf\Dompdf;

class Collection extends BaseController
{
    private function getReportData($type='day')
    {
        $db = \Config\Database::connect();

        $builder = $db->table('bills');

        if($type == 'month'){

            $builder->select("
                DATE_FORMAT(created_at,'%Y-%m') as period,
                SUM(room_charges) room_charges,
                SUM(doctor_fees) doctor_fees,
                SUM(medicine_charges) medicine_charges,
                SUM(test_charges) test_charges,
                SUM(surgery_charges) surgery_charges,
                SUM(anaesthesia_charges) anaesthesia_charges,
                SUM(ot_charges) ot_charges,
                SUM(nursing_charges) nursing_charges,
                SUM(assistance_charges) assistance_charges,
                SUM(other_charges) other_charges,
                SUM(net_amount) total
            ");

            $builder->groupBy("DATE_FORMAT(created_at,'%Y-%m')");

        }elseif($type == 'year'){

            $builder->select("
                YEAR(created_at) as period,
                SUM(room_charges) room_charges,
                SUM(doctor_fees) doctor_fees,
                SUM(medicine_charges) medicine_charges,
                SUM(test_charges) test_charges,
                SUM(surgery_charges) surgery_charges,
                SUM(anaesthesia_charges) anaesthesia_charges,
                SUM(ot_charges) ot_charges,
                SUM(nursing_charges) nursing_charges,
                SUM(assistance_charges) assistance_charges,
                SUM(other_charges) other_charges,
                SUM(net_amount) total
            ");

            $builder->groupBy("YEAR(created_at)");

        }else{

            $builder->select("
                DATE(created_at) as period,
                SUM(room_charges) room_charges,
                SUM(doctor_fees) doctor_fees,
                SUM(medicine_charges) medicine_charges,
                SUM(test_charges) test_charges,
                SUM(surgery_charges) surgery_charges,
                SUM(anaesthesia_charges) anaesthesia_charges,
                SUM(ot_charges) ot_charges,
                SUM(nursing_charges) nursing_charges,
                SUM(assistance_charges) assistance_charges,
                SUM(other_charges) other_charges,
                SUM(net_amount) total
            ");

            $builder->groupBy("DATE(created_at)");
        }

        $builder->orderBy('period','DESC');

        return $builder->get()->getResultArray();
    }

    public function index()
    {
        $type = $this->request->getGet('type') ?? 'day';

        return view('admin/collection/index',[
            'rows' => $this->getReportData($type),
            'type' => $type
        ]);
    }

    public function excel()
    {
        $type = $this->request->getGet('type') ?? 'day';
        $rows = $this->getReportData($type);

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=collection-$type-report.xls");

        echo strtoupper($type)." WISE COLLECTION REPORT\n\n";

        echo "Period\tRoom\tDoctor\tMedicine\tTest\tSurgery\tAnaesthesia\tOT\tNursing\tAssistant\tOther\tTotal\n";

        foreach($rows as $r){
            echo $r['period']."\t".$r['room_charges']."\t".$r['doctor_fees']."\t".$r['medicine_charges']."\t".$r['test_charges']."\t".$r['surgery_charges']."\t".$r['anaesthesia_charges']."\t".$r['ot_charges']."\t".$r['nursing_charges']."\t".$r['assistance_charges']."\t".$r['other_charges']."\t".$r['total']."\n";
        }

        exit;
    }

 public function pdf()
{
    $type = $this->request->getGet('type') ?? 'day';
    $rows = $this->getReportData($type);

    $settings = [
        'site_name' => 'Nursing Home'
    ];

    $html = view('admin/collection/pdf',[
        'rows' => $rows,
        'type' => $type,
        'settings' => $settings
    ]);

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4','landscape');
    $dompdf->render();
    $dompdf->stream("collection-$type-report.pdf",["Attachment"=>true]);
}

}
