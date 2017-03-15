<?php

namespace App\Repositories;

use App\Models\EducationInstitution;
use App\Models\ResponseToOrder;
use App\Repositories\Contracts\IOrderRepository;

use App\Models\Faculty;
use App\Models\Order\Order;
use App\Models\Order\Type as OrderType;
use App\Models\Order\File as OrderFile;

class OrderRepository implements IOrderRepository
{

    protected $instance;

    /**
     * OrderRepository constructor.
     * @param Order $instance
     */
    public function __construct(Order $instance)
    {
        $this->instance = $instance;
    }

    /**
     * @return Order
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * @param array $data
     * @return static
     * @throws \Exception
     */
    public function create(array $data)
    {
        \Auth::user()->can('order.create');

        \DB::beginTransaction();


        try {
            $instance = $this->getInstance();
            $result = $instance->create(
                [
                    'user_id' => \Auth::user()->id,
                    'order_type_id' => OrderType::findBy('name', $data->get('type')),
                    'status_id' => $instance->getStatusWaiting()->get('id'),
                    'educational_institution_id' => EducationInstitution::findBy('name', $data->get('educational_institution')),
                    'faculty_id' => Faculty::findBy('name', $data->get('faculty')),
                    'specialty' => $data->get('specialty'),
                    'theme' => $data->get('theme'),
                    'description' => $data->get('description'),
                    'pages_from' => $data->get('pages_from'),
                    'pages_to' => $data->get('pages_to'),
                    'deadline' => \DateTimeHelper::parseDate($data->get('deadline'), 'Y-m-d'),
                ]
            );

            $orderId = $result->id;

            //Save files for order
            $fileInstance = new OrderFile();
            if (isset($data['files']) && count($data['files'])) {
                foreach ($data['files'] as $file) {
                    $name = $fileInstance->getFileName($file);
                    $originalName = $fileInstance->getFileOriginalName($file);
                    $storagePath = 'app/' . $fileInstance->storagePath($orderId) . '/' . $name;

                    $fileInstance->saveFile($file, $orderId);

                    $fileInstance->create([
                        'order_id' => $orderId,
                        'name' => $name,
                        'original_name' => $originalName,
                        'storage_path' => $storagePath,
                    ]);
                }
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        \DB::commit();
        return $result;
    }

    /**
     * @param $orderId
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function update($orderId, array $data)
    {
        \Auth::user()->can('order.update', $orderId);

        \DB::beginTransaction();
        $data = collect($data);

        try {
            $instance = $this->getInstance()->findOrFail($orderId);
            $instance->update(
                [
                    'order_type_id' => OrderType::findBy('name', $data->get('type')),
                    'educational_institution_id' => EducationInstitution::findBy('name', $data->get('educational_institution')),
                    'faculty_id' => Faculty::findBy('name', $data->get('faculty')),
                    'specialty' => $data->get('specialty'),
                    'theme' => $data->get('theme'),
                    'description' => $data->get('description'),
                    'pages_from' => $data->get('pages_from'),
                    'pages_to' => $data->get('pages_to'),
                    'deadline' => \DateTimeHelper::parseDate($data->get('deadline'), 'Y-m-d'),
                ]
            );

            $orderId = $instance->id;

            //Save files for order
            $fileInstance = new OrderFile();
            if (isset($data['files']) && count($data['files'])) {
                foreach ($data['files'] as $file) {
                    $name = $fileInstance->getFileName($file);
                    $originalName = $fileInstance->getFileOriginalName($file);
                    $storagePath = 'app/' . $fileInstance->storagePath($orderId) . '/' . $name;

                    $fileInstance->saveFile($file, $orderId);

                    $fileInstance->create([
                        'order_id' => $orderId,
                        'name' => $name,
                        'original_name' => $originalName,
                        'storage_path' => $storagePath,
                    ]);
                }
            }

        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        \DB::commit();

        return $instance;
    }

    public function delete($orderId)
    {
        \Auth::user()->can('order.delete', $orderId);
        $responses = (new ResponseToOrder());

        $responses::where('order_id', $orderId)
            ->update(
                [
                    'status_id' => $responses->getStatusComplete()->get('id')
                ]);


        return $this->getInstance()->find($orderId)->delete();
    }

}