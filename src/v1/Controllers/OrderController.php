<?php

namespace ErpNET\Models\v1\Controllers;

use Carbon\Carbon;
use ErpNET\Models\v1\Criteria\OpenOrdersCriteria;
use ErpNET\Models\v1\Interfaces\OrderRepository;
use ErpNET\Models\v1\Validators\OrderValidator;
use NumberFormatter;

/**
 * Mandante resource representation.
 *
 * @Resource("Order", uri="/order")
 */
class OrderController extends ResourceController
{
    protected $routeName = 'order';
    protected $repositoryClass = OrderRepository::class;
    protected $validatorClass = OrderValidator::class;

    /**
     * @var integer
     */
    protected $paginateItemCount = 3;

    /**
     * Criterias to load
     * @var array
     */
    protected $defaultCriterias = [
        OpenOrdersCriteria::class,
    ];

    /**
     * ErpnetWidgetService fields configuration
     * @return array
     */
    protected function widgetServiceFields()
    {
        return [
            'id' => [
                'header' => true,
                'customShow' => function ($item) {
                    $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
                    $header = Carbon::parse($item['posted_at'])->formatLocalized('%d/%m/%Y %X');
                    $total = 0;
                    foreach ($item['orderItems'] as $orderItem) {
                        $total = $total + ($orderItem['quantidade'] * $orderItem['valor_unitario']);
                    }
                    $header = $header . ' ' . t('Total') . ': ' . $formatter->format($total);

                    return $header;
                },
            ],
//            'posted_at' => [
//                'label' => t('Posted'),
//            ],

            'partner' => [
                'label' => t('Partner'),
                'customShow' => function ($item) {
                    return $item['partner']['nome'];
                },
            ],
            'address' => [
                'label' => t('Address'),
                'customShow' => function ($item) {
                    $address = $item['address']['cep'] . ' - ' . $item['address']['logradouro'] . ', ' . $item['address']['numero'];

                    if (!empty($item['address']['complemento']))
                        $address = $address . ' - ' . $item['address']['complemento'];

                    if (!empty($item['address']['obs']))
                        $address = $address . ' (' . $item['address']['obs'] . ')';
                    return $address;
                },
            ],
            'orderSharedStats' => [
                'label' => t('Status'),
                'customShow' => function ($item) {
                    if (count($item['orderSharedStats']) > 0) {
                        $line = '';
                        foreach ($item['orderSharedStats'] as $orderSharedStat) {
                            $line = $line . $orderSharedStat['descricao'] . ', ';
                        }
                        return substr($line, 0, -2);
                    } else
                        return t('No Status');
                },
            ],
            'orderItems' => [
                'label' => t('Items'),
                'customShow' => function ($item) {
                    if (count($item['orderItems']) > 0) {
                        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
                        $line = '';
                        $total = 0;
                        foreach ($item['orderItems'] as $orderItem) {
                            $total = $total + ($orderItem['quantidade'] * $orderItem['valor_unitario']);
                            $line = $line . '<li>' . $orderItem['product']['nome'] . ' - ' . $orderItem['quantidade'] . 'x ' . $formatter->format($orderItem['valor_unitario']) . '</li>';
                        }
//                        $line = $line . '<li>'. t('Total') . ': ' . $formatter->format($total) . '</li>';
                        return '(' . t('Total') . ': <strong>' . $formatter->format($total) . '</strong>)<ul>' . $line . '</ul>';
                    } else
                        return t('No Items');
                },
            ],
        ];
    }
}
