<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail as mails;
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
    protected $description = 'This command is to send a email for each person';
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
     $this->sendMails();
    }

    #region Method to send mails
    public function sendMails(){
        try{
            $mails_object = new mails();
            $send_mail_list = $mails_object->showSendMails();
            if($send_mail_list){
                foreach($send_mail_list as$data){
                    $mails_object->sendEmail($data);
                    $mails_object->changeState($data->id);
                }
            }
            $returned= $this->info('All mails have been sent');
        }catch (Exception $e){
            $returned= $this->error($e->getMessage());
        }
        return $returned;
    }
    #endregion
}
