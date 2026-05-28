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
                case 'success':
                    return $this->successResponse($params);
                case 'error':
                    return $this->errorResponse($params);
                case 'warning':
                    return $this->warningResponse($params);
                case 'noUpdate':
                    return $this->noUpdateResponse($params);
                case 'wrong':
                    return $this->wrongResponse($params);
                case 'bigErrors':
                    return $this->bigErrorsResponse($params);
                case 'noData':
                    return $this->noDataResponse($params);
                case 'validation':
                    return $this->validationResponse($params);
                case 'load_html':
                    return $this->loadHtmlResponse($params);
                default:
                    return $this->noResponse();
            }
        } else {
            return $this->noResponse();
        }
    }
    protected function successResponse($params)
    {
        $data = $params['data'] ?? [];
        $message = $data['message'] ?? trans('alerts.action_success');
        $sweet = $data['sweet'] ?? false;
        $tost = $data['tost'] ?? true;
        $toastr = $data['toastr'] ?? false;
        // Only one can be true
        if ($tost) {
            $sweet = false;
            $toastr = false;
        }
        if ($sweet) {
            $tost = false;
            $toastr = false;
        }
        if ($toastr) {
            $sweet = false;
            $tost = false;
        }
        return Response::json([
            'type' => 'success',
            'success' => true,
            'sweet' => $sweet,
            'tost' => $tost,
            'toastr' => $toastr,
            'reload' => $data['reload'] ?? false,
            'reload_table' => $data['reload_table'] ?? false,
            'message' => $message,
            'data' => $data,
        ]);
    }
    protected function errorResponse($params)
    {
        $data = $params['data'] ?? [];
        $message = $data['message'] ?? trans('alerts.went_wrong');
        $sweet = $data['sweet'] ?? true;
        $tost = $data['tost'] ?? false;
        $toastr = $data['toastr'] ?? false;
        // Only one can be true
        if ($sweet) {
            $tost = false;
            $toastr = false;
        }
        if ($tost) {
            $sweet = false;
            $toastr = false;
        }
        if ($toastr) {
            $sweet = false;
            $tost = false;
        }
        return Response::json([
            'type' => 'error',
            'error' => true,
            'sweet' => $sweet,
            'tost' => $tost,
            'toastr' => $toastr,
            'reload' => $data['reload'] ?? false,
            'reload_table' => $data['reload_table'] ?? false,
            'message' => $message,
            'data' => $data
        ]);
    }
    protected function warningResponse($params)
    {
        $data = $params['data'] ?? [];
        $message = $data['message'] ?? trans('alerts.went_wrong');
        $sweet = $data['sweet'] ?? true;
        $tost = $data['tost'] ?? false;
        $toastr = $data['toastr'] ?? false;
        // Only one can be true
        if ($sweet) {
            $tost = false;
            $toastr = false;
        }
        if ($tost) {
            $sweet = false;
            $toastr = false;
        }
        if ($toastr) {
            $sweet = false;
            $tost = false;
        }
        return Response::json([
            'type' => 'warning',
            'warning' => true,
            'sweet' => $sweet,
            'tost' => $tost,
            'toastr' => $toastr,
            'reload' => $data['reload'] ?? false,
            'reload_table' => $data['reload_table'] ?? false,
            'message' => $message,
            'data' => $data ?? []
        ]);
    }

    protected function noUpdateResponse($params)
    {
        $data = $params['data'] ?? [];
        $message = $data['message'] ?? trans('alerts.went_wrong');
        $sweet = $data['sweet'] ?? true;
        $tost = $data['tost'] ?? false;
        $toastr = $data['toastr'] ?? false;
        // Only one can be true
        if ($sweet) {
            $tost = false;
            $toastr = false;
        }
        if ($tost) {
            $sweet = false;
            $toastr = false;
        }
        if ($toastr) {
            $sweet = false;
            $tost = false;
        }
        return Response::json([
            'type' => 'noUpdate',
            'noUpdate' => true,
            'sweet' => $sweet,
            'tost' => $tost,
            'toastr' => $toastr,
            'reload' => $data['reload'] ?? false,
            'reload_table' => $data['reload_table'] ?? false,
            'message' => $message,
            'data' => $data
        ]);
    }

    protected function wrongResponse($params)
    {
        $data = $params['data'] ?? [];
        $message = $data['message'] ?? trans('alerts.went_wrong');
        $sweet = $data['sweet'] ?? true;
        $tost = $data['tost'] ?? false;
        $toastr = $data['toastr'] ?? false;
        // Only one can be true
        if ($sweet) {
            $tost = false;
            $toastr = false;
        }
        if ($tost) {
            $sweet = false;
            $toastr = false;
        }
        if ($toastr) {
            $sweet = false;
            $tost = false;
        }
        return Response::json([
            'type' => 'wrong',
            'wrong' => true,
            'sweet' => $sweet,
            'tost' => $tost,
            'toastr' => $toastr,
            'reload' => $data['reload'] ?? false,
            'reload_table' => $data['reload_table'] ?? false,
            'message' => $message,
            'data' => $data ?? []
        ]);
    }

    protected function bigErrorsResponse($params)
    {
        $data = $params['data'] ?? [];
        $errors = $params['errors'] ?? [];
        return Response::json([
            'type' => 'bigError',
            'bigError' => true,
            'errors' => $errors,
            'data' => $data,
        ]);
    }

    protected function noDataResponse($params)
    {
        $image = $params['image'] ?? url(config("meta.no_data"));
        $message =  $params['message'] ?? trans("errors.no_history");
        $btn =
            "<button data-prop=" .
            json_encode(["page" => "addPage", "server" => "no"]) .
            " class='viewAction rounded-md bg-blue-500 px-3 py-1 text-xs text-white hover:bg-blue-600'>
                <i class='fa fa-plus'></i>
                <span class='ml-1'>" .
            __("buttons.add") .
            "</span></button>";
        $button =  $params['button'] ?? $btn;
        return view('common.view.no_data_found', ['image' => $image, 'message' => $message, 'button' => $button]);
    }

    protected function validationResponse($params)
    {
        $data = $params['data'] ?? [];
        $errors = $data['errors'] ?? [];
        return Response::json([
            'type' => 'validation',
            'error' => true,
            'errors' =>  $errors,
            'data' =>  $data
        ]);
    }

    protected function loadHtmlResponse($params)
    {
        $data = $params['data'] ?? [];
        $view = $data['view'] ?? [];
        return Response::json([
            'type' => 'load_view',
            'success' => true,
            'view' => collect($view),
            'data' => $data
        ]);
    }

    protected function noResponse()
    {
        return Response::json([
            'type' => 'noResponse',
            'error' => true,
            'sweet' => true,
            'message' => '<span class="text-sm text-green-400">' . trans('alerts.no_message_return') . '</span>',
        ]);
    }
}
