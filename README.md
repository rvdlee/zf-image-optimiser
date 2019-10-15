# ZF3 Package to optimize images

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rvdlee/zf-image-optimiser.svg?style=flat-square)](https://packagist.org/packages/rvdlee/zf-image-optimiser)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rvdlee/zf-image-optimiser/badges/quality-score.png)](https://scrutinizer-ci.com/g/rvdlee/zf-image-optimiser)
[![Total Downloads](https://img.shields.io/packagist/dt/rvdlee/zf-image-optimiser.svg?style=flat-square)](https://packagist.org/packages/rvdlee/zf-image-optimiser)
[![GitHub license](https://img.shields.io/github/license/EpicSoftworks/pelican-prismjs.svg)](https://github.com/EpicSoftworks/pelican-prismjs/blob/master/LICENSE)
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.me/epicsoftworks)

This is a image optimiser package. I've written this with ZF3 in mind, everything is written with configuration over convention in mind. Highly extendible and easy in use. Currently supporting Gifsicle, JpegOptim, Optipng and pngquant2.

This package provides the following ways of converting:

* Through the commandline 
* InputFilter
* Sevice

## Usage

To get started you need to configure your validation chain. The validation chain acts as a validator for the files that are due to processing. There is a [provided config dist file](https://github.com/rvdlee/zf-image-optimiser/blob/master/config/local.config.php.dist) with all the configuration you need to get started. 

The validator chain will require the standard zend validators to verify if the file is suitable to be handled by these adapters. It will look like something like this.

```php
# ... config use statements

return [
    'rvdlee' => [
        'zf-image-optimiser' => [
            # ... Other adapters
            Pngquant2::class => [
                'binary-options'  => [
                    '--verbose',
                    '--force',
                    '--strip',
                    '--speed 1',
                    '--quality=75-100',
                ],
                'validator-chain' => [
                    ['name' => IsImage::class],
                    [
                        'name'    => Extension::class,
                        'options' => [
                            'case'       => false,
                            'extensions' => 'png',
                        ],
                    ],
                    [
                        'name'    => MimeType::class,
                        'options' => [
                            'mimeType' => ['image/png'],
                        ],
                    ],
                ],
            ],
            'enabled'        => [
                # ... Other adapters
                Pngquant2::class,
            ],
        ],
    ],
];
```

## InputFilters

The standard file handling through forms is done with InputFilters in Zend, the InputFilter in this package allows you to save or overwrite the uploaded image. By default behaviour it will overwrite to be more inline with other file handling filters.

Here a example of an InputFilter in a FormInputFilter file using the ImageOptimiser filter to reduce filesize.

```php
# ... Other InputFilters

$this->add(
    [
        'type'       => FileInput::class,
        'name'       => 'image',
        'required'   => false,
        'filters'    => [
            [
                'name'    => RenameUpload::class,
                'options' => [
                    'target'             => <my_target_path>,
                    'useUploadName'      => true,
                    'useUploadExtension' => true,
                    'overwrite'          => false,
                    'randomize'          => false,
                ],
            ],
            ['name' => ImageOptimiser::class],
        ],
        'validators' => [
            ['name' => IsImage::class],
            [
                'name'    => FilesSize::class,
                'options' => [
                    'min' => '4kB',
                    'max' => '8MB',
                ],
            ],
            [
                'name'    => Extension::class,
                'options' => [
                    'case'       => false,
                    'extensions' => 'jpg,png',
                ],
            ],
            [
                'name'    => MimeType::class,
                'options' => [
                    'mimeType' => [
                        'image/jpeg',
                        'image/png',
                    ],
                ],
            ],
            [
                'name'    => ImageSize::class,
                'options' => [
                    'minWidth'  => 128,
                    'minHeight' => 128,
                    'maxWidth'  => 4096,
                    'maxHeight' => 4096,
                ],
            ],
        ],
    ]
);

# ... Other InputFilters
```

## Commandline

The commandline controller is nothing more than a wrapper for the service calling `optimise()`. You can access this controller by running the following command from CLI.

```bash
php ./public/index.php image-optimiser --image='./public/images/test.png' 
```

## Service

The service class allows you to apply this package virtually everywhere in your ZF3 application. We support logging and catch all output given from the programs doing the optimalisation.

The service by default gets decked out with a default `Zend\Log\Writer\Mock` writer. You can still access the logs in this writer. You can override this when building the service. Allowing you to provide a DB, Logfile or Stdout writer.

```php
class SomeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var ImageOptimiserService $imageOptimiserService */
        $imageOptimiserService = $container->get(ImageOptimiserService::class);

        # or... provide your own LoggerInterface

        /** @var Logger $logger */
        $logger = $container->get(Logger::class);
        /** @var Stream $writer */
        $logger->addWriter(new Stream('php://output'));
        /** @var ImageOptimiserService $imageOptimiserService */
        $imageOptimiserService = $container->build(ImageOptimiserService::class, ['logger' => $logger]);

        # ... other factory stuff
    }
}
```

If you want to access the logs in the Mock writer, just use the following snippet. Locate the Mock writer and then look at the events.

```php
/** @var array|WriterInterface[] $writers */
$writers = $imageOptimiserService->getLogger()->getWriters()->toArray();
/** @var Zend\Log\Writer\Mock $mockWriter */
$mockWriter = $writers[0];
/** @var array $events */
$events = $mockWriter->events;
```

## FAQs

There are none at the moment.