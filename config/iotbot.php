<?php

return [
  'master' => explode(',', env('IOT_BOT_MASTER_QQ')),
  'white_group' => explode(',', env('IOT_BOT_WHITE_GROUP')),
  'github_group' => env('IOT_BOT_NEWS_GROUP'),
  'robot_qq' => env('IOT_BOT_REBOT_QQ'),
  'news_group' => env('IOT_BOT_NEWS_GROUP'),
  'bili_up_id' => env('IOT_BOT_BILI_UP_ID'),
  'bili_up_qq' => env('IOT_BOT_BILI_UP_QQ'),
  'auth' => [
    'user' => env('IOT_BOT_AUTH_USER') ?? null,
    'pwd' => env('IOT_BOT_AUTH_PWD') ?? null,
  ],
  'suoim_key' => env('IOT_BOT_SUOIM_KEY'),
  'shell' => [
    'iot_stop' => env('IOT_BOT_SHELL_IOT_STOP'),
    'iot_start' => env('IOT_BOT_SHELL_IOT_START'),
    'supervisorctl' => env('IOT_BOT_SHELL_SUPERVISORCTL'),
  ],
  'local_img_path' => env('IOT_BOT_LOCAL_IMG_PATH'),
  'web_custom_img_path' => env('IOT_BOT_WEB_CUSTOM_IMG_PATH'),
];
