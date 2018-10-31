<?php

namespace App\Http\Controllers;

use App\Channel;
use App\customer;
use App\CustomerImage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Excel;
use function PHPSTORM_META\type;


class CustomerController extends Controller
{
    private $excle;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = customer::all();
//        foreach ($customers as $customer) {
//            if ($customer->image() != null) {
////                dd(gettype($customer->image()));
//            }
//        }
        return view('customer.index', ['customers'=>$customers, 'channels'=>Channel::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customer $customer)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer $customer)
    {
        $customer->delete();
        return view('customer.index', ['customers'=>customer::all(), 'channels'=>Channel::all()]);
    }

    public function search(Request $request) {
        dd($request);
    }

    public function customersExport() {
        return $this->excel->download(new CustomersExport('customers1'), 'customers.xlsx');

//        (new InvoicesExport)->download('invoices.xlsx');
//        Excel::download(new CustomersExport(), 'customers.xlsx');

//        $customers = User::all();
//        Excel::create('customers', function($excel) use($customers) {
//            $excel->sheet('Sheet 1', function($sheet) use($customers) {
//                $sheet->fromArray($customers);
//            });
//        })->export('xls');
    }

    public function apiCustomers(Request $request) {
        $key = $request->get('key');
        $customers = null;
        if ($key != null) {
            $customers = customer::where('name', 'like', '%'.$key.'%')->get();
        } else {
            $customers = customer::all();
        }
        if (count($customers) > 0) {
            return ['success' => true, 'customers' => $customers, 'images'=>CustomerImage::all()];
        } else {
            return ['success' => false];
        }
    }

    public function createcustomer(Request $request) {
//        $customer = new customer();


        $customer = customer::create($this->getRequestArray($request));
        $files = $request->file('image');//$_FILES['image'];
        if (count($files) > 0) {
            $upload = null;
            foreach ($files as $file) {
                $fileName = $file->getClientOriginalName();
//                        dd($file);
                CustomerImage::create([
                    'name' => $fileName,
                    'link' => '/images/customer/'.$fileName,
                    'type' => 0,
                    'order' => 0,
                    'customer_id' => $customer->id,
                ]);
                $this->uploadFile($file, "customer");
            }
//            $upload = $this->uploadfiles($files);
//            if (is_string($upload)) {
//                return ['success' => false, 'error' => $upload];
//            }
        }
        if ($customer != null) {
            return ['success' => true, 'customers' => customer::all(), 'images'=>CustomerImage::all()];
        } else
            return ['success' => false, 'error' => 'no customer found!'];
    }


    public function updatecustomer(Request $request) {
        $getArray = $this->getRequestArray($request);
        $customer = customer::findOrFail($getArray['id']);

        $customer->update($getArray);
        $files = $request->file('image');//$_FILES['image'];
        if (count($files) > 0) {
            $upload = null;
            foreach ($files as $file) {
                $fileName = $file->getClientOriginalName();
//                        dd($file);
                CustomerImage::create([
                    'name' => $fileName,
                    'link' => '/images/customer/'.$fileName,
                    'type' => 0,
                    'order' => 0,
                    'customer_id' => $customer->id,
                ]);
                $this->uploadFile($file, "customer");
            }
//            $upload = $this->uploadfiles($files);
//            if (is_string($upload)) {
//                return ['success' => false, 'error' => $upload];
//            }
        }
        if ($customer != null) {
            return ['success' => true, 'customers' => customer::all(), 'images'=>CustomerImage::all()];
        } else
            return ['success' => false, 'error' => 'no customer found!'];
    }

    private function object_to_array($obj) {
        $obj = (array)$obj;
        foreach ($obj as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $obj[$k] = (array)$this->object_to_array($v);
            }
        }

