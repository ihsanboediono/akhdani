<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\Client;
use App\Models\History;
use App\Models\News;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {


        // $product = Product::all();
        // $partner = Client::all();
        // $project = Project::all();
        // $news = News::all();

        // $graph_product = [];
        // $graph_partner = [];
        // $graph_project = [];
        // $graph_news = [];
        
        // for ($i=1; $i <= 12; $i++) { 
        //     array_push($graph_product, Product::ByMonth($i)->ThisYear()->count() ?? 0) ;
        // }
        // for ($i=1; $i <= 12; $i++) { 
        //     array_push($graph_partner, Client::ByMonth($i)->ThisYear()->count());
        // }
        // for ($i=1; $i <= 12; $i++) { 
        //     array_push($graph_project, Project::ByMonth($i)->ThisYear()->count());
        // }
        // for ($i=1; $i <= 12; $i++) { 
        //     array_push($graph_news, News::ByMonth($i)->ThisYear()->count());
        // }
        



        // $data = [
        //     'product' => $product->count(),
        //     'partner' => $partner->count(),
        //     'project' => $project->count(),
        //     'news' => $news->count(),
        //     'graph_product' => $graph_product,
        //     'graph_partner' => $graph_partner,
        //     'graph_project' => $graph_project,
        //     'graph_news' => $graph_news,
        // ];
        // return $data;
        return view('admin.index');
    }
}
