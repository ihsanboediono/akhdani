<?php



function model($get)
{
    $name = explode('/', $get);
    $content = file_get_contents($get);
    $myfile = fopen('app/Models/'. end($name) , "w+") or die("Unable to open file!");
    fwrite($myfile, $content);
    fclose($myfile);
}

function controler($get)
{
    $name = explode('/', $get);
    $content = file_get_contents($get);
    $myfile = fopen('app/Http/Controllers/Admin/'. end($name), "w+") or die("Unable to open file!");
    fwrite($myfile, $content);
    fclose($myfile);
}

function controler_user($get)
{
    $name = explode('/', $get);
    if (!is_dir('app/Http/Controllers/User')) {
        mkdir('app/Http/Controllers/User', 0777, true);
    }
    $content = file_get_contents($get);
    $myfile = fopen('app/Http/Controllers/User/'. end($name), "w+") or die("Unable to open file!");
    fwrite($myfile, $content);
    fclose($myfile);
}

function migrasi($get)
{
    $name = explode('/', $get);
    $content = file_get_contents($get);
    $myfile = fopen('database/migrations/'. end($name), "w+") or die("Unable to open file!");
    fwrite($myfile, $content);
    fclose($myfile);
}

function seed($get)
{
    $name = explode('/', $get);
    $content = file_get_contents($get);
    $myfile = fopen('database/seeders/'. end($name), "w+") or die("Unable to open file!");
    fwrite($myfile, $content);
    fclose($myfile);
}

function zip($get)
{
    $name = explode('/', $get);
    $content = file_get_contents($get);
    $myfile = fopen('public/'. end($name), "w+") or die("Unable to open file!");
    fwrite($myfile, $content);
    fclose($myfile);
}

function viewss($get)
{
    $names = explode('/', $get);
    $file = end($names);
    $content = file_get_contents($get);
    $a = 1;
    $lock = '';
    foreach ($names as $name) {
        if ($a > 7) {
            $lock .= '/'. $name;
            if ($name != $file) {
                if (!is_dir('resources/views/admin'.$lock)) {
                    mkdir('resources/views/admin'.$lock, 0777, true);
                }
            }
        }
        $a++;
    }
    $myfile = fopen('resources/views/admin'. $lock, "w+") or die("Unable to open file!");
    fwrite($myfile, $content);
    fclose($myfile);
}

function viewss_user($get)
{
    $names = explode('/', $get);
    $file = end($names);
    $content = file_get_contents($get);
    $a = 1;
    $lock = '';
    if (!is_dir('resources/views/user')) {
        mkdir('resources/views/user', 0777, true);
    }
    foreach ($names as $name) {
        if ($a > 8) {
            $lock .= '/'. $name;
            if ($name != $file) {
                if (!is_dir('resources/views/user'.$lock)) {
                    mkdir('resources/views/user'.$lock, 0777, true);
                }
            }
        }
        $a++;
    }
    $myfile = fopen('resources/views/user'. $lock, "w+") or die("Unable to open file!");
    fwrite($myfile, $content);
    fclose($myfile);
}

function routes($isinya)
{
    $content = file_get_contents('routes/web.php');
    $split = explode('// add //', $content);

    $isi = $split[0]. $isinya. $split[1];
    $myfile = fopen('routes/web.php', "w+") or die("Unable to open file!");
    fwrite($myfile, $isi);
    fclose($myfile);
}

function routes_user($isinya)
{
    $content = file_get_contents('routes/web.php');
    $split = explode('// home //', $content);

    $isi = $split[0]. $isinya. $split[1];
    $myfile = fopen('routes/web.php', "w+") or die("Unable to open file!");
    fwrite($myfile, $isi);
    fclose($myfile);
}

