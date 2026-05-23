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
                    return $this->noUpdateResponse($params);
                    break;
                case 'wrong':
                    return $this->wentWrongResponse($params);
                    break;
                case 'success':
                    return $this->successResponse($params);
                    break;
                case 'bigError':
                    return $this->bigErrorsResponse($params);
                    break;
                case 'noData':
                    return $this->noDataResponse($params);
                    break;
                case 'validation':
                    return $this->validationResponse($params);
                    break;
                case 'load_html':
                    return $this->loadHtmlResponse($params);
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
            'title' => '<span class="text-sm text-green-400">' . trans('alerts.no_message_return') . '</span>',
            'content' => '',
            'mobMgs' => trans('alerts.no_response_defined'),
            'mobDes' => ''
        ]);
    }

    protected function noUpdateResponse($params)
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

    protected function successResponse($params)
    {
        return Response::json([
            'success' => true,
            'tost' => (isset($params['data']['tost'])) ? $params['data']['tost'] : false,
            'sweet' => (isset($params['data']['sweet'])) ? $params['data']['sweet'] : false,
            'reload' => (isset($params['data']['table_reload'])) ? $params['data']['table_reload'] : false,
            'data' => (isset($params['data'])) ? $params['data'] : []
        ]);
    }

    protected function validationResponse($params)
    {
        return Response::json([
            'success' => false,
            'errors' => (isset($params['errors'])) ? $params['errors'] : []
        ]);
    }

    protected function wentWrongResponse($params)
    {
        $lang = (isset($params['lang'])) ? trans('errors.' . $params['lang']) : trans('alerts.went_wrong');
        return Response::json([
            'success' => false,
            'wrong' => true,
            'title' => '<span class="text-sm text-red-600">' . $lang . '</span>',
            'content' => '',
            'mobMgs' => $lang,
            'mobDes' => ''
        ]);
    }

    protected function bigErrorsResponse($params)
    {
        return Response::json([
            'success' => false,
            'bigError' => true,
            'bigErrors' => (isset($params['errors'])) ? $params['errors'] : [],
        ]);
    }

    protected function noDataResponse($params)
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

    protected function loadHtmlResponse($params)
    {
        return Response::json([
            'success' => true,
            'data' => isset($params['data']) ? collect($params['data']) : []
        ]);
    }
}
