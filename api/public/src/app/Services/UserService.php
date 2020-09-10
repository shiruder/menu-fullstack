<?php

namespace App\Services;

class UserService
{
    protected $modelUser;

    public function __construct($modelUser)
    {
        $this->modelUser = $modelUser;
    }

    public function getOne($id)
    {
        return $this->modelUser->find((int) $id);
    }

    public function getAll()
    {
        return $this->modelUser->all();
    }

    function save($user)
    {
        return $this->modelUser->insertGetId($user);
    }

    function update($id, $user)
    {   
        if ($return = $this->modelUser->find((int) $id)) {
            return $return->update($user);
        }

        return false;
    }

    function delete($id)
    {   
        return $this->modelUser->destroy($id);
    }
}
