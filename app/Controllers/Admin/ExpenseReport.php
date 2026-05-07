<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ExpenseModel;

class ExpenseReport extends BaseController
{
    protected $expenseModel;

    public function __construct()
    {
        $this->expenseModel = new ExpenseModel();
    }

    public function index()
    {
        $type = $this->request->getGet('type') ?? 'day';

        $rows = $this->getReportData($type);

        return view('admin/expense_report/index', [
            'rows' => $rows,
            'type' => $type
        ]);
    }

public function excel()
{
    $type = $this->request->getGet('type') ?? 'day';
    $rows = $this->getReportData($type);

    while (ob_get_level()) {
        ob_end_clean();
    }

    header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
    header("Content-Disposition: attachment; filename=expense-report-$type.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo view('admin/expense_report/excel', [
        'rows' => $rows,
        'type' => $type
    ]);

    exit;
}

    public function pdf()
    {
        $type = $this->request->getGet('type') ?? 'day';

        $rows = $this->getReportData($type);

        $html = view('admin/expense_report/pdf', [
            'rows' => $rows,
            'type' => $type
        ]);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("expense-report-$type.pdf", ["Attachment" => true]);
    }

    private function getReportData($type)
    {
        if ($type == 'month') {

            return $this->expenseModel
                ->select("DATE_FORMAT(expense_date,'%Y-%m') as period, SUM(amount) as total")
                ->groupBy("DATE_FORMAT(expense_date,'%Y-%m')")
                ->orderBy('expense_date', 'DESC')
                ->findAll();

        } elseif ($type == 'year') {

            return $this->expenseModel
                ->select("YEAR(expense_date) as period, SUM(amount) as total")
                ->groupBy("YEAR(expense_date)")
                ->orderBy('expense_date', 'DESC')
                ->findAll();

        } else {

            return $this->expenseModel
                ->select("expense_date as period, SUM(amount) as total")
                ->groupBy("expense_date")
                ->orderBy('expense_date', 'DESC')
                ->findAll();
        }
    }
// expense report enhance ke liye function

public function categoryMonth()
{
    $month    = $this->request->getGet('month') ?? date('m');
    $year     = $this->request->getGet('year') ?? date('Y');
    $category = $this->request->getGet('category') ?? '';

    $builder = $this->expenseModel
        ->select("category, SUM(amount) as total")
        ->where('MONTH(expense_date)', $month)
        ->where('YEAR(expense_date)', $year);

    if($category != ''){
        $builder->where('category', $category);
    }

    $rows = $builder
        ->groupBy('category')
        ->findAll();

    $categories = $this->expenseModel
        ->select('category')
        ->groupBy('category')
        ->findAll();

    return view('admin/expense_report/category_month',[
        'rows'=>$rows,
        'month'=>$month,
        'year'=>$year,
        'category'=>$category,
        'categories'=>$categories
    ]);
}

 // category month wise excell aur pdf download function
 public function categoryMonthExcel()
{
    $month = $this->request->getGet('month') ?? date('m');
    $year  = $this->request->getGet('year') ?? date('Y');

    $rows = $this->expenseModel
        ->select("category, SUM(amount) as total")
        ->where('MONTH(expense_date)', $month)
        ->where('YEAR(expense_date)', $year)
        ->groupBy('category')
        ->findAll();

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=category-report.xls");

    echo view('admin/expense_report/category_excel', [
        'rows'=>$rows,
        'month'=>$month,
        'year'=>$year
    ]);
    exit;
}

public function categoryMonthPdf()
{
    $month = $this->request->getGet('month') ?? date('m');
    $year  = $this->request->getGet('year') ?? date('Y');

    $rows = $this->expenseModel
        ->select("category, SUM(amount) as total")
        ->where('MONTH(expense_date)', $month)
        ->where('YEAR(expense_date)', $year)
        ->groupBy('category')
        ->findAll();

    $html = view('admin/expense_report/category_pdf', [
        'rows'=>$rows,
        'month'=>$month,
        'year'=>$year
    ]);

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("category-report.pdf", ["Attachment"=>true]);
}



}