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
    protected $mails_object;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->mails_object = new mails();
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
            $send_mail_list = $this->mails_object->showSendMails();
            if($send_mail_list){
                foreach($send_mail_list as $data){
                    $to_view = array('bodyMessage' => $data->message);
                    email::send('emails.basicMessage',$to_view,function($message)use($data){
                        $message->from($data->email,'Bladimir Arroyo');
                        $message->to($data->to)
                            ->subject($data->subject);
                    });
                    $this->mails_object->changeState($data->id);
                }
            }
        }catch (Exception $e){
           $this->error($e->getMessage());
        }
    }
    #endregion
}
