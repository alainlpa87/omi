<?php namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tradeshow;
use Illuminate\Support\Facades\Input;
use DB;

class landToolsController extends Controller {


    public function __construct()
    {

    }
    /*
     * Send to the index view the
     *
     * @return Response
     */
    public function tradeshows()
    {
        $year = date("Y");
        $nextYear = Tradeshow::where('year',$year+1)->get();
        $currentYear = Tradeshow::where('year',$year)->get();
        $prevYear = Tradeshow::where('year',$year-1)->get();
        $prevPrevYear = Tradeshow::where('year',$year-2)->get();
        return view("omi.land.tradeShows",array('nextYear'=>$nextYear,'currentYear'=>$currentYear,'prevYear'=>$prevYear,'prevPrevYear'=>$prevPrevYear,'year'=>$year));
    }

    public function learnIndex($title){
        $title = str_replace("-", " ",$title);
        $article = Article::where('title',$title)->first();
        $content = strtr ($article->content, array ('img/' => '../img/'));
        $content = strtr ($content, array ('href="' => 'href="../'));
        $content = strtr ($content, array ('href="../http' => 'href="http'));
        $articles = Article::orderBy('title')->get();
        return view("omi.land.learningCenter",array('articles'=>$articles,'content'=>$content,'title'=>$title,'titlehtml'=>$article->titlehtml,'descriptionhtml'=>$article->descriptionhtml));
    }

    public function learningArt(){
        $title = Input::get('TITLE');
        $title = str_replace("-", " ",$title);
        $article = Article::where('title',$title)->first();
        if($article!=null)
            $content = strtr ($article->content, array ('img/' => '../img/'));
        $content = strtr ($content, array ('href="' => 'href="../'));
        $content = strtr ($content, array ('href="../http' => 'href="http'));
        $article->content = $content;
        return json_encode($article);
        return -1;
    }

}
