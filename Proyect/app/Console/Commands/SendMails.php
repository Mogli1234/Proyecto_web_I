<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail as mails;
use Auth;
use Symfony\Component\DomCrawler\Tests\Field\InputFormFieldTest;

class SendMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is to send a email for a specific user';
    private $send_mail;
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
        $send_mail_list = $mails_object->showSendMails(Auth::user()->id);
        if(isset($send_mail_list)){
            foreach($send_mail_list as$data){
                $mails_object->sendEmail($data);
                $mails_object->changeState($data->id);
            }
        }else{
            $this->error('You dont have mails to send');
        }
    }
}
