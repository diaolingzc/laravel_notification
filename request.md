## 群发消息

POST http://{{host}}/api/v1/iot/callback/group

```json
{
    "FromGroupId": 994971017,
    "FromGroupName": "叆华",
    "FromUserId": 962130950,
    "FromNickName": "娑娜酱",
    "MsgType": "TextMsg",
    "Content": "cos",
    "MsgSeq": 968,
    "MsgTime": 1589619964,
    "MsgRandom": 1797968256
}
```

## 单发消息

POST http://{{host}}/api/v1/iot/callback/friend

```json
{
  "FromUin": 962130950,
  "ToUin": 2030907791,
  "MsgType": "TextMsg",
  "Content": "setu",
  "MsgSeq": 968
}
```