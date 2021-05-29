<?php

namespace App\Console\Commands;

use App\Mail\NotifyEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class noty extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'not:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //$user = User::select('email')->get();
        $emails = User::pluck('email')->toArray();

        $data=['title'=>'Programing', 'body'=>'php'];

        foreach ($emails as $email){
            //how to send emails in laravel
            Mail::To($email)->send(new NotifyEmail($data));
        }
    }
}