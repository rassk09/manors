<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\Translation;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Facades\Mail;

class MailSend
{
    // TODO: !!!!!!!!!!!!!
    // TODO: !!!REWRITE!!!
    // TODO: !!!!!!!!!!!!!

    // TODO: !!!!!!!!!!!!!
    // TODO: !!!REWRITE!!!
    // TODO: !!!!!!!!!!!!!

    // TODO: !!!!!!!!!!!!!
    // TODO: !!!REWRITE!!!
    // TODO: !!!!!!!!!!!!!

    public static function mail($type, $userName, $userEmail, Event $event = null, $other = [])
    {
        $keys = Translation::$keys;

        try {
            if ($type != 'registration_letter' and !$event) {
                throw new Exception('event - обязательный параметр');
            }

            switch ($type) {

                case 'registration_letter':
                    $template = 'ori_new_letter_registartion';
                    break;

                case 'first_event_creation_letter':
                    $template = 'ori_new_letter_first_event_creation';
                    break;

                case 'event_public_letter':
                    $template = 'ori_new_letter_event_public';
                    break;

                case 'event_rejected_letter':
                    $template = 'ori_new_letter_event_reject';
                    break;

                case 'event_confirmed_letter':
                    $template = 'ori_new_letter_event_confirm';
                    break;

                case 'event_photo_letter':
                    $template = 'ori_new_letter_event_photos_add';
                    break;

                case 'event_admin_message_letter':
                    $template = 'ori_new_letter_event_admin_message';
                    break;

                case 'event_photo_members_letter':
                    $template = 'ori_new_letter_event_photos_add';
                    break;

                case 'event_delete_members_letter':
                    $template = 'ori_new_letter_event_delete';
                    break;

                case 'event_changed_members_letter':
                    $template = 'ori_new_letter_event_change';
                    break;

                case 'event_tomorrow_remind_members_letter':
                    $template = 'ori_new_letter_event_remind';
                    break;

                case 'event_joined_members_letter':
                    $template = 'ori_new_letter_event_join';
                    break;

                case 'event_share_letter':
                    $template = 'ori_new_letter_event_share';
                    break;

                default:
                    throw new \Exception('Неверное значение параметра type');
                    break;
            }

            if($event) {
                $body = [
                    str_replace([
                        '%EVENT_NAME%',
                        '%EVENT_LINK%',
                        '%EVENT_TYPE%',
                        '%EVENT_DESCRIPTION%',
                        '%EVENT_DATE_FROM%',
                        '%EVENT_DATE_TO%',
                        '%EVENT_ADDRESS%',
                        '%REJECT_REASON%',
                        '%MODERATOR_COMMENT%',
                        '%SHARE_TEXT%'
                    ], [
                        $event->name,
                        route('map_event_page', ['id' => $event->id]),
                        $event->type->lang('name'),
                        $event->description,
                        $event->getOnlyDate() . " " . date('H:i', strtotime($event->date_start)),
                        date('H:i', strtotime($event->date_end)),
                        $event->getAddress(),
                        $event->getRejectReasonWithMessage(),
                        $event->last_message()->message ?? '',
                        $other['%SHARE_TEXT%'] ?? ''
                    ],
                        __k($template))
                ];
            } else {
                $body = [__k($template)];
            }

            if ($userEmail && $userEmail != '-') {
                $result = self::sendMail(
                    $keys,
                    $userEmail,
                    $userName,
                    __k('ori_new_letter_title'),
                    0,
                    __k('ori_letter_hello') . " " . $userName,
                    $body,
                    ($type == 'event_joined_members_letter' or $type == 'event_share_letter') ? 'card' : '',
                    ($type == 'event_joined_members_letter' or $type == 'event_share_letter') ? $event : null
                );
            }

            return true;

        } catch(\Exception $e){
            dd($e);

            return false;
        }

    }

    protected static function sendMail($keys, $email_to, $email_name, $email_subject, $email_template = 0, $title = "", $body = [], $special = "", $event = null)
    {
        $error = '';

        try {
            $result = Mail::to($email_to)->send(new MainTemplate([
                'keys' => $keys,
                'template' => $email_template,
                'title' => $title,
                'body' => $body,
                'special' => $special,
                'event' => $event,
                'subject' => $email_subject,
            ]));
        } catch (\Exception $e){

            $result = null;

            $error = $e->getMessage();
        }

        $log = [
            'email' => $email_to,
            'name' => $email_name,
            'email_subject' => $email_subject,
            'template' => $email_template,
            'title' => $title,
            'body' => $body,
            'special' => $special,
            'event' => $event,
            'error' => $error
        ];

        $logger = new Logger('sendMail');
        $logger->pushHandler(new StreamHandler(storage_path('logs/mailer_log_' . date('Y-m-d') . '.log')));
        $logger->info('mailLog', $log);

        return $result;
    }

    public static function __send($template, $data, $to, $subject, $file=null, $replyTo=null) {
        try {
            Mail::send($template, $data, function ($m) use ($to, $subject, $file, $replyTo) {
                $m->from(config('mail.from.address'), config('mail.from.name'));
                $m->to($to['email'], $to['name'])->subject('=?utf-8?B?' . base64_encode($subject) . '?=');
                if($file){
                    $m->attachData($file['raw'], $file['name'], ['as' => $file['name'], 'mime' => $file['mime']]);
                }
                if($replyTo){
                    $m->replyTo($replyTo['email'], $replyTo['name']);
                }
            });
            return 'SEND via ENV';
        } catch (\Exception $e) {
            dd($e);
            try {
                $mailconfig = new MailConfig;
                $mailconfig->fallback();

                //Rambler Mail stopped loving SendPulse at 08-09.09
                if(strrpos($to['email'],"@rambler") !== false){
                    throw new \Exception("Wake up Neo, Rambler has you", 1);
                }else{
                    Mail::send($template, $data, function ($m) use ($to, $subject, $file, $replyTo) {
                        $m->from(config('mail.from.address'), config('mail.from.name'));
                        $m->to($to['email'], $to['name'])->subject('=?utf-8?B?' . base64_encode($subject) . '?=');
                        if($file){
                            $m->attachData($file['raw'], $file['name'], ['as' => $file['name'], 'mime' => $file['mime']]);
                        }
                        if($replyTo){
                            $m->replyTo($replyTo['email'], $replyTo['name']);
                        }
                    });
                    return 'SEND via SENDPULSE';
                }
            } catch (\Exception $e) {
                $mailconfig = new MailConfig;
                $mailconfig->sendmail();
                Mail::send($template, $data, function ($m) use ($to, $subject, $file, $replyTo) {
                    $m->from(config('mail.from.address'), config('mail.from.name'));
                    $m->to($to['email'], $to['name'])->subject('=?utf-8?B?' . base64_encode($subject) . '?=');
                    if($file){
                        $m->attachData($file['raw'], $file['name'], ['as' => $file['name'], 'mime' => $file['mime']]);
                    }
                    if($replyTo){
                        $m->replyTo($replyTo['email'], $replyTo['name']);
                    }
                });
                return 'SEND via SENDMAIL';
                \Log::error('Email send failed, using sendmail. [' . $to['email'] . ', ' . $subject . ']');
            }
        }
    }

}