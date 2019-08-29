<?php

namespace App\Jobs;

use App\Models\NewsFeed;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Redis\RedisManager;
use Illuminate\Support\Facades\Config;

class SendNewFeed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var NewsFeed
     */
    private $newsFeed;
    /**
     * @var RedisManager
     */
    private $redisManager;
    /**
     * @var mixed
     */
    private $config;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(NewsFeed $newsFeed, RedisManager $redisManager)
    {
        //
        $this->newsFeed = $newsFeed;
        $this->redisManager = $redisManager;
        $this->config = Config::getFacadeRoot();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->redisManager->publish(
            $this->config->get('notificationTypes.newFeed'),
            $this->newsFeed->toJson()
        );
    }
}
