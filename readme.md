# PHP多任务
>还不太完善建议，用于测试环境。

# 使用说明

用到了 pcntl_fork(),pcntl_wait() 这两个函数，貌似不支持win

# 使用
```php
    require_once './vendor/autoload.php';

    use Iamxcd\Multitask\Woker;

    $woker = new Woker();

    $url = "https://learnku.com/laravel?page=";
    for ($i = 1; $i <= 10; $i++) {
        $woker->addParams($url . $i);
    }

    $path = './html/';
    if (!is_dir($path)) {
        mkdir($path);
    }
    $woker->task(function ($params, $workr) use ($path) {
        $file_name = md5(mt_rand(1000, 9999) . time()) . '.txt';
        file_put_contents($path . $file_name, file_get_contents($params));
    })->run();
```