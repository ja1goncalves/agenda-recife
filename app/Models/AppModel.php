<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppModel extends Model
{
    use SoftDeletes;

    public function lisAll($limit = 10)
    {
        return self::where('id', '<>', 1)->orderBy('created_at')->paginate($limit);
    }

    public function getById(int $id)
    {
        return self::find($id);
    }

    public function add(Array $data)
    {
        return self::create($data);
    }

    public function edit($id, $data)
    {
        $user = $this->getById($id);
        foreach($data as $key => $linha):
            $user->{$key} = $linha;
        endforeach;
        return $user->save();
    }

    public function remove($id)
    {
        $user = $this->getById($id);
        return $user->delete();
    }
}
