php artisan make:migration create_posts_comments_likes


php artisan make:seeder CommentsTableSeeder
--php artisan make:seeder UserDetailTableSeeder
php artisan make:seeder UserTableSeeder
php artisan make:seeder BooksTableSeeder
php artisan make:seeder BooksAuthorsLikeTableSeeder

php artisan make:seeder CategoriesBookTableSeeder
php artisan make:seeder CategoriesBookRelationTableSeeder
php artisan make:seeder BookAuthorRelationTableSeeder
php artisan make:seeder PuplishingHouseTableSeeder
php artisan make:seeder ProductsTableSeeder

php artisan make:seeder PostsTableSeeder
php artisan make:seeder PostCommentsTableSeeder
php artisan make:seeder CategoriesPostsTableSeeder
php artisan make:seeder CategoriesPostsRelationTableSeeder
php artisan make:seeder PostsTaggasblesTableSeeder
php artisan make:seeder PostsCommentsLikeTableSeeder

php artisan make:factory CommentsFactory --model=Models\Comments\
---php artisan make:factory UserDetailFactory --model=Models\UserDetail\
php artisan make:factory UserFactory --model=Models\User\
php artisan make:factory BooksFactory --model=Models\A_books\
php artisan make:factory BooksAuthorsLikeTableSeeder --model=Models\A_book_author_like\



php artisan make:factory PostsFactory --model=Models\Posts\






php artisan db:seed

php artisan db:seed --class=UserTableSeeder
php artisan db:seed --class=BooksAuthorsLikeTableSeeder
php artisan db:seed --class=UserDetailTableSeeder
php artisan db:seed --class=CategoriesBookTableSeeder
php artisan db:seed --class=CategoriesBookRelationTableSeeder
php artisan db:seed --class=BookAuthorRelationTableSeeder

php artisan db:seed --class=PuplishingHouseTableSeeder

php artisan db:seed --class=BookPuplisherRelationsTableSeeder
php artisan db:seed --class=PostCommentsTableSeeder







https://scotch.io/@wisdomanthoni/make-your-laravel-seeder-using-model-factories

https://bagja.net/blog/seeding-table-with-relationships-in-laravel.html


