<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class OrderController
{

    protected $orderService;

    public function __construct($service)
    {
        $this->orderService = $service;
    }

    public function getOne($id)
    {
        if (!(int)$id && $id < 1) {
            return new JsonResponse([
                'Message' => sprintf('Paramêtro %s inválido.', $id)
            ], 422);
        }

        $order = $this->orderService->getOne($id);

        if (!$order) {
            return new JsonResponse([
                'Message' => sprintf('Pedido %s não encontrado.', $id)
            ], 404);
        }

        return new JsonResponse($order, 200);
    }

    public function getAll()
    {
        return new JsonResponse(
            $this->orderService->getAll()
        );
    }

    public function save(Request $request)
    {

        if (!isset($this->getDataFromRequest($request)['order'])) {
            return new JsonResponse(
                ['Message' => 'Parâmetros inválidos.'], 
                400
            ); 
        }
        
        return new JsonResponse(
            [
                "id" => $this->orderService->save(
                    $this->getDataFromRequest($request)['order']
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

        if (!isset($this->getDataFromRequest($request)['order'])) {
            return new JsonResponse(
                ['Message' => 'Parâmetros inválidos.'], 
                400
            ); 
        }

        $order = $this->orderService->update(
            $id, $this->getDataFromRequest($request)['order']
        ); 

        if (!$order) {
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

        if (!$this->orderService->delete($id)) {
            return new JsonResponse([
                'Message' => sprintf('Pedido %s não encontrado.', $id)
            ], 404);
        }

        return new JsonResponse(null, 204);
    }

    private function getDataFromRequest(Request $request)
    {
        return $order = [
            'order' => $request->request->get("order")
        ];
    }
}
