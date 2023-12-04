<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $transactionsCount = Payment::count();
        $userCount = User::count();
        $productCount = Product::count();
        $totalGrossAmount = Payment::sum('gross_amount');
        return view('admin.dashboard', compact('totalGrossAmount', 'userCount', 'productCount', 'transactionsCount'));
    }
}
