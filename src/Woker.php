<?php

namespace Iamxcd\Multitask;

use Closure;
use Exception;

class Woker
{
    /**
     * 分片处理 参数
     */
    private  $params;

    /**
     * 待执行的函数
     */
    private $func;


    public function addParams($params)
    {
        $this->params[] = $params;
        return $this;
    }

    public function task(Closure $func)
    {
        $this->func = $func;
        return $this;
    }

    public function run()
    {
        $count = count($this->params);
        if (!$count) {
            throw new Exception('参数不能为空');
        }

        if (!($this->func instanceof Closure)) {
            throw new Exception('任务不能为空');
        }
        for ($i = 0; $i < $count; $i++) {
            $pid = pcntl_fork();
            if ($pid == -1) {
                throw new Exception('子进程创建失败');
            } else if ($pid) {
            } else {
                call_user_func($this->func, $this->params[$i], $this);
                die;
            }
        }
        pcntl_wait($status);
    }
}
