<?php
return [
  'master' => env('IOT_BOT_MASTER_QQ'),
  'white_group'=> explode(',', env('IOT_BOT_WHITE_GROUP')),
  'robot_qq' => env('IOT_BOT_REBOT_QQ'),
  'news_group' => env('IOT_BOT_NEWS_GROUP')
];