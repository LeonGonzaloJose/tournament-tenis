<?php

namespace App\Mapper;

use App\Dto\BaseDto;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class Mapper
{
    /**
     * Mapea las claves de un modelo, colección o array asociativo
     * @param Model|Collection|array $data
     * @param string $responseClass Indica la clase de donde se obtendrá el mapeo
     * @param string $dto
     * @return array
     * @throws Exception
     * @uses self::responseIfNotMap()
     * @uses self::mapArray()
     * @uses self::filterByDto()
     */
    public static function mapResponse(Model|Collection|array $data, string $responseClass, string $dto): array
    {
        if (!class_exists($responseClass) || !method_exists($responseClass, 'mapping')) {
            // Si no existe la clase ingresada o no contiene el método mapping, devolvemos el dato transformado a array
            return self::responseIfNotMap($data);
        }

        $mapping         = $responseClass::mapping();
        $data_mapeada    = null;

        if (!$mapping) {
            return self::responseIfNotMap($data);
        }

        if ($data instanceof Collection) {
            $data_mapeada = $data->map(function ($item) use ($mapping) {
                $itemArray = $item->toArray();
                return self::mapArray($itemArray, $mapping);
            })->toArray();
        } else if (is_array($data) && array_keys($data) !== range(0, count($data) - 1)) {
            // Es un array asociativo
            $data_mapeada = self::mapArray($data, $mapping);
        } else if ($data instanceof Model) {
            $mappedData = $data->toArray();
            $data_mapeada = self::mapArray($mappedData, $mapping);
        } else if (is_array($data)) {
            // Es un array de arrays o stdClass
            $data_mapeada = array_map(function ($item) use ($mapping) {
                return self::mapArray((array) $item, $mapping);
            }, $data);
        }

        return self::filterByDto($data_mapeada,$dto);
    }

    /**
     * Mapea un array basado en el mapeo dado (acepta arrays de arrays)
     * @param array $data
     * @param array $mapping
     * @return array
     */
    private static function mapArray(array $data, array $mapping): array
    {
        $mappedData = [];

        foreach ($data as $key => $value) {
            if (array_key_exists($key, $mapping)) {
                if (is_array($value) && is_array($mapping[$key])) {
                    // Si el valor es un array y el mapeo es un array (para manejar arrays anidados)
                    $mappedData[$mapping[$key][0]] = self::mapArray($value, $mapping[$key][1]);
                } else {
                    $mappedData[$mapping[$key]] = $value;
                }
            } else {
                $mappedData[$key] = $value;
            }
        }

        return $mappedData;
    }

    /**
     * Convierte el dato a array y lo retorna
     * @param Model|Collection|array $data
     * @return array
     */
    private static function responseIfNotMap(Model|Collection|array $data): array
    {
        if ($data instanceof Model) {
            return $data->toArray();
        }

        if ($data instanceof Collection) {
            return $data->map(fn($item) => (array) $item)->toArray();
        }

        // Retorna un array vacío en caso de no haber mapeo
        return [];
    }

    /**
     * Devuelve un array filtrado por los parámetros de un Dto (en caso de existir)
     * @param array $data
     * @param string $dto
     * @return array
     * @throws Exception
     */
    private static function filterByDto(array $data, string $dto): array
    {
        if (!class_exists($dto) || !is_subclass_of($dto,BaseDto::class)) {
            throw new Exception('La clase ' . $dto . ' no existe o no extiende de BaseDto');
        }

        // Si es un array de arrays, mapeamos los Dto's
        if (is_array(array_values($data)[0])) {
            foreach ($data as &$item) {
                $item = (new $dto($item))->toArray();
            }
            return $data;
        }

        return (new $dto($data))->toArray();
    }
}
