<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail as mails;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send all mails from specfic user';

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
     * @return mixed
     */
    public function handle()
    {
        $mails_object = new mails();
        $send_mail_list = $mails_object->showSendMailsToSend();//carga los datos de la db

        if($send_mail_list !=null){
            foreach($send_mail_list as $data){
                $mails_object->sendEmail($data);
                $mails_object->changeState($data->id);//cambia los estados de los correosss
            }
        }else{
            $this->error('You dont have mails to send');
        }
    }
}