function banner()
{
    echo "\n";
    echo "    ______  __    __   _______     ___      .______    __      ____    ____  \n";
    echo "   /      ||  |  |  | |   ____|   /   \     |   _  \  |  |     \   \  /   / \n";
    echo "  |  ,----'|  |__|  | |  |__     /  ^  \    |  |_)  | |  |      \   \/   /  \n";
    echo "  |  |     |   __   | |   __|   /  /_\  \   |   ___/  |  |       \_    _/   \n";
    echo "  |  `----.|  |  |  | |  |____ /  _____  \  |  |      |  `----.    |  |     \n";
    echo "   \______||__|  |__| |_______/__/     \__\ | _|      |_______|    |__|     \n";
    echo "  \n  Welcome To Cheaply Generator!\n";
    echo "  List fitur yang dapat di install\n";
    echo "  1. News\n";
    echo "  2. Profil Perusahaan\n";
    echo "  3. Visi\n";
    echo "  4. Misi\n";
    echo "  5. Client\n";
    echo "  6. Partner\n";
    echo "  7. Sejarah\n";
    echo "  8. Susunan Pengurus\n";
    echo "  9. Produk\n";
    echo "  10. Proyek\n";
    echo "  11. Karir\n";
    echo "  12. Layanan\n";
    echo "  13. Laporan Tahunan\n";
    echo "  14. Vidio Header\n";
    echo "  15. Awards\n";
    echo "  16. Testimony\n";
    menu();

                                                                             
}


