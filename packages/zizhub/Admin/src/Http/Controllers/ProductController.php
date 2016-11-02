<?php

namespace Zizhub\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\View;
use Input;
use Validator;
use Auth;
use Paginate;
use Grids;
use HTML;
use Form;
use Nayjest\Grids\Components\Base\RenderableRegistry;
use Nayjest\Grids\Components\ColumnHeadersRow;
use Nayjest\Grids\Components\ColumnsHider;
use Nayjest\Grids\Components\CsvExport;
use Nayjest\Grids\Components\ExcelExport;
use Nayjest\Grids\Components\Filters\DateRangePicker;
use Nayjest\Grids\Components\FiltersRow;
use Nayjest\Grids\Components\HtmlTag;
use Nayjest\Grids\Components\Laravel5\Pager;
use Nayjest\Grids\Components\OneCellRow;
use Nayjest\Grids\Components\RecordsPerPage;
use Nayjest\Grids\Components\RenderFunc;
use Nayjest\Grids\Components\ShowingRecords;  
use Nayjest\Grids\Components\TFoot;
use Nayjest\Grids\Components\THead;
use Nayjest\Grids\Components\TotalsRow;
use Nayjest\Grids\DbalDataProvider;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use App\Http\Controllers\Controller;
use Zizhub\Admin\Models\ProductCode;
//use Zizhub\Admin\Models\ZizhubCoupon;  
//use Zizhub\Admin\Models\ZizhubCouponCode;
use Zizhub\Admin\Http\Requests\ZizhubProductRequest;
use Zizhub\Admin\Http\Requests\ZizhubProductUpdateRequest; 

use Omnipay\Omnipay;
use Illuminate\Support\Facades\Session;
use App\Helpers\Helper as Helper;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\App;
use DB;

//use Inventory\Admin\Http\Requests\MetricRequest;

/**
 * Class MetricController
 */
class ProductController extends Controller {

     public function __construct( Request $request ) {
        //  $this->middleware( 'auth' );
        parent::__construct();

        $ln = $request->segment( 1 );
        $this->ln = $ln;
    }

    


    public function index( Request $request ) {
        
        $lang = $request->segment( 1 );
        $page_title = 'Create Zizhub Product';        
        return view( 'packages::product.index', compact(  'lang' , 'page_title' ) );
    }
    
    public function store_product(ProductCode $zizhubproduct ,ZizhubProductRequest $req)
    {        
        if(!empty(Input::file('product_img')->getClientOriginalName()))
        {
            $name=Input::file('product_img')->getClientOriginalName();            
            Input::file('product_img')->getClientOriginalExtension();
            $uploded=Input::file('product_img')->move('assets/product_image/',$name);
            $zizhubproduct->pname= Input::get('pname') ;
            $zizhubproduct->product_image= $name;
            $zizhubproduct->product_order = Input::get('product_order'); 
            $zizhubproduct->save();
        }
        return Redirect::to( $this->ln . '/zizhub/product/' )
                        ->with( 'flash_alert_notice' , 'Zizhub product was successfully created !' )->with( 'alert_class' , 'alert-success alert-dismissable' );        
    }
    
    public function productlist()
    {
        $page_title = 'Zizhub Product Management';
        $grid = $this->generateGrid( $page_title );
        $grid->setDataProvider(
                new EloquentDataProvider( ProductCode::query()->orderBy( 'id' , 'desc' )  )
        );
        $grid->setColumns( [
                    (new FieldConfig )
                    ->setName( 'id' )
                    ->setLabel( 'ID' )
                    ->setSortable( true )
                    ->setSorting( Grid::SORT_ASC )
                    ,
                    (new FieldConfig )
                    ->setName( 'pname' )
                    ->setLabel( 'Name' )
                    ->setCallback( function ($val) {                        
                        return $val;
                    } )
                    ->setSortable( true )
                    ->addFilter(
                            (new FilterConfig )
                            ->setOperator( FilterConfig::OPERATOR_LIKE )
                    )      
                    ,      
                    (new FieldConfig )
                    ->setName( 'product_order' )
                    ->setLabel( 'Product Order' )
                    ->setSortable( true )
                    ->setSorting( Grid::SORT_ASC )
                    
                    ,
                    (new FieldConfig )
                    ->setName( 'product_image' )
                    ->setLabel( 'Product Image' )
                    ->setSortable( true )
                    ->setCallback( function ($val) {
                        return HTML::image(Config::get( 'app.image_path' ).$val,'',array('height' => '60px','width'=>'92px')) ;
                    } )
                    ->addFilter(
                            (new FilterConfig )
                            ->setOperator( FilterConfig::OPERATOR_LIKE )
                    ) ,
                    (new FieldConfig )
                    ->setName( 'actions' )
                    ->setLabel( 'Actions' )
                    ->setCallback( function ($val , $row ) {
                        $attr = $row->getSrc();
                        $btn = Form::button( '' , array( 'class' => 'no-style fa fa-pencil-square-o' ) );

                        $html = '<a class="pull-left" href="' . ( 'edit/' . $attr->id ) . '" >' . $btn . '</a>';                        
                        return $html;
                    } )
        ] );
        $grid = new Grid( $grid );
        $grid = $grid->render();
        return $this->view( 'packages::products.index' , compact(  'grid' , 'page_title' ) );        
    }
    
    public function productEdit($id='')
    {
        $lang=$this->ln;
        $page_title="Zizhub Edit Product";
        $data=ProductCode::find($id);        
        return $this->view( 'packages::product.edit' , compact(  'lang' , 'page_title','data' ) );        
    }
    
    public function updateProduct(ProductCode $zizhubproduct,ZizhubProductUpdateRequest $req){        
        $product = $zizhubproduct::find(Input::get('hid'));         
        if(Input::file('product_img'))
        {
            if(!empty(Input::file('product_img')->getClientOriginalName()))
            {
                $name=Input::file('product_img')->getClientOriginalName();            
                Input::file('product_img')->getClientOriginalExtension();
                $uploded=Input::file('product_img')->move(Config::get( 'app.image_path' ),$name);
                $product->product_image = $name;
            }
        }                     
                $product->pname = Input::get('pname');
                $product->product_order = Input::get('product_order');  
                                  
                $product->save();                               
            return Redirect::to( $this->ln . '/zizhub/edit/'.Input::get('hid') )
                            ->with( 'flash_alert_notice' , 'Zizhub product was successfully Updated !' )->with( 'alert_class' , 'alert-success alert-dismissable' );                
    }
    
  
}