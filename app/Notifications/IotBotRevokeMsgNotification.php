<?php
/*
 * @Author: Yunli
 * @Date: 2020-05-16 15:37:04
 * @LastEditTime: 2020-05-16 15:42:48
 * @LastEditors: Please set LastEditors
 * @Description: IotBotRevokeMsgNotification
 */ 

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Channels\IotBotRevokeMsgChannel;
use Illuminate\Notifications\Notification;

class IotBotRevokeMsgNotification extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct($message)
  {
    $this->message = $message;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function via($notifiable)
  {
    return [IotBotRevokeMsgChannel::class];
  }

  /**
   * Get the mail representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toIotBotRevokeMsg($notifiable)
  {
    return $this->message;
  }

  /**
   * Get the array representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function toArray($notifiable)
  {
    return [
      //
    ];
  }
}
