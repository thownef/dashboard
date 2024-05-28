<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Libraries\FileResponseLibraries;
use App\Models\Company;
use App\Models\TCompany;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keyword = request()->query('keyword', '');
        $queryCompany = QueryBuilder::for(Company::class)->with(['category.translate', 'area.translate', 'translate'])
                ->allowedFilters(['country', 'category_id', "area_id"]);
                
        if ($keyword) {
            $queryCompany->whereHas('translate', function ($query) use ($keyword) {
                $query->where('company_name', 'like', '%' . $keyword . '%')
                    ->orWhere('address', 'like', '%' . $keyword . '%')
                    ->orWhere('need', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        $companies= $queryCompany->where('status', 2)->paginate(10)->appends(request()->query());
        return CompanyResource::collection($companies);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $company = Company::with('category.translate', 'area.translate', 'translate')->findOrFail($id);

       return new CompanyResource($company);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $company = Company::where('user_id', $id)->firstOrFail();
        $company->update($request->except('company_logo', 'company_name', 'address', 'need', 'description'));
        $company_logo = $request->file("company_logo");

        if ($request->hasFile('company_logo')) {
            $company_logo = $request->file('company_logo');
            $fileName = "logo_" . $company->id . '.' . $company_logo->getClientOriginalExtension();
            $filePath = "/$company->id/" . $fileName;
            FileResponseLibraries::uploadFile($company_logo, "/$company->id/", $fileName);
            $company->company_logo = $filePath;
            $company->save();
        }
        $company_names = json_decode($request->company_name, true);
        $addresses = json_decode($request->address, true);
        $needs = json_decode($request->need, true);
        $descriptions = json_decode($request->description, true);
        $languages = ['vi', 'en', 'ja'];
        $t_company_datas = ['company_name' => $company_names, 'address' => $addresses, 'need' => $needs, 'description' => $descriptions];
        foreach ($languages as $language) {
            $companyRecord = TCompany::where('company_id', $company->id)->where('language', $language)->first();
            $updateData = [];
            foreach ($t_company_datas as $key => $t_company_data) {
                if (isset($t_company_data[$language])) {
                    $updateData[$key] = $t_company_data[$language];
                }
            }
           
            if ($companyRecord && !empty($updateData)) {
                $companyRecord->update($updateData);
            }
        }

        return response()->json([
            'message' => 'Update company successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function highlight()
    {
        $keyword = request()->query('country', 'Viet Nam');
        $company = Company::where("country", $keyword)
            ->where('highlight', 1)
            ->where('status', 2)
            ->get();

        return CompanyResource::collection($company);
    }
}
