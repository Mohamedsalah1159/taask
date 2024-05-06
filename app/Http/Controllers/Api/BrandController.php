<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Traits\ApiTrait;
use App\Http\Requests\BrandRequest;
class BrandController extends Controller
{
    use ApiTrait;

    public function getAllBrands()
    {
        //
        $brands = Brand::get();
        return $this->returnData(200, 'this is all Brands' ,$brands);
    }//end method

    public function store(BrandRequest $request)
    {
        $add = new Brand();
        $add->brand_name = $request->brand_name;

        if($request->file('image')){
            $add['image'] = $this->saveFile($request->file('image') , 'uploads/brands');
        }
        $add->save();

        return $this->returnData(200, 'this is Brand Created Successfully' ,$add);
    }


    public function show($id)
    {
        $brand=Brand::find($id);
        if($brand){
            return $this->returnData(200, 'this is Brand' ,$brand);
        }else{
            return $this->returnError(404, 'sorry this Brand Is Not Exists');
        }
    }

    public function update(BrandRequest $request, $id){

        $brand=Brand::find($id);
        if($brand){
            $brand->brand_name = $request->brand_name;
            if($request->file('image')){
                $brand['image'] = $this->saveFile($request->file('image') , 'uploads/brands', $brand->image);
            }
            $brand->save();
    
            return $this->returnData(200, 'this is Brand Updated Successfully' ,$brand);

        }else{
            return $this->returnError(404, 'sorry this Brand Is Not Exists');
        }
    }
    
    public function destroy($id){
        $brand=Brand::find($id);
        if($brand){
            // delete image from folder
            @unlink($brand->image);
            $brand->delete();
            return $this->returnSuccess(200, 'your Brand Deleted Successfully');
        }else{
            return $this->returnError(404, 'sorry this Brand Is Not Exists');
        }

    }//end method
}