        return $obj;
    }

    private function getRequestArray($request) {
        foreach($request->request as $key=>$value) {
            $object[$key] = $this->object_array($value);
        }
        return $this->object_to_array(json_decode(json_encode($object)));
    }

    function object_array($array) {
        if(is_object($array)) {
            $array = (array)$array;
        } if(is_array($array)) {
            foreach($array as $key=>$value) {
                $array[$key] = $this->object_array($value);
            }
        }
        return $array;
    }

    function uploadfiles($files, $path="images/customer",
                        $allowExt = array('png','jpg','jpeg','gif','mmp','qnmlgb'),
                        $maxSize=1048576,$imgFlag=true){

        if (! file_exists($path)) {
            mkdir($path,0777,true);
        }
        $i = 0;
//        $infoArr = buildInfo();
        foreach ($this->buildInfo($files) as $val) {
            if ($val['error'] === UPLOAD_ERR_OK) {

                $ext = getExt($val['name']);
                for($j=0;$j<count($allowExt);$j++){
                    if($ext == $allowExt[$j]){
                        $m = "此文件适合上传标准";
                        $h = $m;
                    }else {
                        $m = "此文件不可以被上传";
                    }
                }
                if($h){
                    $mes = "文件格式正确";
                }else{
                    $mes = "文件格式错误";
                    exit;
                }
                if($val['size']>$maxSize){
                    $mes = "文件太大了";
                    exit;
                }
                if($imgFlag){
                    $result = getimagesize($val['tmp_name']);
                    if(!$result){
                        $mes = "您上传的不是一个真正图片";
                        exit;
                    }
                }
                if(!is_uploaded_file($val['tmp_name'])){
                    $mes = "不是通过httppost传输的";
                    exit;
                }

                $realName = getUniName().".".$ext;
                $destination = $path."/".$realName;
                if(move_uploaded_file($val['tmp_name'], $destination)){
                    $val['name'] = $realName;
                    unset($val['error'],$val['tmp_name'],$val['size'],$val['type']);

                    $uploadedFiles[$i]=$val;//?????????
                    $i++;
                }
            }else {
                switch ($val['error']) {
                    case 1: // UPLOAD_ERR_INI_SIZE
                        $mes = "超过配置文件中上传文件的大小";
                        break;
                    case 2: // UPLOAD_ERR_FORM_SIZE
                        $mes = "超过表单中配置文件的大小";
                        break;
                    case 3: // UPLOAD_ERR_PARTIAL
                        $mes = "文件被部分上传";
                        break;
                    case 4: // UPLOAD_ERR_NO_FILE
                        $mes = "没有文件被上传";
                        break;
                    case 6: // UPLOAD_ERR_NO_TMP_DIR
                        $mes = "没有找到临事文件目录";
                        break;
                    case 7: // UPLOAD_ERR_CANT_WRITE
                        $mes = "文件不可写";
                        break;
                    case 8: // UPLOAD_ERR_EXTENSION
                        $mes = "php扩展程序中断了上传程序";
                        break;
                }
                echo $mes;
            }
        }

        return $uploadedFiles;
    }

    function buildInfo($info){
//     $info = $_FILES;
        $i = 0;
        foreach ($_FILES as $v){//三维数组转换成2维数组
            if(is_string($v['name'])){ //单文件上传
                $info[$i] = $v;
                $i++;
            }else{ // 多文件上传
                foreach ($v['name'] as $key=>$val){//2维数组转换成1维数组
                    //取出一维数组的值，然后形成另一个数组
                    //新的数组的结构为：info=>i=>('name','size'.....)
                    $info[$i]['name'] = $v['name'][$key];
                    $info[$i]['size'] = $v['size'][$key];
                    $info[$i]['type'] = $v['type'][$key];
                    $info[$i]['tmp_name'] = $v['tmp_name'][$key];
                    $info[$i]['error'] = $v['error'][$key];
                    $i++;
                }
            }
        }
        return $info;
    }


}

    class CustomersExport implements FromView
    {
        private $customers;

        /**
         * CustomersExport constructor.
         * @param $customers
         */
        public function __construct($customers)
        {
            $this->customers = $customers;
        }


        public function view(): View
        {
            return view('customer.table', [
                'customers' => customer::all()
            ]);
        }
    }