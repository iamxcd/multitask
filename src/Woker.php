<?php

namespace Iamxcd\Multitask;

use Closure;
use Exception;

class Woker
{
    /**
     * 进程数量
     */
    private  $count;

    private $func;

    public function setCount(int $num)
    {
        $this->count = $num;
        return $this;
    }

    public function task(Closure $func)
    {
        $this->func = $func;
        return $this;
    }

    public function run()
    {
        $pid = pcntl_fork();

        if ($pid == -1) {
            throw new Exception('子进程创建失败');
        } else if ($pid) {
            // 等待子进程中断，防止子进程成为僵尸进程。
            pcntl_wait($status);
        } else {
            $func = $this->func;
            $func();
        }
    }
}
