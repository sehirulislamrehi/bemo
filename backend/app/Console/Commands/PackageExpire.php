<?php

namespace App\Console\Commands;

use App\Models\UserModule\VisitorPackage;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PackageExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Package Expire';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $visitor_packages = VisitorPackage::where("expiry_date","<",Carbon::now()->toDateString())->get();

        foreach( $visitor_packages as $visitor_package ){
            $visitor_package->status = "Expired";
            $visitor_package->save();
        }
    }
}
