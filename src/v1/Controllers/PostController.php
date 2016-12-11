<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Entities\PostEloquent;
use ErpNET\Models\v1\Interfaces\PostRepository;
use ErpNET\Models\v1\Validators\PostValidator;

/**
 * Post resource representation.
 *
 * @Resource("Post", uri="/post")
 */
class PostController extends ResourceController
{
    protected $routeName = 'post';
    protected $repositoryClass = PostRepository::class;
    protected $validatorClass = PostValidator::class;

    /**
     * @var integer
     */
    protected $paginateItemCount = 3;

    /**
     * Criterias to load
     * @var array
     */
    protected $defaultCriterias = [
//        OpenOrdersCriteria::class,
    ];

    /**
     * ErpnetWidgetService fields configuration
     * @return array
     */
    protected function widgetServiceFields()
    {
        return [
            'mandante' => ['value' => 'testesdivertidos'],
            'title',
            'description',
            'paramName'=>['component' => 'widgetCheckbox', 'value' => '1', 'label' => 'Mostrar Nome do Perfil'],
            'paramFirstName'=>['component' => 'widgetCheckbox', 'value' => '1', 'label' => 'Mostrar Somente Primeiro Nome do Perfil'],
            'paramNameSize'=>['attributes' => ['placeholder' => 'ex.: 10'], 'label' => 'Tamanho do Nome do Perfil'],
            'paramNameColor'=>['attributes' => ['placeholder' => 'ex.: FFFFFF'], 'label' => 'Cor do Nome do Perfil'],
            'paramNameX'=>['attributes' => ['placeholder' => 'ex.: 270'], 'label' => 'Posição X do Nome do Perfil'],
            'paramNameY'=>['attributes' => ['placeholder' => 'ex.: 230'], 'label' => 'Posição Y do Nome do Perfil'],
            'paramProfileImageSize'=>['attributes' => ['placeholder' => 'ex.: 116x116'], 'label' => 'Tamanho da Imagem do Perfil'],
            'paramProfileImageX'=>['attributes' => ['placeholder' => 'ex.: 10'], 'label' => 'Posição X da Imagem do Perfil'],
            'paramProfileImageY'=>['attributes' => ['placeholder' => 'ex.: 20'], 'label' => 'Posição Y da Imagem do Perfil'],
            'file'=>['component' => 'widgetFile', 'label' => 'Imagem Antes do Teste', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file'); }],
            'file1' => ['component' => 'widgetFile', 'label' => 'Imagem Aleatória do Teste 1', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file1'); }],
            'file2' => ['component' => 'widgetFile', 'label' => 'Imagem Aleatória do Teste 2', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file2'); }],
            'file3' => ['component' => 'widgetFile', 'label' => 'Imagem Aleatória do Teste 3', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file3'); }],
            'file4' => ['component' => 'widgetFile', 'label' => 'Imagem Aleatória do Teste 4', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file4'); }],
            'file5' => ['component' => 'widgetFile', 'label' => 'Imagem Aleatória do Teste 5', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file5'); }],
            'file6' => ['component' => 'widgetFile', 'label' => 'Imagem Aleatória do Teste 6', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file6'); }],
            'file7' => ['component' => 'widgetFile', 'label' => 'Imagem Aleatória do Teste 7', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file7'); }],
            'file8' => ['component' => 'widgetFile', 'label' => 'Imagem Aleatória do Teste 8', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file8'); }],
            'file9' => ['component' => 'widgetFile', 'label' => 'Imagem Aleatória do Teste 9', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file9'); }],
            'file10' => ['component' => 'widgetFile', 'label' => 'Imagem Aleatória do Teste 10', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file10'); }],
            'file11' => ['component' => 'widgetFile', 'label' => 'Imagem Aleatória do Teste 11', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file11'); }],
            'file12' => ['component' => 'widgetFile', 'label' => 'Imagem Aleatória do Teste 12', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file12'); }],
            'file13' => ['component' => 'widgetFile', 'label' => 'Imagem Aleatória do Teste 13', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file13'); }],
            'file14' => ['component' => 'widgetFile', 'label' => 'Imagem Aleatória do Teste 14', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file14'); }],
            'file15' => ['component' => 'widgetFile', 'label' => 'Imagem Aleatória do Teste 15', 'customShow'=> function(PostEloquent $item){ return $item->fileImageField('file15'); }],
        ];
    }


}
