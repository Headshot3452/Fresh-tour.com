<?php
    return array(
        'urlManagerGenerator' => array(
            'module_config_dir'       => 'application.config.module_config',
            'data_dir'                => 'application.data',
            'url_manager_config'      => 'urlManagerConfig.json',
            'url_manager_config_bckp' => 'urlManagerConfig.json.bckp',
            'url_manager'             => 'frontendUrlManager.php',
            'url_manager_config_bckp' => 'frontendUrlManager.php.bckp',
            'write_backup'            => false
        ),

        'upload' => array(
            'modules'  => array(
                'temp' => 'application.upload.modules.temp.'
            ),
            'media'   => array(
                'images'  => array(
                    'path'    => 'webroot.data.media.images',
                    'webpath' => '/data/media/images/',
                ),
                'files'   => array(
                    'path'    => 'webroot.data.media.files',
                    'webpath' => '/data/media/files/',
                ),
            )
        ),

        'api' => array('actions' => array('storage' => 'http://storage.ideadrive.iwl/api/store/'),
            'auth' => array(
                'id'   => '2',
                'key'  => '225520880',
            ),
        ),

        'noavatar' => 'images/noavatar.png',
        'noimage'  => 'images/noimage.png',
        'no-image'  => 'images/no-image.png',

        'icons' => array(
            'main_settings' => 'images/icon-admin/main_settings.png',
            'permission'    => 'images/icon-admin/permission.png'
        ),

        'watermark' => '/images/watermark.png',

        'site'=>array(
            'allow_register_admin' => false,
            'allow_register'       => true,
        ),

        'multi_language'=>false,

        'pages' => array(
            'strany-i-oteli' => '3',
            'informaciya' => '4',
            'tema-tours' => '5',
            'o-kompanii' => '7',
            'agentstvam' => '8',
            'nash-ofis' => '10',
            'novosti' => '13',
            'sposoby-oplaty' => '18',
            'visy' => '16',
            'visa' => '77',
            'o-kompanii-array' => array(7, 8, 10, 11, 12, 13, 69, 71),
            'info-array' => array(4, 18, 19),
            'tyrs-array' => array(16, 76, 77),
            'strany-and-hotel' => array(3, 66, 67),
        ),

        'vizy_catalog' => '3',      // Каталог "Визы"
        'strany_catalog' => '4',    // Каталог "Визы"

        'date_from' => '5',         // Параметр "Дата отправления"
        'tema_tours' => '6',        // Параметр "Тематика тура"
        'type_hotel' => '8',        // Параметр "Тип отеля"
        'hot' => '9',               // Параметр "Горяший тур"
        'stars' => '7',             // Параметр "Звёзды"
        'vylet' => '10',            // Параметр "Вылет из"
        'kyrort' => '11',           // Параметр "Курорт"
        'sostav' => '12',           // Параметр "Состав"
        'pitanie' => '13',          // Параметр "Питание"
        'transport' => '14',        // Параметр "Транспорт"
        'dlitelnost' => '15',       // Параметр "Длительность"
        'popular' => '17',          // Параметр "Популярное"
        'hotel' => '19',            // Параметр "Отель"
        'name_hotel' => '20',       // Параметр "Название отеля"

        // Параметры отеля

        'wi-fi' => '103',
        'transfer' => '104',
        'restoran' => '105',
        'sportzal' => '106',

        'phone' => array(
            'mask'   => '+375(99)999-99-99',
            'regexp' => '/\+375\(\d{2}\)\d{3}\-\d{2}\-\d{2}/isU',
        ),

        'settings_id' => 1,

        'allowWidgets'=>array(
            'AskAnswerWidget',
            'BannerDescriptionWidget',
            'BlockWidget',
            'CarouselGalleryWidget',
            'CatalogTreeViewWidget',
            'CatalogTreeWidget',
            'MapWidget',
            'MenuWidget',
            'NewsLastWidget',
            'SliderProductsWidget',
            'SliderWidget',
        ),
    );
?>