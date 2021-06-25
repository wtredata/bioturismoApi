<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Service;
use App\Models\Tag;
use App\Models\TypeExperience;
use App\Models\TypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::with('partner.city')->get();

        return $this->successResponse($services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'partner_id' => 'required',
            'type_service_id' => 'required',
            'photo' => 'image'
        ];
        $this->validate($request, $rules);

        $fields = $request->except(['photo']);

        if ($request->has('photo')) {
            $fields['photo'] = $request->photo->store('service', 'public');
        }

        $service = Service::create($fields);

        return $this->successResponse($service);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $service->experiences=$service->experiences;
        $service->albums=$service->albums;
        $service->itineraries=$service->itineraries;
        $service->city = $service->partner->city;
        $service->tags = $service->tags;
        $service->typeExperiences = $service->typeExperiences;
        $service->typeService = $service->typeService;
        $service->dateExperience = $service->dateExperience;
        return $this->successResponse($service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $rules = [
            'photo' => 'image',
        ];
        $this->validate($request, $rules);

        $service->fill($request->except(['photo']));

        if ($request->has('photo')) {
            Storage::disk('public')->delete(explode('storage/',$service->photo)[1]);
            $service->photo = $request->photo->store('service', 'public');
        }

        if($service->isClean()){
            return response()->json("No se hicieron cambios",422);
        }

        $service->save();

        return $this->successResponse($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        Storage::disk('public')->delete(explode('storage/',$service->photo)[1]);
        return $this->successResponse($service);
    }


    /**
     * Services by type of service and city
     *
     * $type: type of service
     * $city: city searched
     * @return \Illuminate\Http\Response
     */
    public function service_city_type(TypeService $type, City $city)
    {
        $services = Service::whereHas('partner', function ($item) use($city){
            $item->where('city_id', $city->id);
        })->where('type_service_id', $type->id)->get();

        return $this->successResponse($services);
    }

    public function addTypeExperienceInService(Service $service, TypeExperience $typeExperience) {
        $service->typeExperiences()->attach($typeExperience->id);
        return $this->successResponse($service->typeExperiences);
    }

    public function delTypeExperienceInService(Service $service, TypeExperience $typeExperience) {
        $service->typeExperiences()->detach($typeExperience->id);
        return $this->successResponse($service);
    }

    public function headerService(Request $request) {
        
        $services = [];
        if ($request->has('city') && $request->has('typeExperience')) {
            $services = Service::with('partner.city')->whereHas('partner', function ($partner) use ($request){
                $partner->where('city_id', $request->city);
            })
            ->whereHas('typeExperiences', function ($typeExperience) use ($request){
                $typeExperience->where('type_experience_id', $request->typeExperience);
            })->get();
        } else {
            if ($request->has('city')) {
                $services = Service::with('partner.city')->whereHas('partner', function ($partner) use ($request){
                    $partner->where('city_id', $request->city);
                })->get();
            }
            if ($request->has('typeExperience')) {
                $services = Service::with('partner.city')->whereHas('typeExperiences', function ($typeExperience) use ($request){
                    $typeExperience->where('type_experience_id', $request->typeExperience);
                })->get();
            }
        }
        if (!$request->has('city') && !$request->has('typeExperience')) {
            $services = Service::with('partner.city')->get();
        }
        return $this->successResponse($services);
    }

    public function addTagInService(Service $service, Tag $tag) {
        $service->tags()->attach($tag->id);
        return $this->successResponse($service->tags);
    }

    public function delTagInService(Service $service, Tag $tag) {
        $service->tags()->detach($tag->id);
        return $this->successResponse($service);
    }

    public function indexRecommended() {
        $services = Service::with('partner.city')->where('recommended', true)->get();
        return $this->successResponse($services);
    }

    public function indexInclusive() {
        $services = Service::with('partner.city')->where('inclusive', true)->get();
        return $this->successResponse($services);
    }

}
