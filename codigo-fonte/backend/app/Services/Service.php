<?php
namespace App\Services;

use App\Constants\Constants;
use App\Constants\Messages;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use function is_int;
use function strlen;

abstract class Service
{
    protected $model;

    protected $queryBuilder;

    public $message = [];

    public function __construct()
    {
        if (is_null($this->queryBuilder)) {
            $this->queryBuilder = $this->model;
        }
    }

    public function isValid(&$data, $id = null): bool
    {
        return true;
    }

    public function save($data, $id = null)
    {
        try {
            DB::beginTransaction();
            $this->isValid($data, $id);
            $model = $this->model;
            if ($id) {
                $model = $this->model->find($id);
                unset($data['id']);
            }
            $model->populate($data);
            $model->save();
            DB::commit();
            return $model;
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }

    public function find($id)
    {
        $data = $this->queryBuilder->where($this->model->getKeyName(), $id)->first();
        if ($data) {
            $data->id = $data->{$this->model->getKeyName()};
        }
        return $data;
    }

    public function isValidDelete($id): bool
    {
        return true;
    }

    public function delete($id)
    {
        try {
            if ($this->isValidDelete($id)) {
                return $this->model->destroy($id);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Melhorar forma de adicionar o campo ID na paginacao.
     */
    public function getPaginate($data)
    {
        $collect = collect($data);

        $filter = [];

        foreach($collect as $key => $value){
            if($key !== 'page' && $key !== 'sort')
                $filter[$key] = $value;
        }

        $queryBuilder = $this->queryBuilder
            ->autoQuery($filter)
            ->order(json_decode($collect->pull('order')));
        if ($collect->pull('page')) {
            $paginate = $queryBuilder->paginate(10);
            $itemsTransformed = self::treateDataAddPk($paginate->getCollection());
            $itemsTransformed = $this->treatePaginateData($itemsTransformed);
            return new \Illuminate\Pagination\LengthAwarePaginator(
                $itemsTransformed,
                $paginate->total(),
                $paginate->perPage(),
                $paginate->currentPage(),
                [
                    'path' => \Request::url(),
                    'query' => [
                        'page' => $paginate->currentPage()
                    ]
                ]
            );
        }
        $itemsTransformed = $this->treatePaginateData($queryBuilder->get());
        return self::treateDataAddPk($itemsTransformed);
    }

    public function treatePaginateData($data)
    {
        return $data;
    }

    public function treateDataAddPk($collection)
    {
        try {
            $keyName = $this->model->getKeyName();
            return $collection->map(function ($data, $key) use ($keyName) {
                $data['id'] = $data[$keyName];
                return $data;
            });
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    /**
     * Get the cpf formatted according to the bacen rule.
     *
     * @param  $cpf
     * @return string
     */
    public function convertCpf($cpf)
    {
        return substr_replace(substr_replace($cpf,'***',0,3),'***',8,3);
    }

    /**
     * Get the cpf formatted according to the bacen rule.
     *
     * @param  $cpf
     * @return string
     */
    function validCPF($cpf) {

        if (!ctype_digit($cpf)) {
            $cpf = $this->convertCpf($cpf);
            $message = sprintf(Messages::MSG019,'CPF', $cpf);
            throw new \InvalidArgumentException($message, 422);
        }

        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        if (preg_match('/(\d)\1{10}/', $cpf) || strlen($cpf) != 11) {
            $cpf = $this->convertCpf($cpf);
            $message = sprintf(Messages::MSG009,'CPF', $cpf);
            throw new \InvalidArgumentException($message, 422);
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $cpf = $this->convertCpf($cpf);
                $message = sprintf(Messages::MSG009,'CPF', $cpf);
                throw new \InvalidArgumentException($message, 422);
            }
        }
        return true;

    }


    /**
     * Get the CNPJ formatted according to the bacen rules.
     *
     * @param  $cnpj
     * @return boolean
     */
    public function validCNPJ($cnpj)
    {
        if (!ctype_digit($cnpj)){
            $message = sprintf(Messages::MSG019,'CNPJ', $cnpj);
            throw new \InvalidArgumentException($message, 422);
        }

        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        if (strlen($cnpj) != 14 || preg_match('/(\d)\1{13}/', $cnpj)) {
            $message = sprintf(Messages::MSG009,'CNPJ', $cnpj);
            throw new \InvalidArgumentException($message, 422);
        }

        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) {
            $message = sprintf(Messages::MSG009,'CNPJ', $cnpj);
            throw new \InvalidArgumentException($message, 422);
        }

        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);

    }

    public function validKey($data)
    {
        $isPhone = is_int(strpos($data,'+'));
        if ($isPhone || ctype_digit($data)) {
            if (strlen($data) === 11) {
                $this->validCPF($data);
                return [
                    Constants::DS_CHAVE => $data,
                    Constants::NO_TIPO_CHAVE => 'CPF'
                ];
            }
            if (!$isPhone && strlen($data) === 14) {
                $this->validCNPJ($data);
                return [
                    Constants::DS_CHAVE => $data,
                    Constants::NO_TIPO_CHAVE => 'CNPJ'
                ];
            }
            if ($isPhone || strlen($data) === 12)  {
                $this->validPhone($data);
                return [
                    Constants::DS_CHAVE => $data,
                    Constants::NO_TIPO_CHAVE => 'PHONE'
                ];
            }
        }

        if (strpos($data, '@') !== false)  {
            $this->validMail($data);
            return [
                Constants::DS_CHAVE => $data,
                Constants::NO_TIPO_CHAVE => 'EMAIL'
            ];
        }

    }

    public function validMail($mail) {

        try {
            if (strlen($mail) > 77) {
                $message = sprintf(Messages::MSG022, 'e-mail', $mail);
                throw new \InvalidArgumentException($message, 422);
            }

            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $message = sprintf(Messages::MSG009, 'e-mail', $mail);
                throw new \InvalidArgumentException($message, 422);
            }
            return true;
        } catch (\Exception $exception){
            return $exception;
        }
    }

    public function validPhone($phone)
    {
        if (preg_match('/^\d{13}+$/', substr($phone, 1))) {
            return true;
        }

        $message = sprintf(Messages::MSG009,'Telefone', $phone);
        throw new \InvalidArgumentException($message, 422);

    }

}
