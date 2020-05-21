<?php
return [
  'master' => env('IOT_BOT_MASTER_QQ'),
  'white_group'=> explode(',', env('IOT_BOT_WHITE_GROUP')),
  'robot_qq' => env('IOT_BOT_REBOT_QQ'),
  'news_group' => env('IOT_BOT_NEWS_GROUP'),
  'bili_up_id' => env('IOT_BOT_BILI_UP_ID'),
  'bili_up_qq' => env('IOT_BOT_BILI_UP_QQ'),
  'auth' => [
    'user' => env('IOT_BOT_AUTH_USER') ?? null,
    'pwd' => env('IOT_BOT_AUTH_PWD') ?? null,
  ]
];
