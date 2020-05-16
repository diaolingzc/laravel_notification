<?php

namespace App\Http\Requests\Api;
use Illuminate\Http\Request;

class IotBotRequest extends FormRequest
{

    protected $friendMsgRules = [
      'Content' => 'required|String',
      'FromUin' => 'required|integer',
      'MsgSeq' => 'required|integer',
      'MsgType' => 'required|String',
      'ToUin' => 'required|integer',
    ];

    protected $groupMsgRules = [
      'Content' => 'required|String',
      'FromGroupId' => 'required|integer',
      'FromGroupName' => 'required|String',
      'FromNickName' => 'required|String',
      'FromUserId' => 'required|integer',
      'MsgRandom' => 'required|integer',
      'MsgSeq' => 'required|integer',
      'MsgTime' => 'required|integer',
      'MsgType' => 'required|String',
    ];
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = $this->friendMsgRules;

        if ($request->type === 'group') {
          $rules = $this->groupMsgRules;
        }
        return $rules;
    }
}