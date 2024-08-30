<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
    'Modules\\Article\\Config\\Setup' => $baseDir . '/Config/Setup.php',
    'Modules\\Article\\Database\\Seeders\\ArticleDatabaseSeeder' => $baseDir . '/Database/Seeders/ArticleDatabaseSeeder.php',
    'Modules\\Article\\Entities\\Article' => $baseDir . '/Entities/Article.php',
    'Modules\\Article\\Entities\\ArticleCategory' => $baseDir . '/Entities/ArticleCategory.php',
    'Modules\\Article\\Entities\\ArticleTag' => $baseDir . '/Entities/ArticleTag.php',
    'Modules\\Article\\Http\\Controllers\\ArticleCategoryController' => $baseDir . '/Http/Controllers/ArticleCategoryController.php',
    'Modules\\Article\\Http\\Controllers\\ArticleController' => $baseDir . '/Http/Controllers/ArticleController.php',
    'Modules\\Article\\Http\\Controllers\\ArticleTagController' => $baseDir . '/Http/Controllers/ArticleTagController.php',
    'Modules\\Article\\Http\\Requests\\CreateArticleCategoryValidation' => $baseDir . '/Http/Requests/CreateArticleCategoryValidation.php',
    'Modules\\Article\\Http\\Requests\\CreateArticleTagValidation' => $baseDir . '/Http/Requests/CreateArticleTagValidation.php',
    'Modules\\Article\\Http\\Requests\\CreateArticleValidation' => $baseDir . '/Http/Requests/CreateArticleValidation.php',
    'Modules\\Article\\Providers\\ArticleServiceProvider' => $baseDir . '/Providers/ArticleServiceProvider.php',
    'Modules\\Article\\Providers\\RouteServiceProvider' => $baseDir . '/Providers/RouteServiceProvider.php',
);
