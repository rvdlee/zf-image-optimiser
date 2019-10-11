# ZF3 Package to optimize images

This package aims to do very much the same thing as spatie. However, this package will a few ideas and combine them the Zend way.

Configuration over convention. This package supports Form InputFilters, Commandline, Adapters for easy expansion and a good old service for easy implementation in any DI class.

## Usage

## InputFilters

The standard file handling is done through InputFilters, the InputFilter in this package allows you to save or overwrite the uploaded image. You can chain adapters together for maximum effect.

## Commandline

```bash
php ./public/index.php image-optimise --input ./public/images/sample.png --output ./public/images/sample-optimised.png 
```

## Service

You can use dependacy injection to get this service anywhere in your application. This way you can use it in any way you see fit.

```php
/** @var ImageOptimiserService $imageOptimiserService */
$imageOptimiserService = $container->get(ImageOptimiserService::class);
```

## FAQs