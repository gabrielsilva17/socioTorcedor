<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

abstract class BaseModel extends Model
{
    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'ts_criado';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'ts_atualizado';

    /**
     * The name of the "deleted at" column.
     *
     * @var string
     */
    const DELETED_AT = 'ts_removido';

    public function __construct()
    {
        self::changeKeyName();
    }

    protected function changeKeyName()
    {
        if ($this->primaryKey === 'id') {
            $this->primaryKey = str_replace('tb', 'cd', $this->table);
        }
    }

    public function getKeyName()
    {
        return $this->primaryKey;
    }

    public function find($id = null)
    {
        return parent::find($id);
    }

    public function populate($data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
        return $this;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExcept($query, $id)
    {
        return $query->where($this->getKeyName(), '!=', $id);
    }

    public function scopeAutoQuery($query, $param)
    {
        collect($param)->each(function ($value, $key) use ($query) {
            $value = trim($value);
            if (!empty($value) || $value === "0") {
                if (strpos($key, 'ds_') === 0 || strpos($key, 'no_') === 0) {
                    $query->where(
                        $key,
                        'like',
                        DB::raw('%{$value}%')
                    );
                } else {
                    $query->where($key, '=', $value);
                }
            }
        });
        return $query;
    }

    public function scopeLike($query, $param)
    {
        collect($param)->each(function ($value, $key) use ($query) {
            if ($value) {
                $query->where($key, 'like', "%{$value}%");
            }
        });
        return $query;
    }

    public function scopeOrder($query, $param)
    {
        collect($param)->each(function ($value, $key) use ($query) {
            $query->orderBy($key, $value);
        });
        return $query;
    }

    public function scopeLatest($query)
    {
        return $query->orderBy(self::CREATED_AT, 'desc');
    }

    public function scopeGet($query, $param)
    {
        collect($param)->each(function ($value, $key) use ($query) {
            $query->orderBy($key, $value);
        });
        return $query;
    }
}
