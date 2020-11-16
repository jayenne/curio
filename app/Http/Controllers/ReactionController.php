<?php

namespace App\Http\Controllers;

use App\Transformers\ReactionTransformer;
use Auth;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReactionController extends Controller
{
    //
    public function toggle(Request $request)
    {
        $type = (string) ucfirst(strtolower($request['type']));
        $action = (string) $request['action'];

        $modelclass = 'App\\'.$type;
        $id = (int) $request['id'];
        $model = $modelclass::find($id);

        //TOGGLE
        $user = Auth::user();
        $reacterFacade = $user->viaLoveReacter();
        $reactantFacade = $model->viaLoveReactant();
        $reacted = $reactantFacade->isReactedBy($user, $action);

        if ($reacted) {
            $reacterFacade->unreactTo($model, $action);
            $addend = -1;
            $reacted = false;
        } else {
            $reacterFacade->reactTo($model, $action);
            $addend = 1;
            $reacted = true;
        }

        // RETURN
        $resource = \Fractal::create()
        ->collection([$model])
        ->parseIncludes(['reaction'])
        ->transformWith(new ReactionTransformer)
        ->toArray();

        $resource = $resource['data'][0];

        if ($request->ajax()) {
            //if counter doesn't exist yet (never been loved)
            if (! isset($resource['items'][$action])) {
                $reactions = $reactantFacade->getReactions();
                $mass = ReactionType::fromName($action)->getMass();
                foreach ($reactions as $reaction) {
                    $resource['items'][$action] = [
                        'name' => $action,
                        'reacted' => $reacted,
                        'type' => $reaction['reaction_type_id'],
                        'count' => 0,
                        'weight' => 0,
                        'mass' => $mass,
                        //'reactiontypes' => $reactionTypes,
                    ];
                }
            }

            $weight = $addend * $resource['items'][$action]['mass'];

            $resource['items'][$action]['reacted'] = $reacted;
            $resource['items'][$action]['count'] += $addend;
            $resource['items'][$action]['weight'] += $weight;
            $resource['totals']['count'] += $addend;
            $resource['totals']['weight'] += $weight;

            $resource['totals']['reacted'] = false;
            foreach ($resource['items'] as $item) {
                if ($item['reacted'] === true) {
                    $resource['totals']['reacted'] = true;
                    break;
                }
            }
        }

        return $resource;
    }
}
