<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UserController
{

    protected $userService;

    public function __construct($service)
    {
        $this->userService = $service;
    }

    public function getOne($id)
    {
        if (!(int)$id && $id < 1) {
            return new JsonResponse([
                'Message' => sprintf('Paramêtro %s inválido.', $id)
            ], 422);
        }

        $user = $this->userService->getOne($id);

        if (!$user) {
            return new JsonResponse([
                'Message' => sprintf('Cliente %s não encontrado.', $id)
            ], 404);
        }

        return new JsonResponse($user, 200);
    }

    public function getAll()
    {
        return new JsonResponse(
            $this->userService->getAll()
        );
    }

    public function save(Request $request)
    {

        if (!isset($this->getDataFromRequest($request)['user'])) {
            return new JsonResponse(
                ['Message' => 'Parâmetros inválidos.'], 
                400
            ); 
        }

        return new JsonResponse(
            [
                "id" => $this->userService->save(
                    $this->getDataFromRequest($request)['user']
                )
            ], 
            201
        );

    }

    public function update(Request $request, $id)
    {    
        if (!(int)$id && $id < 1) {
            return new JsonResponse([
                'Message' => sprintf('Paramêtro %s inválido.', $id)
            ], 422);
        }
        
        if (!isset($this->getDataFromRequest($request)['user'])) {
            return new JsonResponse(
                ['Message' => 'Parâmetros inválidos.'], 
                400
            ); 
        }

        $user = $this->userService->update(
            $id, $this->getDataFromRequest($request)['user']
        ); 

        if (!$user) {
            return new JsonResponse(null, 404);
        }

        return new JsonResponse(null, 200);

    }

    public function delete($id)
    {
        if (!(int)$id && $id < 1) {
            return new JsonResponse([
                'Message' => sprintf('Paramêtro %s inválido.', $id)
            ], 422);
        }

        if (!$this->userService->delete($id)) {
            return new JsonResponse([
                'Message' => sprintf('Cliente %s não encontrado.', $id)
            ], 404);
        }

        return new JsonResponse(null, 204);
    }

    private function getDataFromRequest(Request $request)
    {
        return $user = [
            'user' => $request->request->get("user")
        ];
    }
}