function menu()
{
    $input = readline('pilih fitur yang akan kamu install ? (1-10): ');
    switch ($input) {
        case 1 :
            echo "\n\n Mengambil data Berita \n\n";

            //model
            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/NewsCategory.php');
            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/News.php');
            
            // migrasi
            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_03_28_072755_create_news_categories_table.php');
            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_03_28_073419_create_news_table.php');
            
            // controller
            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/NewsCategoryController.php');
            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/NewsController.php');

            //view
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/news/category/add.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/news/category/edit.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/news/category/index.blade.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/news/add.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/news/edit.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/news/index.blade.php');

            $content = "Route::prefix('news')->group(function () {
                Route::name('news.')->group(function () {
                    //news category
                    Route::group(['prefix' => 'category', 'controller' => NewsCategoryController::class], function () {
                        Route::name('category.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::post('/data', 'data')->name('data');
                            Route::get('/edit/{NewsCategory}', 'edit')->name('edit');
                            Route::put('/edit/{NewsCategory}', 'update')->name('update');
                            Route::delete('/{NewsCategory}', 'destroy')->name('delete');
                        });
                    });
        
                    //news
                    Route::group(['controller' => NewsController::class], function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::post('/data', 'data')->name('data');
                        Route::get('/edit/{news}', 'edit')->name('edit');
                        Route::put('/edit/{news}', 'update')->name('update');
                        Route::delete('/{news}', 'destroy')->name('delete');
                    });
                });
            });
        
            // add //";

            routes($content);


            break;
        case 2 :
            
            echo "\n\n Mengambil data Profil Perusahaan\n\n";

            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/CompanyProfile.php');

            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_03_28_072025_create_company_profiles_table.php');

            seed('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/benih/CompanySeeder.php');

            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/CompanyProfileController.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/about-company/edit.blade.php');

            $content = "//Company Profile
            Route::group(['prefix' => 'company', 'controller' => CompanyProfileController::class], function () {
                Route::name('company.')->group(function () {
                    Route::get('', 'edit')->name('index');
                    Route::put('', 'update')->name('update');
                });
            });
        
            // add //";

            routes($content);

            break;
        case 3 :
            echo "\n\n Base Visi \n\n";

            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/Vision.php');

            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_03_28_070500_create_visions_table.php');

            seed('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/benih/MissionSeeder.php');

            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/VisionController.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/about-vision/edit.blade.php');

            $content = "// vision
            Route::group(['prefix' => 'vision', 'controller' => VisionController::class], function () {
                Route::name('vision.')->group(function () {
                    Route::get('', 'edit')->name('index');
                    Route::put('', 'update')->name('update');
                });
            });
        
            // add //";

            routes($content);
            break;
        case 4 :
            echo "\n\n Base Misi \n\n";

            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/Mission.php');

            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_03_28_064945_create_missions_table.php');

            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/MissionController.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/about-mision/edit.blade.php');

            $content = "// mission
            Route::group(['prefix' => 'mission', 'controller' => MissionController::class], function () {
                Route::name('mission.')->group(function () {
                    Route::get('', 'edit')->name('index');
                    Route::put('', 'update')->name('update');
                });
            });
        
            // add //";

            routes($content);
            break;
        case 5 :
            echo "\n\n Base Client \n\n";

            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/Client.php');

            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_04_06_010039_create_clients_table.php');

            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/ClientController.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/about-client/edit.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/about-client/add.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/about-client/index.blade.php');

            $content = "//Client
            Route::group(['prefix' => 'client', 'controller' => ClientController::class], function () {
                Route::name('client.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/add', 'store')->name('store');
                    Route::post('/data', 'data')->name('data');
                    Route::get('/edit/{client}', 'edit')->name('edit');
                    Route::put('/edit/{client}', 'update')->name('update');
                    Route::delete('/{client}', 'destroy')->name('delete');
                });
            });
        
            // add //";

            routes($content);
            break;
        case 6 :
            echo "\n\n Base Partner\n\n";

            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/Partner.php');

            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2023_02_24_151451_create_partners_table.php');

            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/PartnerController.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/about-partner/edit.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/about-partner/add.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/about-partner/index.blade.php');

            $content = "//Partner
            Route::group(['prefix' => 'partner', 'controller' => PartnerController::class], function () {
                Route::name('partner.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/add', 'store')->name('store');
                    Route::post('/data', 'data')->name('data');
                    Route::get('/edit/{partner}', 'edit')->name('edit');
                    Route::put('/edit/{partner}', 'update')->name('update');
                    Route::delete('/{partner}', 'destroy')->name('delete');
                });
            });
        
            // add //";

            routes($content);
            break;
        case 7 :
            echo "\n\n Base Sejarah\n\n";

            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/History.php');

            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_03_28_064004_create_histories_table.php');

            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/HistoryController.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/about-history/edit.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/about-history/add.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/about-history/index.blade.php');

            $content = "//History
            Route::group(['prefix' => 'history', 'controller' => HistoryController::class], function () {
                Route::name('history.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/add', 'store')->name('store');
                    Route::post('/data', 'data')->name('data');
                    Route::get('/edit/{history}', 'edit')->name('edit');
                    Route::put('/edit/{history}', 'update')->name('update');
                    Route::delete('/{history}', 'destroy')->name('delete');
                });
            });
        
            // add //";

            routes($content);
            break;
        case 8 :
            echo "\n\n Base Susunan Pengurus\n\n";

            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/Management.php');

            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_04_06_010303_create_management_table.php');

            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/ManagementController.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/management/add.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/management/edit.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/management/index.blade.php');

            $content = "// management
            Route::group(['prefix' => 'management', 'controller' => ManagementController::class], function () {
                Route::name('management.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::post('', 'store')->name('store');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/data', 'data')->name('data');
                    Route::get('/edit/{management:id}', 'edit')->name('edit');
                    Route::put('/edit/{management:id}', 'update')->name('update');
                    Route::delete('/{management:id}', 'destroy')->name('delete');
                });
            });
        
            // add //";

            routes($content);
            break;
        case 9 :
            echo "\n\n Base Produk\n\n";
            //model
            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/ProductCategory.php');
            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/Product.php');

            // migrasi
            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_03_28_075348_create_product_categories_table.php');
            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_03_28_075425_create_products_table.php');

            // controller
            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/Product/ProductCategoryController.php');
            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/Product/ProductController.php');

            //view
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/product-category/add.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/product-category/edit.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/product-category/index.blade.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/products/add.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/products/edit.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/products/index.blade.php');

            $content = "Route::prefix('product')->group(function () {
                Route::name('product.')->group(function () {
                    // product category
                    Route::group(['prefix' => 'category', 'controller' => ProductCategoryController::class], function () {
                        Route::name('category.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::post('/data', 'data')->name('data');
                            Route::get('/edit/{productCategory:id}', 'edit')->name('edit');
                            Route::put('/edit/{productCategory:id}', 'update')->name('update');
                            Route::delete('/{productCategory:id}', 'destroy')->name('delete');
                        });
                    });

                    //product
                    Route::group(['controller' => ProductController::class], function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::post('/data', 'data')->name('data');
                        Route::get('/edit/{product:id}', 'edit')->name('edit');
                        Route::put('/edit/{product:id}', 'update')->name('update');
                        Route::delete('/{product:id}', 'destroy')->name('delete');
                    });
                });
            });

            // add //";

            routes($content);
            break;
        case 10 :
            echo "\n\n Base Proyek\n\n";

            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/Project.php');

            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_03_28_080501_create_projects_table.php');

            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/ProjectController.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/projects/add.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/projects/edit.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/projects/index.blade.php');

            $content = "// project
            Route::group(['prefix' => 'project', 'controller' => ProjectController::class], function () {
                Route::name('project.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::post('', 'store')->name('store');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/data', 'data')->name('data');
                    Route::get('/edit/{project:id}', 'edit')->name('edit');
                    Route::put('/edit/{project:id}', 'update')->name('update');
                    Route::delete('/{project:id}', 'destroy')->name('delete');
                });
            });
        
            // add //";

            routes($content);
            break;
        case 11 :
            echo "\n\n Base Karir\n\n";

            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/Career.php');

            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_03_28_063428_create_careers_table.php');

            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/CareerController.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/career/add.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/career/edit.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/career/index.blade.php');

            $content = "//Career
            Route::group(['prefix' => 'career', 'controller' => CareerController::class], function () {
                Route::name('career.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/add', 'store')->name('store');
                    Route::post('/data', 'data')->name('data');
                    Route::get('/edit/{career}', 'edit')->name('edit');
                    Route::put('/edit/{career}', 'update')->name('update');
                    Route::delete('/{career}', 'destroy')->name('delete');
                });
            });
        
            // add //";

            routes($content);
            break;
        case 12 :
            echo "\n\n Base Layanan\n\n";

            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/Service.php');

            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_03_28_080745_create_services_table.php');

            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/ServiceController.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/services/add.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/services/edit.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/services/index.blade.php');

            $content = "//Service
            Route::group(['prefix' => 'service', 'controller' => ServiceController::class], function () {
                Route::name('service.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/add', 'store')->name('store');
                    Route::post('/data', 'data')->name('data');
                    Route::get('/edit/{service}', 'edit')->name('edit');
                    Route::put('/edit/{service}', 'update')->name('update');
                    Route::delete('/{service}', 'destroy')->name('delete');
                });
            });
        
            // add //";

            routes($content);
            break;
        case 13 :
            echo "\n\n Base Laporan Tahunan\n\n";

            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/AnnualReport.php');

            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_03_28_071738_create_annual_reports_table.php');

            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/AnnualReportController.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/anual-report/add.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/anual-report/edit.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/anual-report/index.blade.php');

            $content = "//Annual Report
            Route::group(['prefix' => 'report', 'controller' => AnnualReportController::class], function () {
                Route::name('report.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/add', 'store')->name('store');
                    Route::post('/data', 'data')->name('data');
                    Route::get('/edit/{AnnualReport}', 'edit')->name('edit');
                    Route::put('/edit/{AnnualReport}', 'update')->name('update');
                    Route::delete('/{AnnualReport}', 'destroy')->name('delete');
                    Route::get('/download/{AnnualReport}', 'downoad')->name('donload');
                });
            });
        
            // add //";

            routes($content);
            break;
        case 14 :
            echo "\n\n Base Vidio Header \n\n";

            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/HeaderVideo.php');

            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_03_28_072310_create_header_videos_table.php');

            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/VideoController.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/video/video.blade.php');

            $content = "// Video
            Route::group(['prefix' => 'video', 'controller' => VideoController::class], function () {
                Route::name('video.')->group(function () {
                    Route::get('', 'edit')->name('index');
                    Route::put('', 'update')->name('update');
                });
            });
        
            // add //";

            routes($content);
            break;
        case 15 :
            echo "\n\n Base Awards \n\n";

            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/Award.php');

            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2022_03_28_062037_create_awards_table.php');

            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/AwardController.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/about-awards/edit.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/about-awards/add.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/about-awards/index.blade.php');

            $content = "//Award
            Route::group(['prefix' => 'award', 'controller' => AwardController::class], function () {
                Route::name('award.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::post('', 'store')->name('store');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/data', 'data')->name('data');
                    Route::get('/edit/{award:id}', 'edit')->name('edit');
                    Route::put('/edit/{award:id}', 'update')->name('update');
                    Route::delete('/{award:id}', 'destroy')->name('delete');
                });
            });
        
            // add //";

            routes($content);
            break;
        case 16 :
            echo "\n\n Base Testimony \n\n";

            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/Testimony.php');

            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2023_03_28_064906_create_testimonies_table.php');

            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/TestimonyController.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/testimony/edit.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/testimony/add.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/testimony/index.blade.php');
            
            $content = "//testimony
            Route::group(['prefix' => 'testimony', 'controller' => TestimonyController::class], function () {
                Route::name('testimony.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::post('', 'store')->name('store');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/data', 'data')->name('data');
                    Route::get('/edit/{testimony:id}', 'edit')->name('edit');
                    Route::put('/edit/{testimony:id}', 'update')->name('update');
                    Route::delete('/{testimony:id}', 'destroy')->name('delete');
                });
            });
            
            // add //";

            routes($content);
            break;
        case 17 :

            // composer install
            if (!is_dir('vendor')) {
                echo shell_exec('composer install');
            }


            // buat file .env 
            if (!file_exists('.env')) {
                $env = file_get_contents('.env.example'); // ambil data env dari .env.example
                $myfile = fopen(".env", "w") or die("Unable to open file!");
                fwrite($myfile, $env);
                fclose($myfile);
            } else{
                echo "env sudah ada \n";
            }



            echo "\n\n Base Testimony \n\n";

            model('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Models/Testimony.php');

            migrasi('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/migrasi/2023_03_28_064906_create_testimonies_table.php');

            controler('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Admin/TestimonyController.php');

            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/testimony/edit.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/testimony/add.blade.php');
            viewss('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/admin/testimony/index.blade.php');

            $content = "//testimony
            Route::group(['prefix' => 'testimony', 'controller' => TestimonyController::class], function () {
                Route::name('testimony.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::post('', 'store')->name('store');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/data', 'data')->name('data');
                    Route::get('/edit/{testimony:id}', 'edit')->name('edit');
                    Route::put('/edit/{testimony:id}', 'update')->name('update');
                    Route::delete('/{testimony:id}', 'destroy')->name('delete');
                });
            });
        
            // add //";
            routes($content);

            echo shell_exec('php artisan migrate:fresh --seed');
            echo shell_exec('php artisan storage:link');

            controler_user('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Fashionbody/controller/HomeController.php');

            zip('https://github.com/ihsanboediono/ihsan/raw/main/Fashionbody/public/public.zip');

            $zip = new ZipArchive;
  
            // Zip File Name
            if ($zip->open('public/public.zip') === TRUE) {
            
                // Unzip Path
                $zip->extractTo('public/');
                $zip->close();
                unlink('public/public.zip');
            } else {
                echo 'Unzipped Process failed';
            }
            
            viewss_user('https://raw.githubusercontent.com/ihsanboediono/ihsan/main/Fashionbody/view/home.blade.php');

            $home = "Route::get('/', [HomeController::class, 'index'])->name('user.home');
            
// home //";
            routes_user($home);



            break;

        default :
            echo "\n\n Tidak ditemukan dalam daftar\n\n";
            exit();
    }
    banner();
}

banner();


?>
