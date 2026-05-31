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

    private function successResponse($params)
    {
        $data = $params['data'] ?? [];
        $message = $data['message'] ?? trans('alerts.action_success');
        $notification = $this->notification($data, 'sweet', 'toastr', 'tost');
        return Response::json([
            'type' => 'success',
            'success' => true,
            'sweet' => $notification === 'sweet',
            'tost' => $notification === 'tost',
            'toastr' => $notification === 'toastr',
            'reload' => $data['reload'] ?? false,
            'reload_table' => $data['reload_table'] ?? false,
            'message' => $message,
            'data' => $data,
        ]);
    }

    private function errorResponse($params)
    {
        $data = $params['data'] ?? [];
        $message = $data['message'] ?? trans('alerts.went_wrong');
        $notification = $this->notification($data, 'tost', 'toastr', 'sweet');
        return Response::json([
            'type' => 'error',
            'success' => false,
            'error' => true,
            'sweet' => $notification === 'sweet',
            'tost' => $notification === 'tost',
            'toastr' => $notification === 'toastr',
            'reload' => $data['reload'] ?? false,
            'reload_table' => $data['reload_table'] ?? false,
            'message' => $message,
            'data' => $data
        ]);
    }

    private function warningResponse($params)
    {
        $data = $params['data'] ?? [];
        $message = $data['message'] ?? trans('alerts.went_wrong');
        $notification = $this->notification($data, 'tost', 'toastr', 'sweet');
        return Response::json([
            'type' => 'warning',
            'success' => true,
            'warning' => true,
            'sweet' => $notification === 'sweet',
            'tost' => $notification === 'tost',
            'toastr' => $notification === 'toastr',
            'reload' => $data['reload'] ?? false,
            'reload_table' => $data['reload_table'] ?? false,
            'message' => $message,
            'data' => $data
        ]);
    }

    private function noUpdateResponse($params)
    {
        $data = $params['data'] ?? [];
        $message = $data['message'] ?? trans('alerts.went_wrong');
        $notification = $this->notification($data, 'tost', 'toastr', 'sweet');
        return Response::json([
            'type' => 'noUpdate',
            'success' => true,
            'noUpdate' => true,
            'sweet' => $notification === 'sweet',
            'tost' => $notification === 'tost',
            'toastr' => $notification === 'toastr',
            'reload' => $data['reload'] ?? false,
            'reload_table' => $data['reload_table'] ?? false,
            'message' => $message,
            'data' => $data
        ]);
    }

    private function wrongResponse($params)
    {
        $data = $params['data'] ?? [];
        $message = $data['message'] ?? trans('alerts.went_wrong');
        $notification = $this->notification($data, 'tost', 'toastr', 'sweet');
        return Response::json([
            'type' => 'wrong',
            'success' => false,
            'wrong' => true,
            'sweet' => $notification === 'sweet',
            'tost' => $notification === 'tost',
            'toastr' => $notification === 'toastr',
            'reload' => $data['reload'] ?? false,
            'reload_table' => $data['reload_table'] ?? false,
            'message' => $message,
            'data' => $data
        ]);
    }

    private function bigErrorsResponse($params)
    {
        $data = $params['data'] ?? [];
        $errors = $data['errors'] ?? [];
        return Response::json([
            'type' => 'bigError',
            'success' => false,
            'bigError' => true,
            'errors' => $errors,
            'data' => $data,
        ]);
    }

    private function noDataResponse($params)
    {
        $image = $params['image'] ?? url(config('meta.no_data'));
        $message = $params['message'] ?? trans('errors.no_history');
        $btn =
            '<button data-prop=' .
            json_encode(['page' => 'addPage', 'server' => 'no']) .
            " class='viewAction rounded-md bg-blue-500 px-3 py-1 text-xs text-white hover:bg-blue-600'>
                <i class='fa fa-plus'></i>
                <span class='ml-1'>" .
            __('buttons.add') .
            '</span></button>';
        $button = $params['button'] ?? $btn;
        return view('common.view.no_data_found', ['image' => $image, 'message' => $message, 'button' => $button]);
    }

    private function validationResponse($params)
    {
        $data = $params['data'] ?? [];
        $message = $data['message'] ?? trans('alerts.failed');
        $errors = $data['errors'] ?? [];
        return Response::json([
            'type' => 'validation',
            'success' => false,
            'error' => true,
            'tost' => true,
            'message' => $message,
            'errors' => $errors,
            'data' => $data
        ]);
    }

    private function loadHtmlResponse($params)
    {
        $data = $params['data'] ?? [];
        $view = $data['view'] ?? 'Not Reached';
        $message = $data['message'] ?? trans('alerts.went_wrong');
        $notification = $this->notification($data, 'sweet', 'toastr', 'tost');
        return Response::json([
            'type' => 'load_view',
            'success' => true,
            'sweet' => $notification === 'sweet',
            'tost' => $notification === 'tost',
            'toastr' => $notification === 'toastr',
            'reload' => $data['reload'] ?? false,
            'reload_table' => $data['reload_table'] ?? false,
            'message' => $message,
            'view' => $view,
            'data' => $data
        ]);
    }

    private function noResponse()
    {
        return Response::json([
            'type' => 'noResponse',
            'success' => false,
            'error' => true,
            'sweet' => true,
            'message' => '<span class="text-sm text-green-400">' . trans('alerts.no_message_return') . '</span>',
        ]);
    }

    private function notification($data, $n1, $n2, $default)
    {
        $notification = match (true) {
            !empty($data[$n1]) => $n1,
            !empty($data[$n2]) => $n2,
            default => $default,
        };

        return $notification;
    }
}
