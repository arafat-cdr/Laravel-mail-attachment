<?php

namespace App\Http\Controllers;

use App\Assessment;
use App\EmailList;
use App\EmailShortCodes;
use App\EmailTemplate;
use App\Models\EmailSetting;
use App\TimeZone;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Mail\Markdown;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Webklex\IMAP\Client;

class ArafatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('arafat');
    }

    public function test_mail(Request $request) {

        $email_setting  =  EmailSetting::where('from_address','=',$request->from_setting)->first();

        #dd($request);

        #save the email list 

        #$emails_to = $request->to;

        #$this->_saveEmailList($emails_to);

        #sending The mail 
        
        $this->_emailSettingWithSendMAil($request, $email_setting);
    }


    private function _emailSettingWithSendMAil( $request, $email_setting) {

       config( ['mail' => ['from' => ['address' => @$email_setting->from_address, 'name' => @$email_setting->from_name],
           'driver'=>@$email_setting->mail_driver,
           'host'=>@$email_setting->mail_host ,
           'port'=>@$email_setting->mail_port ,
           'encryption'=>null ,
           'username'=>@$email_setting->mail_username ,
           'password'=>@$email_setting->mail_password ,
       ] ] );

      $res =  Mail::send([], [], function($message) use ($request)
       {
        #$files = $request->file('file')[0]->getRealPath();
        #$files = $request->file('file')[0]->getRealPath();
        /*$files = $request->file('file');
        $paths = array();
        foreach ($files as $file) {
            
            $paths[] = $file->getRealPath();
        }

        dd($paths);*/
           
           $message->to($request->to)
                   ->subject($request->subject)
                   ->setBody($request->email_body, 'text/html');
            if($request->file('file')) {
            foreach ($request->file('file') as $file) {

              $message->attach($file->getRealPath(), array(
                        'as' => $file->getClientOriginalName(),      
                        'mime' => $file->getMimeType())
                              );
            } 
          }
        }, true);

      var_dump($res);

    }

}
