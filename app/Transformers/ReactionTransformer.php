<?php

namespace App\Transformers;

use App\Board;
use App\Post;
use App\User;
use Auth;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;
use League\Fractal\TransformerAbstract;

class ReactionTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include.
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    private function getReactions($model)
    {
        $user = \Auth::user();
        $reacter = $user->viaLoveReacter();

        $reactant = $model->viaLoveReactant();

        $reactedby = $reactant->isReactedBy($user);

        $totals = $reactant->getReactionTotal();
        $counters = $reactant->getReactionCounters();
        $types = ReactionType::all()->pluck('mass', 'name')->toArray();

        $responce = [
            'totals' => [
                'reacted' => $reactedby ? true : false,
                'count' => $totals->getCount(),
                'weight' => $totals->getWeight(),
            ],
            'items' => [],
            'meta' => [
                'types' => $types,
            ],
        ];

        foreach ($counters as $reaction) {
            $name = $reaction->getReactionType()->name;
            $reacted = $reacter->hasReactedTo($model, $name);
            $count = $reaction->count;
            $weight = $reaction->weight;
            $mass = $reaction->getReactionType()->mass;

            $responce['items'][$name] = [
                'name' => (string) $name,
                'reacted' => (bool) $reacted,
                'type' => (int) $reaction->reaction_type_id,
                'count' => (int) $count,
                'weight' => (float) $weight,
                'mass' => (float) $mass,
            ];
        }

        return $responce;
    }

    /*
     //GET ALL USERS WHO REACTED TO THIS POST
     $users = [];
     foreach ($reactions as $reaction) {
         $u = $reaction->getReacter()->getReacterable();
         $users[] = $u;
     }
     */

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($model)
    {
        $reactions = $this->getReactions($model);

        return  $reactions;
    }
}
