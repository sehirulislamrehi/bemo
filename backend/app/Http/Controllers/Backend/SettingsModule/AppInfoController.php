<?php

namespace App\Http\Controllers\Backend\SettingsModule;

use App\Http\Controllers\Controller;
use App\Models\SettingsModule\AppInfo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AppInfoController extends Controller
{
    //index function start
    public function index(){
        if( can("app_info") ){
            $app_info = AppInfo::first();
            return view("backend.modules.setting_module.app_info.index", compact("app_info"));
        }
        else{
            return view("errors.403");
        }
    }
    //index function end

    //update function start
    public function update(Request $request, $id){
        if( can("edit_app_info") ){
            try{
                $app_info = AppInfo::find($id);

                if( $request->logo ){
                    if( File::exists('images/info/'. $app_info->logo) ){
                        File::delete('images/info/'. $app_info->logo);
                    }
                    $image = $request->file('logo');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/info/'.$img);
                    Image::make($image)->save($location);
                    $app_info->logo = $img;
                }

                if( $request->footer_logo ){
                    if( File::exists('images/info/'. $app_info->footer_logo) ){
                        File::delete('images/info/'. $app_info->footer_logo);
                    }
                    $image = $request->file('footer_logo');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/info/'.$img);
                    Image::make($image)->save($location);
                    $app_info->footer_logo = $img;
                }

                if( $request->fav ){
                    if( File::exists('images/info/'. $app_info->fav) ){
                        File::delete('images/info/'. $app_info->fav);
                    }
                    $image = $request->file('fav');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/info/'.$img);
                    Image::make($image)->save($location);
                    $app_info->fav = $img;
                }

                if( $request->ad_one ){
                    if( File::exists('images/info/'. $app_info->ad_one) ){
                        File::delete('images/info/'. $app_info->ad_one);
                    }
                    $image = $request->file('ad_one');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/info/'.$img);
                    Image::make($image)->save($location);
                    $app_info->ad_one = $img;
                }

                if( $request->ad_two ){
                    if( File::exists('images/info/'. $app_info->ad_two) ){
                        File::delete('images/info/'. $app_info->ad_two);
                    }
                    $image = $request->file('ad_two');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/info/'.$img);
                    Image::make($image)->save($location);
                    $app_info->ad_two = $img;
                }

                if( $request->banner_image ){
                    if( File::exists('images/info/'. $app_info->banner_image) ){
                        File::delete('images/info/'. $app_info->banner_image);
                    }
                    $image = $request->file('banner_image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/info/'.$img);
                    Image::make($image)->save($location);
                    $app_info->banner_image = $img;
                }

                $app_info->banner_text = $request->banner_text;
                $app_info->about = $request->about;
                $app_info->facebook_url = $request->facebook_url;
                $app_info->linkedin_url = $request->linkedin_url;
                $app_info->youtube_url = $request->youtube_url;
                $app_info->twitter_url = $request->twitter_url;
                $app_info->ad_one_link = $request->ad_one_link;
                $app_info->ad_two_link = $request->ad_two_link;
                $app_info->opening_time = $request->opening_time;
                $app_info->closing_time = $request->closing_time;
                $app_info->email = $request->email;
                $app_info->phone = $request->phone;
                $app_info->address = $request->address;
                $app_info->footer_text = $request->footer_text;

                if( $app_info->save() ){
                    return response()->json(['success' => 'App Info Updated'], 200);
                }

            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
        else{
            return response()->json(['warning' => unauthorized()], 200);
        }
    }
    //update function end
}
