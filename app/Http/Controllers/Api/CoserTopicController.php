<?php

namespace App\Http\Controllers\Api;

use App\CoserTopic;
use App\CoserImg;
use App\Http\Resources\CoserImgResource;
use Illuminate\Http\Request;
use App\Http\Resources\CoserTopicResource;
use Spatie\QueryBuilder\QueryBuilder;

class CoserTopicController extends Controller
{
    public function index(Request $request, CoserTopic $topic)
    {
        $query = $topic->query();

        if ($coser_category_id = $request->coser_category_id) {
            $query->where('coser_category_id', $coser_category_id);
        }

        $topics = QueryBuilder::for($query)
            ->allowedIncludes('category')
            ->paginate(12);

        return CoserTopicResource::collection($topics);
    }

    public function show(Request $request, CoserImg $img)
    {
        return CoserImgResource::collection($img->where('coser_topic_id', $request->coser_topic)->get());
    }
}
