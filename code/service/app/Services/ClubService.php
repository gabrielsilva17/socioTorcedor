<?php

namespace App\Services;

use App\Models\Club;
use App\Models\ClubHistory;
use App\Traits\ServiceSoftDelete;

class ClubService extends Service
{
    use ServiceSoftDelete;

    /** @var Club $model */
    public $model;

    /** @var ClubHistory $history */
    public $history;

    public function __construct(Club $model)
    {
        $this->model = $model;
        $this->history = new ClubHistory();
        parent::__construct();
        $this->setSoftDelete();

    }

    public function save($data, $id = null)
    {
        try {
            $this->isValid($data, $id);
            $model = $this->model;

            if ($id) {
                $model = $this->model->find($id);
                unset($data['id']);
            }
            $model->populate($data);
            $model->save();
            $this->historic($data,$model);

            return $model;
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function historic ($data, $array) {

        try{
            foreach ($data as $key => $value) {
                $club = $this->history->where('cd_club', '=', $array['cd_club'])->first();
                $save = [
                    'ds_changed_field' => $key,
                    'vl_new_value' => $value,
                    'vl_old_value' => $club[$key],
                    'cd_club' => $array['cd_club'],
                    'cd_author' => 1
                ];
                $this->history->populate($save);
                $this->history->save();

                return true;
            }
        } catch (\Exception $exception) {
            throw new \Exception("Requisição Inválida,  erro ao salvar historico",422);
        }

    }

}
