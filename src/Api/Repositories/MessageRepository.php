<?php

/**
 * Created by PhpStorm.
 * User: HeYuanJun
 * Date: 2021/1/11
 * Time: 5:59 下午
 */

namespace Blog\Api\Repositories;

use Blog\Api\Models\LeaveMessage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Blog\Common\Repositories\Repository;

class MessageRepository extends Repository
{
    public function messages()
    {
        return $this->getSearchAbleData(LeaveMessage::class, ['title'],
            function (Builder $builder) {
        });
    }

    public function leaveMessage($params)
    {
        $data['id'] = '';
        $data['name'] = Arr::get($params, 'token');
        $data['username'] = Arr::get($params, 'token');
        $data['Imgsrc'] = $this->getRandImg();
        $data['value'] = Arr::get($params, 'value');
        $data['date'] = date('Y-m-d');

        return LeaveMessage::updateOrCreate([
            'id' => $data['id']
        ], $data);

    }

    public function getRandImg()
    {
        $randNum = mt_rand(1, 10);

        $url = '';
        switch ($randNum) {
            case 1:
                $url = 'https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=1071334779,862940228&fm=26&gp=0.jpg';
                break;
            case 2:
                $url = 'https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=251289958,1860898046&fm=26&gp=0.jpg';
                break;
            case 3:
                $url = 'https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=2871119264,233376496&fm=26&gp=0.jpg';
                break;
            case 4:
                $url = 'https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=3582194852,1481557220&fm=26&gp=0.jpg';
                break;
            case 5:
                $url = 'https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=2271550032,3475765659&fm=26&gp=0.jpg';
                break;
            case 6:
                $url = 'https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=2344451607,2404623174&fm=11&gp=0.jpg';
                break;
            case 7:
                $url = 'https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=1427449583,2042113504&fm=26&gp=0.jpg';
                break;
            case 8:
                $url = 'https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=3757239321,1175359126&fm=26&gp=0.jpg';
                break;
            case 9:
                $url = 'https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=2715272079,1912335992&fm=11&gp=0.jpg';
                break;
            case 10:
                $url = 'https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=3114108387,3095593137&fm=26&gp=0.jpg';
                break;
        }

        return $url;
    }

}
