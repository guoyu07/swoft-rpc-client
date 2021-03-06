<?php

namespace Swoft\Rpc\Client\Pool;

use Swoft\App;
use Swoft\Pool\ConnectPool;
use Swoft\Rpc\Client\Service\ServiceConnect;
use Swoft\Rpc\Client\Service\SyncServiceConnect;
use Swoft\Rpc\Client\Service\AbstractServiceConnect;

/**
 * RPC服务连接池
 *
 * @uses      ServicePool
 * @version   2017年05月11日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 Swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class ServicePool extends ConnectPool
{
    /**
     * 创建连接
     *
     * @return AbstractServiceConnect
     */
    public function createConnect(): AbstractServiceConnect
    {
        if (App::isWorkerStatus()) {
            return new ServiceConnect($this);
        }

        return new SyncServiceConnect($this);
    }

    public function reConnect($client)
    {
        list($host, $port) = $this->getConnectAddress();
    }
}
