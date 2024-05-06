<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campain;
use App\Models\BrandCampain;
use App\Models\Brand;
use App\Traits\ApiTrait;
use App\Http\Requests\CampainRequest;
class CampainController extends Controller
{
    use ApiTrait;

    public function getAllCampains()
    {
        //
        $Campains = Campain::paginate(10);
        return $this->returnData(200, 'this is all campains' ,$Campains);
    }//end method

    public function getReadyCampains()
    {
        //
        $Campains = Campain::where('type', 'ready')->paginate(10);
        return $this->returnData(200, 'this is all ready campains' ,$Campains);
    }//end method

    public function getLiveCampains()
    {
        //
        $Campains = Campain::where('type', 'live')->paginate(10);
        return $this->returnData(200, 'this is all live campains' ,$Campains);
    }//end method

    public function store(CampainRequest $request)
    {
        $brands = Brand::whereIn('id', explode(',',$request->brand_ids))->get();
        if(count($brands) === count(explode(',',$request->brand_ids))){
            $add = new Campain();
            $add->campain_name = $request->campain_name;
            $add->type = $request->type;
            $add->description = $request->description;
            if($request->file('video')){
                $add['video'] = $this->saveFile($request->file('video') , 'uploads/campains');
            }
            $add->save();
            // append brand ids to product in new table
            if($request->brand_ids){
                foreach(explode(',',$request->brand_ids) as $item){
                    $campainItem = new BrandCampain();
                    $campainItem->campain_id = $add->id;
                    $campainItem->brand_id = $item;
                    $campainItem->save();
                }
            }
            $campain = Campain::with('brands')->findOrFail($add->id);

            return $this->returnData(200, 'this is Campain Created Successfully' ,$campain);
        }else{
            return $this->returnError(422, 'your brand ids not exists');
        }

    }


    public function show($id)
    {
        $campain=Campain::find($id);
        if($campain){
            return $this->returnData(200, 'this is Campain' ,$campain);
        }else{
            return $this->returnError(404, 'sorry this Campain Is Not Exists');
        }
    }

    public function update(CampainRequest $request, $id){
        $brands = Brand::whereIn('id', explode(',',$request->brand_ids))->get();
        if(count($brands) === count(explode(',',$request->brand_ids))){
            $campain=Campain::find($id);
            if($campain){
                $campain->campain_name = $request->campain_name;
                $campain->type = $request->type;
                $campain->description = $request->description;
                if($request->file('video')){
                    $campain['video'] = $this->saveFile($request->file('video') , 'uploads/campains', $campain->video);
                }
                $campain->save();

                // delete all data first before append new
                $oldDataCampain = BrandCampain::where('campain_id', $campain->id)->get();
                $oldDataCampain->each(function ($item) {
                    $item->delete();

                });

                // append brand ids to product in new table
                if($request->brand_ids){
                    foreach(explode(',',$request->brand_ids) as $item){
                        $campainItem = new BrandCampain();
                        $campainItem->campain_id = $campain->id;
                        $campainItem->brand_id = $item;
                        $campainItem->save();
                    }
                }
                $campainNew = Campain::with('brands')->findOrFail($campain->id);
        
                return $this->returnData(200, 'this is Campain Updated Successfully' ,$campainNew);
    
            }else{
                return $this->returnError(404, 'sorry this Campain Is Not Exists');
            }
        }else{
            return $this->returnError(422, 'your brand ids not exists');
        }

    }
    
    public function destroy($id){
        $campain=Campain::find($id);
        if($campain){
            // delete image from folder
            @unlink($campain->video);
            $campain->delete();
            return $this->returnSuccess(200, 'your Campain Deleted Successfully');
        }else{
            return $this->returnError(404, 'sorry this Campain Is Not Exists');
        }

    }//end method
}
