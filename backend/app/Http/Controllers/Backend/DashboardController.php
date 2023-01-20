<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductModule\Product;
use App\Models\Reports\History;
use App\Models\Reports\SmsHistory;
use App\Models\Reports\Transaction;
use App\Models\SystemDataModule\Blog;
use App\Models\UserModule\Package;
use App\Models\UserModule\PackageTransaction;
use App\Models\UserModule\Visitor;
use App\Models\UserModule\VisitorPackage;
use App\Models\UserModule\VisitorType;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if( auth('super_admin')->check() || auth('web')->check() ){
            return view('backend.dashboard');
        }else{
            return view("errors.404");
        }
    }

}