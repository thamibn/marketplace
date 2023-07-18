<?php

namespace App\Console\Commands;

use App\Domain\Listing\Models\Listing;
use Elastic\Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexListingsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elasticsearch:reindexlistings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all listings to Elasticsearch';

    public function __construct(private readonly Client $elasticsearch)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Indexing all listings. This might take a while...');

        foreach (Listing::cursor() as $listing)
        {
            $this->elasticsearch->index([
                'index' => $listing->getSearchIndex(),
                'type' => $listing->getSearchType(),
                'id' => $listing->getKey(),
                'body' => $listing->toSearchArray(),
            ]);

            $this->output->write('.');
        }

        $this->output->writeln('');
        $this->info('Done!');
    }
}
