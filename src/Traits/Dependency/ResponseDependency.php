<?php

namespace Orian\Framework\Traits\Dependency;

use Response;

trait ResponseDependency
{
    public function logRequest($type = 'POST')
    {
        switch ($type) {
            case 'FILE':
                print_r($_FILES);
                break;
            case 'GET':
                print_r($_GET);
                break;
            default:
                print_r($_POST);
                break;
        }
        die();
    }

    public function response($params = [])
    {
        if (isset($params['type'])) {
            switch ($params['type']) {
                case 'noUpdate':
                    return $this->noUpdate($params);
                    break;
                case 'wrong':
                    return $this->wentWrong($params);
                    break;
                case 'success':
                    return $this->success($params);
                    break;
                case 'bigError':
                    return $this->bigErrors($params);
                    break;
                case 'noData':
                    return $this->noData($params);
                    break;
                case 'validation':
                    return $this->validation($params);
                    break;
                case 'load_html':
                    return $this->loadHtml($params);
                    break;

                default:
                    return $this->noResponse();
                    break;
            }
        } else {
            return $this->noResponse();
        }
    }

    protected function noResponse()
    {
        return Response::json([
            'success' => false,
            'noUpdate' => true,
            'title' => '<span class="text-sm text-green-400">' . trans('common.errors.no_message_return') . '</span>',
            'content' => '',
            'mobMgs' => 'No Response Defined',
            'mobDes' => ''
        ]);
    }

    protected function noUpdate($params)
    {
        $title = isset($params['title']) ? $params['title'] : '';
        $content = isset($params['content']) ? $params['content'] : '';
        return Response::json([
            'success' => false,
            'noUpdate' => true,
            'title' => '<span class="text-sm text-red-600">' . $title . '</span>',
            'content' => '<span class="text-sm text-red-600">' . $content . '</span>',
            'mobMgs' => strip_tags($title),
            'mobDes' => strip_tags($content),
            'data' => isset($params['data']) ? collect($params['data']) : null
        ]);
    }

    protected function success($params)
    {
        return Response::json([
            'success' => true,
            'data' => (isset($params['data'])) ? $params['data'] : []
        ]);
    }

    protected function validation($params)
    {
        return Response::json([
            'success' => false,
            'errors' => (isset($params['errors'])) ? $params['errors'] : []
        ]);
    }

    protected function wentWrong($params)
    {
        $lang = (isset($params['lang'])) ? trans('common.errors.' . $params['lang']) : trans('common.errors.went_wrong');
        return Response::json([
            'success' => false,
            'noUpdate' => true,
            'title' => '<span class="text-sm text-red-600">' . $lang . '</span>',
            'content' => '',
            'mobMgs' => $lang,
            'mobDes' => ''
        ]);
    }

    protected function bigErrors($params)
    {
        return Response::json([
            'success' => false,
            'bigError' => true,
            'bigErrors' => (isset($params['errors'])) ? $params['errors'] : [],
        ]);
    }

    protected function noData($params)
    {
        $image = (isset($params['image'])) ? $params['image'] : 'no';
        $title = (isset($params['title'])) ? $params['title'] : '';
        $message = (isset($params['message'])) ? $params['message'] : '';
        $url = (isset($params['url'])) ? $params['url'] : 'no';
        $btn_text = (isset($params['btn_text'])) ? $params['btn_text'] : '';
        return view(
            'common.view.no_data_found',
            [
                'image' => $image,
                'title' => $title,
                'message' => $message,
                'url' => $url,
                'btn_text' => $btn_text
            ]
        );
    }

    protected function loadHtml($params)
    {
        return Response::json([
            'success' => true,
            'data' => isset($params['data']) ? collect($params['data']) : []
        ]);
    }
}
