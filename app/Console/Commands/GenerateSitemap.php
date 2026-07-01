<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate sitemap.xml untuk SEO';

    public function handle()
    {
        $sitemap = Sitemap::create();
        $configuredUrl = rtrim((string) config('app.url'), '/');
        $baseUrl = preg_match('#(localhost|127\.0\.0\.1)#i', $configuredUrl)
            ? 'https://beritojayamedika.com'
            : ($configuredUrl ?: 'https://beritojayamedika.com');
        $lastModified = Carbon::now();

        $pages = [
            ['path' => '/', 'priority' => 1.0, 'frequency' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['path' => '/products', 'priority' => 0.9, 'frequency' => Url::CHANGE_FREQUENCY_DAILY],
            ['path' => '/contact', 'priority' => 0.8, 'frequency' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['path' => '/about', 'priority' => 0.8, 'frequency' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['path' => '/articles', 'priority' => 0.7, 'frequency' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['path' => '/toocare', 'priority' => 0.7, 'frequency' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['path' => '/projects', 'priority' => 0.6, 'frequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        ];

        foreach ($pages as $page) {
            $sitemap->add(
                Url::create($baseUrl . $page['path'])
                    ->setPriority($page['priority'])
                    ->setChangeFrequency($page['frequency'])
                    ->setLastModificationDate($lastModified)
            );
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap berhasil dibuat di public/sitemap.xml');
    }
}
