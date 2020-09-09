<?php

namespace App\Services;

class OrderService
{
    protected $modelOrder;

    public function __construct($modelOrder)
    {
        $this->modelOrder = $modelOrder;
    }

    public function getOne($id)
    {
        return $this->modelOrder->find((int) $id);
    }

    public function getAll()
    {
        return $this->modelOrder->all();
    }

    function save($order)
    {
        return $this->modelOrder->insertGetId($order);
    }

    function update($id, $order)
    {   
        if ($return = $this->modelOrder->find((int) $id)) {
            return $return->update($order);
        }

        return false;
    }

    function delete($id)
    {   
        return $this->modelOrder->destroy($id);
    }

}
