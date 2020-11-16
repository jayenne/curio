<?php

namespace App\Traits;

use App\Board;
use App\User;
use Auth;
use Illuminate\Support\Str;

trait CanViewModelByStatusTrait
{
    /**
     * Abort call if zero result returned.
     *
     * @param  array $model
     * @return \Illuminate\Http\Response
     */
    protected function canViewByStatus($model)
    {
        $this->error_code = null;
        if ($model === null) {
            return $this->error_code;
        }
        // get owner/author
        $auth = Auth::user();
        $user = User::find($model->user_id);

        foreach ($model->statuses as $key => $val) {
            switch ($val) {
                case 'private': $auth->id != $user->id ? $this->error_code = 403 : $this->error_code = 200;
                    break;
                case 'subscriber': ! $model->isSubscribedBy($auth) ? $this->error_code = 426 : $this->error_code = 200;
                    break;
                case 'followback': ! $user->areFollowingEachOther($auth) ? $this->error_code = 412 : $this->error_code = 200;
                    break;
                case 'follower': ! $auth->isFollowing($user) ? $this->error_code = 412 : $this->error_code = 200;
                    break;
                case 'following': ! $user->isFollowedBy($auth) ? $this->error_code = 412 : $this->error_code = 200;
                    break;
                case 'public': $this->error_code = 200;
                    break;
                default: $this->error_code = 404;
            }
        }

        return $this->error_code;
    }
}
