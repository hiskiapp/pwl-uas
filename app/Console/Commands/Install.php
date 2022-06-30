<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup project installation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('--------- :===: By @hiskiapp :==: ---------------');
        $this->info('====================================================================');

        if ($this->confirm('Do you have setting the database configuration at .env ?')) {
            $this->call('key:generate');
            $this->call('migrate:fresh');
            $this->call('db:seed');
            $this->call('optimize');

            if(is_dir(base_path('public/storage'))){
                rmdir(base_path('public/storage'));
            }
            $this->call('storage:link');

            if(!is_dir(base_path('public/storage/uploads/files')) && !mkdir($concurrentDirectory = base_path('public/storage/uploads/files'), 0775, true) && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
            copy(base_path('public/media/products/11.png'), base_path('public/storage/uploads/files/sample-product.png'));
            copy(base_path('public/media/client-logos/logo1.png'), base_path('public/storage/uploads/files/sample-icon.png'));

            $this->call('route:clear');

            $this->info('Installing Is Completed ! Thank You :)');
            $this->info('--');
            $this->info("::Administrator Credential::\nURL Login: http://localhost/simple-ecommerce/public/admin/login\nEmail: hi@hiskia.app\nPassword: 123456");
            $this->info("\n::Sample User Credential::\nURL Login: http://localhost/simple-ecommerce/public/login\nEmail: hi@hiskia.app\nPassword: 123456");
        } else {
            $this->info('Setup Aborted !');
            $this->info('Please setting the database configuration for first !');
        }

        $this->info('====================================================================');
        $this->info('------------------- :===: Completed !! :===: ------------------------');
        exit;

    }
}
