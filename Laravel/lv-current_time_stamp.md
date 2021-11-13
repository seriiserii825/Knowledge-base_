ALTER TABLE `laravel`.`posts` 
CHANGE COLUMN `created_at` `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
CHANGE COLUMN `updated_at` `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;


public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            \Illuminate\Support\Facades\DB::statement(" ALTER TABLE `laravel`.`posts` CHANGE COLUMN `created_at` `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , CHANGE COLUMN `updated_at` `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;
            ");
        });
}
